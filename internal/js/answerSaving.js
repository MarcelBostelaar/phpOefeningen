const key = "phpOefenenData";
const fieldclass = "field";
const resizeIncrement = 10;
const resizeBuffer = 3;
const minSize = 20;
const fieldIdPrefix = "field_";

/**
 * On page loads, loads all the previous answers to the page.
 */
window.addEventListener("load",loadOldAnswers,false)

function loadOldAnswers(){
    let data = getData();

    let fields = document.getElementsByClassName(fieldclass);
    let lesson = getLesson();
    let exerciseNumber = getExerciseNumber();

    for (const field of fields) {
        field.value = getAnswer(data, lesson, exerciseNumber, field.name.replace(fieldIdPrefix, ""));
    }
    fieldResize();
}

/**
 * On field input, saves all data to local storage
 */
function fieldInput(){
    fieldResize();
    let data = getData();

    let fields = document.getElementsByClassName(fieldclass);
    let lesson = getLesson();
    let exerciseNumber = getExerciseNumber();

    for (const field of fields) {
        saveAnswer(data, lesson, field.name, field.value.replace(fieldIdPrefix, ""));
    }
    storeData(data);
}

function saveAnswer(data, lesson, exerciseNumber, field, answer){
    if(data == null)
        return
    if(data[lesson] == null){
        data[lesson] = {};
    }
    if(data[lesson][exerciseNumber] == null){
        data[lesson][exerciseNumber] = {};
    }
    data[lesson][exerciseNumber][field] = answer;
}

/**
 * Tries to retrieve the associated answer if it exists, returns "" if it doesn't.
 * @param data The data storage
 * @param lesson Lesson id
 * @param exerciseNumber The number of the exercise
 * @param field Field name
 * @returns {string|*}
 */
function getAnswer(data, lesson, exerciseNumber, field){
    if(data == null)
        return "";
    if(data[lesson] == null)
        return "";
    if(data[lesson][exerciseNumber] === undefined)
        return "";
    if(data[lesson][exerciseNumber][field] === undefined)
        return "";
    return data[lesson][exerciseNumber][field];
}

function storeData(data){
    localStorage.setItem(key, JSON.stringify(data));
}

function getData(){
    let data = localStorage.getItem(key);
    if(data == null){
        data = {};
    }
    else{
        data = JSON.parse(data);
    }
    return data;
}

function resetAnswers(){
    localStorage.removeItem(key);
}

function saveAnswers(){
    saveStaticDataToTextFile(JSON.stringify(getData(), null, 2), "antwoorden.json");
}

function getLesson(){
    return document.getElementById("lesson").value;
}

function getExerciseNumber(){
    return document.getElementById("exerciseNumber").value;
}

function saveStaticDataToTextFile(text, filename) {
    downloadToFile(text, filename, "text/plain;charset=utf-8");
}

function downloadToFile (content, filename, contentType) {
    const a = document.createElement('a');
    const file = new Blob([content], {type: contentType});

    a.href= URL.createObjectURL(file);
    a.download = filename;
    a.click();

    URL.revokeObjectURL(a.href);
}

function fieldResize(){
    let fields = document.getElementsByClassName(fieldclass);
    for (const field of fields) {
        while(field.size < field.value.length + resizeBuffer){
            field.size += resizeIncrement;
        }
        while(field.size > field.value.length + resizeBuffer + resizeIncrement){
            field.size -= resizeIncrement;
        }
        if(field.size < minSize)
            field.size = minSize;
    }
}

function handinSend(lessons){
    var data = getData().filter(function(x){
        return lessons.contains(x);
    });
}