function compteur_mise() {
    var bar = document.querySelector('#game_play_miseInput')
    var aff = document.querySelector('#game_play_miseInput_compteur')
    if (bar != null && aff != null) {
        aff.innerHTML = bar.value
    }
}

compteur_mise()