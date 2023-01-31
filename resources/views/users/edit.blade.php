@extends('layouts.site')

@section('content')

<h2>ALFASOFT - Laravel Teste</h2>

<div class="row p-2" >
    <div class="col">
        <div class="mb-3">
            <label for="name" class="form-label float-start">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset( $user->name ) ? $user->name : '' }}" required>
            <input type="hidden" name="id" value="{{ isset( $user->id ) ? $user->id : '' }}">
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label float-start">Email</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ isset( $user->contact ) ? $user->contact : '' }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label float-start">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ isset( $user->email ) ? $user->email : '' }}" required>
        </div>
        <div class="mb-3 mt-1">
            <label class="float-end">Criado em: <span class="badge bg-secondary">{{ isset( $user->created_at ) ? $user->created_at : '' }}</span></label>
            <label class="float-end">Atualizado em: <span class="badge bg-dark">{{ isset( $user->updated_at ) ? $user->updated_at : '' }}</span></label>
        </div>
    </div>
</div>
@endsection