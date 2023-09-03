<div wire:ignore.self class="modal fade" id="delete-confirmation-modal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark px-3 py-2">
                <h5 class="modal-title text-white" id="exampleModalLabel">Delete Confirmation</h5>
            </div>
           <div class="modal-body">
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="confirmDelete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>
