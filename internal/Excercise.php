<?php
include_once dirname(__DIR__) . "/internal/excerciseHandling/FillableCodeGenerator.php";
include_once dirname(__DIR__) . "/internal/excerciseHandling/AnswerRetrieval.php";
include_once dirname(__DIR__) . "/internal/excerciseHandling/CodeExecution.php";
include_once dirname(__DIR__) . "/internal/excerciseHandling/ExcerciseParser.php";
include_once dirname(__DIR__) . "/internal/LessonRegistration.php";

$lesson = $_GET["lesson"];
$exerciseNumber = filter_input(INPUT_GET, "exerciseNumber", FILTER_SANITIZE_NUMBER_INT);
$exercise = LessonRegister::$AllLessons[$lesson][$exerciseNumber];
$totalExercises = count(LessonRegister::$AllLessons[$lesson]);
$parsedLines = ParseFullExcercise($exercise->code);
$userAnswers = GetUserSetFields(count($exercise->answers));

?>
<head>
    <link rel="stylesheet" href="./css/css.css">
    <script src="./js/answerSaving.js"></script>
    <script src="./js/solutioncode.js"></script>
    <title>Opdracht</title>
    <!--  Solution or user answers are hidden/shown via js with this -->
    <style id='exampleCodeCSS'>.fieldSolution {
            display: none
        }</style>
</head>
<body>
<header>
</header>
<main>
    <?php if ($exerciseNumber > 1) { ?>
        <form action="" method="get" class="inline">
            <input name="exerciseNumber" value="<?=($exerciseNumber - 1)?>" hidden>
            <input name="lesson" value="<?= $lesson ?>" hidden>
            <button type="submit" name="back">Vorige oefening</button>
        </form>
    <?php }
    if ($exerciseNumber < $totalExercises) { ?>
        <form action="" method="get" class="inline">
            <input name="exerciseNumber" value="<?= ($exerciseNumber + 1) ?>" hidden>
            <input name="lesson" value="<?= $lesson ?>" hidden>
            <button type="submit" name="back">Volgende oefening</button>
        </form>
    <?php } ?>
    <a href="../index.php">
        <button>Terug naar overzicht</button>
    </a>

    <p>
        <?= str_replace("\n", "</p><p>", $exercise->instruction)?>
    </p>
    <p>Dit is opdracht nummer <?= $exerciseNumber?></p>


    <h2>Vul de juiste code in:</h2>
    <form method='POST'>
        <?php echo LinesToCodeHTML($parsedLines, $exercise->answers, $userAnswers); ?>
        <br><br>
        <input type='submit' value='Test jouw code' name='submit'>
        <br><br>
        <label>
            <input type='checkbox' onchange='toggleExample(this)'>
            <label>Zie oplossing</label>
        </label>
    </form>

    <h2>Verwachte uitkomst:</h2>
    <div class='examplediv'>
        <?php CreateRunnableUserCode($parsedLines, $exercise->answers)(); ?>
    </div>

    <h2>Jouw uitkomst uitkomst:</h2>
    <div class='incorrect solutiondiv'>
        <?php
        if (WereUserAnswersSend()) {
            CreateRunnableUserCode($parsedLines, $userAnswers)();
        } else {
            echo "Nog geen code uitgevoerd, klik op uitvoeren";
        }
        ?>
    </div>

</main>
</body>
