<?php

class SESSION {

    /**
     * Have.
     *
     * You can know if session have start
     *
     * @return number
     */

    public static function have(){

        session_start();
        return (isset($_SESSION['user']) && !empty($_SESSION['user']) && is_array($_SESSION['user']) || ENV === 'DEV') ? 1: 0;

    }

    /**
     * Start.
     *
     * You can start a session with $_SESSION['user] empty array
     *
     * @return number
     */

    public static function start(){

        session_start();
        $_SESSION['user'] = array();
        return 1;

    }

    /**
     * Destroy.
     *
     * You can destroy a session
     *
     * @return number
     */

    public static function destroy(){

        session_start();
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );

        }

        session_destroy();
        return 1;

    }

}