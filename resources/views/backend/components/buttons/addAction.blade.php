<button type="submit"
        class="btn btn-primary  rounded-pill"
        id="btn-add"
>
    <i class="fa fa-save"></i>
    {{trans('message.button.save')}}
</button>
&nbsp; &nbsp;

@if(@$add_more_button == true)
    <button type="submit"
            class="btn btn-success  rounded-pill"
            id="addMore"
            name="addMore"
            value="true"
    >
        <i class="fa fa-plus-circle"></i>
        {{trans('message.button.addMore')}}
    </button>
    &nbsp; &nbsp;
@endif
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