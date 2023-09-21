<div class="modal fade" id="patraModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="btnclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section>
                    <div class="print-button">
                        <button class="btn btn-primary" onclick="printReportPatra()" id="printbutton"> <i class="fa fa-save"></i> Print</button>
                    </div>
                    <div id="printPatra">
                        <div>
                            <h2 class="text-center">{{trans('dcDocument.dc_document.pdf_maintitle')}}</h2>
                            <h3 class="text-center"> {{trans('dcDocument.dc_document.pdf_title')}}</h3>
                            <p>
                                <span class='pull-left'>
                                    <label class=''> {{trans('dcDocument.dc_document.fiscal_year')}}:</label>                                                                                 
                                     <label class=''>{{trans('dcDocument.dc_document.employee')}}: </label>                                                                            
                                  
                                </span>
                                <span class='pull-right'>
                                    <label class=''> {{trans('letterstatus.dc_document.date_from')}}:</label>                                    -
                                    <label class=''>{{trans('letterstatus.dc_document.date_to')}}: </label>                               </span>
                            </p>
                        </div>
                        <table id=""
                        class="table table-bordered table-striped dataTable dtr-inline">
            <thead class="th-header">
                                <tr>
                                    <th width="10px">
                                        {{trans('message.commons.s_n')}}
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
                                        {{trans('dcDocument.dc_document.letter_topic')}}
                                    </th>
                                    <th>
                                        {{trans('dcDocument.dc_document.action')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>