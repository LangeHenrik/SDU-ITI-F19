<?php

namespace App;

use App\Core\Auth\Auth;
use App\Core\Persistence\DB\Model;
use App\Core\Utility\Uuid;

class User extends Model
{

    protected $incrementing = false;

    protected $table = 'users';

    protected $primaryKeyType = 'string';

    protected $fillable = [
        'id', 'email', 'phone', 'first_name', 'last_name', 'password', 'zip', 'city'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected function primaryKey()
    {
        return Uuid::generate();
    }

    public static function currentUser()
    {
        /** @var User $u */
        $u = User::find(Auth::currentSession());

        // Return user object if the user was found
        if($u && $u->exists) {
            return $u;
        }

        return false;
    }

    public function name()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}