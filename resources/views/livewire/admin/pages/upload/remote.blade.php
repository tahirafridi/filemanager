<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.files.index') }}">{{ __('Files') }}</a></li>
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
                        @can('file_folder_upload')
                            <a href="{{ route('admin.folder-upload.index') }}" class="btn btn-success btn-xs">
                                <i class="fas fa-upload"></i> {{ __('Folder Upload') }}
                            </a>
                        @endcan
                        @can('file_upload')
                            <a href="{{ route('admin.upload.index', $folder->id ?? null) }}" class="btn btn-secondary btn-xs">
                                <i class="fas fa-file-upload"></i> {{ __('File(s) Upload') }}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit="store">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Folder <i class="text-danger">*</i></label>
                                    <select wire:model="folder_id" class="custom-select" required>
                                        <option value="">-- Select --</option>
                                        @foreach ($folders as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>URLs <i class="text-danger">*</i> <small>each URL per line, hit <code>ENTER</code> for line change</small></label>
                                    <textarea wire:model="urls" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4 text-right">
                                <button type="submit" class="btn btn-dark">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Pending Remote Uploads') }}</h3>
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

                    <div wire:poll.10s class="table-responsive">
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
                                            <td>{{ $row->folder->name }}</td>
                                            <td>{{ $row->url }}</td>
                                            <td>{{ $row->status }}</td>
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
