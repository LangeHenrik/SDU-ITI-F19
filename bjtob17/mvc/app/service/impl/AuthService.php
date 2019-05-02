<?php


namespace app\service\impl;


use app\model\dto\UserLoginDto;
use app\service\IAuthService;
use app\service\IUserService;
use app\util\AuthUtil;

class AuthService implements IAuthService
{

    /**
     * @var IUserService
     */
    private $userService;

    /**
     * AuthService constructor.
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }


    function isLoggedInWeb(): bool
    {
        return AuthUtil::isLoggedIn();
    }

    function isLoggedInApi(string $username, string $password): bool
    {
        $userInDb = $this->userService->findByUsername($username);
        if ($userInDb == null) {
            return false;
        }
        if (!$userInDb->verifyPassword($password)) {
            return false;
        }
        return true;
    }

    function login(UserLoginDto $loginDto): array
    {
        $userInDb = $this->userService->findByUsername($loginDto->username);
        $errors = [];
        if ($userInDb == null) {
            array_push($errors, "Invalid username or password");
        } else if (!$userInDb->verifyPassword($loginDto->password)) {
            array_push($errors, "Invalid username or password");
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $this->actualLogin($loginDto->username);
        return $errors;
    }

    private function actualLogin($username)
    {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
    }

    function logout()
    {
        session_unset();
        session_destroy();
        unset($_SESSION["username"]);
        unset($_SESSION["loggedin"]);
    }
}