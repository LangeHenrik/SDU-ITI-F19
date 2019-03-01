<?php


namespace controllers;


use framework\ActionResult;
use framework\ControllerBase;
use models\CreateUserRequest;
use models\IsLoggedInResponse;
use models\LoginUserRequest;
use models\ValidationError;
use services\SessionService;
use services\UserService;

class UserController extends ControllerBase
{

    /**
     * @var UserService
     */
    private $service;

    public function __construct(UserService $service, SessionService $sessionService)
    {
        parent::__construct($sessionService);
        $this->service = $service;
    }


    public function get(): ActionResult
    {
        if ($result = $this->required_authentication()) {
            return $result;
        }

        $users = $this->service->getUsers();

        return $this->Ok($users);
    }

    public function post(CreateUserRequest $body): ActionResult
    {
        $validation_result = $body->validate();

        if ($validation_result) {
            return $this->BadRequest(new ValidationError($validation_result));
        }

        $error = $this->service->create_user($body->username, $body->password);

        if ($error) {
            return $this->BadRequest(new ValidationError($error));
        }

        return $this->NoContent();
    }

    /**
     * Handle the route POST /api/user/login/
     *
     * @param LoginUserRequest $body
     * @return ActionResult
     */
    public function post_login(LoginUserRequest $body): ActionResult
    {
        $error = $this->service->login($body->username, $body->password);

        if ($error) {
            return $this->BadRequest(new ValidationError($error));
        }

        return $this->NoContent();
    }

    public function post_logout(): ActionResult
    {
        $this->service->logout();

        return $this->NoContent();
    }

    public function get_isLoggedIn(): ActionResult
    {
        $logged_in = $this->service->is_logged_in();

        return $this->Ok(new IsLoggedInResponse($logged_in));
    }
}