<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('user.index') }}">{{ __('Dashboard') }}</a></li>
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
                    <div class="card-tools"></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between mb-3">
                        <div class="col-3 col-sm-2 col-md-3 col-lg-2">
                            <select wire:model.live="per_page" class="custom-select" title="Per Page">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-9 col-sm-6 col-md-5 col-lg-5">
                            <input wire:model.live.debounce.400ms="search" type="search" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                    <div class="row justify-content-between mb-3">
                        <div class="col-3 col-sm-2 col-md-2">
                            <button wire:click="markAsFixed()" {{ $appUpdateIds ? '' : 'disabled' }} class="btn btn-sm btn-secondary">Fix Selected</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="recordList" class="table table-hover table-sm">
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
                                                {!! $column['title'] !!}
                                            @endif
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if ($rows->count())
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td class="text-center">
                                                @if (!$row->fixed_at)
                                                    <div class="icheck-secondary d-inline">
                                                        <input wire:model.live="appUpdateIds" type="checkbox" id="appUpdateId{{ $row->id }}" value="{{ $row->id }}">
                                                        <label for="appUpdateId{{ $row->id }}"></label>
                                                    </div>
                                                @else
                                                    <div class="icheck-primary d-inline">
                                                        <input disabled checked type="checkbox">
                                                        <label></label>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $row->apk_id }} {{ $row->user->name }}</td>
                                            @if ($row->apk->url)
                                                <td><a wire:navigate href="{{ $row->apk->url }}" target="_blank">{{ $row->app }}</a></td>
                                            @else
                                                <td>{{ $row->app }}</td>
                                            @endif
                                            <td>{{ $row->website }}</td>
                                            <td>{{ $row->scraper }}</td>
                                            <td>{{ $row->message }}</td>
                                            <td>{{ $row->error_code }}</td>
                                            <td class="text-center">{{ $row->created_at->format('Y-m-d h:ia') }}</td>
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

    {{-- Mark as Completed Confirmation Modal --}}
    <div wire:ignore.self class="modal fade" id="fixed-confirmation-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark px-3 py-2">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Mark as Fixed Confirmation</h5>
                </div>
               <div class="modal-body">
                    <p>Are you sure want to mark as fixed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="confirmMarkAsFixed()" class="btn btn-secondary close-modal" data-dismiss="modal">Yes, Mark as Fixed</button>
                </div>
            </div>
        </div>
    </div>
</div>
