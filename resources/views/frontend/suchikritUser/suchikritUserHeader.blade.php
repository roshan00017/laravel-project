<!-- form steps -->
<ul id="form__steps">
    <li class="form-item @if(@$current_url =='suchikrit-info') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='suchikrit-info')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>1</span>
            </p>
        @endif
    </li>
    <li class="form-item @if(@$current_url =='otp-verify') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='otp-verify')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>2</span>
            </p>
        @endif
    </li>
    <li class="form-item @if(@$current_url =='loginInfo') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='loginInfo')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>2</span>
            </p>
        @endif
    </li>
</ul>