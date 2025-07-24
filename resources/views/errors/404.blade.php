{{-- @extends('errors::minimal') --}}
@extends('errors.minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

{{-- @extends('errors.minimal')

@section('title', 'Page Not Found')
@section('code', '404')
@section('message')
    <div style="text-align: center; padding: 50px;">
        <h1 style="font-size: 100px; color: #dc3545;">404</h1>
        <h2 style="font-size: 32px; margin-top: 20px;">Oops! Page Not Found</h2>
        <p style="font-size: 18px; color: #666;">
            The page you are looking for doesn't exist or has been moved.
        </p>
        <a href="{{ route('dashboard') }}"
            style="display: inline-block; margin-top: 30px; padding: 10px 20px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 5px;">
            Go to Homepage
        </a>
    </div>
@endsection --}}
