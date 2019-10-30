@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>User List</h3>
            {!! Button::primary(Icon::plus().' New User')->asLinkTo(route('admin.users.create')) !!}
        </div>
        <div class="row">
            {!!
                Table::withContents($users->items())
                    ->striped()
                    ->callback('Actions', function($field, $model){
                        $linkEdit = route('admin.users.edit',['user' => $model->id]);
                        $linkShow = route('admin.users.show',['user' => $model->id]);
                        return Button::link(Icon::edit().'&nbsp;&nbsp;Edit')->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::create('eye-open').'&nbsp;&nbsp;View')->asLinkTo($linkShow);
                    })
            !!}
            {!! $users->links() !!}
        </div>
    </div>
@endsection