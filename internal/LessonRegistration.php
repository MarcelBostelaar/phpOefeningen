<?php
include_once dirname(__DIR__) .  "/internal/util/classes.php";
include_once dirname(__DIR__) . "/Lessons/EchoAndVariables.php";
include_once dirname(__DIR__) . "/Lessons/functies.php";
include_once dirname(__DIR__) . "/Lessons/ifelse.php";

class LessonRegister{
    public static $AllLessons = [];

    static function register($lessonName, array $exercises){
        if(!isset(LessonRegister::$AllLessons[$lessonName])) {
            LessonRegister::$AllLessons[$lessonName] = $exercises;
        }
    }
}