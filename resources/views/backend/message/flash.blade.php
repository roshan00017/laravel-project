@section('js')
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script>
        toastr.options = {
            "newestOnTop": true,
            "progressBar": true,
        }
        @if(Session::has('success'))
        toastr.success('<span class="{{setFont()}}">{{ Session::get('success') }}</span>');

        @endif

        @if(Session::has('info'))
        toastr.info('<span class="{{setFont()}}">{{ Session::get('info') }}</span>');
        @endif


        @if(Session::has('warning'))
        toastr.warning('<span class="{{setFont()}}">{{ Session::get('warning') }}</span>');
        @endif


        @if(Session::has('error'))
        toastr.error('<span class="{{setFont()}}">{{ Session::get('error') }}</span>');
        @endif
        @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        toastr.error('<span class="{{setFont()}}">{{ $error }}</span>');
        @endforeach
        @endif
        @if(Session::has('server_error'))
        toastr.warning('<span class="{{setFont()}}">{{ Session::get('server_error') }}</span>');
        @endif


    </script>
@endsection