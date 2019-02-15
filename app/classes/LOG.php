<?php

class LOG {

    public static function put($data = null, $user = '', $file = APP_STORAGE_PATH.'app.log') {

        if ($data !== null) {

            if (self::write($file, "\r\n")) {

                $data = (is_array($data)) ? implode('||', $data): $data;
                self::write($file, date(DATE_RFC2822).' '.$user.' '.$data);

            }else {

                echo '
                    <script>
                        console.log("Error escribiendo LOG");
                    </script>
                ';

            }

        }

    }

    private static function write($file = null, $data = null) {

        $result = 0;

        if ($file !== null && $data !== null) {

            if (file_put_contents($file, $data, FILE_APPEND)) { $result = 1; }

        }

        return $result;

    }

}
