@extends('layouts.site')

@section('content')

<h2>ALFASOFT - Laravel Teste</h2>

<div class="container-fluid">

    <div class="container">

        <div class="row mt-2">
            <h1 class="fs-1 text-start">Login</h1>
        </div>

        <div class="row card p-2" >

            <form action="{{ route( 'login.auth' ) }}" method="POST" enctype="multipart/form-data" >
                @csrf

                <div class="row p-2" >
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label float-start">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label float-start">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col">
                        <a type="button" class="btn btn-primary" href="{{ route( 'user.index' ) }}">Voltar</a>
                        <button type="submit" class="btn btn-success" >Entrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection