@extends('layouts.site')

@section('content')

<h2>ALFASOFT - Laravel Teste</h2>

<div class="container text-center">

    <div class="row container mt-2">

        <div class="row text-start">
            <h1 class="fs-1">Contatos</h1>
        </div>

        <nav class="navbar">
            <div class="container-fluid float-start">
              <form role="search" action= "{{route( 'user.index' )}}" method="GET">
                <input class="form-control" type="search" placeholder="Nome" aria-label="Search" name="filter_name">
                <input class="form-control" type="search" placeholder="Email" aria-label="Search" name="filter_email">
                <input class="form-control" type="search" placeholder="Contato" aria-label="Search" name="filter_contact">
                <button class="btn btn-success" type="submit">Pesquisar</button>
            </form>
            <a class="btn btn-primary float-end" type="buttom" href="{{ route( 'user.edit' ) }}"><i class="bi bi-plus-lg"></i>Novo</a></a>
            </div>
        </nav>

        <div class="card p-2 table-responsive" >
            <table class="table table-striped table-hover">
                <thead>
                    <tr >
                        <th></th>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Email</th>
                        <th>Cadastro</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($collection as $item)
                    <tr class="align-middle">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->contact }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ date("d-m-Y H:i",strtotime( $item->created_at ) ) }}</td>
                        <td>
                            <div class="d-grid gap-1 d-md-flex justify-content-md-end action-buttons">
                                <a class="btn" type="buttom" href="{{ route( 'user.edit', [ $item->id ] ) }}">Editar</a>
                                <a class="btn" type="button" href="{{ route( 'user.delete', [ $item->id ] ) }}">Excluir</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- {{$collection->links('includes.pagination')}} --}}

    </div>
</div>
@endsection