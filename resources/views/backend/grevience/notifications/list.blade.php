<a href="{{url($page_url)}}"
   class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
   data-toggle="tooltip"
   title="{{trans('message.button.list')}}"
>
    <i class="fa fa-list"></i>
    {{trans('message.button.list')}}
</a>



@if(@$is_import ==true)
    <button
            class="btn btn-success btn-sm float-left  rounded-pill boxButton {{setFont()}}"
            data-toggle="modal"
            data-target="#importModal"
            title="{{trans('message.button.import')}}"
    >
        <i class="fa fa-file-import"></i>
        {{trans('message.button.import')}}
    </button>
@endif

@if(@$is_export ==true)
    <a href="{{url($page_url.'/exportData')}}"
       class="btn btn-secondary btn-sm float-right rounded-pill  boxButton {{setFont()}}"
       data-toggle="tooltip"
       title="{{trans('message.button.export')}}"
    >
        <i class="fa fa-file-excel"></i>
        {{trans('message.button.export')}}
    </a>
@endif




<button class="btn btn-info btn-sm float-right rounded-pill {{setFont()}}"
        data-toggle="modal"
        data-target="#searchModal"
        title="{{ trans('message.button.filter') }}">
    <i class="fas fa-filter"></i>
    {{ trans('message.button.filter') }}
</button>

<button class="btn btn-primary btn-sm float-right boxButton rounded-pill {{ setFont() }}"
        id="showPdf" target="_blank">
    <i class="fas fa-print"></i>
    {{ trans('message.button.export') }}
</button>

@if( $request->notify_type !=null || $request->from_date !=null || $request->to_date !=null || $request->fy_id !=null
 
)

    <a href="{{url(@$page_url)}}"
       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
       title="{{ trans('message.button.reload') }}"
    >
        <i class="fas  fa-undo"></i>
        {{ trans('message.button.reload') }}
    </a>

@endif