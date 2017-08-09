@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Nova Disciplina</h3>
            {!!
            form($form->add('insert', 'submit', [
                'attr' => ['class' => 'btn btn-primary btn-block'],
                'label' => Icon::create('floppy-disk')." Inserir"
            ]))
            !!}
        </div>
    </div>

@endsection