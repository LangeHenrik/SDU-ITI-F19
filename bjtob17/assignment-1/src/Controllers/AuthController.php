<?php

namespace Controllers;


use Routing\IRequest;

class AuthController extends BaseController
{
    public function postLogin(IRequest $request)
    {
        $body = $request->getBody();
        if ($body["username"] === "bob" && $body["password"] === "secret") {
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