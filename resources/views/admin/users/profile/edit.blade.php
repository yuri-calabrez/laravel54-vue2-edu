@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @component('admin.users.tabs-component', ['user' => $form->getModel()])
                <div class="col-md-12">
                    <h3>Editar perfil</h3>
                    {!!
                    form($form->add('insert', 'submit', [
                        'attr' => ['class' => 'btn btn-primary btn-block'],
                        'label' => Icon::create('pencil')." Editar"
                    ]))
                    !!}
                </div>
            @endcomponent
        </div>
    </div>

@endsection