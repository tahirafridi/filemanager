@extends('errors.app')

@section('title')
503 Service Unavailable
@endsection

@section('content')

<div class="card-body text-center">
    <h2>{{ __('503 Service Unavailable') }}</h2>
    <div class="mt-3">
        <p>We apologize for any inconvenience caused, as our server maintenance is currently in progress.</p>
    </div>
</div>

@endsection
