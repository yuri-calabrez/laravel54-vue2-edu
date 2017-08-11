@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Turma</h3>
            {!! Button::primary('Nova Turma')->asLinkTo(route('admin.class_informations.create')) !!}
        </div>

        <div class="row">
            {!!
            Table::withContents($class_informations->items())
            ->striped()
            ->callback('Editar', function($field, $class_information){
                return Button::primary(Icon::pencil().' Editar')
                    ->asLinkTo(route('admin.class_informations.edit', [
                    'class_information' => $class_information->id
                ]));
            })
            ->callback('Ver',function($field, $class_information){
                return Button::info(Icon::create('folder-open').'&nbsp;&nbsp; Ver')
                    ->asLinkTo(route('admin.class_informations.show', [
                    'class_information' => $class_information->id
                ]));
            })
            ->callBack('Alunos', function($field, $class_information){
                return Button::info(Icon::create('home').'&nbsp;&nbsp; Alunos')
                    ->asLinkTo(route('admin.class_informations.students.index', [
                    'class_information' => $class_information->id
                ]));
            })
            !!}
        </div>

        {!! $class_informations->links(); !!}
    </div>

@endsection