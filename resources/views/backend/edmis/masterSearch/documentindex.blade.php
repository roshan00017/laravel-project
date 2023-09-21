@if(sizeof($results) > 0)
<div class="table-responsive">
<table id="example2"
            class="table table-bordered table-striped dataTable dtr-inline">
    
        <thead class="th-header">
        <tr class="{{setFont()}}">
            <th width="10px">
                {{ trans('message.commons.s_n') }}
            </th>
        <th>
        {{trans('dcDocument.dc_document.fiscal_year')}}
        </th>
        <th>
            {{trans('dcDocument.dc_document.registration_number')}}
        </th>
        <th>
        {{trans('dcDocument.dc_document.registration_date')}}
        </th>

        <th>
        {{trans('dcDocument.dc_document.letter_sending_depart')}}
        </th>

        <th>
        {{trans('dcDocument.dc_document.letter_receiving_depart')}}
        </th>

        <th>
        {{trans('dcDocument.dc_document.letter_receiving_person')}}
        </th>
        <th>
            {{trans('dcDocument.dc_document.duration')}}
        </th>

        </tr>
        </thead>
        <tbody>
        @foreach($results as $key=>$data)
            <tr>
                <th scope="row {{setFont()}}">
                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                </th>
                <td>
                    @if(isset($data->fiscal))
                        {{ @$data->fiscal->code }}
                    @endif
                </td>
                
                <td>
                    @if(isset($data->regd_no))
                        {{ $data->regd_no }}
                    @endif
                </td>
                
                <td>
                    @if(isset($data->regd_date_bs))
                        {{ $data->regd_date_bs }}
                    @endif
                </td>
                
                <td>
                </td>
                
                <td>
                    @if(isset($data->office))
                        {{ getLan() == 'np' ? @$data->office->name_np : @$data->office->name_en }}
                    @endif
                </td>
                
                <td>
                    @if(isset($data->patraReceiver))
                        {{ getLan() == 'np' ? $data->patraReceiver->first_name_np : $data->patraReceiver->first_name_en }}
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