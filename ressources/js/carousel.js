// Adaptation du contenu au clique des flèches

function fleche_droite_action(e) {
    var avantModif_extremeDroite = $(".car_droite_droite")[0]
    var avantModif_droite = $(".car_droite")[0]
    var avantModif_centre = $(".car_centre")[0]
    var avantModif_gauche = $(".car_gauche")[0]
    var avantModif_extremeGauche = $(".car_gauche_gauche")[0]

    var prep_url = Number(avantModif_extremeDroite.id.replace('game_class_', '')) + 2;
    avantModif_extremeGauche.id = 'game_class_' + String(prep_url);

    avantModif_extremeDroite.classList.add("anim_right_arrow")
    avantModif_droite.classList.add("anim_right_arrow")
    avantModif_centre.classList.add("anim_right_arrow")
    avantModif_gauche.classList.add("anim_right_arrow")
    avantModif_extremeGauche.classList.add("anim_right_arrow")

    setTimeout(function() {
        function charge_element_droite() {
            var send_lang = document.querySelector('#lang_selection').value;
            $.ajax({
                type: 'GET',
                url: '/ressources/fonctions/actualisation_carousel.php',
                data: 'needed_game=' + prep_url + '&lang=' + send_lang,
                beforeSend: function() {
                    document.querySelector('#game_class_' + String(prep_url)).innerHTML = ' <div class="jeux_tendance_contenu clair_sombre"> <div class="parent_charg"> <div class="animation_chargement"></div> </div></div></div> '
                },
                success: function(data) {
                    document.querySelector('#game_class_' + String(prep_url)).innerHTML = data
                    adaptative_jeux_content()
                },
                error: function(data) {
                    setTimeout(function() {
                        charge_element_droite(e)
                    }, 2000)
                },
            });
        };
        charge_element_droite()
        setTimeout(function() {
            var apresModif_extremeDroite = avantModif_extremeGauche.innerHTML
            var apresModif_droite = avantModif_extremeDroite.innerHTML
            var apresModif_centre = avantModif_droite.innerHTML
            var apresModif_gauche = avantModif_centre.innerHTML
            var apresModif_extremeGauche = avantModif_gauche.innerHTML

            avantModif_extremeDroite.innerHTML = apresModif_extremeDroite
            avantModif_droite.innerHTML = apresModif_droite
            avantModif_centre.innerHTML = apresModif_centre
            avantModif_gauche.innerHTML = apresModif_gauche
            avantModif_extremeGauche.innerHTML = apresModif_extremeGauche

            apresModif_extremeDroite_id = avantModif_extremeGauche.id
            apresModif_droite_id = avantModif_extremeDroite.id
            apresModif_centre_id = avantModif_droite.id
            apresModif_gauche_id = avantModif_centre.id
            apresModif_extremeGauche_id = avantModif_gauche.id

            avantModif_extremeDroite.id = apresModif_extremeDroite_id
            avantModif_droite.id = apresModif_droite_id
            avantModif_centre.id = apresModif_centre_id
            avantModif_gauche.id = apresModif_gauche_id
            avantModif_extremeGauche.id = apresModif_extremeGauche_id

            avantModif_extremeDroite.classList.remove("anim_right_arrow")
            avantModif_droite.classList.remove("anim_right_arrow")
            avantModif_centre.classList.remove("anim_right_arrow")
            avantModif_gauche.classList.remove("anim_right_arrow")
            avantModif_extremeGauche.classList.remove("anim_right_arrow")

            var lien_centre = document.querySelector(".c_c a.lien_jeu_centre")
            var lien_apresModif = lien_centre.querySelector(".jeux_tendance_contenu").id
            lien_centre.href = lien_apresModif

            adaptative_jeux_content()

        }, 125)

    }, 125)
}

function fleche_gauche_action(e) {
    var avantModif_extremeDroite = $(".car_droite_droite")[0]
    var avantModif_droite = $(".car_droite")[0]
    var avantModif_centre = $(".car_centre")[0]
    var avantModif_gauche = $(".car_gauche")[0]
    var avantModif_extremeGauche = $(".car_gauche_gauche")[0]

    var prep_url = Number(avantModif_extremeGauche.id.replace('game_class_', '')) - 2;
    avantModif_extremeDroite.id = 'game_class_' + String(prep_url);

    avantModif_extremeDroite.classList.add("anim_left_arrow")
    avantModif_droite.classList.add("anim_left_arrow")
    avantModif_centre.classList.add("anim_left_arrow")
    avantModif_gauche.classList.add("anim_left_arrow")
    avantModif_extremeGauche.classList.add("anim_left_arrow")

    setTimeout(function() {
        function charge_element_gauche() {
            var prep_url = Number(avantModif_extremeGauche.id.replace('game_class_', '')) - 2;
            avantModif_extremeDroite.id = 'game_class_' + String(prep_url);
            var send_lang = document.querySelector('#lang_selection').value;
            $.ajax({
                type: 'GET',
                url: '/ressources/fonctions/actualisation_carousel.php',
                data: 'needed_game=' + prep_url + '&lang=' + send_lang,
                beforeSend: function() {
                    document.querySelector('#game_class_' + String(prep_url)).innerHTML = ' <div class="jeux_tendance_contenu clair_sombre"> <div class="parent_charg"> <div class="animation_chargement"></div> </div></div></div> '
                },
                success: function(data) {
                    document.querySelector('#game_class_' + String(prep_url)).innerHTML = data
                    adaptative_jeux_content()
                },
                error: function(data) {
                    setTimeout(function() {
                        charge_element_gauche()
                    }, 2000)
                },
            });
        };
        charge_element_gauche()
        setTimeout(function() {
            var apresModif_extremeDroite = avantModif_droite.innerHTML
            var apresModif_droite = avantModif_centre.innerHTML
            var apresModif_centre = avantModif_gauche.innerHTML
            var apresModif_gauche = avantModif_extremeGauche.innerHTML
            var apresModif_extremeGauche = avantModif_extremeDroite.innerHTML

            avantModif_extremeDroite.innerHTML = apresModif_extremeDroite
            avantModif_droite.innerHTML = apresModif_droite
            avantModif_centre.innerHTML = apresModif_centre
            avantModif_gauche.innerHTML = apresModif_gauche
            avantModif_extremeGauche.innerHTML = apresModif_extremeGauche

            apresModif_extremeDroite_id = avantModif_droite.id
            apresModif_droite_id = avantModif_centre.id
            apresModif_centre_id = avantModif_gauche.id
            apresModif_gauche_id = avantModif_extremeGauche.id
            apresModif_extremeGauche_id = avantModif_extremeDroite.id

            avantModif_extremeDroite.id = apresModif_extremeDroite_id
            avantModif_droite.id = apresModif_droite_id
            avantModif_centre.id = apresModif_centre_id
            avantModif_gauche.id = apresModif_gauche_id
            avantModif_extremeGauche.id = apresModif_extremeGauche_id

            avantModif_extremeDroite.classList.remove("anim_left_arrow")
            avantModif_droite.classList.remove("anim_left_arrow")
            avantModif_centre.classList.remove("anim_left_arrow")
            avantModif_gauche.classList.remove("anim_left_arrow")
            avantModif_extremeGauche.classList.remove("anim_left_arrow")

            var lien_centre = document.querySelector(".c_c a.lien_jeu_centre")
            var lien_apresModif = lien_centre.querySelector(".jeux_tendance_contenu").id
            lien_centre.href = lien_apresModif

            adaptative_jeux_content()

        }, 125)

    }, 125)
}


// Parametrage du type de carousel en fonction de la dimension de l'écran et des division


window.addEventListener('resize', function auto_vertical_ratio() {
    if (document.querySelector(".cont_carousel") != null) {
        var cellule_jeux_cont_vertical = document.getElementsByClassName("jeux_tendance")
        var ratio_keeper = document.getElementsByClassName("ratio_keeper")[0]
        var cont_car_horizontal_vertical = document.getElementsByClassName("cont_carousel")[0]
            // Creation du mode vertical en fonction du rapport hauteur/largeur
        const larg_cc = cont_car_horizontal_vertical.offsetWidth
        const haut_cc = cont_car_horizontal_vertical.offsetHeight
        if (haut_cc > (larg_cc - 175)) {
            cont_car_horizontal_vertical.classList.add("vertical")
        } else {
            cont_car_horizontal_vertical.classList.remove("vertical")
        }
        // Parametrage ratio 16:9 sur cellules jeux mode vertical
        if (cont_car_horizontal_vertical.classList.contains('vertical')) {
            const cel_haut = cellule_jeux_cont_vertical[0].offsetHeight
            const cel_larg = (cel_haut * 16) / 9
            if (((cel_larg * 2) + 40) > cont_car_horizontal_vertical.offsetWidth && cont_car_horizontal_vertical.offsetHeight > ratio_keeper.offsetHeight) {
                const ideal_larg_cel = ((cont_car_horizontal_vertical.offsetWidth - 25) / 2)
                const ideal_haut_ratio_keep = (((ideal_larg_cel * 9) / 16) * 5)
                ratio_keeper.style.height = String(ideal_haut_ratio_keep) + "px"
                const re_cel_haut = cellule_jeux_cont_vertical[0].offsetHeight
                const re_cel_larg = (re_cel_haut * 16) / 9
                for (i = 0; i < cellule_jeux_cont_vertical.length; i++) {
                    cellule_jeux_cont_vertical[i].style.width = String(re_cel_larg) + 'px'
                }
                fleche = document.querySelectorAll(".cont_carousel .fleche_content")
                for (i = 0; i < fleche.length; i++) {
                    fleche[i].classList.remove("fleche_content_droite_gauche")
                    fleche[i].classList.add("fleche_content_haut_bas")
                }
            } else {
                ratio_keeper.style = ""
                for (i = 0; i < cellule_jeux_cont_vertical.length; i++) {
                    cellule_jeux_cont_vertical[i].style.width = String(cel_larg) + 'px'
                }
                fleche = document.querySelectorAll(".cont_carousel .fleche_content")
                for (i = 0; i < fleche.length; i++) {
                    fleche[i].classList.add("fleche_content_droite_gauche")
                    fleche[i].classList.remove("fleche_content_haut_bas")
                }
            }
        } else {
            ratio_keeper.style = ""
            for (i = 0; i < cellule_jeux_cont_vertical.length; i++) {
                cellule_jeux_cont_vertical[i].style = ''
            }
            fleche = document.querySelectorAll(".cont_carousel .fleche_content")
            for (i = 0; i < fleche.length; i++) {
                fleche[i].classList.add("fleche_content_droite_gauche")
                fleche[i].classList.remove("fleche_content_haut_bas")
            }
        };
    }
})

function manu_vertical_ratio() {
    if (document.querySelector(".cont_carousel") != null) {
        var cellule_jeux_cont_vertical = document.getElementsByClassName("jeux_tendance")
        var ratio_keeper = document.getElementsByClassName("ratio_keeper")[0]
        var cont_car_horizontal_vertical = document.getElementsByClassName("cont_carousel")[0]
            // Creation du mode vertical en fonction du rapport hauteur/largeur
        const larg_cc = cont_car_horizontal_vertical.offsetWidth
        const haut_cc = cont_car_horizontal_vertical.offsetHeight
        if (haut_cc > (larg_cc - 175)) {
            cont_car_horizontal_vertical.classList.add("vertical")
        } else {
            cont_car_horizontal_vertical.classList.remove("vertical")
        }
        // Parametrage ratio 16:9 sur cellules jeux mode vertical
        if (cont_car_horizontal_vertical.classList.contains('vertical')) {
            const cel_haut = cellule_jeux_cont_vertical[0].offsetHeight
            const cel_larg = (cel_haut * 16) / 9
            if (((cel_larg * 2) + 40) > cont_car_horizontal_vertical.offsetWidth && cont_car_horizontal_vertical.offsetHeight > ratio_keeper.offsetHeight) { // Largeur carousel vertical > Largeur contenant carousel
                const ideal_larg_cel = ((cont_car_horizontal_vertical.offsetWidth - 25) / 2)
                const ideal_haut_ratio_keep = (((ideal_larg_cel * 9) / 16) * 5)
                ratio_keeper.style.height = String(ideal_haut_ratio_keep) + "px"
                const re_cel_haut = cellule_jeux_cont_vertical[0].offsetHeight
                const re_cel_larg = (re_cel_haut * 16) / 9
                for (i = 0; i < cellule_jeux_cont_vertical.length; i++) {
                    cellule_jeux_cont_vertical[i].style.width = String(re_cel_larg) + 'px'
                }
                fleche = document.querySelectorAll(".cont_carousel .fleche_content")
                for (i = 0; i < fleche.length; i++) {
                    fleche[i].classList.remove("fleche_content_droite_gauche")
                    fleche[i].classList.add("fleche_content_haut_bas")
                }
            } else {
                ratio_keeper.style = ""
                for (i = 0; i < cellule_jeux_cont_vertical.length; i++) {
                    cellule_jeux_cont_vertical[i].style.width = String(cel_larg) + 'px'
                }
                fleche = document.querySelectorAll(".cont_carousel .fleche_content")
                for (i = 0; i < fleche.length; i++) {
                    fleche[i].classList.add("fleche_content_droite_gauche")
                    fleche[i].classList.remove("fleche_content_haut_bas")
                }
            }
        } else {
            ratio_keeper.style = ""
            for (i = 0; i < cellule_jeux_cont_vertical.length; i++) {
                cellule_jeux_cont_vertical[i].style = ''
            }
            fleche = document.querySelectorAll(".cont_carousel .fleche_content")
            for (i = 0; i < fleche.length; i++) {
                fleche[i].classList.add("fleche_content_droite_gauche")
                fleche[i].classList.remove("fleche_content_haut_bas")
            }
        };
    }
}

// Actualisation du mode vertical à la fin de l'animation du menu de gauche

var men_gau_anim_end = document.getElementsByClassName('menu_gauche')[0]
men_gau_anim_end.addEventListener('transitionend', function() {
    if (document.querySelector('.cont_carousel') != null) {
        manu_vertical_ratio()
    }
})

if (document.querySelector('.cont_carousel') != null) {
    manu_vertical_ratio()
}

window.addEventListener("show", manu_vertical_ratio())

// Afficher + ou - 

function afficher_plus() {
    var send_lang = document.querySelector('#lang_selection').value;
    $.ajax({
        type: 'GET',
        url: '/ressources/fonctions/afficher_plus_moins.php',
        data: 'lang=' + send_lang + '&type=plus',
        beforeSend: function() {
            document.querySelector('#cont_jeux').innerHTML = ' <div class="jeux_tendance_contenu clair_sombre"> <div class="parent_charg"> <div class="animation_chargement"></div> </div></div></div> '
        },
        success: function(data) {
            document.querySelector('#cont_jeux').innerHTML = data
            adaptative_jeux_content()
            adaptation_clair_sombre()
            return true
        },
        error: function(data) {
            setTimeout(function() {
                return afficher_plus()
            }, 2000)
        },
    })
};

function afficher_moins() {
    var send_lang = document.querySelector('#lang_selection').value;
    $.ajax({
        type: 'GET',
        url: '/ressources/fonctions/afficher_plus_moins.php',
        data: 'lang=' + send_lang + '&type=moins',
        beforeSend: function() {
            document.querySelector('#cont_jeux').innerHTML = ' <div class="jeux_tendance_contenu clair_sombre"> <div class="parent_charg"> <div class="animation_chargement"></div> </div></div></div> '
        },
        success: function(data) {
            document.querySelector('#cont_jeux').innerHTML = data
            manu_vertical_ratio()
            adaptative_jeux_content()
            adaptation_clair_sombre()
            return true
        },
        error: function(data) {
            setTimeout(function() {
                return afficher_moins()
            }, 2000)
        },
    })
};