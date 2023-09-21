@if (allowShow() && @$show_button == true)
    @if (@$index_menu == true)
        <a href="{{ route($page_route . '.' . 'show', hashIdGenerate($data->id)) }}"
           class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
            title="{{ trans('message.button.show') }}">
            <i class="fas fa-eye"></i>
        </a>
    @else
        <button type="button" class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
            data-target="#showModal{{ $key }}" data-placement="top" title="{{ trans('message.button.show') }}">
            <i class="fas fa-eye"></i>
        </button>
    @endif
@endif
&nbsp;
@if (allowEdit())
    @if (@$edit_menu == true)
        <a href="{{ route($page_route . '.' . 'edit', hashIdGenerate($data->id)) }}"
            class="btn btn-info btn-xs rounded-pill {{ setFont() }}" title="{{ trans('message.button.edit') }}">
            <i class="fas fa-pencil-alt"></i>
        </a>
    @else
        <button type="button" class="btn btn-info btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
            data-target="#editModal{{ $key }}" data-placement="top"
            title="{{ trans('message.button.edit') }}">
            <i class="fas fa-pencil-alt"></i>
        </button>
    @endif
@endif
&nbsp;
@if (allowDelete())
    <button type="button" class="btn btn-danger btn-xs rounded-pill {{ setFont() }}" data-toggle="modal"
        data-target="#deleteModal{{ $key }}" data-placement="top"
        title="{{ trans('message.button.delete') }}">


        <i class="fas fa-trash"></i>
    </button>
@endif
