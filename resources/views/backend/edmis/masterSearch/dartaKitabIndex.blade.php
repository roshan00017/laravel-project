@if(sizeof($results) > 0)
<div class="table-responsive">
 <table id="example2"
        class="table table-bordered table-striped dataTable dtr-inline">

    <thead class="th-header">
    <tr class="{{setFont()}}">
        <th rowspan="2" >
            {{ trans('message.commons.s_n') }}
        </th>
        <th rowspan="2">
            {{getLan() =='np' ? trans('dartaKitab.dc_register_book.Date_of_Registration_np'): trans('dartaKitab.dc_register_book.Date_of_Registration_en') }}
        </th>
        <th rowspan="2">
            {{ trans('dartaKitab.dc_register_book.Registration_no') }}
        </th>

        <th rowspan="2">
            {{ trans('dartaKitab.dc_register_book.invoice_no') }}
        </th>

        <th rowspan="2">
            {{ trans('dartaKitab.dc_register_book.letter_no') }}
        </th>


        <th rowspan="2">
            {{ trans('dartaKitab.dc_register_book.subject_of_the_letter') }}
        </th>

        <th rowspan="2">
        {{ trans('dartaKitab.dc_register_book.letter_status') }}
        </th>

        <th rowspan="2">
        {{ trans('dartaKitab.dc_register_book.registering_person') }}
        </th>

        <th rowspan="2">
        {{ trans('dartaKitab.dc_register_book.letter_receiving_depart') }}
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
    
    
    </thead>
    <tbody>
    @foreach($results as $key=>$data)
        <tr>
            <th scope="row {{setFont()}}">
                {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
            </th>
            

            <td>
                @if(isset($data->regd_date_bs))
                    {{ getLan() == 'np' ? $data->regd_date_bs : $data->regd_date_ad }}
                @endif
            </td>
            
            <td>
                @if(isset($data->regd_no))
                    {{ $data->regd_no }}
                @endif
            </td>
            
            <td>
                @if(isset($data->dispatch_no))
                    {{ $data->dispatch_no }}
                @endif
            </td>
            
            <td>
                @if(isset($data->letter_no))
                    {{ $data->letter_no }}
                @endif
            </td>
            
            <td>
                @if(isset($data->letter_sub))
                   {{$data->letter_sub}}
                @endif
            </td>
            
            <td>
                @if(isset($data->letterStatus))
                    {{ $data->letterStatus->name_np }}
                @endif
            </td>
            
            <td>
                @if(isset($data->user))
                    {{ @$data->user->full_name }}
                @endif
            </td>
            
            <td>
                @if(isset($data->office))
                    {{ getLan() == 'np' ? $data->office->name_np : $data->office->name_en }}
                @endif
            </td>
            
            <td>
                @if(isset($data->patraReceiver))
                    {{ getLan() == 'np' ? $data->patraReceiver->first_name_np : $data->patraReceiver->first_name_en }}
                @endif
            </td>
            
            <td>
                @if(isset($data->dcoffice))
                    {{ getLan() == 'np' ? @$data->dcoffice->name_np : @$data->dcoffice->name_en }}
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
                                    