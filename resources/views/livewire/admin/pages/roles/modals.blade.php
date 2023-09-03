<!--Start: Add Modal -->
<div class="modal fade" id="add_modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name <i class="text-danger">*</i></label>
                                <input wire:model="name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @isset($permissions)
                                <h3>Permissions</h3>
                                <div class="row">
                                    @foreach ($permissions as $row)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input wire:model="selectedPermissions" type="checkbox" value="{{ $row->id }}" id="permission{{ $row->id }}" name="permissions[]" class="custom-control-input">
                                                    <label class="custom-control-label" for="permission{{ $row->id }}">{{ Str::title(str_replace('_', ' ', $row->name)) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endisset
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
<div class="modal fade" id="edit_modal" tabindex="-1">
    <div class="modal-dialog modal-xl">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name <i class="text-danger">*</i></label>
                                <input wire:model="name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @isset($permissions)
                                <h3>Permissions</h3>
                                <div class="row">
                                    @foreach ($permissions as $row)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input wire:model="selectedPermissions" type="checkbox" value="{{ $row->id }}" id="permission{{ $row->id }}" name="permissions[]" class="custom-control-input">
                                                    <label class="custom-control-label" for="permission{{ $row->id }}">{{ Str::title(str_replace('_', ' ', $row->name)) }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endisset
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
