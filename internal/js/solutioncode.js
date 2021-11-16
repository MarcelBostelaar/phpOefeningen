function toggleExample(button){
    if(button.checked){
        document.getElementById('exampleCodeCSS').innerText = '.fieldAnswer {display: none !important;}';
    }
    else{
        document.getElementById('exampleCodeCSS').innerText = '.fieldSolution {display: none !important;}';
    }
}