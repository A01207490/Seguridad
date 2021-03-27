@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="card w-100" style="width: 18rem;">
        <img class="card-img-top imgfit-lg" src="{{asset('storage/steganography/'. $steganography->id .'.png')}}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{$steganography->steganography_ket}}</h5>
            <p class="card-text">
                {{$steganography->steganography_message}}
            </p>
        </div>
        <div class="card-body">
            <a href="{{route('steganographies.index')}}" class="card-link">
                <button class="btn btn-primary">
                    {{ __('Go Back') }}
                </button>
            </a>
        </div>
    </div>
</div>
@endsection