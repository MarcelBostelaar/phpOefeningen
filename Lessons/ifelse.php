<?php
include_once dirname(__DIR__) . "/internal/LessonRegistration.php";
$defaultInstructie = "Vul de code aan om het verwachte antwoord te krijgen.";
$complexOperatorInstructie = "Je kan ook 2 boolean waarden met elkaar vergelijken en combineren. Zo is 'true && false' gelijk aan 'false', en is 'false || true' gelijk aan 'true'.
    Door verschillende operantoren te gebruiken kan je meer complexe regels schrijven. 
    Houd hierbij in gedachte dat de volgorde belangrijk is, gebruik dus haakjes ( en ) om een subgroepje eerst compleet uit te werken.";

LessonRegister::register("ifelse",
    [
    new exercise(
        "Een speciaal type waarde is de 'boolean' waarde. Deze waarde heeft twee mogelijke waarden, waar en onwaar, of in het engels 'true' en 'false'.
        Deze waarden kunnen worden gebruikt om beslissingen te nemen. Een belangrijk voorbeeld hiervan is een if-else. Hiermee kan je sommige stukken code wel of niet uitvoeren aan de hand van een boolean waarde.
        Hieronder zie je een voorbeeld van een if else. Als de boolean waarde true is, wordt het deel binnen de if uitgevoerd. Als het false is, word de else uitgevoerd.",
'if (true){
    echo "Voer dit uit";
}else{
    echo "Voer dit niet uit";
}', []),
    new exercise(
        $defaultInstructie,
'if ([FIELD]){
    echo "Voer dit uit";
}else{
    echo "Voer dit niet uit";
}', ["true"]
    ),
    new exercise(
        $defaultInstructie,
        '
[FIELD] = "appel";
[FIELD] = "peer";        
if (true){
    echo $a;
}else{
    echo $b;
}', ['$a', '$b']
    ),
    new exercise(
        $defaultInstructie,
        '[FIELD]{
    echo "Voer dit uit";
}else{
    echo "Voer dit niet uit";
}', ["if (true)"]),

    new exercise(
        "Een boolean waarde kan je natuurlijk maken. Met verschillende 'operatoren' kan je waardes vergelijken en hieruit een booleanwaarde krijgen.
        Met operatoren zoald > en < (zie de onderste tabel op bladzijde 38 van je boek) kan je waardes vergelijken.",
        '
$leeftijd = 15;
if ($leeftijd < 18){
    echo "je bent te jong";
}else{
    echo "welkom";
}', []),
    new exercise($defaultInstructie,
    '
$leeftijd = [FIELD];
if ($leeftijd >= 18){
    echo "welkom";
}else{
    echo "Je bent te jong";
}', ["17"]),
    new exercise($defaultInstructie,
    '
$a = [FIELD];
$b = [FIELD];
if ($a > $b){
    echo "Peer";
}else{
    echo "Appel";
}', ['7', '6']),
    new exercise($defaultInstructie,
        '
$a = 5;
$b = 5;
if ($a [FIELD] $b){
    echo "Peer";
}else{
    echo "Appel";
}', ["=="]),
    new exercise($defaultInstructie,
        '
$a = 5;
$b = 5;
if ($a [FIELD] $b){
    echo "Peer";
}else{
    echo "Appel";
}', ["!="]),
    new exercise($defaultInstructie,
    '
echo "A";
if([FIELD]){
    echo "B";
}
echo "C";
    ', ["true"]),
    new exercise($defaultInstructie,
        '
$fruit = "appel";
if([FIELD] == "peer"){
    echo "Lekkere peren";
}
else{
    if($fruit [FIELD] "citroen"){
        echo "Zure citroen";
    }
    else{
        echo "Lekkere appels";
    }
}', ['$fruit', "=="]),
    new exercise($defaultInstructie,
        '
$fruit = "citroen";
if([FIELD] == "peer"){
    echo "Lekkere peren";
}
elseif($fruit [FIELD] "citroen"){
    echo "Zure citroen";
}
else{
    echo "Lekkere appels";
}', ['$fruit', "=="]),
    new exercise($complexOperatorInstructie,
    '
$woonplaats = "rotterdam";
$leeftijd = 17;
if($woonplaats == "rotterdam" && $leeftijd > 15){
    echo "Welkom";
}
else{
    echo "Alleen voor echte Rotterdammers boven de 15";
}',[]),
    new exercise($complexOperatorInstructie,
        '
$woonplaats = "rotterdam";
$leeftijd = 5;
if($woonplaats == "rotterdam" || $leeftijd > 15){
    echo "Welkom";
}
else{
    echo "Alleen voor echte Rotterdammers of mensen boven de 15";
}', []),
    new exercise($complexOperatorInstructie . "\nPrint de naam uit als die 'Sanne' heet en in Amersfoort woont, of als deze persoon van ponies houd maar niet van kroketten.",
        '
$naam = "Frits";
$woonplaats = "Amersfoort";
$favoDier = "ponie";
$favoEten = "frikandel";
if(($naam [FIELD] "Sanne" && $woonplaats [FIELD] "Amersfoort") || ($favoDier [FIELD] "ponie" && $favoEten [FIELD] "kroket")){
    echo $naam;
}
else{
    echo "jij niet";
}
    ',
        ["==", "==", "==", "!="]),
    new exercise($complexOperatorInstructie . "\nPrint de naam uit als die 'Sanne' heet en in Amersfoort woont, of als deze persoon van ponies houd maar niet van kroketten.",
        '
$naam = "Sanne";
$woonplaats = "Zoutelande";
$favoDier = "ponie";
$favoEten = "frikandel";
if(($naam [FIELD] "Sanne" [FIELD] $woonplaats [FIELD] "Amersfoort") [FIELD] ($favoDier [FIELD] "ponie" [FIELD] $favoEten [FIELD] "kroket")){
    echo $naam;
}
else{
    echo "jij niet";
}
    ',
        ["==", "&&", "==", "||", "==", "&&", "!="])
]);
?>