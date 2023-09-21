<div class="modal fade" id="dartaModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="{{url('registerReport')}}" class="close" id="btnclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                </button>
            </div>
            <div class="modal-body">
                <section>
                    <div class="print-button">
                        <button class="btn btn-primary" onclick="printReportDarta()" id="printbutton"> <i class="fa fa-save"></i> Print</button>
                    </div>
                    <div id="printRegd">
                        <div  class="{{setFont()}}">
                            <h2 class="text-center">{{trans('dartaKitab.dc_register_book.pdf_maintitle')}}</h2>
                            <h3 class="text-center"> {{trans('dartaKitab.dc_register_book.pdf_title')}}</h3>
                            <p>
                                <span class='pull-left'>
                                    <label class=''> {{trans('dartaKitab.dc_register_book.fiscal_year')}}:</label>                                                                                 
                
                                </span>
                            </p>
                        </div>
                        <table id=""
                        class="table table-bordered table-striped dataTable dtr-inline"
                 >
            <thead class="th-header">
                                <tr  class="{{setFont()}}">
                                    <th width="10px">
                                        {{ trans('message.commons.s_n') }}
                                    </th>
                                    <th>
                                        {{ trans('dartaKitab.dc_register_book.invoice_no') }}
                                    </th>

                                    <th>
                                        {{ trans('dartaKitab.dc_register_book.Registration_no') }}
                                    </th>

                                    <th>
                                    {{getLan() =='np' ? trans('dartaKitab.dc_register_book.Date_of_Registration_np'): trans('dartaKitab.dc_register_book.Date_of_Registration_en') }}
                                    </th>

                                    <th style="display: none;">
                                        {{ trans('dartaKitab.dc_register_book.Date_of_Registration_en') }}
                                    </th>

                                    <th>
                                        {{ trans('dartaKitab.dc_register_book.letter_no') }}
                                    </th>

                                    <th>
                                        {{ trans('dartaKitab.dc_register_book.ward_No') }}
                                    </th>

                                    <th>
                                        {{ trans('dartaKitab.dc_register_book.subject_of_the_letter') }}
                                    </th>

                                </tr>
                                <tbody>
                                    @foreach($results as $key=>$data)
                                    <tr>
                                        <th scope="row {{setFont()}}">
                                            {{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}
                                        </th>
                               

                                        <td>

                                            {{$data->dispatch_no}}

                                        </td>
                                        <td>
                                            {{$data->regd_no}}

                                        </td>

                                        <td>
                                            {{ getLan() =='np' ? $data->regd_date_bs : $data->regd_date_ad }}

                                        </td>
                                        <td>
                                            {{$data->letter_no}}

                                        </td>

                                        <td>
                                            {{$data->ward_no}}

                                        </td>
                                        <td>
                                            {{$data->letter_sub}}

                                        </td>
                                            
                                            </tr>
                                            @endforeach
                                    </tbody>

                            </thead>
                        </table>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <a href="{{url('registerReport')}}" class="btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>