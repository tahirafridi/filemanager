@extends('errors.app')

@section('title')
404 Page Notfound
@endsection

@section('content')

<div class="card-body text-center">
    <h2>{{ __('404 Page Notfound') }}</h2>
    <div class="mt-3">
        <p>The page or resource you are searching for does not exist.</p>
    </div>
</div>

@endsection
