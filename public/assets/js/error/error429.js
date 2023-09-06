let cooldown = document.getElementById('cooldown');
let cpt = 60;
setInterval(function () {
    if (cpt > 0) {
        --cpt;
        cooldown.innerHTML = cpt;
    }
    if (cpt <= 0) {
        window.location.href = "http://crypto-data/home";
        cpt = 60;
    }
}, 1000);
