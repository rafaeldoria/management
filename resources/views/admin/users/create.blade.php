@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>New User</h3>
            {!! 
                form($form->add('create', 'submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => Icon::create('floppy-disk').'&nbsp;&nbsp;Save'
                ])) 
            !!}
        </div>
    </div>
@endsection