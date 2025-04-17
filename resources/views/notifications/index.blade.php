@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h3>Notifications</h3>

    @if($notifications->count())
        <ul class="list-group">
        @foreach($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    {{ $notification->data['message'] ?? 'You have a new notification' }}
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                @if(!$notification->read_at)
                    <span class="badge bg-primary rounded-pill">New</span>
                @endif
            </li>
        @endforeach
        </ul>

        <form action="{{ route('notifications.markAllAsRead') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary">
                Mark All as Read
            </button>
        </form>
    @else
        <p class="text-muted">No notifications.</p>
    @endif
</div>
@endsection
