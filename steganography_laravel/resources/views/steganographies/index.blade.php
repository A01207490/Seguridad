@extends('layouts.app')

@section('content')

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        {{ __('Steganographies') }}
    </div>
</div>

<div class="card-body">
    {{ $table }}
</div>

@endsection