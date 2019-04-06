<?php


namespace app\controllers;


use framework\controllers\BaseController;
use framework\responses\IResponse;
use framework\routing\IRequest;

class UserController extends BaseController
{
    public function getUsers(IRequest $request): IResponse
    {
        return $this->json([
            [
                "user_id" => 1,
                "username" => "bob"
            ],
            [
                "user_id" => 2,
                "username" => "also bob"
            ]
        ]);
    }
}