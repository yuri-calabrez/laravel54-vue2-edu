@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Ver disciplina</h3>
            @php
                $linkEdit = route('admin.subjects.edit', ['subject' => $subject->id]);
                $linkRemove = route('admin.subjects.destroy', ['subject' => $subject->id]);
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
                    <td>{{$subject->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$subject->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
