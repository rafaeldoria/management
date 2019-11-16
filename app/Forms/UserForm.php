<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('name', 'text', [
                'rules' => 'required|max:255'
            ])
            ->add('email', 'email', [
                'label' => 'E-mail',
                'rules' => "required|max:255|email|unique:users,email,{$id}"
            ])
            ->add('send_mail', 'checkbox', [
                'label' => 'Send welcome email',
                'value' => true,
                'checked' => false
            ]);
    }
}
