// Barre de gauche déployable

function barre_gauche_deploiement(e) {
    while (e.classList.contains('contenu_page') != false) {
        console.log(e)
        e = e.parentNode
    }
    var cont_page = document.querySelector('.contenu_page')
    cont_page.classList.toggle('bg_deployer')
}

//barre_gauche_deploiement()

// Animation autres boutons

var boutons_barre_gauche = document.getElementsByClassName('para_mod_bg_button')

for (i = 0; i < boutons_barre_gauche.length; i++) {
    boutons_barre_gauche[i].addEventListener('click', function(e) {
        this.querySelector('.rond_para_mod_bg_button').classList.toggle('actif')
    })

}

// Gestion Transition haut-gauche

var men_gau_anim_srt_end = document.querySelector('.menu_gauche')

men_gau_anim_srt_end.addEventListener('transitionstart', function() {
    var e = this
    while (e.classList.contains('contenu_page') == false) {
        e = e.parentNode
    }
    if (e.classList.contains('bg_deployer')) {
        men_gau_anim_srt_end.style.visibility = "visible"
    }
})
men_gau_anim_srt_end.addEventListener('transitionend', function() {
    var e = this
    while (e.classList.contains('contenu_page') == false) {
        e = e.parentNode
    }
    if (e.classList.contains('bg_deployer') == false) {
        setTimeout(function() {
            men_gau_anim_srt_end.style.visibility = "hidden"
        }, 250)
    } else {
        men_gau_anim_srt_end.style.visibility = "visible"
    }
})

var e = men_gau_anim_srt_end
while (e.classList.contains('contenu_page') == false) {
    e = e.parentNode
}
if (e.classList.contains('bg_deployer') == false) {
    men_gau_anim_srt_end.style.visibility = "hidden"
}

// Changement de la langue

function change_langue(e) {
    url_actuel = location.href
    uas = url_actuel.split('/')
    new_url = ''
    for (i = 0; i <= (uas.length - 1); i++) {
        if (i == 0) {
            new_url += uas[i]
        } else if (i == 3) {
            new_url += ('/' + e.value)
        } else {
            new_url += ('/' + uas[i])
        }
    }
    window.location = new_url
}