// Rend le bouton mode sombre fonctionnel

var som = document.getElementsByClassName('clair_sombre')

function clair_sombre() {
    var som = document.getElementsByClassName('clair_sombre')
    if (som[0].classList.contains('clair')) {
        for (i = 0; i < som.length; i++) {
            som[i].classList.remove('clair')
            som[i].classList.add('sombre')
        }
    } else {
        for (i = 0; i < som.length; i++) {
            som[i].classList.remove('sombre')
            som[i].classList.add('clair')
        }
    }
}

for (i = 0; i < som.length; i++) {
    som[i].classList.add('sombre') // Changer ici le mode de base
}

function adaptation_clair_sombre() {
    elements_cs = document.getElementsByClassName('clair_sombre')
    if (elements_cs[0].classList.contains('clair')) {
        for (i = 0; i < som.length; i++) {
            som[i].classList.add('clair')
            som[i].classList.remove('sombre')
        }
    } else {
        for (i = 0; i < som.length; i++) {
            som[i].classList.add('sombre')
            som[i].classList.remove('clair')
        }
    }
}

// Boutton de l'accueil

var sup_but1 = document.getElementsByClassName('but_mode_sombre')[0]
var but1 = document.getElementsByClassName('rond_but_mode_sombre')[0]

if (document.getElementsByClassName('rond_but_mode_sombre').length > 0) {
    if (som[0].classList.contains('sombre')) {
        but1.classList.add('actif')
    }
    sup_but1.addEventListener('click', function(e) {
        // Activation animation boutton dans barre_gauche.js
        clair_sombre()
    })
}