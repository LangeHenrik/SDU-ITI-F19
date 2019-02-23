<?php

namespace Controllers;


use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\UserDto;
use Repositories\Interfaces\IUserRepository;
use Repositories\UserRepository;
use Routing\IRequest;

class AuthController extends BaseController
{
    /**
     * @var IUserRepository;
     */
    private $userRepo;

    /**
     * @param DependencyInjectionContainer $di
     * @param $config
     */
    public function __construct(DependencyInjectionContainer $di, $config)
    {
        parent::__construct($config);
        $this->userRepo = $di->get(IUserRepository::class);
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

    public function getLogin(IRequest $request)
    {
        return $this->html("login", ["page_title" => "Login"]);
    }

    public function logout(IRequest $request)
    {
        session_unset();
        session_destroy();
        unset($_SESSION["username"]);
        unset($_SESSION["loggedin"]);
        $this->redirect("/login");
    }

    public function postRegister(IRequest $request)
    {
        $body = $request->getBody();
        $user = $this->userRepo->getByUsername($body["username"]);
        if ($user !== null) {
            $errors = ["Username already taken"];
            return $this->html("register", ["_errors" => $errors]);
        } else if ($body["password"] !== $body["password2"]) {
            $errors = ["Passwords must match"];
            return $this->html("register", ["_errors" => $errors]);
        } else if(strlen($body["username"]) < 2 || strlen($body["password"]) < 6) {
            $errors = ["Username must be atleast 2 characters, and password must be atleast 6"];
            return $this->html("register", ["_errors" => $errors]);
        } else {
            $userDto = new UserDto($body["username"], $body["password"]);
            $success = $this->userRepo->add($userDto);
            if (!$success) {
                $errors = ["An error occured"];
                return $this->html("register", ["_errors" => $errors]);
            } else {
                $this->login($userDto->username);
            }
        }
    }

    public function getRegister(IRequest $request)
    {
        return $this->html("register", ["page_title" => "Register"]);
    }

    private function login($username)
    {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $this->redirect("/");
    }

}