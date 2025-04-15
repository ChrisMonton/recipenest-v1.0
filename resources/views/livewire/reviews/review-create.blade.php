<div>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review-create-modal">
        Write a Review
    </button>

    <!-- Modal -->
    <div class="modal fade show" id="review-create-modal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Write a Review</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" wire:model="title">
                    </div>

                    <div class="form-group">
                        <label for="review">Review:</label>
                        <textarea class="form-control" rows="5" wire:model="review"></textarea>
                    </div>

                    <input type="hidden" wire:model="user_id">
                    <input type="hidden" wire:model="recipe_id" value="{{ $recipe_id }}">
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button wire:click="store" type="button" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>