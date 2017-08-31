@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Novo usuário</h3>
        {!! form($form->add('submit', 'submit', ['label' => '<i class="fa fa-floppy-o" aria-hidden="true"></i> Editar', 'attr' => [ 'class' => ' btn btn-block btn-primary']])) !!}
    </div>
@endsection