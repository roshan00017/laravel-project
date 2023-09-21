<footer class="main-footer">
    <strong class="{{setFont()}}">
        {{trans('message.footer.copyright')}} &copy; <?php echo date('Y'); ?>
        <a href="{{url('/userDashboard')}}">@if(systemSetting()->app_name)
            {{getLan() == 'np' ? systemSetting()->app_name_np : systemSetting()->app_name}} @else {{ env('APP_NAME') }}
            @endif </a>
        {{trans('message.footer.all_rights_reserved')}}
    </strong>
    {{--    <div class="float-right d-none d-sm-inline-block">--}}
    {{--        <b>  {{trans('message.footer.developed_by')}}: </b> Charles--}}
    {{--    </div>--}}
    @yield('js')


    <!-- jQuery -->
    {{-- <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>--}}
    <script src="{{asset('plugins/jquery/main-jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('theme-design/js/main.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/validation/validate.min.js')}}"></script>
    <script src="{{asset('plugins/validation/additional-methods.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src={{asset("plugins/bootstrap-toggle/js/bootstrap-toggle.js")}}></script>
    <script src={{asset("js/theme_switch.min.js")}}></script>
    <script src={{asset("js/common.min.js")}}></script>


    @if(@$load_js)
    @foreach(@$load_js as $js)
    <script src="{{asset($js)}}"></script>
    @endforeach
    @endif
    <script type="text/javascript">
    var site_url = "{{url('/')}}";
    @if(@$script_js) {
        !!$script_js!!
    }
    @endif
    </script>
    <script type="text/javascript">
    let count = 0;

    function addMore(weekDays) {
        count++;
        let options = '<option value="">{{trans('
        calendar.week_day ').'
        '.trans('
        calendar.select ')}}</option>';
        weekDays.forEach(function(item) {
            options += '<option value="' + item.code + '">' + item.name + '</option>';
        })
        let selectWeekDayField = '<div class="form-group col-md-4 {{setFont()}}">' +
            '<select class="form-control" name="week_day_code[]" style="width: 100%" required>' +
            options +
            '</select>' +
            '</div>';

        let dayField = '<div class="form-group col-md-4 {{setFont()}}">' +
            '<input type="number" name="day[]" class="form-control" placeholder="{{trans("calendar.day")}}" min=1 autocomplete="off" required />' +
            '</div>';

        let deleteBtn = '<div class="form-group col-md-4 {{setFont()}}" id="deleteBtn' + count + '">' +
            '<a class="btn btn-danger rounded-pill {{setFont()}}" title="{{trans('
        calendar.add_more ')}}">' +
            '<i class="fa fa-minus-circle"></i></a>' +
            '</div>';

        $('#wrapper').append('<div class="row" id="newField' + count + '">' + selectWeekDayField + dayField +
            deleteBtn + '</div>');
        $('#deleteBtn' + count).click(function() {
            $('#newField' + count).remove();
            --count;
        })
    }
    </script>


</footer>