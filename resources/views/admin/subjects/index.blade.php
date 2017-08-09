@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de disciplinas</h3>
            {!! Button::primary('Nova disciplina')->asLinkTo(route('admin.subjects.create')) !!}
        </div>

        <div class="row">
            {!!
            Table::withContents($subjects->items())
            ->striped()
            ->callback('Editar', function($field, $subject){
                return Button::primary(Icon::pencil().' Editar')->asLinkTo(route('admin.subjects.edit', ['subject' => $subject->id]));
            })
            ->callback('Ver',function($field, $subject){
                return Button::info(Icon::create('folder-open').'&nbsp;&nbsp; Ver')->asLinkTo(route('admin.subjects.show', ['subject' => $subject->id]));
            })
            !!}
        </div>

        {!! $subjects->links(); !!}
    </div>

@endsection