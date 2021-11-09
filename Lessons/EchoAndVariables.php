<?php
include_once dirname(__DIR__) . "/internal/LessonRegistration.php";
$defaultInstructie = "Vul de code aan om het verwachte antwoord te krijgen.";
$echoLessons = [
    new exercise(
        "Dit programmatje print de tekst \"Hello world\" uit.
        'echo' is een commando dat je kan gebruiken om iets op je html pagina te plaatsen.
        De waarde die je hier uitprint is een stukje tekst. Tekst in php kan je tussen 2 aanhalingstekens plaatsen. Een stukje tekst heet een 'string'.
        Een commando dat iets uitvoert (zoals een programma aanroepen, of echo gebruiken) moet je afsluiten met een puntcomma ; . Deze dienen als scheiding tussen twee commandos.
        PHP code gebruik je tussen je html code, en hiermee kan je dynamisch/automatisch delen van je html pagina genereren.
        Deze tool waar je nu in werkt is bedoelt om php mee te oefen. Later komen er invul mogelijkheiden in de code, die je correct moet invullen.
        Klik op 'Test jouw code' om het resultaat van de code te zien. Dit resultaat moet overeenkomen met het voorbeeldresultaat.
        De nummertjes voor de regels van de code zijn de regelnummers van de code.",
        'echo "Hello world";',
        []
    ),
    new exercise(
        "Vul de code hieronder aan zodat het de tekst 'Mijn eerste programmatje!' uitprint, net als de verwachte uitkomst.
        Als je een pagina-grote foutmelding krijgt als je op 'Test jouw code' klikt, is er waarschijnlijk een fout in de door jouw ingevulde code die het programma doet crashen. Navigeer dan terug en probeer uit te zoeken wat er fout gaat.
        Als je een syntax fout maakt kan er een foutmelding getoond worden in de uitkomst van jouw code. Probeer deze te gebruiken om te kijken wat er fout is.
        Als je een het niet weet, kan je op 'Zie oplossing' klikken. Deze zal een correcte voorbeelduitwerking laten zien.",
        'echo [FIELD];', ['"Mijn eerste programmatje!"']
    ),
    new exercise(
        $defaultInstructie,
        '
[FIELD] "Hello world!";
echo "<br>Dit is een nieuwe regel";',
        ["echo"]
    ),
    new exercise(
        $defaultInstructie . "\nLet op dat je commando's moet afsluiten met een puntcomma.",
        '
echo [FIELD]
echo "<br>Dit is een nieuwe regel";',
        ['"Hello world!";']
    ),
    new exercise(
        $defaultInstructie,
        '
echo "Mijn naam is Freek";
echo "<br>";
[FIELD]
echo "<br>";
echo "Ik hou van honden";',
        ['echo "Ik ben 18 jaar";']
    ),
    new exercise(
        'In php werk je met variabelen. Een variabele is als het ware een laadje in een ladenkastje met een naam. In dit ladenkastje kan je een laadje een naam geven er daar iets instoppen of uit halen.
        Om een variabele te gebruiken gebruik je de notatie $X. X is de naam van de variabele. Je kan bijna elke naam gebruiken, zoals $leeftijd, $leeftijd, $automerk, etc.
        Hieronder zie je hoe je een waarde aan een variabele kan toekennen en kan opvragen. Ook zien jullie de = notatie. Op regel 1 wordt aan het laadje/de variabele $naam een waarde toegekend. Aan de linkerkant staat de variabele, en aan de rechterkant de nieuwe waarde.
        Op de regel daaronder word de waarde van $naam opgevraagt en gebruikt in het echo commando.
        Variabelenamen zijn hoofdlettergevoelig.',
'$naam = "Hugo";
echo $naam;', []
    ),
    new exercise(
        $defaultInstructie,
        '$naam = [FIELD];
echo $naam;', ['"Hugo"']
    ),
    new exercise(
        $defaultInstructie,
        '[FIELD] = "Hugo";
echo $naam;', ['$naam']
    ),
    new exercise(
        $defaultInstructie,
        '[FIELD]
echo $naam;', ['$naam = "Hugo";']
    ),
    new exercise(
        'Je kan variabelen ook binnen een string gebruiken. Hiermee kun je makkelijk dingen in zinnen of aan elkaar plakken.
        Dit kan alleen als je een string met dubbele aanhalingstekens gebruikt, "zoals dit", en niet met enkele, \'zoals dit\'.
        Om variabelen in je tekst te zetten gebruik je de notatie zoals in de voorbeeldcode',
        '$naam = "Hugo";
echo "Hallo $naam";', []
    )
    ];

LessonRegister::register("echo", $echoLessons);
?>