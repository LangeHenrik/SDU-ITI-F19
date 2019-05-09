<?php


namespace services;


class SessionService
{


    /**
     * SessionService constructor.
     */
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function set_active_user_id(int $user_id)
    {
        $_SESSION['user'] = $user_id;
    }

    /**
     * Gets the currently active user id
     * @return int|null
     */
    public function get_active_user_id()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return null;
    }

    public function destroy_session()
    {
        session_unset();
        session_destroy();
    }
}