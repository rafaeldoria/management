<?php

namespace App\Models;

use App\Notifications\UserCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bootstrapper\Interfaces\TableInterface;

class User extends Authenticatable implements TableInterface
{
    use Notifiable;
    const ROLE_ADMIN = 1;
    const ROLE_TEACHER = 2;
    const ROLE_STUDENT = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'enrolment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function createFully($data)
    {
        $password = str_random(6);
        $data['password'] = $password;
        $user = parent::create($data+['enrolment' => str_random(6)]);
        self::assingEnrolment($user, self::ROLE_ADMIN);
        $user->save();

        if(isset($data['send_mail'])){
            $token = \Password::broker()->createToken($user);
            $user->notify(new UserCreated($token));
        }

        return compact('user', 'password');
    }

    public static function assingEnrolment(User $user, $type)
    {
        $types = [
            self::ROLE_ADMIN => 100000,
            self::ROLE_TEACHER => 400000,
            self::ROLE_STUDENT => 700000,
        ];
        $user->enrolment = $types[$type] + $user->id;
        return $user->enrolment;
    }

    public function getTableHeaders()
    {
        return ['#', 'Name', 'Email'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Name':
                return $this->name;
            case 'Email':
                return $this->email;
        }
    }
}
