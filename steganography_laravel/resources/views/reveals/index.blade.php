@extends('layouts.app')

@section('content')

<div class="card-header">
    {{ __('Reveal') }}
</div>

<div class="card-body">
    <form method="POST" action="{{route('reveals.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="steganography_key" class="col-md-4 col-form-label text-md-right">{{ __('Key') }}</label>
            <div class="col-md-6">
                <input id="steganography_key" type="text" class="form-control @error('steganography_key') is-invalid error-input @enderror" name="steganography_key" value="{{ old('steganography_key') }}" required autocomplete="steganography_key" autofocus placeholder="echo117">
                @error('steganography_key')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

       

        <div class="form-group row">
            <label for="steganography_image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
            <div class="col-md-6">
                <input id="steganography_image" type="file" class="form-control-file @error('steganography_image') is-invalid error-input @enderror" name="steganography_image" value="{{ old('steganography_image') }}" autocomplete="steganography_image" autofocus placeholder="Festival de Atletismo y Borrego Plateado.">
                @error('steganography_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Accept') }}
                </button>
            </div>
        </div>

    </form>
</div>
@endsection