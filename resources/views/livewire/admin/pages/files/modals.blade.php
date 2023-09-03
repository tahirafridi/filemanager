<!--Start: Edit Modal -->
<div class="modal fade" id="edit_modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
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
                        <div class="col-sm-6">
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

<!--Start: Share Modal -->
<div wire:ignore class="modal fade" id="share_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark px-3 py-2">
                <h5 class="modal-title text-white">{{ $label }} - <small>{{ __('Share') }}</small></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit="share">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input wire:model="name" type="text" readonly disabled class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Share URL</label>
                                <textarea wire:model="shareUrl" id="shareUrl" rows="5" type="text" readonly disabled class="form-control"></textarea>
                                <a href="javascript:void(0);" class="d-inline-block mt-1" onclick="copyText($(this), 'shareUrl')"><i class="fas fa-copy"></i> Copy</a>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-4 text-right">
                            <button type="button" class="btn btn-default mr-1" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End: Share Modal -->

{{-- Delete Confirmation Modal --}}
<x-modals.delete-confirmation />
