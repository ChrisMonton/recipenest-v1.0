@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
    @endif

    <!-- Form to update profile information -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Profile Picture Upload -->
        <div class="mb-3">
            <label for="profilePicture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profilePicture" name="profile_picture" accept="image/*">
            @if(Auth::user()->profile_picture)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Current Profile Picture" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
            @endif
        </div>

        <!-- Bio -->
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Enter a short bio...">{{ old('bio', Auth::user()->bio) }}</textarea>
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter your phone number">
        </div>

        <!-- Specialties (max 3) -->
        <div class="mb-3">
            <label class="form-label">Specialties <small class="text-muted">(Choose up to 3)</small></label>
            @php
                $options = [
                    'Soups','Stews','Stir-fries','Grills / Barbecues','Roasts','Curries',
                    'Bakes / Casseroles','Sandwiches / Wraps / Burgers','Noodles / Pasta',
                    'Rice dishes','Pies / Tarts','Pancakes / Crepes / Waffles','Dumplings',
                    'Skewers / Kebabs','Sushi / Sashimi','Pickles / Fermented foods',
                    'Dips / Spreads','Smoothies / Shakes'
                ];
                $current = old('specialties', Auth::user()->specialties ? explode(',', Auth::user()->specialties) : []);
            @endphp
            <div id="specialties-group">
                @foreach($options as $idx => $opt)
                    <div class="form-check form-check-inline">
                        <input
                          class="form-check-input specialty-checkbox"
                          type="checkbox"
                          id="spec-{{ $idx }}"
                          name="specialties[]"
                          value="{{ $opt }}"
                          {{ in_array($opt, $current) ? 'checked' : '' }}>
                        <label class="form-check-label" for="spec-{{ $idx }}">{{ $opt }}</label>
                    </div>
                @endforeach
            </div>
            @error('specialties')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<script>
  // enforce max 3 specialties
  document.querySelectorAll('.specialty-checkbox').forEach(cb => {
    cb.addEventListener('change', function(){
      const checked = document.querySelectorAll('.specialty-checkbox:checked');
      if(checked.length > 3){
        this.checked = false;
        alert('You can select up to 3 specialties only.');
      }
    });
  });
</script>
@endsection
