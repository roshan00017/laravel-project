<!-- form steps -->
<ul id="form__steps">
    <li class="form-item @if(@$current_url =='appointment-info') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='appointment-info')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>1</span>
            </p>
        @endif
    </li>
    <li class="form-item @if(@$current_url =='personalInfo') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='personalInfo')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>2</span>
            </p>
        @endif
    </li>
    <li class="form-item @if(@$current_url =='appointmentConfirm') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='appointmentConfirm')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>3</span>
            </p>
        @endif
    </li>
</ul>