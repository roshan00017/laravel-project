@if(sizeof($results) > 0)
<div class="table-responsive">
<table id="example2"
                class="table table-bordered table-striped dataTable dtr-inline"
        >
            <thead class="th-header">
            <tr class="{{setFont()}}">
                <th rowspan="2">
                    {{ trans('message.commons.s_n') }}
                </th>
                <th rowspan="2">
                    {{ trans('dispatch.dispatch_data.dispatch_no') }}
                </th>
               
                <th rowspan="2">
                    {{ trans('dispatch.dispatch_data.dispatch_date_bs') }}
                </th>
                <th rowspan="2">
                {{ trans('dispatch.dispatch_data.invoicing_person') }}
                </th>
                <th rowspan="2">
                    {{ trans('dispatch.dispatch_data.letter_no') }}
                </th>

                <th rowspan="2">
                {{ trans('dartaKitab.dc_register_book.letter_status') }}
                </th>

                <th rowspan="2">
                {{ trans('dispatch.dispatch_data.letter_date_bs') }}
                </th>


                <th rowspan="2">
                {{ trans('dispatch.dispatch_data.file_type') }}
                </th>

                

                <th rowspan="2">
                {{ trans('dispatch.dispatch_data.sent_medium') }}
                </th>

                <th rowspan="2">
                {{ trans('dispatch.dispatch_data.from_branch_id') }}
                </th>

                


                <th rowspan="2">
                {{ trans('dartaKitab.dc_register_book.letter_receiving_person') }}
                </th>

                <th colspan="3" >
                    {{ trans('dartaKitab.dc_register_book.header') }}
                
                
                </th>

                
                </tr>
                <tr>
                    <th> {{ trans('dartaKitab.dc_register_book.header1') }}</th>
                    <th> {{ trans('dartaKitab.dc_register_book.header2') }}</th>
                    <th> {{ trans('dartaKitab.dc_register_book.header3') }}</th>
                </tr>

            
            
                

                
            </tr>
            </thead>
            <tbody>
            @foreach($results as $key=>$data)
                <tr>
                    <th scope="row {{setFont()}}">
                        {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                    </th>
                    <td>
                    @if(isset($data->dispatch_no))
                        {{ $data->dispatch_no }}
                    @endif
                    </td>

                    <td>
                    @if(isset($data->dispatch_date_bs))
                        {{ $data->dispatch_date_bs }}
                    @endif

                    </td>
                    <td>
                    {{ @$data->user->full_name }}
                    </td>
                    <td>
                    @if(isset($data->letter_no))
                        {{ $data->letter_no }}
                    @endif

                    <td>

                       @if(isset($data->status->name_np))
                        {{ $data->status->name_np }}
                     @endif

                    </td>


    
                    <td>
                       
                    @if (isset($data->letter_date_bs))
                        {{getLan() =='np' ? $data->letter_date_bs :  $data->letter_date_bs}}
                    @endif
                    </td>

                    <td>
                    @if(isset($data->file->name_np))
                    {{ getLan() =='np' ? $data->file->name_np : $data->file->name_en}}
                    @endif

                    </td>

                    <td>
                    @if(isset($data->file->name_np))
                    {{ getLan() =='np' ? $data->medium->name_np : $data->medium->name_en}}
                    @endif

                    </td>

                    <td class="{{setFont()}}">
                        @if(isset($data->branch->name_np))
                            {{getLan() == 'np'? $data->branch->name_np : $data->branch->name_en}}
                        @endif
                    </td>

                    <td >
                   

                    </td>
                    <td>
                        @if(isset($data->office))
                            {{ getLan() == 'np' ? @$data->office->name_np : @$data->office->name_en}}
                        @endif
                    </td>
                    
                    <td>
                        @if(isset($data->contact_person))
                            {{ $data->contact_person }}
                        @endif
                    </td>
                    
                    <td>
                        @if(isset($data->contact_address))
                            {{ $data->contact_address }}
                        @endif
                    </td>
                      
                </tr>
              

            @endforeach
            </tbody>
        </table>
</div>

@else
                        <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
                            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{trans('message.commons.no_record_found')}}
                            </label>
                        </div>

                        @endif