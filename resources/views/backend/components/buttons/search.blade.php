<button type="submit"
        id="btn-search"
        class="btn btn-info  rounded-pill"
>
    <i class="fa fa-search"></i>
    {{trans('message.button.filter')}}
</button>
&nbsp;

<a href="{{url($page_url)}}" type="button"
        class="btn btn-secondary  rounded-pill"
        onclick="resetForm(event,$(this));"
>
    <i class="fas  fa-sync-alt"></i>
    {{trans('message.button.reset')}}
</a>