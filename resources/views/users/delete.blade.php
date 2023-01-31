@extends('layouts.site')

@section('content')

<h2>ALFASOFT - Laravel Teste</h2>

<div class="container-fluid">

    <div class="container">

        <div class="row mt-2">
            <h1 class="fs-1 text-start">Contato - Excluir</h1>
        </div>

        <div class="row card p-2" >

            <form action="{{ route( 'user.destroy' ) }}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('DELETE')

                <div class="row p-2" >
                    <div class="col">
                        <h4>Deseja realmente apagar o contato {{ $user->name }}?</h4>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <a type="button" class="btn btn-primary" href="{{ route( 'user.index' ) }}">Voltar</a>
                        <button type="submit" class="btn btn-success" >Excluir</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection