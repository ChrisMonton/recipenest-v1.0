@extends('layouts.app')

@section('content')
    <style>
        .hero-section {
            background: url('{{ asset('images/kitchen.jpg') }}') center/cover no-repeat;
            height: 100vh;
            position: relative;
            color: white;
        }
        .hero-text {
            position: absolute;
            top: 40%;
            left: 10%;
            font-size: 3rem;
            font-weight: bold;
        }
    </style>

    <div class="hero-section">
        <div class="hero-text">
            <div>Cook</div>
            <div>Create</div>
            <div>Cherish</div>
        </div>
    </div>
@endsection
