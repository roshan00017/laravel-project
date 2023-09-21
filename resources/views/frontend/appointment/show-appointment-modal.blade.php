<div class="modal fade" id="showModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-body">
                <div>
                    <h5 class="{{ setFont() }}">
                        <i class="fa fa-calendar-day"></i>
                        {{ trans('appointment.visiting_details') }}
                    </h5>
                    <br>
                    <table class="table  table-bordered">
                        <tbody>

                            <tr>
                                <td width="28%" class="{{ setFont() }}">
                                    {{ trans('complaints.ticket_no') }}
                                </td>

                                <td class="{{ setFont() }}">
                                    {{ @$appointment->appointment_no }}
                                </td>
                            </tr>

                            <tr>
                                <td class="{{ setFont() }}">
                                    {{ trans('appointment.appointment_date') }}
                                </td>

                                <td width="60%" class="{{ setFont() }}">
                                    @if (@$appointment->appointment_date_bs)
                                        {{ getLan() == 'np' ? $appointment->appointment_date_bs : $appointment->appointment_date_ad }}
                                        &nbsp;
                                        <i class="fa fa-clock"></i>
                                        {{ \Carbon\Carbon::parse(@$appointment->time)->format('g:i A') }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="{{ setFont() }}">
                                    {{ trans('appointment.visiting_department') }}
                                </td>

                                <td width="60%" class="{{ setFont() }}">
                                    @if (@$appointment->visiting_section)
                                        {{ appointmentDepartment($appointment->visiting_section) }}
                                    @endif
                                </td>
                            </tr>
                            @if ($appointment->visiting_section == 'km')
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.elected_person') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        @if (@$appointment->visiting_to_person_id)
                                            {{ $appointmentHelper->getElectedPerson(@$appointment->visiting_to_person_id) }}
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if ($appointment->visiting_section == 'om')
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.employee') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        @if (@$appointment->visiting_to_person_id)
                                            {{ $appointmentHelper->getEmployee(@$appointment->visiting_to_person_id) }}
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (@$appointment->visiting_purpose_id)
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.visiting_purpose') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        {{ $appointmentHelper->getVisitingPurpose(@$appointment->visiting_purpose_id) }}
                                    </td>
                                </tr>
                            @endif

                            @if (@$appointment->appointment_status)
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('message.commons.status') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        @if (isset($appointment->appointmentStatus))
                                            {{ getLan() == 'np' ? $appointment->appointmentStatus->name_np : $appointment->appointmentStatus->name_en }}
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if (@$appointment->visiting_purpose_reason)
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.other_reason') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        {{ $appointment->visiting_purpose_reason }}
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <br>

                <div>
                    <h5 class="{{ setFont() }}">
                        <i class="fa fa-user"></i>
                        {{ trans('appointment.personal_details') }}
                    </h5>
                    <br>
                    <table class="table  table-bordered">
                        <tbody>

                            @if (@$appointment->full_name)
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.full_name') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        {{ $appointment->full_name }}
                                    </td>
                                </tr>
                            @endif
                            @if (@$appointment->address)
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.address') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        {{ $appointment->address }}
                                    </td>
                                </tr>
                            @endif
                            @if (@$appointment->email)
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.email') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        {{ $appointment->email }}
                                    </td>
                                </tr>
                            @endif
                            @if (@$appointment->mobile_no)
                                <tr>
                                    <td class="{{ setFont() }}">
                                        {{ trans('appointment.mobile_no') }}
                                    </td>

                                    <td width="60%" class="{{ setFont() }}">
                                        {{ $appointment->mobile_no }}
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>

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
