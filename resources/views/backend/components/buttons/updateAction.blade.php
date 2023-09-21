<button type="submit"
        class="btn btn-success  rounded-pill"
>
    <i class="fa fa-check-circle"></i>
    {{trans('message.button.update')}}
</button>
&nbsp; &nbsp;
@if(@$cancel_button == true)
    <a href="{{url(@$index_page_url)}}"
       class="btn btn-danger  rounded-pill {{setFont()}}"
       title="{{trans('message.button.close')}}"
    >
        <i class="fa fa-times-circle"></i>
        {{trans('message.button.close')}}
    </a>
@else
    <button type="button"
            class="btn btn-danger  rounded-pill"
            data-dismiss="modal"
    >
        <i class="fa fa-times-circle"></i>
        {{trans('message.button.close')}}
    </button>
@endif