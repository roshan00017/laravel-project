<div class="bs-stepper-header" role="tablist">

    <div class="step @if(@$current_url =='appointment.appointmentInfo') active @endif" data-target="#logins-part">
        <button type="button" class="step-trigger" role="tab"
                aria-controls="logins-part" id="logins-part-trigger">
            <span class="bs-stepper-circle {{setFont()}}">1</span>
            <span class="bs-stepper-label {{setFont()}}">
                   {{trans('appointment.visiting_details')}}
            </span>
        </button>
    </div>
    <div class="line"></div>
    <div class="step @if(@$current_url =='appointment.personalInfo') active @endif" data-target="#information-part">
        <button type="button" class="step-trigger" role="tab"
                aria-controls="information-part" id="information-part-trigger">
            <span class="bs-stepper-circle {{setFont()}}">2</span>
            <span class="bs-stepper-label {{setFont()}}">
                     {{trans('appointment.personal_details')}}
            </span>
        </button>
    </div>
    <div class="line"></div>
    <div class="step @if(@$current_url =='appointment.appointmentConfirm') active @endif" data-target="#information-part">
        <button type="button" class="step-trigger" role="tab"
                aria-controls="information-part" id="information-part-trigger">
            <span class="bs-stepper-circle {{setFont()}}">3</span>
            <span class="bs-stepper-label {{setFont()}}">
                {{trans('appointment.detail_confirm')}}
            </span>
        </button>
    </div>

</div>