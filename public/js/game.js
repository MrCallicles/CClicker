//init
let dataSet = document.querySelector(".initData");
let game;
fetch("/jeu/"+dataSet.dataset.id+"/get",{ method:'get'})
    .then((resp) => resp.text())
    .then(function(data){
        game = JSON.parse(data);
        gameParsed = {
            id:parseInt(game.id),
            nom:game.nom,
            score:parseInt(game.score),
            life:parseInt(game.life),
            image:game.image,
            over:parseInt(game.over)
        };
        game = gameParsed;
        displayGame(game);
        return game;
    })


function displayGame(game){
    document.querySelector("#avatar").innerHTML = game.image;
    document.querySelector("#nom").innerHTML = game.nom;
    document.querySelector("#score .value").innerHTML = game.score;
    document.querySelector("#life .value" ).innerHTML = game.life;
}

function updateScore(game, value){
    let update = new XMLHttpRequest();
    update.addEventListener('load', ()=>{});
    let _value = value;
    game.score += _value;
    update.open('GET', '/jeu/'+game.id+'/save/'+game.life+'/'+game.score);
    update.send();
}

function die(game){
    fetch('/jeu'+game.id+'/die')
        .then((response) => response.text())
        .then(function(){
            document.location.href="/compte";
        });
}

function updateLife(game, value){
    let update = new XMLHttpRequest();
    update.addEventListener('load', ()=>{});
    let _value = value;
    game.life += _value;
    update.open('GET', '/jeu/'+game.id+'/save/'+game.life+'/'+game.score);
    if(game.life <= 0){
        die(game);
    }
    update.send();
}

function updateScoreDisplay(game, score){
    updateScore(game, score);
    displayGame(game);
}

function updateLifeDisplay(game, life){
    updateLife(game, life);
    displayGame(game);
}

function randomRoutine(button, r){
    r = Math.floor(Math.random() * 100);
    if(r < 85){
        button.style.color = "blue";
    }
    else{
        button.style.color = "red";
    }
    button.style.top = "" + Math.floor(Math.random() * (screen.height - 100)) + "px";
    button.style.left = "" + Math.floor(Math.random() * (screen.width - 100)) + "px";
    document.querySelector("#game").appendChild(button);
}

//Mécanisme
let clickGame = document.createElement("button");
let r;
clickGame.id = "clickGame";
clickGame.innerHTML = "click !";
clickGame.style.position = "absolute";
randomRoutine(clickGame,r);


clickGame.addEventListener('click', function(){
    if(r < 70){
        updateScoreDisplay(game, 1);
    }
    else if(r < 85){
        updateLifeDisplay(game, 1);
    }
    else{
        updateLifeDisplay(game, -1);
    }
    document.querySelector("#game").removeChild(clickGame);
    randomRoutine(clickGame,r);
});

setInterval(function(){
    document.querySelector("#game").removeChild(clickGame);
    randomRoutine(clickGame,r);
}, 1000);
