@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2>My Recipes</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($recipes->count())
        @foreach ($recipes as $recipe)
            <div class="card mb-3" style="max-width: 600px;">
                <div class="row g-0">
                    <!-- If there's an image, display it -->
                    @if($recipe->image)
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $recipe->image) }}"
                                 class="img-fluid rounded-start"
                                 alt="Recipe Image">
                        </div>
                    @endif

                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">
                                <strong>Ingredients:</strong> {{ $recipe->ingredients }} <br>
                                <strong>Instructions:</strong> {{ $recipe->instructions }} <br>
                                <strong>Description:</strong> {{ $recipe->full_description }}
                            </p>
                            <!-- Buttons for View/Edit/Delete or however you want to manage the recipe -->
                            <a href="#" class="btn btn-sm btn-primary">View</a>
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf
                                <!-- ... -->
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination if needed -->
        {{ $recipes->links() }}
    @else
        <p>You haven't added any recipes yet.</p>
    @endif
</div>
@endsection
