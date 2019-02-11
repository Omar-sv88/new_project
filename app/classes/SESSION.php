<?php

class SESSION {
    
     /**
     * Is Session Started.
     *
     * You can know if session have start
     *
     * @return bool
     */
    
    public static function is_session_started() {

        $result = FALSE;
        if ( php_sapi_name() !== 'cli' ) {

            if ( version_compare(phpversion(), '5.4.0', '>=') ) {

                $result =  (session_status() === PHP_SESSION_ACTIVE) ? TRUE : FALSE;

            } else {

                $result = (session_id() === '') ? FALSE : TRUE;

            }

            if (!$result) {

                if (session_status() == PHP_SESSION_NONE) { session_start(); }
                $result = self::haveData();

            }

        }

        return $result;

    }

    /**
     * Have Data.
     *
     * You can know if var session is empty
     *
     * @return bool
     */

    private static function haveData(){

        $result = (isset($_SESSION['user']) && !empty($_SESSION['user']) && is_array($_SESSION['user']) || ENV === 'DEV') ? TRUE: FALSE;
        return $result;

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
