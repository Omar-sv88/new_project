<?php

class USER extends CONTROLLER {
    protected $model = 'user';
    private $user;

    /**
     * Login.
     *
     * You can login in to the app
     *
     * @return number
     */

    public function login(){

        $user = (isset($_POST['user']) && !empty($_POST['user'])) ? $_POST['user']: null;
        $pass = (isset($_POST['pass']) && !empty($_POST['pass'])) ? $_POST['pass']: null;
        $result = 0;

        if ($user !== null && $pass !== null) {

            $result = $this->model->login($user, $pass);
            $this->user = [
                'name' => $user,
                'pass' => $pass
            ];

        }

        return $result;

    }

    /**
     * Get Name.
     *
     * You can get the user's name
     *
     * @return number
     */

    public function getName() {

        return $this->user['name'];

    }

}
