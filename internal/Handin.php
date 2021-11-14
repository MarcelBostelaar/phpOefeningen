<?php
include_once dirname(__DIR__) . "/internal/excerciseHandling/FillableCodeGenerator.php";
include_once dirname(__DIR__) . "/internal/excerciseHandling/AnswerRetrieval.php";
include_once dirname(__DIR__) . "/internal/excerciseHandling/CodeExecution.php";
include_once dirname(__DIR__) . "/internal/excerciseHandling/ExcerciseParser.php";
include_once dirname(__DIR__) . "/internal/LessonRegistration.php";
include_once dirname(__DIR__) . "/internal/ResultWindows.php";

function singleExerciseAnswer($exercise, $userAnswers){
    $parsedLines = ParseFullExcercise($exercise->code);
    echo LinesToCodeHTML($parsedLines, $exercise->answers, $userAnswers);
    ResultWindows($parsedLines, $exercise->answers, $userAnswers);
}

?>

<head>
    <style>
        <?php include dirname(__DIR__) . "/internal/css/css.css";?>
    </style>
    <title>Handin</title>
</head>
<body>
<header>
</header>
<main>

<?php
    $AllRecievedAnswers = GetHandinAnswers();
    if($AllRecievedAnswers == null){
        echo "ERROR, geen antwoorden ontvangen";
    }
    else{
        foreach ($AllRecievedAnswers as $lessonName => $lesson){
            echo "<h1>Les $lessonName</h1>";
            foreach ($lesson as $exerciseNumber => $userAnswers){
                echo "<h2>Opdracht $exerciseNumber</h2>";
                $exercise = LessonRegister::$AllLessons[$lessonName][$exerciseNumber];
                singleExerciseAnswer($exercise, $userAnswers);
            }
        }
    }
?>

</main>
