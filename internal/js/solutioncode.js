function toggleExample(button){
    if(button.checked){
        document.getElementById('exampleCodeCSS').innerText = '.field {display: none}';
    }
    else{
        document.getElementById('exampleCodeCSS').innerText = '.fieldSolution {display: none}';
    }
}