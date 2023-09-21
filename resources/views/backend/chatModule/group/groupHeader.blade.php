<div class="bs-stepper-header" role="tablist">

    <div class="step @if(@$current_url =='chat.groupInfo') active @endif" data-target="#logins-part">
        <button type="button" class="step-trigger" role="tab"
                aria-controls="logins-part" id="logins-part-trigger">
            <span class="bs-stepper-circle {{setFont()}}">1</span>
            <span class="bs-stepper-label {{setFont()}}">
                   {{trans('chat.group_details')}}
            </span>
        </button>
    </div>
    <div class="line"></div>
    <div class="step @if(@$current_url =='chat.memberInfo') active @endif" data-target="#information-part">
        <button type="button" class="step-trigger" role="tab"
                aria-controls="information-part" id="information-part-trigger">
            <span class="bs-stepper-circle {{setFont()}}">2</span>
            <span class="bs-stepper-label {{setFont()}}">
                     {{trans('chat.member_details')}}
            </span>
        </button>
    </div>

</div>