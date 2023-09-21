<div class="modal fade" id="showComplaintModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">

                <div>
                    <div>
                        <h5 class="{{ setFont() }}">
                            <i class="fa fa-question"> </i>
                            {{ trans('appointment.complaint_details') }}
                        </h5>
                        <br>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('complaints.ticket_no') }}
                                    </td>
                                    <td width="60%" class="{{ setFont() }}">
                                        @if (isset($appComplaintInfo->complaint_no))
                                            {{ $appComplaintInfo->complaint_no }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('message.commons.status') }}
                                    </td>
                                    <td width="60%" class="{{ setFont() }}">
                                        @if ($appComplaintInfo->status)
                                            {{ getLan() == 'np' ? $appComplaintInfo->complaintStatus->name_ne : $appComplaintInfo->complaintStatus->name }}
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('complaints.related_works') }}
                                    </td>
                                    <td width="60%" class="{{ setFont() }}">
                                        <div class="tracking-list">
                                            @foreach ($appComplaintProgress as $pg)
                                                <div class="tracking-item">
                                                    <div class="tracking-icon status-intransit">
                                                        <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true"
                                                            data-prefix="fas" data-icon="circle" role="img"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                            data-fa-i2svg="">
                                                            {{-- <path fill="currentColor"
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path> --}}
                                                        </svg>
                                                        {{-- <i class="fas fa-circle"></i> --}}
                                                    </div>
                                                    <div class="tracking-date">
                                                        <div>
                                                            {{ getLan() == 'np' ? $dateHelper->eng_to_nep($pg->created_at, true) : date('l, jS F, Y', strtotime($pg->created_at)) }}
                                                        </div>

                                                    </div>
                                                    <div class="tracking-content">
                                                        <span class="h6 mb-0 ">{{ $pg->description }}</span>
                                                        <span>
                                                            {{ @$pg->responding_office }}</span>
                                                        <span>-
                                                            {{ getLan() == 'np' ? @$pg->userInfo->full_name_np : @$pg->userInfo->full_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary rounded-pill {{ setFont() }}" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    {{ trans('message.button.close') }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
