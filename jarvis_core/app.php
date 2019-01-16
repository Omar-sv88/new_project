<?php

class App {

    /**
     * The argument's passing in console.
     *
     * @var array
     */

    private $_ARGUMENTS;

    /**
     * Construct's class
     *
     * @return string
     */

     public function __construct($argv){

        echo 'Welcome to Jarvis!'.PHP_EOL;
        echo "Loading App's Core...".PHP_EOL;
        echo "----------------------------------------------".PHP_EOL;
        $this->_ARGUMENTS = $this->arguments($argv);
        echo "App's Core loaded...".PHP_EOL;
        echo "----------------------------------------------".PHP_EOL.PHP_EOL;

     }

     /**
     * Destruct's class
     *
     * @return string
     */

     public function __destruct(){

        echo PHP_EOL."Removing App's Core...".PHP_EOL;
        echo "----------------------------------------------".PHP_EOL;
        unset($this->_ARGUMENTS);
        echo "Removed App's Core...".PHP_EOL;
        echo "----------------------------------------------".PHP_EOL;
        echo "Bye :)".PHP_EOL.PHP_EOL;

     }

    /**
     * Explode arguments passing by console.
     *
     * @param  $argv = array();
     * @return array
     */

    public function arguments($argv) {

        $_ARG = array();

        foreach ($argv as $i => $arg) {

            switch ($i){

                case 1:
                    $explode_action = explode(':', $arg);
                    $_ARG['command'] = $explode_action[0];
                    $_ARG['option'] = $explode_action[1];
                break;

                case 2:
                    $_ARG['name'] = $arg;
                break;

            }

        }

        $_ARG['command'] = (empty($_ARG['command'])) ? '': $_ARG['command'];
        return $_ARG;

    }

    /**
     * Create controllers and models.
     *
     * @param  $component = string   controller/model;
     * @return string
     */

    public function create($component) {

        $name = strtoupper($this->_ARGUMENTS['name']).'.php';

        switch ($component) {

            case 'class':
                echo 'Creating '. $name. ' ' .PHP_EOL;
                $dir = CLASSES_PATH.$name;
                $fileToCreate = CLASSES_PATH.$this->_ARGUMENTS['name'].'.php';
                $changes = [
                    [
                        'search'    => "inputName",
                        'replace'   => strtoupper($this->_ARGUMENTS['name'])
                    ],
                    [
                        'search'    => "inputNameModel",
                        'replace'   => $this->_ARGUMENTS['name']
                    ],
                ];
                if(file_exists($dir)){ $message = "File $name exists"; }
                else {

                    if (fopen($dir,'w+')){

                        if (copy('./jarvis_core/models/class.tfd', $fileToCreate)){
                            $file = fopen($fileToCreate, 'r');
                            while (!feof($file)){ $line[] = fgets($file); }
                            fclose($file);
                            $file = fopen($fileToCreate,'w+');
                            foreach ($line as $arg){

                                $arg = str_replace($changes[1]['search'], $changes[1]['replace'], $arg);
                                $arg = str_replace($changes[0]['search'], $changes[0]['replace'], $arg);
                                fwrite($file, $arg);

                            }

                            fclose($file);
                            $message = "File $name created";

                        }else { $message = "Error creating $name"; }
                    }else { $message = "Can't create file $name"; }
                }
                echo $message.PHP_EOL;
            break;

            case 'model':
                $name = strtolower($this->_ARGUMENTS['name']).'.php';
                echo 'Creating '. $name. ' ' .PHP_EOL;
                $dir = MODELS_PATH.$name;
                $fileToCreate = MODELS_PATH.$this->_ARGUMENTS['name'].'.php';
                $changes = [
                    [
                        'search'    => "inputName",
                        'replace'   => strtolower($this->_ARGUMENTS['name'])
                    ],
                ];
                if(file_exists($dir)){ $message = "File $name exists"; }
                else {

                    if (fopen($dir,'w+')){

                        if (copy('./jarvis_core/models/model.tfd', $fileToCreate)){

                            $file = fopen($fileToCreate, 'r');
                            while (!feof($file)){ $line[] = fgets($file); }
                            fclose($file);
                            $file = fopen($fileToCreate,'w+');
                            foreach ($line as $arg){

                                $arg = str_replace($changes[0]['search'], $changes[0]['replace'], $arg);
                                fwrite($file, $arg);

                            }
                            fclose($file);
                            $message = "File $name created";
                        }else { $message = "Error creating $name"; }
                    }else { $message = "Can't create file $name"; }
                }
                echo $message.PHP_EOL;
            break;

        }

    }

    /**
     * Remove controllers and models.
     *
     * @param  $component = string   controller/model;
     * @return string
     */

     public function remove($component) {

        switch ($component){

            case 'class':
                $name = strtoupper($this->_ARGUMENTS['name']).'.php';
                $dir = CLASSES_PATH.$name;
            break;

            case 'model':
                $name = strtolower($this->_ARGUMENTS['name']).'.php';
                $dir = MODELS_PATH.$name;
            break;

        }

        if (file_exists($dir)) {

            $message = (unlink($dir)) ? "File $name removed": "File $name not removed!";

        }else { $message = "File $name not found!"; }

        echo $message.PHP_EOL;

     }

    /**
     * Print Copyright Information.
     *
     * @return string
     */

    public function getCopyritght(){

        $copyright = [
            '/**',
            '*',
            '* Jarvis 1.0',
            '* By Omar Santos <dev@omarsantos.es>',
            '*',
            '**/',
            PHP_EOL
        ];
        foreach ($copyright as $textWrite) { echo $textWrite.PHP_EOL; }

    }

}
