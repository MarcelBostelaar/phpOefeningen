<?php

/**
 * Class line
 * A structure that represents a linebreak, piece of constant code or a fillable field, stored in $type.
 * Value of the code is stored in $value;
 */
class line{
    const LineBreak = 0;
    const Code = 1;
    const Field = 2;


    public $type;
    public $value;

    /**
     * @param $code string A piece of code
     * @return line A line instance representing the code
     */
    static public function code($code){
        $i = new line();
        $i->type = line::Code;
        $i->value = $code;
        return $i;
    }

    /**
     * @return line A linebreak instance
     */
    static public function linebreak(){
        $i = new line();
        $i->type = line::LineBreak;
        return $i;
    }

    /**
     * @return line A field instance
     */
    static public function field(){
        $i = new line();
        $i->type = line::Field;
        return $i;
    }

    public function isCode(){
        return $this->type == self::Code;
    }
    public function isLinebreak(){
        return $this->type == self::LineBreak;
    }
    public function isField(){
        return $this->type == self::Field;
    }
}

/**
 * Class exercise
 * A structure containing a single exercise
 */
class exercise{
    function __construct($_instruction, $_code, array $_answers) {
        $this->instruction = $_instruction;
        $this->code = $_code;
        $this->answers = $_answers;
    }

    public $instruction;
    public $code;
    public $answers;
}