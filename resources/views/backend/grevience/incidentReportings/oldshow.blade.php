<div class="modal fade" id="showModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ getLan() == 'np' ? 'सुझाव' : 'Suggestion' }} {{ trans('message.pages.roles.details') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6 {{ setFont() }}">
                        <label for="">
                            {{ trans('suggestion.date_time') }}
                        </label>
                        @php
                            $time = \Carbon\Carbon::parse($data->created_at)->format('g:i A');
                        @endphp
                        @if (isset($data->incident_submit_date_np))
                            <input type="text" class="form-control"
                                value="{{ getLan() == 'np' ? $data->incident_submit_date_np : $data->incident_submit_date_en }} {{ $time }}"
                                readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class=" row container {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.incident_reporter_details') }} :

                                </label>
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.name') }}
                                </label>
                                @if (isset($data->name))
                                    <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.mobile_no') }}
                                </label>
                                @if (isset($data->mobile))
                                    <input type="text" class="form-control" value="{{ $data->mobile }}" readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.email') }}
                                </label>
                                @if (isset($data->email))
                                    <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.address') }}
                                </label>
                                @if (isset($data->address))
                                    <input type="text" class="form-control" value="{{ $data->address }}" readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.latitude') }}
                                </label>
                                @if (isset($data->latitude))
                                    <input type="text" class="form-control" value="{{ $data->latitude }}" readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.longitude') }}
                                </label>
                                @if (isset($data->longitude))
                                    <input type="text" class="form-control" value="{{ $data->longitude }}" readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="modal-body">
                        <div class="row">
                            <div class="row container {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.incident_details') }} :
                                </label>
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.incident_title') }}
                                </label>
                                @if (isset($data->title))
                                    <input type="text" class="form-control" value="{{ $data->title }}" readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('incidentReport.incident_description') }}
                                </label>
                                @if (isset($data->description))
                                    <input type="text" class="form-control" value="{{ $data->description }}"
                                        readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ setFont() }}">
                                <label for="">
                                    {{ trans('suggestion.file') }}
                                </label>
                                @if($data->file != null)
                                    @php
                                        $fileNames = explode(',', $data->file);
                                    @endphp
                                    @foreach($fileNames as $fileName)
                                        <a href="{{URL::to('/storage/'.'app/public/documents/incidents'.'/'.$fileName)}}"
                                           target="_blank"
                                           class="btn btn-secondary btn-xs rounded-pill"
                                           data-placement="top"
                                           title="{{trans('message.pages.common.viewFile')}}"
                                        >
                                            <i class="fa fa-file"></i>
                                        </a>
                                        &nbsp;

                                        <br> <!-- Add line break between files -->
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-danger rounded-pill {{ setFont() }}"
                            data-dismiss="modal">
                            <i class="fa fa-times-circle"></i>
                            {{ trans('message.button.close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
