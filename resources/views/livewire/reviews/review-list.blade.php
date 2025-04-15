<div>

    <h3>{{ $review_data->count() ?? 0 }} Comments</h3>

    @foreach ($review_data as $review)

    <div data-id="review-{{ $review->id }}" class="comment">
        {{-- Image --}}
        <img style="width: 50px; height: 50px" src="{{ $review->user->getImage() }}" alt="Image placeholder">
        {{-- User Name --}}
        <h3><a href="{{ route('chefs.show', ['id' => $review->user->id]) }}">{{
                $review->user->name }}</a></h3>

        {{-- Review --}}
        <div class="comment-body">
            <div>{{ app('CustomHelper')->dateToReadableWithTime($review->created_at) }}</div>
            <p>{{ $review->title }}</p>
            <p>{{ $review->review }}</p>
            <p>
                @if ($review->user_id == auth()->id())
                <button {{-- Livewire + sweetalert --}} onclick="confirmDeleteReview({{ $review->id }})"
                    class="btn btn-danger">
                    Delete</button>
                @endif
            </p>
        </div>
    </div>
    @endforeach

    <div class="row">
        <div class="col-md-12">
            {{ $review_data->links() }}
        </div>
    </div>
</div>