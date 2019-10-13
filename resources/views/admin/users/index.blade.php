@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>User List</h3>
            {!! Button::primary('New User')->asLinkTo(route('admin.users.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($users->items())
                    ->striped()
                    ->callback('Actions', function($field, $model){
                        $linkEdit = route('admin.users.edit',['user' => $model->id]);
                        $linkShow = route('admin.users.show',['user' => $model->id]);
                        return Button::link('Edit')->asLinkTo($linkEdit).'|'.
                            Button::link('Show')->asLinkTo($linkShow);
                    })
            !!}
            {!! $users->links() !!}
        </div>
    </div>
@endsection