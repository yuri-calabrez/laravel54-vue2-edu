@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Ver Turma</h3>
            @php
                $linkEdit = route('admin.class_informations.edit', ['class_information' => $class_information->id]);
                $linkRemove = route('admin.class_informations.destroy', ['class_information' => $class_information->id]);
                $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'url' => $linkRemove,
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ])
            @endphp
            {!! form($formDelete) !!}

            {!! Button::primary(Icon::pencil().' Editar')->asLinkTo($linkEdit) !!}
            {!!
            Button::danger(Icon::remove().' Remover')->asLinkTo($linkRemove)
                ->addAttributes([
                    'onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"
                ])
            !!}
            <br><br>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$class_information->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Data Início</th>
                    <td>{{$class_information->date_start->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <th scope="row">Data Fim</th>
                    <td>{{$class_information->date_start->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <th scope="row">Ciclo</th>
                    <td>{{$class_information->cycle}}</td>
                </tr>
                <tr>
                    <th scope="row">Subdivisão</th>
                    <td>{{$class_information->subdivision}}</td>
                </tr>
                <tr>
                    <th scope="row">Semester</th>
                    <td>{{$class_information->year}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection