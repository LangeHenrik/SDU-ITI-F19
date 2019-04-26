<?php

namespace App;

use App\Core\Auth\Auth;
use App\Core\Persistence\DB\Model;
use App\Core\Utility\Uuid;

class Picture extends Model
{

    protected $incrementing = false;

    protected $table = 'pictures';

    protected $primaryKeyType = 'string';

    protected $fillable = [
        'id', 'user', 'file', 'caption'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected function primaryKey()
    {
        return Uuid::generate();
    }

    public function userObject() {
        return User::find($this->user);
    }

    public function getURL() {
        return "#";
    }

    public function userName()
    {
        return $this->userObject()->name;
    }

    public function likes()
    {
        $count = count(PictureLike::findAllWhere([
            'picture', "=", $this->id
        ]));

        if($count == 0) {
            return "";
        }
        return $count;
    }

}