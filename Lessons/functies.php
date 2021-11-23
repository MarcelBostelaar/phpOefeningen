<?php
include_once dirname(__DIR__) . "/internal/LessonRegistration.php";
$defaultInstructie = "Vul de code aan om het verwachte antwoord te krijgen.";
$functieInstructie = "In php, en bijna elke andere programmeertaal kan je functies maken. Hiermee kan je stukjes code op meerdere plekken aanroepen en hergebruiken.
    Een functie heeft 0 of meer zogenaamde 'parameters', dit zijn waardes die je meegeeft en dus beschikbaar maakt aan de functie.
    Ook kan een functie een waarde teruggeven, de zogenaamde return value. Dit hoeft niet, maar mag wel.";

LessonRegister::register("functies",
    [
    new exercise($functieInstructie,
        '
function naamVanJeFunctie($parameter1, $parameter2){
    echo "Dit is jouw functie!";
    echo "<br>";
    echo $parameter1 . " " . $parameter2;
    echo "<br>";
}

naamVanJeFunctie("Hallo", "student!");
naamVanJeFunctie("Hoe gaat", "het?");
    ', []),
    new exercise($functieInstructie,
        '
[FIELD] print5Keer($parameter){
    echo $parameter;
    echo $parameter;
    echo $parameter;
    echo $parameter;
    echo $parameter;
}

print5Keer("7 ");
print5Keer("hoi ");
print5Keer("hallo ");
    ', ["function"]),
    new exercise($functieInstructie,
        '
[FIELD]{
    echo $parameter;
    echo $parameter;
    echo $parameter;
    echo $parameter;
    echo $parameter;
}

print5Keer("7 ");
print5Keer("hoi ");
print5Keer("hallo ");
    ', ['function print5Keer($parameter)']),
    new exercise($functieInstructie,
        '
[FIELD]{
    [FIELD]
    [FIELD]
    [FIELD]
    [FIELD]
    [FIELD]
}

print5Keer("7 ");
print5Keer("hoi ");
print5Keer("hallo ");
    ', ['function print5Keer($parameter)', 'echo $parameter;', 'echo $parameter;', 'echo $parameter;', 'echo $parameter;', 'echo $parameter;']),
    new exercise($functieInstructie,
        '
function mijnFunctie[FIELD]{
    [FIELD]
    [FIELD]
    [FIELD]
}

mijnFunctie(true, "hallo");
mijnFunctie(false, "hoi");
    ', ['($printWelNiet, $tekst)', 'if($printWelNiet){', 'print($tekst);', '}'])
]);