const key = "phpOefenenData";
const fieldclass = "field";
const resizeIncrement = 10;
const resizeBuffer = 3;
const minSize = 20;

/**
 * On page loads, loads all the previous answers to the page.
 */
window.addEventListener("load",loadOldAnswers,false)
function loadOldAnswers(){
    let data = getData();

    let fields = document.getElementsByClassName(fieldclass);
    let page = getPage();

    for (const field of fields) {
        field.value = getAnswer(data, page, field.name);
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
    let page = getPage();

    for (const field of fields) {
        saveAnswer(data, page, field.name, field.value);
    }
    storeData(data);
}

function saveAnswer(data, page, field, answer){
    if(data == null)
        return
    if(data[page] == null){
        data[page] = {};
    }
    data[page][field] = answer;
}

/**
 * Tries to retrieve the associated answer if it exists, returns "" if it doesn't.
 * @param data The data storage
 * @param page Page adress
 * @param field Field name
 * @returns {string|*}
 */
function getAnswer(data, page, field){
    if(data == null)
        return "";
    if(data[page] == null)
        return "";
    if(data[page][field] === undefined)
        return "";
    return data[page][field];
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

function getPage(){
    return window.location.href.split("/").slice(-1)[0];
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