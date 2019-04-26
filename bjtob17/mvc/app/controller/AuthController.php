<?php


namespace app\controller;


use app\service\IUserService;
use framework\controller\BaseController;
use framework\routing\IRequest;

class AuthController extends BaseController
{
    /**
     * @var IUserService
     */
    private $userService;

    /**
     * AuthController constructor.
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function postLogin(IRequest $request)
    {
        $body = $request->getBody();



        $user = $this->userRepo->getByUsername($body["username"]);
        if ($user !== null && $user->verifyPassword($body["password"])) {
            $this->login($body["username"]);
        } else {
            $errors = ["Invalid username or password"];
            return $this->html("login", ["page_title" => "Login", "_errors" => $errors]);
        }
    }


}