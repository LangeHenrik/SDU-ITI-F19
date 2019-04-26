<?php


namespace app\controller;


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
     * UserController constructor.
     * @param IUserService $userService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }


    public function getUsers(IRequest $request): IResponse
    {
        return $this->json($this->userService->findAll());
    }

    public function postRegister(IRequest $request): IResponse
    {

    }

    public function getRegister(IRequest $request): IResponse
    {
        return $this->html("register", ["page_title" => "Register"]);
    }
}