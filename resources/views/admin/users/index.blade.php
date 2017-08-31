@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Listagem de usuários</h3>
        {!! Button::primary('<i class="fa fa-plus" aria-hidden="true"></i>')->asLinkTo(route('admin.users.create')) !!}


        <div class="row">
            <div class="col-md-12">
                {!! Table::withContents($users->items())->striped()->callback('Ações', function($fields, $model){
                    $linksEdit = route('admin.users.edit', ['users' => $model->id]);
                    $linksShow = route('admin.users.show', ['users' => $model->id]);
                    return Button::success('<i class="fa fa-pencil" aria-hidden="true"></i>')->asLinkTo($linksEdit) . ' ' .
                        Button::primary('<i class="fa fa-eye" aria-hidden="true"></i>')->asLinkTo($linksShow);

                }) !!}
            </div>
        </div>

        {!! $users->render() !!}
    </div>
@endsection