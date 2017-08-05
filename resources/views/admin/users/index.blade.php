@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Lista de usuários</h3>
            {!! Button::primary('Novo usuário')->asLinkTo(route('admin.users.create')) !!}
        </div>

        <div class="row">
            {!!
            Table::withContents($users->items())
            ->striped()
            ->callback('Editar', function($field, $user){
                return Button::primary(Icon::pencil().' Editar')->asLinkTo(route('admin.users.edit', ['user' => $user->id]));
            })
            ->callback('Ver',function($field, $user){
                return Button::info(Icon::create('folder-open').'&nbsp;&nbsp; Ver')->asLinkTo(route('admin.users.show', ['user' => $user->id]));
            })
            !!}
        </div>

        {!! $users->links(); !!}
    </div>

@endsection