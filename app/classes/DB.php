<?php

class DB {

    /**
     * The db's driver.
     *
     * @var string
     */

    private $driver;

    /**
     * The mysql's host.
     *
     * @var string
     */

    private $host;

     /**
     * The mysql's db name.
     *
     * @var string
     */

    private $db;

     /**
     * The mysql's user.
     *
     * @var string
     */

    private $user;

     /**
     * The mysql's pass.
     *
     * @var string
     */

    private $pass;

     /**
     * The mysql's charset.
     *
     * @var string
     */

    private $charset;

     /**
     * The d3's perl.
     *
     * @var string
     */

    private $pl;

    /**
     * The token to authentify.
     *
     * @var string
     */

    private $token;

    /**
     * The d3's json encode and decode.
     *
     * @var number
     */

    private $json;

    private static function init(){

        self::$config  = require_once CONFIG_PATH.'db.php';
        self::$driver       = self::$config['driver'];
        self::$host         = self::$config['mysql']['host'];
        self::$db           = self::$config['mysql']['db'];
        self::$user         = self::$config['mysql']['user'];
        self::$pass         = self::$config['mysql']['pass'];
        self::$charset      = self::$config['mysql']['charset'];
        self::$pl           = self::$config['d3']['pl'];

    }

    public static function d3($prog, $params){

        if (empty(self::$config)) { self::init(); }

        $command = '/'.self::$pl.' '.$prog.'#'.$params;
        $exec = exec($command,$result);

        $status = explode('#', $result[0]);
        switch ($status[0]) {

            case '1':

                if (!isset($_SESSION)) { session_start(); }
                $_SESSION['user']['token'] = $result[1];

            break;

            case '0':

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
                header('Location: index.php?login=1&errCode='.$status[1]);
                exit;

            break;


        }

        unset($status);
        return $result;

    }

    /**
     * Mysql Conection.
     *
     * We prepare the conection with the mysql server
     *
     * @return object
     */

    public static function mysql(){

        $conection = new mysqli(self::$host,self::$user,self::$pass,self::$db);
        $conection->query("SET NAMES '".self::$charset."'");
        return $conection;

    }

}