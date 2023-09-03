@extends('errors.app')

@section('title')
401 Unauthorized
@endsection

@section('content')

<div class="card-body text-center">
    <h2>{{ __('401 Unauthorized') }}</h2>
    <div class="mt-3">
        <p>You do not have the necessary authorization to access this resource.</p>
    </div>
</div>

@endsection
