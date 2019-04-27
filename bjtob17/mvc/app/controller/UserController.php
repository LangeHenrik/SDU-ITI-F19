<?php


namespace app\controller;

use app\model\dto\UserLoginDto;
use app\model\dto\UserRegisterDto;
use app\service\IAuthService;
use app\service\IUserService;
use framework\controller\BaseController;
use framework\response\IResponse;
use framework\routing\IRequest;

class UserController extends BaseController
{
    /**
     * @var IUserService
     */
    private $userService;

    /**
     * @var IAuthService
     */
    private $authService;

    /**
     * @var string
     */
    private $registerAction;

    /**
     * @var string
     */
    private $loginAction;

    /**
     * UserController constructor.
     * @param IUserService $userService
     * @param IAuthService $authService
     */
    public function __construct(IUserService $userService, IAuthService $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
        $this->registerAction = $_SERVER["route_offset"] . "/register";
        $this->loginAction = $_SERVER["route_offset"] . "/login";
    }


    public function getUsers(IRequest $request): IResponse
    {
        return $this->json($this->userService->findAll());
    }

    public function getUsersHtml(IRequest $request): IResponse
    {
        return $this->html("users", [
            "page_title" => "Users",
            "users" => $this->userService->findAll()
        ]);
    }

    public function postLogout(IRequest $request): IResponse
    {
        $this->authService->logout();
        $this->redirect("/");
    }

    public function postLogin(IRequest $request): IResponse
    {
        $loginDto = UserLoginDto::fromArray($request->getBody());
        $errors = $this->authService->login($loginDto);
        if (count($errors) > 0) {
            return $this->html("login", [
                "page_title" => "login",
                "register_action" => $this->loginAction,
                "_errors" => $errors
            ]);
        } else {
            return $this->redirect("/");
        }
    }

    public function getLogin(IRequest $request): IResponse
    {
        return $this->html("login", [
            "page_title" => "Login",
            "login_action" => $this->loginAction
        ]);
    }

    public function postRegister(IRequest $request): IResponse
    {
        $registerDto = UserRegisterDto::fromArray($request->getBody());
        $errors = $this->userService->create($registerDto);
        if (count($errors) > 0) {
            return $this->html("register", [
                "page_title" => "Register",
                "register_action" => $this->registerAction,
                "_errors" => $errors
            ]);
        } else {
            return $this->redirect("/login");
        }
    }

    public function getRegister(IRequest $request): IResponse
    {
        return $this->html("register", [
            "page_title" => "Register",
            "register_action" => $this->registerAction
        ]);
    }
}