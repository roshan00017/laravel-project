<div class="modal fade" id="dispatchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="{{url('dispatchReport')}}" class="close" id="btnclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <section> 
                    <div class="print-button">
                        <button class="btn btn-primary" onclick="printReport()" id="printbutton"> <i class="fa fa-save"></i> Print</button>
                    </div>
                    <div id="printDispatch">
                        <div class="{{setFont()}}">
                            <h2 class="text-center">{{ trans('dispatchreport.dc_dispatch_book.pdf_title') }}</h2>
                            <h3 class="text-center">{{ trans('dispatchreport.dc_dispatch_book.title_head') }}</h3>
                            <p>
                                <span class='pull-left'>
                                    <label class=''> {{ trans('dispatchreport.dc_dispatch_book.financial_year') }} </label>
                                    <!-- <label class=''> {{ trans('dispatchreport.dc_dispatch_book.Users') }} </label> -->
                                </span>
                                <!-- <span class='float-right'>
                                    <label class=''>{{ trans('dispatchreport.dc_dispatch_book.date_from') }}</label>                         
                                    <label class=''>{{ trans('dispatchreport.dc_dispatch_book.date_to') }} </label>                             
                                  </span> -->
                            </p>
                        </div>
                        <table id='dispatchBook' class="table table-bordered table-striped dataTable dtr-inline">   
                        <thead class="th-header">
                        <tr class="{{setFont()}}">
                            <tr>
                                             <th>
                                                {{ trans('message.commons.s_n') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.letter_no') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.dispatch_no') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.dispatch_date_bs') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.letter_sub') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.to_office_name') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.from_branch_id') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.person_name') }}
                                            </th>
                                            <th>
                                                {{ trans('dispatch.dispatch_data.letter_status') }}
                                            </th>
                                          
                                        </tr>
                            </thead>
                            <tbody>
                                        @foreach($results as $key=>$data)
                                            <tr>
                                                <th  scope="row {{setFont()}}">
                                                    {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                                </th>
                                                <td class="{{setFont()}}">
                                                    @if(isset($data->letter_no))
                                                        {{ $data->letter_no }}
                                                    @endif
                                                </td>
                                                <td >
                                                    @if(isset($data->dispatch_no))
                                                    {{ $data->dispatch_no }}
                                                    @endif
                                                </td>
                                                <td >
                                                    @if(isset($data->dispatch_date_bs))
                                                    {{getLan() == 'np'? $data->dispatch_date_bs : $data->dispatch_date_ad  }}
                                                    @endif
                                                </td>
                                                <td >
                                                    @if(isset($data->letter_sub))
                                                        {{ $data->letter_sub }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($data->to_office_name))
                                                        {{ $data->to_office_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($data->branch->name_np))
                                                        {{getLan() == 'np'? $data->branch->name_np : $data->branch->name_en}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($data->contact_person))
                                                        {{ $data->contact_person }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($data->status->name_np))
                                                        {{getLan() == 'np' ? $data->status->name_np : $data->status->name_en}}
                                                    @endif
                                                </td>
                                                <td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button> -->
                <a href="{{url('dispatchReport')}}" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>