<?php
declare(strict_types=1);

namespace services;

use database\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Creates a new user
     *
     * @param string $username
     * @param string $password
     * @return null|string null if everything went okay, and error in a string otherwise
     * @throws \Exception
     */
    public function create_user(string $username, string $password)
    {
        // Check if the user already exists
        $user = $this->userRepository->get_user($username);

        if ($user) {
            return "Username is already in use";
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $user = $this->userRepository->create_user($username, $hash);

        if ($user) {
            $_SESSION['user'] = $user->user_id;
            return null;
        }
        return null;
    }

    /**
     * Does a login for the given user/password combination
     *
     * If the login is successful, then the session is updated
     *
     * @param string $username
     * @param string $password
     * @return string|null
     */
    public function login(string $username, string $password)
    {
        $user = $this->userRepository->get_user($username);

        if (!$user) {
            return "Login failed";
        }

        if (!password_verify($password, $user->password)) {
            return "Login failed";
        }

        $_SESSION['user'] = $user->user_id;

        return null;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function is_logged_in(): bool
    {
        return !!$_SESSION['user'];
    }
}