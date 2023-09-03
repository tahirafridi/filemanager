<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a></li>

                        @if ($file)
                            <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.files.index') }}">{{ __('Files') }}</a></li>
                        @endif

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
                    <h3 class="card-title">
                        @if ($file)
                            {{ $file->name }} &nbsp; <i class="fas fa-chevron-right"></i> &nbsp; 
                        @endif
                        {{ $label }}</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between mb-3">
                        <div class="col-3 col-sm-2 col-md-2">
                            <select wire:model.live="per_page" class="custom-select" title="Per Page">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-9 col-sm-6 col-md-5 col-lg-4">
                            <input wire:model.live.debounce.400ms="search" type="search" class="form-control" placeholder="Search...">
                        </div>
                    </div>

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
                                            <td>{{ $row->signed_minutes }} minutes</td>
                                            <td>{{ $row->ip }}</td>
                                            <td>{{ $row->created_at->format('d-m-Y h:i:s a') }}</td>
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

                    @if ($rows->count())
                        <hr>
                        <div class="row justify-content-between mt-3">
                            <div class="col-12 col-md-3">
                                Showing {{ $rows->firstItem() }} to {{ $rows->lastItem() }} out of {{ $rows->total() }} results
                            </div>
                            <div class="col-12 col-md-9">
                                {{ $rows->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
