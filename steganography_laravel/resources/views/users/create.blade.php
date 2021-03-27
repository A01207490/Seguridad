@extends('layouts.app')

@section('content')
<div class="card-header">
    {{ __('Crear') }}
</div>

<div class="card-body">
    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Juan Hernández López">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ejemplo@ejemplo.com">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row">
            <label for="carrera_id" class="col-md-4 col-form-label text-md-right">{{ __('Career') }}</label>

            <div class="col-md-6">
                <select id="carrera_id" name='carrera_id' class="custom-select @error('carrera_id') is-invalid @enderror" required>
                    @foreach($carreras as $carrera)
                    <option value="{{$carrera->id}}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>{{$carrera->carrera_nombre}}</option>
                    @endforeach
                </select>
                @error('carrera_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="semestre" class="col-md-4 col-form-label text-md-right">{{ __('Semester') }}</label>
            <div class="col-md-6">
                <select value="{{ old('semestre') }}" id="semestre" name='semestre' class="custom-select @error('semestre') is-invalid @enderror" required>
                    <option value="1" {{ old('semestre') == 1 ? 'selected' : '' }}>1°</option>
                    <option value="2" {{ old('semestre') == 2 ? 'selected' : '' }}>2°</option>
                    <option value="3" {{ old('semestre') == 3 ? 'selected' : '' }}>3°</option>
                    <option value="4" {{ old('semestre') == 4 ? 'selected' : '' }}>4°</option>
                    <option value="5" {{ old('semestre') == 5 ? 'selected' : '' }}>5°</option>
                    <option value="6" {{ old('semestre') == 6 ? 'selected' : '' }}>6°</option>
                    <option value="7" {{ old('semestre') == 7 ? 'selected' : '' }}>7°</option>
                    <option value="8" {{ old('semestre') == 8 ? 'selected' : '' }}>8°</option>
                    <option value="9" {{ old('semestre') == 9 ? 'selected' : '' }}>9°</option>
                    <option value="N/A" {{ old('semestre') == "N/A" ? 'selected' : '' }}>N/A</option>
                </select>
                @error('semestre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
            <div class="col-md-6">
                <input type="radio" id="student" name="role" value="Alumno" {{ old('role') == "Alumno" ? 'checked' : '' }} required>
                <label for="student">Alumno</label><br>
                <input type="radio" id="Administrador" name="role" value="Administrador" {{ old('role') == "Administrador" ? 'checked' : '' }} required>
                <label for="Administrador">Administrador</label><br>
                @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection