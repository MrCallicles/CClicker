//debugHelper
let lastLog = document.querySelector(".lastLog");
let debug = document.querySelector('.debug');
let dataSetDebug = document.querySelector(".initData");

//GetData
let queryData = new XMLHttpRequest();
queryData.addEventListener('load', function(){
        console.log(this.responseText);
        lastLog.innerHTML = this.responseText;
    }
);
queryData.open('GET', '/jeu/'+dataSetDebug.dataset.id+'/get');
queryData.send();

//die
let diePerso = new XMLHttpRequest();
diePerso.addEventListener('load', function(){
    console.log(this.responseText);
    lastLog.innerHTML = this.responseText;
});

let clickDie = document.createElement('button');
clickDie.type = "button";
clickDie.innerHTML = "die !";
clickDie.addEventListener('click', function(){
        diePerso.open('GET', '/jeu/'+game.id+'/die');
        diePerso.send();
    });

debug.appendChild(clickDie);

//-life
let minusLife = new XMLHttpRequest();
minusLife.addEventListener('load', function(){
    console.log(this.responseText);
    lastLog.innerHTML = this.responseText;
});

let clickMinusLife = document.createElement('button');
clickMinusLife.type = "button";
clickMinusLife.innerHTML = "-life";
clickMinusLife.addEventListener('click', function(){
        game.life -= 1;
        minusLife.open('GET', '/jeu/'+game.id+'/save/'+game.life+'/'+game.score);
        minusLife.send();
        queryData.open('GET', '/jeu/'+game.id+'/get');
        queryData.send();
    });

debug.appendChild(clickMinusLife);

//+life
let plusLife = new XMLHttpRequest();
plusLife.addEventListener('load', function(){
    console.log(this.responseText);
    lastLog.innerHTML = this.responseText;
});

let clickPlusLife = document.createElement('button');
clickPlusLife.type = "button";
clickPlusLife.innerHTML = "+life";
clickPlusLife.addEventListener('click', function(){
        game.life += 1;
        plusLife.open('GET', '/jeu/'+game.id+'/save/'+game.life+'/'+game.score);
        plusLife.send();
        queryData.open('GET', '/jeu/'+game.id+'/get');
        queryData.send();
    });

debug.appendChild(clickPlusLife);
//-score
let moinsScore = new XMLHttpRequest();
moinsScore.addEventListener('load', function(){
    console.log(this.responseText);
    lastLog.innerHTML = this.responseText;
});

let clickMoinsScore = document.createElement('button');
clickMoinsScore.type = "button";
clickMoinsScore.innerHTML = "-score";
clickMoinsScore.addEventListener('click', function(){
        game.score -= 1;
        moinsScore.open('GET', '/jeu/'+game.id+'/save/'+game.life+'/'+game.score);
        moinsScore.send();
        queryData.open('GET', '/jeu/'+game.id+'/get');
        queryData.send();
    });

debug.appendChild(clickMoinsScore);

//+score
let plusScore = new XMLHttpRequest();
plusScore.addEventListener('load', function(){
    console.log(this.responseText);
    lastLog.innerHTML = this.responseText;
});

let clickPlusScore = document.createElement('button');
clickPlusScore.type = "button";
clickPlusScore.innerHTML = "+score";
clickPlusScore.addEventListener('click', function(){
        game.score += 1;
        moinsScore.open('GET', '/jeu/'+game.id+'/save/'+game.life+'/'+game.score);
        moinsScore.send();
        queryData.open('GET', '/jeu/'+game.id+'/get');
        queryData.send();
    });
debug.appendChild(clickPlusScore);

//displayUpdate
let clickDisplay = document.createElement('button');
clickDisplay.type = "button";
clickDisplay.innerHTML = "display";
clickDisplay.addEventListener('click', function(){
        displayGame(game);
    });
debug.appendChild(clickDisplay);
