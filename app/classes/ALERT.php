<?php

class ALERT {
    
     /**
     * Have Alert
     *
     * You can know if have vars to init alert
     *
     * @return bool
     */

    private static function have() {

        return (isset($_GET['alert']) && isset($_GET['msg']) && !empty($_GET['alert']) && !empty($_GET['msg'])) ? 1: 0;

    }
    
     /**
     * Show Alert.
     *
     * You can show alert
     * @param  $alert = string
     * @param  $msg = string
     *
     * @return bool
     */

    public static function show($alert = null, $msg = null) {

        if (self::have()) {

            $alert = ($_GET['alert'] === 'success') ? 'success': 'danger';
            $msg = $_GET['msg'];

        }

        if ($alert !== null && $msg !== null) {

            echo '
            <div class="alert alert-'. $alert .' alert-dismissible fade show mb-5" role="alert">
                '. $msg .'
                    <button class="close" type="button" data-dismiss="alert" aria-label="Cerrar">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            ';

        }

    }

}
