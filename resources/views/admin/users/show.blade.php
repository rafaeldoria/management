@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>View User</h3>

            @php
                $linkEdit = route('admin.users.edit',['user' => $user->id]);
                $linkDelete = route('admin.users.destroy',['user' => $user->id]);
            @endphp
            {!! Button::primary(Icon::edit().' Edit')->asLinkTo($linkEdit)!!}
            {!! 
                Button::danger(Icon::trash().' Delete')->asLinkTo($linkDelete)
                ->addAttributes([
                    'onclick' => "event.preventDefault();documento.getElementById(\"form-delete\").submit();"
                ]);
            !!}
            @php
                $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'url' => $linkDelete,
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ])
            @endphp
            {!! form($formDelete)!!}
            <br/>
            <br/>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row"> # </th>
                        <td>{{$user->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Name</th>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td>{{$user->email}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection