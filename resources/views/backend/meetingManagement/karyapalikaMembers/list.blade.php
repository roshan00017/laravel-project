<a href="{{url($page_url)}}"
   class="btn btn-secondary btn-sm float-left rounded-pill  boxButton {{setFont()}}"
   data-toggle="tooltip"
   title="{{trans('message.button.list')}}"
>
    <i class="fa fa-list"></i>
    {{trans('message.button.list')}}
</a>

@if(allowAdd())

    @if(@$create_menu ==true)

        <a href="{{url(@$page_url .'/create')}}"
           class="btn btn-primary btn-sm float-left boxButton boxButton rounded-pill {{setFont()}}"
           title="{{trans('message.button.add_new')}}"
        >
            <i class="fa fa-plus-circle"></i>
            {{trans('message.button.add_new')}}
        </a>
    @else
        <button
                class="btn btn-primary btn-sm float-left boxButton rounded-pill {{setFont()}}"
                data-toggle="modal"
                data-target="#addModal"
                title="{{trans('message.button.add_new')}}"
        >
            <i class="fa fa-plus-circle"></i>
            {{trans('message.button.add_new')}}
        </button>

    @endif
@endif

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

@if( $request->name !=null || $request->status !=null|| $request->mobile != null || $request->email != null
 
)

    <a href="{{url(@$page_url)}}"
       class="btn btn-secondary btn-sm float-right boxButton rounded-pill {{setFont()}}"
       title="{{ trans('message.button.reload') }}"
    >
        <i class="fas  fa-undo"></i>
        {{ trans('message.button.reload') }}
    </a>

@endif