<?php

class Logger {
    private $_logFileName
    private $_fileStream;

    public function __construct() {
        $this->_logFileName = "log.txt";
    }

    private function writeArray($array)
    {
        foreach ($array as $key => $value)
        {
            $this->write("key = " . $key . " value = " . $value);
            if(is_array($value)){ 
                $this->writeArray($value);
            }  
        } 
    }

    public function write($message) {
        if (!is_resource($this->_fileStream)) {
            $this->open();
        }

        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        $time = @date('[d/M/Y:H:i:s]');
        fwrite($this->_fileStream, "$time ($script_name) $message" . PHP_EOL);

        if (is_array($message) 
        {
            $this->writeArray($message);
        }
    }

    public function close() {
        fclose($this->_fileStream);
    }
    
    private function open( $fileName ) {
        $this->_fileStream = fopen($this->_logFileName, 'a') or exit("Can't open file " . $this->_logFileName);
    }
}