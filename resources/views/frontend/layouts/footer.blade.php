<footer class="footer__section">
    <nav class="footer__nav">
        <div class="custom-container">
            <div class="footer__menu">
                <h2 class="section__title {{setFont()}}">
                    {{trans('frontendfooter.contact')}}
                </h2>

                <ul>
                    <li>
                        <a href="mailto:smartoffice.shangrilagroup@gmail.com"
                           class="footer__link">
                            <i class="fa-solid fa-envelope-open-text"></i>
                            {!! settingInfo('E') !!}
                        </a>
                    </li>

                    <li>
                        <a href="tel:041-474833"
                           class="footer__link">
                            <i class="fa-solid fa-envelope-open-text"></i>
                            {!! settingInfo('PH') !!}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="copyright">
        <p class="{{setFont()}}">
            &copy; {{trans('frontendfooter.copyright')}} {{ date('Y')}} । {{trans('frontendfooter.reserved')}}
        </p>
    </div>
</footer>

<!-- scroll to top button -->
<a href="#"
   class="scrollToTop">
    <i class="fa-solid fa-chevron-up"></i>
</a>

<script src={{asset('assets/js/jquery.min.js')}}></script>
<script src="{{asset('assets/js/fontawesome.min.js')}}"></script>
<script src="{{asset('assets/js/boostrap.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('js/common.min.js')}}"></script>

@if (session('success'))
    <script>
        $('#success_modal').modal('show');
        setTimeout(function() {
            $('#success_modal').modal('hide');
        }, 30000);
    </script>
@endif
@if (session('data_not_found'))
    <script>
        $('#data_not_found').modal('show');
        setTimeout(function() {
            $('#data_not_found').modal('hide');
        }, 30000);
    </script>
@endif

@if (session('server_error'))
    <script>
        $('#technicalErrorModal').modal('show');
        setTimeout(function() {
            $('#technicalErrorModal').modal('hide');
        }, 30000);
    </script>
@endif
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>--}}
@if(@$load_js)
    @foreach(@$load_js as $js)
        <script src="{{asset($js)}}"></script>
    @endforeach
@endif
<script type="text/javascript">
    const site_url = "{{url('/')}}";
    @if(@$script_js)
        {!!$script_js!!}
    @endif
</script>
@if (session('message'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'कार्य सम्पन्न !',
            text: '{{ session('
        message ') }}',
            confirmButtonText: 'ठिक छ'
        });
    </script>
@endif

@if (session('incident_register'))
    <script>
        Swal.fire({
            icon: 'success',
            class: '{{setFont()}}',
            title: 'कार्य सम्पन्न !',
            text: 'स्थलगत सूचना सफलतापुर्वक दर्ता भएको छ !',
            confirmButtonText: 'ठिक छ'
        });
    </script>
@endif



@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'त्रुटी फेला पर्यो !',
            text: '{{ session('
        error ') }}',
            confirmButtonText: 'ठिक छ'
        });
    </script>
@endif
@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'चेतावनी !',
            text: '{{ session('
        error ') }}',
            confirmButtonText: 'ठिक छ'
        });
    </script>
@endif

<script>
    $(function () {
        $(".video__slider").slick({
            autoplay: true,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: ".arrow_vertical-prev1",
            nextArrow: ".arrow_vertical-next1",
        });
    })
</script>

<script>
    $("#type").on("change", function () {
        const type = $(this).val();
        if (type != "" && type=='c') {
            window.location.href = '/complaint-info';
        }else if(type != "" && type=='s')
        {
            window.location.href = '/suggestion-info';
        }
    });
</script>
@if($errors->has('type') || $errors->has('token_no'))
<script>
    $('#statusModal').modal('show');
</script>
@endif

<script>
    // navbar sticky on scroll
    const sectionHeader = document.querySelector(".header__section");

    window.addEventListener("scroll", () => {
        if (window.pageYOffset > 0) {
            sectionHeader.classList.add("stickyHeader");
        } else if (window.pageYOffset == 0) {
            sectionHeader.classList.remove("stickyHeader");
        }
    });
</script>

<script>
    // scroll to top animation
    window.onscroll = function () {
        scrollToTopReveal();
    };

    const bottomHeight = document.documentElement.clientHeight;
    console.log(bottomHeight);

    function scrollToTopReveal() {
        const scrollTopBtn = document.querySelector(".scrollToTop");

        if (
            document.body.scrollTop > bottomHeight ||
            document.documentElement.scrollTop > bottomHeight
        ) {
            scrollTopBtn.classList.add("active");
        } else {
            scrollTopBtn.classList.remove("active");
        }
    }

    $(".scrollToTop").click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
    });
    $('.changeLang').change(function () {
        window.location.href = url + "?lang=" + $(this).val();
    });
    // document.addEventListener('contextmenu', event=> event.preventDefault());
    // document.onkeydown = function(e) {
    //     if(event.keyCode == 123) {
    //         return false;
    //     }
    //     if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    //         return false;
    //     }
    //     if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    //         return false;
    //     }
    //     if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
    //         return false;
    //     }
    // }
</script>

</body>

</html>