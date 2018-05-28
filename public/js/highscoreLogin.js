let highscoreRequest = new XMLHttpRequest();
highscoreRequest.addEventListener('load', function(){
    let tmp = document.createElement('div');
    tmp.innerHTML = parseHighScore(JSON.parse(this.responseText));
    document.querySelector(".highscore").appendChild(tmp);
});
highscoreRequest.open('GET', '/highscore.json');
highscoreRequest.send();

function parseHighScore(jsonArray){
    let ul = "<ol>";
    let lu = "</ol>";
    let li = "<li>";
    let il = "</li>";
    let tmp = ul;
    jsonArray.forEach(function(element){
        tmp += li+" "+element.nom+" "+element.score+" "+element.life+il;
    });
    tmp += lu;
    console.log(tmp);
    return tmp;
}

