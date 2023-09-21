<header class="header__section">
    <div class="custom-container">
        <nav class="header__nav">
            <div class="header__nav-left">
                <a href="{{url('/')}}"
                   class="logo">
                    <img class="logo__img"
                         src="{{asset('assets/images/logo1.png')}}"
                         alt="">

                    <p class="brand__name {{setFont()}}">
                        @if(systemSetting()->app_name)
                            {{ getLan() =='np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
                        @else
                            {{ env('APP_NAME') }}
                        @endif
                    </p>
                </a>
            </div>

            <div class="header__nav-middle">
                <a href="{{url('/')}}"
                   class="logo">
                    <p class="brand__name {{setFont()}}">
                        {{  clientInfo()->name }}
                        <span class="{{setFont()}}">

                            @if(clientInfo()->local_body_type_id == 4)
                                {{ getLan() == 'np' ? ' गाउँकार्यपालिकाको कार्यालय' : '
                                Office of the Village Executive' }}
                            @else
                                {{ getLan() == 'np' ? ' नगरकार्यपालिकाको कार्यालय ' : 'City Executive Office' }}
                            @endif
                            ,
{{--                            {{  clientInfo()->district_name }} , --}}
                                {{  clientInfo()->province_name }}
                        </span>
                    </p>
                </a>
            </div>

            <div class="header__nav-right">
                <div class="logo__group">
                    <p class="full__date {{setFont()}}">

                        {{  getLan() == 'np' ? (new \App\Helpers\DateConverter)->eng_to_nep(date('Y-m-d'),null,'np') : date(' j  F Y , l ') }}
                        <br>
                      <i class="fa fa-clock"></i>  <label class="{{setFont()}}" id="timeset" style="font-weight: 400 !important;"></label>
                    </p>

                    <div class="logos">
                        <div class="right__logo">
{{--                            <img class="logo__img"--}}
{{--                                 src="{{asset('assets/images/logo2.png')}}"--}}
{{--                                 alt="">--}}
                            <img class="nepal__logo"
                                 src="{{asset('assets/images/flag-nepal.gif')}}"
                                 alt="">
{{--                            <img class="lipi__logo"--}}
{{--                                 src="{{asset('assets/images/rachana-lipi.png')}}"--}}
{{--                                 alt="">--}}
                        </div>

                        <a href="  {{route('LangChange', ['lang' =>  getLan() == 'np' ? 'en' : 'np' ])}}"
                           class="language__toggler {{getLan() == 'np' ? 'active' : 'language__text'}}">
                            <span class="language__text"></span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>