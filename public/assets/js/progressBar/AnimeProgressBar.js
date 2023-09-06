let progressBarVote = document.getElementById('progressBarVote');
let progressBarSupply = document.getElementById('progressBarSupply');
let max_supply = null;
let circulating_supply = document.getElementById('circulatingSupply').value;
let progressBarTopBot = document.getElementById('progressBarTopBot');
let total24h = ((document.getElementById('low_24h').value * 100 ) / document.getElementById('high_24h').value).toFixed(0) - 2;

if (document.getElementById('maxSupply').value == 'unlimited') {
    max_supply = 'unlimited';
}else{
    max_supply = document.getElementById('maxSupply').value;
}


if (max_supply == 'unlimited') {
    AnimationProgressBar(progressBarSupply, 100, 2);
}else{
    AnimationProgressBar(progressBarSupply, ((circulating_supply * 100) / max_supply),5);
}

if (sentiment_votes_down >= 90) {

    AnimationProgressBar(progressBarVote,sentiment_votes_down,2);

}else{
    AnimationProgressBar(progressBarVote,sentiment_votes_up,2);
}

AnimationProgressBar(progressBarTopBot,total24h,2);

function AnimationProgressBar(progressBar, data, speed) {
    var w = 0;

    var foo = setInterval(function () {
      if (w > data) clearInterval(foo);

      w = w + 1;

      progressBar.style.width = w + "%";
    }, speed);
  }
