<?php

namespace App;

use App\Core\Auth\Auth;
use App\Core\Persistence\DB\Model;
use App\Core\Utility\Uuid;

class PictureLike extends Model
{

    protected $table = 'picture_likes';

    protected $fillable = [
        'id', 'picture', 'user'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

}