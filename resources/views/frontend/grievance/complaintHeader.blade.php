<!-- form steps -->
<ul id="form__steps">
    <li class="form-item @if(@$current_url =='complaint-info') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='complaint-info')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>1</span>
            </p>
        @endif
    </li>
    <li class="form-item @if(@$current_url =='complaint-complainer') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='complaint-complainer')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>2</span>
            </p>
        @endif
    </li>
    <li class="form-item @if(@$current_url =='complaint-confirm') active @endif">
        <span class="icon"></span>
        @if(@$current_url =='complaint-confirm')
            <p class="{{setFont()}}">
                {{ getLan() =='np' ? 'पृष्ठ' : 'Page' }}
                <span>3</span>
            </p>
        @endif
    </li>
</ul>