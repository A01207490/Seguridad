@extends('layouts.app')

@section('content')
<div class="row p-2 mt-2 d-flex justify-content-center align-items-center">
    <div class="col-12 col-sm-11 col-md-8 col-lg-6 col-xl-5">
        <div class="alert alert-danger w-100" role="alert">
            <h4 class="alert-heading">¡Advertencia!</h4>
            <p>¿Está seguro de borrar el registro?</p>
            <hr>
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route($index)}}" class="pl-2 ">
                    <button class="btn btn-primary">
                        Cancelar
                    </button>
                </a>
                <form method="POST" class="pl-2 " action="{{route($destroy, $type)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary">
                        Aceptar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection