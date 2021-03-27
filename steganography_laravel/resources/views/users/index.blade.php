@extends('layouts.app')

@section('content')

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        {{ __('Students') }}
        <div>
            <a href="{{route('users.export')}}" title=" {{ __('Download') }}">
                <button type="button" class="btn btn-green-accent-4 btn-circle btn-sm">
                    <img src="{{ asset('img/icons/download.svg')}}" class="icon-white" alt="search" width="15px" height="15px">
                </button>
            </a>
            <a href="{{route('users.confirmDestroyAll')}}" title=" {{ __('Destroy all') }}">
                <button type="button" class="btn btn-red-darken-1 btn-circle btn-sm">
                    <img src="{{ asset('img/icons/delete.svg')}}" class="icon-white" alt="search" width="20px" height="20px">
                </button>
            </a>
        </div>

    </div>
</div>

<div class="card-body">
    {{ $table }}
</div>
@endsection