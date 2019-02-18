<?php

namespace Controllers;


use Repositories\UserRepository;
use Routing\IRequest;

class AuthController extends BaseController
{
    private $userRepo;

    /**
     * AuthController constructor.
     * @param $userRepo UserRepository
     */
    public function __construct($userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function postLogin(IRequest $request)
    {
        $body = $request->getBody();
        $user = $this->userRepo->getByUsername($body["username"]);
        if ($user !== null && $user->hashedPassword === $body["password"]) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $body["username"];
            $this->redirect("/");
        } else {
            $errors = ["Invalid username or password"];
            return $this->html("login", $errors);
        }
    }

    public function getLogin(IRequest $request)
    {
        return $this->html("login");
    }

    public function logout(IRequest $request)
    {
        session_unset();
        session_destroy();
        unset($_SESSION["username"]);
        unset($_SESSION["loggedin"]);
        $this->redirect("/login");
    }

}