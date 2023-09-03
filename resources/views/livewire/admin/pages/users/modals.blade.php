<!--Start: Add Modal -->
<div class="modal fade" id="add_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark px-3 py-2">
                <h5 class="modal-title text-white">{{ $label }} - <small>{{ __('Add New') }}</small></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit="store">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <i class="text-danger">*</i></label>
                                <input wire:model="name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <i class="text-danger">*</i></label>
                                <input wire:model="email" type="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Role <i class="text-danger">*</i></label>
                                <select wire:model="role" class="custom-select" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($roles as $row)
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <i class="text-danger">*</i></label>
                                <select wire:model="status" class="custom-select" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($statuses as $row)
                                        <option value="{{ $row }}">{{ $row }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-4 text-right">
                            <button type="button" class="btn btn-default mr-1" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End: Add Modal -->

<!--Start: Edit Modal -->
<div wire:ignore class="modal fade" id="edit_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark px-3 py-2">
                <h5 class="modal-title text-white">{{ $label }} - <small>{{ __('Edit') }}</small></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit="update">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <i class="text-danger">*</i></label>
                                <input wire:model="name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <i class="text-danger">*</i></label>
                                <input wire:model="email" type="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role <i class="text-danger">*</i></label>
                                <select wire:model="role" class="custom-select" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($roles as $row)
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <i class="text-danger">*</i></label>
                                <select wire:model="status" class="custom-select" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($statuses as $row)
                                        <option value="{{ $row }}">{{ $row }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-4 text-right">
                            <button type="button" class="btn btn-default mr-1" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End: Edit Modal -->

{{-- Delete Confirmation Modal --}}
<x-modals.delete-confirmation />
