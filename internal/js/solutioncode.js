function checkSolution(){
    if(document.getElementById('solutiondiv').innerText === document.getElementById('examplediv').innerText){
        document.getElementById('solutiondiv').className = 'correct';
    }
    else{
        document.getElementById('solutiondiv').className = 'incorrect';
    }
}

window.addEventListener("load",checkSolution,false);

function toggleExample(button){
    if(button.checked){
        document.getElementById('exampleCodeCSS').innerText = '.field {display: none}';
    }
    else{
        document.getElementById('exampleCodeCSS').innerText = '.fieldSolution {display: none}';
    }
}

function checkScrollDown(){
    window.scrollTo(0,document.body.scrollHeight);
}