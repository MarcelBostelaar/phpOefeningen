<?php
include_once dirname(__DIR__) . "/internal/LessonRegistration.php";
?>


<head>
    <link rel="stylesheet" href="./css/css.css">
    <script src="./js/answerSaving.js"></script>
    <script src="./js/handin.js"></script>
    <title>Inleveren</title>
</head>
<body>
    <header>
    </header>
    <main>
        <a href="../index.php"><button>Terug naar hoofdmenu</button></a>
        <br><br>
        <?php foreach(array_keys(LessonRegister::$AllLessons) as $x){ ?>
            <label>
                <input type="checkbox" name="<?php echo $x;?>" class="handinCheckbox">
                <?php echo $x;?>
            </label>
            <br>
        <?php } ?>
        <button onclick="downloadHandin()">Download</button>
    </main>
</body>
