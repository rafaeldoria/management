@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Edit User</h3>
            {!! 
                form($form->add('edit', 'submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => Icon::create('refresh').'&nbsp;&nbsp;Edit'
                ])) 
            !!}
        </div>
    </div>
@endsection