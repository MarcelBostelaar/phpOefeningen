const checkboxClassName = "handinCheckbox";
const handinFormName = "handinAnswers";

function filterObjectKey(obj, predicate) {
    let result = {}, key;

    for (key in obj) {
        if (obj.hasOwnProperty(key) && predicate(key)) {
            result[key] = obj[key];
        }
    }

    return result;
}

function downloadHandin(){
    let lessons = Array.from(document.getElementsByClassName(checkboxClassName))
        .filter(x => x.checked)
        .map(x => x.name);
    getHandinString(lessons, function(data){
        saveStaticDataToTextFile(data, "Huiswerk.html");
    });
}

function getHandinString(lessons, handleData){
    var data = filterObjectKey(getData(), x => lessons.includes(x));
    var formData = new FormData();
    formData.append(handinFormName, JSON.stringify(data));
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "HandinGenerator.php", true);
    xhr.onload = function() {
        handleData(this.responseText);
    }
    xhr.send(formData);
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