<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link" style="padding-bottom: 30px !important;">
        <img src="@if(systemSetting()->app_logo !=null)
        {{asset('/storage/uploads/files/'.systemSetting()->app_logo)}}
        @else {{url('images/logo.jpg')}}   @endif" alt="Admin Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light {{setFont()}}" style="font-size: 22px;">
            @if(systemSetting())
            {{getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
            @else
            {{trans('message.pages.common.app_short_name')}}
            @endif
        </span>
    </a>



    <!-- /.sidebar -->
</aside>
