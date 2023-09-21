<div class="modal fade" id="showModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ getLan() == 'np' ? 'टोकन न.' . ' ' . $data->token_no . ' ' . 'लग विवरण' : 'Token' . ' ' . $data->token_no . ' ' . 'Log History' }}

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $logDetails = @$tokenManagementRepo->serviceTokenLogDetailsByToken(@$data->token_no);
                ?>
                <div class="row">
                    @if (sizeof($logDetails) > 0)
                        <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline">
                                <thead class="th-header">
                                    <tr class="{{ setFont() }}">
                                        <th class="{{ setFont() }}" width="1%">
                                            {{ trans('message.commons.s_n') }}
                                        </th>
                                        <th width="30%">
                                            {{ trans('tokenManagement.date') }}
                                        </th>
                                        <th>
                                            {{ trans('tokenManagement.tokenStatus') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logDetails as $key => $agenda)
                                        <tr>
                                            <th scope=row {{ setFont() }}>
                                                {{ ++$key }}
                                            </th>
                                            <td class="{{ setFont() }}">
                                                @if (isset($data->date_np))
                                                    {{ getLan() == 'np' ? $data->date_np : $data->date_en }}
                                                @endif
                                            </td>
                                            <td class="{{ setFont() }}">
                                                @if (isset($data->status_title_np))
                                                    {{ getLan() == 'np' ? $data->status_title_np : $data->status_title_en }}
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{ trans('message.commons.no_record_found') }}
                            </label>
                        </div>
                    @endif

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
