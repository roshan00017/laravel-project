<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileUploadLibraryHelper
{
    /* delete existing file  form path  */
    public static function deleteExistingFile($fileName, $filePath)
    {
        @unlink(storage_path().'/app/public/'.$filePath.'/'.$fileName);
    }

    /* set upload file name */
    public static function setFileUploadName($file, $fileName): string
    {
        $fileExtension = $file->getClientOriginalExtension();

        return $fileName.date('YmdHis').'.'.strtolower($fileExtension);
    }

    /* set upload file path library */
    public static function setFileUploadPath($file, $fileName, $filePath, $fileWidth = null, $fileHeight = null)
    {
        Storage::putFileAs('public/'.$filePath, $file, $fileName);
        $fileExtension = $file->getClientOriginalExtension();
        if ($fileWidth != null && $fileHeight != null) {
            if ($fileExtension == 'pdf') {
                storage_path().'/app/public/'.$filePath.'/'.$fileName;
            } else {
                Image::make(storage_path().'/app/public/'.$filePath.'/'.$fileName)->resize($fileWidth, $fileHeight)->save();
            }
        } else {
            if ($fileExtension == 'pdf') {
                storage_path().'/app/public/'.$filePath.'/'.$fileName;
            } else {
                Image::make(storage_path().'/app/public/'.$filePath.'/'.$fileName)->save();
            }
        }
    }

    /* update existing file only   */
    public static function updateUploadedFile($model, $id, $column_name, $file, $fileTitle, $filePath, $fileWidth = null, $fileHeight = null)
    {
        try {
            $id = (int) $id;
            $value = $model->find($id);
            if ($value) {
                if ($column_name != null && $fileTitle != null && $file != null) {
                    $fileName = FileUploadLibraryHelper::setFileUploadName($file, $fileTitle);
                    $imageSuccess = true;
                    if ($value->$column_name != null) {
                        FileUploadLibraryHelper::deleteExistingFile($value->$column_name, $filePath);
                    }
                    $update = $model::where('id', $id)->update([$column_name => $fileName]);
                    if ($update) {
                        if (isset($imageSuccess)) {
                            FileUploadLibraryHelper::setFileUploadPath($file, $fileName, $filePath, $fileWidth, $fileHeight);
                        }
                        session()->flash('success', Lang::get('message.commons.imageUploadSuccess'));
                    }
                } else {
                    session()->flash('error', Lang::get('message.commons.imageUploadFailed'));
                }

                return back();
            }
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    /* delete existing uploaded file from path & database table */
    public static function deleteUploadedFile($model, $id, $column, $filePath)
    {
        $id = (int) $id;
        try {
            $value = $model->find($id);
            if ($value) {
                FileUploadLibraryHelper::deleteExistingFile($value->$column, $filePath);
                $model::where('id', $id)->update([$column => null]);
                session()->flash('success', Lang::get('message.commons.imageDeletedSuccess'));
            } else {
                session()->flash('error', Lang::get('message.commons.imageDeletedFailed'));
            }

            return back();
        } catch (Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
