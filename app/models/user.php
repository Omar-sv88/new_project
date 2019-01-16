<?php

class userModel {

    /**
     * Login.
     *
     * The login app
     * User Def => Developer
     * Pass Def => 1234
     *
     * @param  $user = string
     * @param  $pass = string
     * @return number
     */

    public function login($user = null, $pass = null){

        $result = 0;

        if ($user !== null && $pass !== null) {

            $result = ($user === 'Developer' && $pass === '1234') ? 1: 0;

        }

        return $result;

    }

}