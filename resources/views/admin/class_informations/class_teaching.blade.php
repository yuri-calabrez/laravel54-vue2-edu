@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Adicionar disciplina e professorna turma</h3>
        </div>
        <class-teaching class-information="{{$class_information->id}}"></class-teaching>
    </div>
    </div>
@endsection