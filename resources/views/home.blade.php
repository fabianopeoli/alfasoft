@extends('layouts.site')

@section('content')

<h2>ALFASOFT - Laravel Teste</h2>

<div class="container text-center">

    <div class="row container mt-2">

        <div class="row text-start">
            <h1 class="fs-1">Contatos</h1>
        </div>

        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid float-start">
              <form class="d-flex" role="search" action= "{{route( 'user.index' )}}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Nome" aria-label="Search" name="filter_name">
                <input class="form-control me-2" type="search" placeholder="Email" aria-label="Search" name="filter_email">
                <input class="form-control me-2" type="search" placeholder="Contato" aria-label="Search" name="filter_contact">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
            </form>
            <button class="btn btn-outline-primary float-end" type="buttom" data-bs-target="#modalEdit" data-bs-toggle="modal" style="border-radius:50%;width:40px;height:40px" onclick="{{ route( 'user.create' )}}"><i class="bi bi-plus-lg"></i></a></button>
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
                        <td>{{ $item-id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->contact }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ date("d-m-Y H:i",strtotime( $item->created_at ) ) }}</td>
                        <td>
                            <div class="d-grid gap-1 d-md-flex justify-content-md-end action-buttons">
                                <a class="btn btn-outline-primary float-end" type="buttom" href="{{ route( 'user.edit', [ $item->id ] ) }}"><i class="bi bi-pencil"></i></a>
                                <button class="btn btn-outline-danger btn-sm" type="button" onclick="deleteItem( $item->id )"><i class="bi bi-trash fs-5"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{$collection->links('components.pagination')}}

    </div>
</div>

<script>
    var deleteItem = function(id){
        if( confirm('Confirme excluir o contato?') ){
            location.href = "{{ route( 'user.destroy', [" + id + "] ) }}";
        }
        return false;
    }
</script>

@endsection