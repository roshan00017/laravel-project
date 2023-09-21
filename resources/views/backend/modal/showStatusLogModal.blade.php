@php
    $name = setName()
@endphp
<div class="modal fade"
     id="logModal"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                     {{trans('common.accountStatusLogDetails')}}
                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if(sizeof($results) > 0)
                        <div class="card-body">
                            <table id="logTable"
                                   class="table table-bordered table-striped dataTable dtr-inline"
                            >
                                <thead class="th-header">
                                <tr class="{{setFont()}}">
                                    <th width="5%">
                                        {{trans('message.commons.s_n')}}
                                    </th>

                                    <th>
                                        {{trans('message.commons.status')}}
                                    </th>

                                    <th>
                                        {{trans('teacher.updatedBy')}}
                                    </th>
                                    <th>
                                        {{trans('teacher.updatedDate')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-md-12 {{setFont()}}"
                             style="padding-top: 10px"
                        >
                            <label class="form-control badge badge-pill"
                                   style="text-align:  center; font-size: 18px;"
                            >
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{trans('message.commons.no_record_found')}}
                            </label>
                        </div>
                    @endif

                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}"
                            data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
