if (document.querySelector('#lang_selection') != null) {
    var lang = document.querySelector('#lang_selection').value
} else {
    var lang = 'fr'
}


window.addEventListener('resize', function() {
    // Reglage vertical ou horizontal des dès
    var desParent = document.querySelector('#game_yams_partDes_parent')
    var des = document.querySelector('#game_yams_partDes')
    if (des != null) {
        var nombre_des = document.querySelectorAll('.game_yams_des_parent').length
        if (desParent.offsetHeight > desParent.offsetWidth) {
            des.style = "grid-template-rows: repeat(" + nombre_des + ", 20%)";
            desParent.classList.remove('game_yams_partDes_alignement_horizontal')
            desParent.classList.add('game_yams_partDes_alignement_vertical')
            partDes = document.querySelectorAll(".game_yams_des")
            partDes_newSize = String((des.offsetHeight / 5) - (2 * 10))
            for (i = 0; i < partDes.length; i++) {
                partDes[i].style = "padding-left:" + partDes_newSize + "px ; height:" + partDes_newSize + "px ;"
            }

        } else {
            des.style = "grid-template-columns: repeat(" + nombre_des + ", 20%)";
            desParent.classList.remove('game_yams_partDes_alignement_vertical')
            desParent.classList.add('game_yams_partDes_alignement_horizontal')
            partDes = document.querySelectorAll(".game_yams_des")
            for (i = 0; i < partDes.length; i++) {
                partDes[i].style = ""
            }
        }
    }
    // Réglage taille cases score tableau
    var casesScore = document.querySelectorAll('.game_yams_tabl_grillePoints_ligne_score')
    for (i = 0; i < casesScore.length; i++) {
        var height = casesScore[i].offsetHeight
        casesScore[i].style.width = height
        casesScore[i].style.fontSize = height / 2
    }

})

function adaptSize() {
    var desParent = document.querySelector('#game_yams_partDes_parent')
    var des = document.querySelector('#game_yams_partDes')
    if (des != null) {
        var nombre_des = document.querySelectorAll('.game_yams_des_parent').length
        if (desParent.offsetHeight > desParent.offsetWidth) {
            des.style = "grid-template-rows: repeat(" + nombre_des + ", 20%)";
            desParent.classList.remove('game_yams_partDes_alignement_horizontal')
            desParent.classList.add('game_yams_partDes_alignement_vertical')
            partDes = document.querySelectorAll(".game_yams_des")
            partDes_newSize = String((des.offsetHeight / 5) - (2 * 10))
            for (i = 0; i < partDes.length; i++) {
                partDes[i].style = "padding-left:" + partDes_newSize + "px ; height:" + partDes_newSize + "px ;"
            }

        } else {
            des.style = "grid-template-columns: repeat(" + nombre_des + ", 20%)";
            desParent.classList.remove('game_yams_partDes_alignement_vertical')
            desParent.classList.add('game_yams_partDes_alignement_horizontal')
            partDes = document.querySelectorAll(".game_yams_des")
            for (i = 0; i < partDes.length; i++) {
                partDes[i].style = ""
            }
        }
    }
    // Réglage taille cases score tableau
    var casesScore = document.querySelectorAll('.game_yams_tabl_grillePoints_ligne_score')
    for (i = 0; i < casesScore.length; i++) {
        var height = casesScore[i].offsetHeight
        casesScore[i].style.width = height
        casesScore[i].style.fontSize = height / 2
    }
}

adaptSize()


function envoie(action, e) {
    if (e.classList.contains('possibleToClick')) {
        var value_str = ''
        var des_list = document.querySelectorAll('.game_yams_des_parent')
        if (des_list.length > 0) { // Renvoie tout les dés , en notant ceux qui sont gardés et leurs valeurs
            for (i = 0; i < des_list.length; i++) {
                var tempI1 = des_list[i].id.replace('game_yams_des_parent_', '')
                if (i != 0) {
                    value_str += '!'
                }
                value_str += tempI1

                var tempI2 = des_list[i].querySelector('.game_yams_des_val').id.replace('game_yams_des_val', '')
                value_str += ':' + tempI2

                if (des_list[i].classList.contains('selected_des')) {
                    value_str += '~keep'
                }
            }
        }
        value_str += '|'
        var scr_value_list = document.querySelectorAll('.game_yams_tabl_grillePoints_ligne_score')
        if (scr_value_list.length > 0) { // Renvoie tout les dés , en notant ceux qui sont gardés
            for (j = 0; j < scr_value_list.length; j++) {
                var tempJ1 = scr_value_list[j].id.replace('game_yams_tabl_score', '')
                if (j != 0) {
                    value_str += '!'
                }
                value_str += tempJ1
                var tempJ2 = parseInt(scr_value_list[j].innerHTML)
                value_str += ':' + tempJ2
                if (scr_value_list[j].classList.contains('selected_score')) {
                    value_str += '~keepUser'
                }
                if (scr_value_list[j].classList.contains('selected_score_byPHP')) {
                    value_str += '~keepPHP'
                }
            }
        }
        value_str += '|'
        value_str += 'total:' + document.querySelector('#game_yams_tabl_totalPoints_scoreStockage').innerHTML
        $.ajax({
            type: 'POST',
            url: '/ressources/games/yams/game_ajax.php',
            data: 'lang=' + lang + '&&action=' + action + '&&value= ' + value_str,
            beforeSend: function() {
                document.querySelector('#game_yams_mess_erreur').innerHTML = ' <div class="parent_charg"> <div class="animation_chargement"> </div></div> '
                document.querySelector('#game_yams_mess_erreur').style = "display: flex;"
            },
            success: function(data) {
                console.log($(data).filter('div#PHP_RETURN_BUG')[0].innerHTML)
                console.log(data)
                document.querySelector('#game_yams_mess_erreur').style = "display: none;"
                var errInner = $(data).filter('div#PHP_RETURN_ERROR') // Selectionne l'élément de classe PHP_RETURN_ERROR dans le retour de ajax
                if (errInner.length == 0) {
                    var des = $(data).filter('div#PHP_RETURN_DES')[0]
                    var tabl = $(data).filter('div#PHP_RETURN_TABL')[0]
                    var but = $(data).filter('div#PHP_RETURN_TABL_BUTTON')[0]
                    document.querySelector('#game_yams_partDes_parent').innerHTML = des.innerHTML
                    var tabl_score_list = tabl.innerHTML.split('|')
                    var tabl_score_html_list = document.querySelectorAll('.game_yams_tabl_grillePoints_ligne_score')
                    for (i = 0; i < tabl_score_html_list.length; i++) {
                        tabl_score_html_list[i].classList.remove('selected_score_byPHP')
                        var t = tabl_score_list[i].split('~')
                        if (t.length > 1 && t[1] == 'keepPHP') {
                            tabl_score_html_list[i].classList.add('selected_score_byPHP')
                        }
                        tabl_score_html_list[i].innerHTML = t[0]
                    }
                    var totalPhp = $(data).filter('div#PHP_RETURN_TABL_TOTAL')[0]
                    var total = document.querySelector('#game_yams_tabl_totalPoints_score')
                    var totalStock = document.querySelector('#game_yams_tabl_totalPoints_scoreStockage')
                    total.innerHTML = totalPhp.innerHTML
                    totalStock.innerHTML = totalPhp.innerHTML

                    var newBut = but.innerHTML
                    var butRel = document.querySelector('#game_yams_tabl_buttonRelance')
                    var butRelText = document.querySelectorAll('.game_yams_tabl_buttonRelance_tir')
                    for (i = 0; i < butRelText.length; i++) {
                        butRelText[i].style = "display: none;"
                    }
                    if (newBut == "fst_tir") {
                        butRel.classList.add('possibleToClick')
                        document.querySelector('#game_yams_tabl_buttonRelance_snd_tir').style = ""
                    } else if (newBut == "snd_tir") {
                        butRel.classList.add('possibleToClick')
                        document.querySelector('#game_yams_tabl_buttonRelance_trd_tir').style = ""
                    } else if (newBut == "trd_tir") {
                        butRel.classList.remove('possibleToClick')
                    }

                    var cases_score = document.querySelectorAll('.game_yams_tabl_grillePoints_ligne_score')
                    for (i = 0; i < cases_score.length; i++) {
                        cases_score[i].classList.remove('selected_score')
                    }
                    document.querySelector("#game_yams_tabl_buttonValider").classList.remove('possibleToClick')

                    adaptSize()
                    adaptSize() // On exécute 2 fois la fonction, pour que la taille soit bien adaptée
                    return true
                } else {
                    var err_list = errInner[0].innerHTML.split('|')
                    var textError = '<div class="game_yams_mess_erreur_text_croix" onclick="mess_erreur_close(this)"></div>'
                    for (i = 0; i < err_list.length; i++) {
                        var err = err_list[i].split(':')
                        if (err[0] == "message") {
                            if (textError != "") {
                                textError += "</br>"
                            }
                            textError += err[1]
                        } else if (err[0] == "redirect") {
                            document.location.href = err[1]
                        }
                    }
                    document.querySelector('#game_yams_mess_erreur').innerHTML = '<div class="game_yams_mess_erreur_text">' + textError + '</div>'
                    document.querySelector('#game_yams_mess_erreur').style = "display: flex;"
                }
            }
        });
    }
}

function select_des(e) {
    if (!e.classList.contains("selected_des_BySelectedScoreScript")) {
        e.classList.toggle('selected_des')
    }
}

function select_score(e) {
    if (!e.classList.contains('selected_score_byPHP')) {
        var buttonValider = document.querySelector("#game_yams_tabl_buttonValider")
        if (e.classList.contains('selected_score')) {
            var temoin = true
        } else {
            var temoin = false
        }
        var cases_score = document.querySelectorAll('.game_yams_tabl_grillePoints_ligne_score')
        for (i = 0; i < cases_score.length; i++) {
            cases_score[i].classList.remove('selected_score')
        }
        var total = document.querySelector('#game_yams_tabl_totalPoints_score')
        var totalStock = document.querySelector('#game_yams_tabl_totalPoints_scoreStockage')
        var total_val = parseInt(totalStock.innerHTML)
        var case_val = parseInt(e.innerHTML)
        var des = document.querySelectorAll('.game_yams_des_parent')
        if (!temoin) {
            e.classList.add('selected_score')
            buttonValider.classList.add('possibleToClick')
            var newTotal = total_val + case_val
            total.innerHTML = String(newTotal)
            for (i = 0; i < des.length; i++) {
                if (!des[i].classList.contains('selected_des')) {
                    des[i].classList.add('selected_des_BySelectedScore')
                }
                des[i].classList.add('selected_des')
                des[i].classList.add('selected_des_BySelectedScoreScript')
            }
        } else {
            e.classList.remove('selected_score')
            buttonValider.classList.remove('possibleToClick')
            var newTotal = total_val
            total.innerHTML = String(newTotal)
            for (i = 0; i < des.length; i++) {
                if (des[i].classList.contains('selected_des_BySelectedScore')) {
                    des[i].classList.remove('selected_des')
                    des[i].classList.remove('selected_des_BySelectedScore')
                }
                des[i].classList.remove('selected_des_BySelectedScoreScript')
            }
        }
    }
}

function mess_erreur_close(e) {
    document.querySelector('#game_yams_mess_erreur').style = "display: none;"
}