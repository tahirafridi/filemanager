@section('style')
@endsection

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ $label }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">{{ $label }}</h3>
                    <div class="card-tools">
                        @can('user_create')
                            <button wire:click="create" type="button" class="btn btn-secondary btn-xs">
                                <i class="fa fa-plus"></i> {{ __('Add New') }}
                            </button>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="recordList" class="table table-hover table-sm text-nowrap">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th {{ setAttributes($column) }}>
                                            @if ($column['sort'])
                                                <span wire:click.prevent="sort('{{ $column['name'] }}')" class="pointer">
                                                    @if ($order_by == $column['name'])
                                                        <i class="fas fa-arrow-{{ $direction == 'desc' ? 'down' : 'up' }}"></i>
                                                    @endif
                                                    {{ $column['title'] }}
                                                </span>
                                            @else
                                                {{ $column['title'] }}
                                            @endif
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if ($rows->count())
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    @can('user_edit')
                                                        <button wire:click="edit({{ $row->id }})" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-success"></i></button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{ count($columns) }}">
                                            <p class="text-secondary text-center">No records found.</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.admin.pages.roles.modals')
</div>
