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
        'id', 'user', 'file', 'caption', 'title'
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

    public function jsonSerialize()
    {
        return [
            'image_id' => $this->id,
            'user_id' => $this->user,
            'title' => $this->title,
            'description' => $this->caption,
            'image' => "data:image/jpeg;base64," . base64_encode(file_get_contents(__DIR__ . "/../public/uploads/{$this->file}")),
        ];
    }


}