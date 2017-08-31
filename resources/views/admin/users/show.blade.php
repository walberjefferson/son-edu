@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Ver de usuário</h3>
        {!! Button::primary('<i class="fa fa-plus" aria-hidden="true"></i>')->asLinkTo(route('admin.users.create')) !!}
        @php
            $linksEdit = route('admin.users.edit', ['users' => $user->id]);
            $linkDelete = route('admin.users.destroy', ['users' => $user->id]);
        @endphp

        {!! Button::success('<i class="fa fa-pencil" aria-hidden="true"></i>')->asLinkTo($linksEdit) !!}
        {!! Button::danger('<i class="fa fa-trash" aria-hidden="true"></i>')->asLinkTo($linkDelete)->addAttributes([
        'onclick' => "event.preventDefault(); document.getElementById(\"form-delete\").submit();"
        ]) !!}

        @php
            $formDelete = FormBuilder::plain([
                'id' => 'form-delete',
                'url' => $linkDelete,
                'method' => 'DELETE',
                'style' => 'display:none;'
            ])
        @endphp

        {!! form($formDelete) !!}

        <br><br>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection