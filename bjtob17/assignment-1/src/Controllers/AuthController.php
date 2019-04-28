<?php

namespace Controllers;


use DependencyInjector\DependencyInjectionContainer;
use Models\Dto\UserDto;
use Repositories\Interfaces\IUserRepository;
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
        $this->redirect("/");
    }

    public function postRegister(IRequest $request)
    {
        $body = $request->getBody();
        $user = $this->userRepo->getByUsername($body["username"]);
        if ($user !== null) {
            $errors = ["Username already taken"];
            return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
        }
        else if (strlen($body["firstName"]) <= 1) {
            $errors = ["First name must have at least two character"];
            return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
        }
        else if (strlen($body["lastName"]) <= 1) {
            $errors = ["Last name must have at least two character"];
            return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
        }
        else if (strlen($body["zip"]) < 4) {
            $errors = ["Zip must be 4 numbers"];
            return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
        }
        else if (strlen($body["city"]) <= 1) {
            $errors = ["City name must be at least two characters"];
            return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
        }
        else if (strlen($body["email"]) <= 1 || strpos($body["email"], "@") === false) {
            $errors = ["Email must be at least two characters, and contain the '@' character"];
            return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
        }
        else if (strlen($body["phone"]) < 8) {
            $errors = ["Phone number must be at least eight characters"];
            return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
        }
        else {
            $userDto = new UserDto($body["username"], $body["password"], $body["firstName"],
                $body["lastName"], $body["zip"], $body["city"], $body["email"], $body["phone"]);
            $success = $this->userRepo->add($userDto);
            if (!$success) {
                $errors = ["An error occured"];
                return $this->html("register", ["page_title" => "Register", "_errors" => $errors]);
            } else {
                $this->redirect("/login");
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