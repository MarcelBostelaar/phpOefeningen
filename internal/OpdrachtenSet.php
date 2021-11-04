<?php
    class opdracht{
        function __construct($_instructie, $_code, array $_antwoorden) {
            $this->instructie = $_instructie;
            $this->code = $_code;
            $this->antwoorden = $_antwoorden;
        }

        public $instructie;
        public $code;
        public $antwoorden;
    }


    function OpdrachtenSet(... $opdrachten)
    {
        ?>
    <head>
        <link rel="stylesheet" href="../internal/css.css">
        <script src="../internal/answerSaving.js"></script>
        <script src="../internal/solutioncode.js"></script>
        <title>Opdracht</title>
        <style id='exampleCodeCSS'>.fieldSolution {display: none}</style>
    </head>
    <body>
        <header>
        </header>
        <main>
            <a href="../index.php"><button>Terug naar overzicht</button></a>
        <?php
        include "../internal/ExcerciseCode.php";

        $oefening = 1;
        if (isset($_GET["lesson"])) {
            $oefening = filter_input(INPUT_GET, "lesson", FILTER_SANITIZE_NUMBER_INT);
        }

        if ($oefening > 1) {
            $vorige = $oefening - 1;
            echo '<form action="" method="get" class="inline">';
            echo "<button type='submit' name='lesson' value='$vorige' formmethod='get'>Vorige opdracht</button>";
            echo "</form>\n";
        }
        if ($oefening < count($opdrachten)) {
            $volgende = $oefening + 1;
            echo '<form action="" method="get" class="inline">';
            echo "<button type='submit' name='lesson' value='$volgende' formmethod='get'>Volgende opdracht</button>";
            echo "</form>";
        } else {
            echo "<button onclick=\"location.href='../index.php'\" type='button'>Laatste opdracht, naar overzicht</button>";
        }
        echo "<p>" . str_replace("\n", "</p><p>", $opdrachten[$oefening - 1]->instructie) . "</p>";
        echo "<p>Dit is opdracht nummer $oefening</p>";

        createExcercise($opdrachten[$oefening - 1]->code, $opdrachten[$oefening - 1]->antwoorden);

        ?>
        </main>
    </body>

        <?php
    }
?>