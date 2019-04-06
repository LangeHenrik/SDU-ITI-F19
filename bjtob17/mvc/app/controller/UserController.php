<?php


namespace app\controller;


use framework\controller\BaseController;
use framework\response\IResponse;
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