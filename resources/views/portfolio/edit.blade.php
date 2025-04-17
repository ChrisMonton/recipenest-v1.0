@extends('layouts.app')

@section('styles')
<style>
    .portfolio-edit-container {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container portfolio-edit-container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Portfolio</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('portfolio.update', $user->id) }}" method="POST" id="portfolioForm">
                @csrf
                @method('PUT')
                <!-- Experience Field -->
                <div class="mb-3">
                    <label for="experience" class="form-label">Experience</label>
                    <textarea class="form-control" id="experience" name="experience" rows="4">{{ old('experience', $portfolio->experience ?? '') }}</textarea>
                </div>
                <!-- Education Field (Optional) -->
                <div class="mb-3">
                    <label for="education" class="form-label">Education (Optional)</label>
                    <textarea class="form-control" id="education" name="education" rows="3">{{ old('education', $portfolio->education ?? '') }}</textarea>
                </div>
                <!-- Interests Field -->
                <div class="mb-3">
                    <label for="interests" class="form-label">Interests</label>
                    <textarea class="form-control" id="interests" name="interests" rows="3">{{ old('interests', $portfolio->interests ?? '') }}</textarea>
                </div>
                <!-- Culinary Skills or Specialties Field -->
                <div class="mb-3">
                    <label for="specialties" class="form-label">Culinary Skills or Specialties</label>
                    <textarea class="form-control" id="specialties" name="specialties" rows="3">{{ old('specialties', $portfolio->specialties ?? '') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
    <a href="{{ route('portfolio.show', $user->id) }}" id="backLink" class="btn btn-secondary mt-3">Back to Portfolio</a>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Portfolio edit script loaded'); // Check if script runs

    var form = document.getElementById('portfolioForm');
    var formChanged = false;

    // Listen for input changes to mark the form as changed
    form.addEventListener('input', function() {
        formChanged = true;
    });

    // Warn user if they try to leave the page with unsaved changes (browser refresh, close, etc.)
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Intercept the "Back to Portfolio" link click
    var backLink = document.getElementById('backLink');
    backLink.addEventListener('click', function(e) {
        if (formChanged) {
            var confirmLeave = confirm("You have unsaved changes. Are you sure you want to leave this page?");
            if (!confirmLeave) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endsection
