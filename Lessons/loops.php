<?php
include_once dirname(__DIR__) . "/internal/LessonRegistration.php";
$defaultInstructie = "Vul de code aan om het verwachte antwoord te krijgen.";
$complexOperatorInstructie = "Je kan ook 2 boolean waarden met elkaar vergelijken en combineren. Zo is 'true && false' gelijk aan 'false', en is 'false || true' gelijk aan 'true'.
    Door verschillende operantoren te gebruiken kan je meer complexe regels schrijven. 
    Houd hierbij in gedachte dat de volgorde belangrijk is, gebruik dus haakjes ( en ) om een subgroepje eerst compleet uit te werken.";


LessonRegister::register("Loops",
    [
        new exercise(
            "De simpelste vorm van een loop is de while loop. Deze checkt of de boolean statement (de bewering) klopt, en voert elke keer zijn inhoud uit totdat dit niet meer waar is.",
            '
$eenbewering = true;
while($eenbewering){
    echo "Hallo!<br>";
    $eenbewering = false;
}
echo "de rest";
    ', []),
        new exercise(
            "Je kan ook andere soorten beweringen gebruiken om dit te controleren\n",
            '
$counter = 0;
while($counter < 5){
    echo $counter;
    echo "<br>";
    $counter++; //Dit is hetzelfde als $counter += 1 of $counter = $counter + 1;
}
            ',
            []
        ),
        new exercise(
            $defaultInstructie,
            '
[FIELD]
while([FIELD]){
    echo "Ik print dit 10 keer uit<br>";
    [FIELD]
}
            ',
            ['$counter = 0;', '$counter < 10', '$counter += 1;']
        ),
        new exercise(
            "Er zijn ook andere gebruiksdingen voor een while loop, bijvoorbeeld het zoeken van een naam.",
            '
$namen = ["mohammed", "josje", "arnout", "nicolas"];
$counter = 0;
$gevondenPositie = -1;
while($counter < count($namen)){
    if($namen[$counter] == "arnout"){
        $gevondenPositie = $counter; //sla op waar we arnout vonden
        $namen[$counter] = "jantje beton"; //vervang de naam
    }
    $counter++;
}
//rapporteer resultaat
if($gevondenPositie != -1){
    echo "Arnout stond op plaats $gevondenPositie, nu niet meer";
}
else{
    echo "Er was geen arnout in de lijst";
}
            ',
            []
        ),
        new exercise("Deze twee loopjes doen hetzelfde.
        Een for loop heeft het voordeel overzichtelijker te zijn. Je ziet alle informatie over hoe de loop telt, apart van de inhoud van de loop.
        Ook kan je niet per ongeluk het optellen vergeten.",
        '
$i = 0;
while($i < 10){
    echo "*";
    $i++;
}

echo "<br>";

for($x = 0; $x < 10; $x++){
    echo "*";
}
        ',
        []),
        new exercise(
            "Print de getallen van 0 tm 99 uit.",
            '
for([FIELD]){
    echo [FIELD];
    echo "<br>";
}
            ',
            ['$i = 0; $i < 100; $i++', '$i']
        ),
        new exercise(
            "Print de getallen van -35 tm 50 uit.",
            '
for([FIELD]){
    echo [FIELD];
    echo "<br>";
}
            ',
            ['$i = -35; $i <= 50; $i++', '$i']
        ),
        new exercise(
            "Print de getallen van -35 tm 50 uit, omgekeerd",
            '
for([FIELD]){
    echo [FIELD];
    echo "<br>";
}
            ',
            ['$i = 50; $i >= -35; $i--', '$i']
        ),
        new exercise(
            "Print de getallen van 1 tm 100 uit, maar alleen de oneven getallen",
            '
for([FIELD]){
    echo [FIELD];
    echo "<br>";
}
            ',
            ['$i = 1; $i <= 100; $i += 2', '$i']
        ),
        new exercise(
            "Print de getallen van 1 tm 10 uit, 10 keer",
            '
for([FIELD]){
    for([FIELD]){
        echo [FIELD];
        echo " ";
    }
    echo "<br>";
}
            ',
            ['$i = 0; $i < 10; $i++', '$j = 1; $j <= 10; $j++', '$j']
        ),
        new exercise(
            "Print dit figuur uit",
            '
for([FIELD]){
    for([FIELD]){
        echo "*";
    }
    echo "<br>";
}
            ',
            ['$i = 1; $i < 10; $i++', '$j = 1; $j <= $i; $j++']
        ),
        new exercise(
            "Print dit figuur uit",
            '
for([FIELD]){
    for([FIELD]){
        echo "*";
    }
    echo "<br>";
}
            ',
            ['$i = 10; $i >= 1; $i--', '$j = 1; $j <= $i; $j++']
        ),
        new exercise(
            "Print dit figuur uit",
            '
for([FIELD]){
    for([FIELD]){
        if([FIELD]){
            echo "*";
        }
        else{
            echo "_";
        }
    }
    echo "<br>";
}
            ',
            ['$y = 0; $y < 10; $y++', '$x = 0; $x < 10; $x++', '($x == 0 || $x == 9) || ($y == 0 || $y == 9)']
        ),
        new exercise(
            "De laatste loop die je kan gebruiken is de foreach loop.",
            '
$namen = ["mohammed", "josje", "arnout", "nicolas"];
foreach($namen as $naam){
    echo $naam;
    echo "<br>";
}
            ',
            []
        ),
        new exercise(
            $defaultInstructie,
            '
$namen = ["mohammed", "josje", "arnout", "nicolas"];
foreach([FIELD]){
    [FIELD];
}
            ',
            ['$namen as $naam', 'echo "Hallo, mijn naam is $naam <br>";']
        ),
        new exercise(
        $defaultInstructie,
            '
$namen = ["mohammed", "josje", "arnout", "nicolas", 
"sana", "sabrina", "felicity", "aysha", "leonie", 
"penelope", "mashkar", "bloem", "annabell"];
$totaalNamenMetEenA = 0;
[FIELD]
    if(strpos([FIELD], "a") !== false){ //als er een a erin zit, is dit true
        $totaalNamenMetEenA++;
    }
[FIELD]
echo "$totaalNamenMetEenA namen met een a erin";
            ',
            ['foreach($namen as $naam){', '$naam', '}']
        )
    ]);
?>