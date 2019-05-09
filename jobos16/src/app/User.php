<?php

namespace App;

use App\Core\Auth\Auth;
use App\Core\Persistence\DB\Model;
use App\Core\Utility\Uuid;

class User extends Model
{

    /**
     * Used to indicate if the model should use auto incrementing ID's
     *
     * @var bool
     */
    protected $incrementing = false;

    /**
     * The table in which the model is stored in
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The MySQL type of the primary key
     *
     * @var string
     */
    protected $primaryKeyType = 'string';

    /**
     * Attribute keys that may be assigned
     *
     * @var array
     */
    protected $fillable = [
        'id', 'email', 'phone', 'first_name', 'last_name', 'password', 'zip', 'city'
    ];

    /**
     * Attribute keys that may be mapped when in array form
     *
     * @var array
     */
    protected $arrayMap = [
        'id' => 'user_id',
        'email' => 'username'
    ];

    /**
     * Attribute keys that should be removed from the model in array form
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Attribute keys that will be converted to dates
     *
     * @var array
     */
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