if (document.querySelector('.form_section_content') != null) {
    document.querySelector(".form_section_content").style.gridTemplateColumns = "repeat(" + document.querySelector(".form_section_content").querySelectorAll('div.form_page').length + ", 100%)"
}

// Animation focus des inputs

window.addEventListener('pageshow', function() { // On remet correctement la présentation de la page si l'utilisateur en change puis revient avec le bouton retour du navigateur
    all_input = document.querySelectorAll('input.form_input')
    for (i = 0; i < all_input.length; i++) {
        form_focusout_input(all_input[i])
    }
})

function form_focus_input(e) {
    while (e.classList.contains('form_encadr_input') == false) {
        e = e.parentNode
    }
    e.classList.add('form_inp_focus')
    e.querySelector('.form_input_text_fond').classList.add('form_inp_focus')
    e.querySelector('.form_input_text_fond').classList.add('form_inp_text_hautgauche')
    e.querySelector('.form_input').focus()
}

function form_focusout_input(e) {
    while (e.classList.contains('form_encadr_input') == false) {
        e = e.parentNode
    }
    if (e.querySelector('.form_input').value == "") {
        e.querySelector('.form_input_text_fond').classList.remove('form_inp_text_hautgauche')
    } else {
        e.querySelector('.form_input_text_fond').classList.add('form_inp_text_hautgauche')
    }
    e.classList.remove('form_inp_focus')
    e.querySelector('.form_input_text_fond').classList.remove('form_inp_focus')
}

// Navigation entre les différentes parties du formulaire

function form_navig_pages(e) {
    let clicked = e
    while (e.classList.contains('form_page') == false) {
        e = e.parentNode
    }
    var nb_pages = document.querySelectorAll('.form_page').length
    var num_page = parseInt(e.id.replace('page', ''))

    if (clicked.classList.contains('form_suivant') || clicked.classList.contains('form_page')) {
        if (verif_page(num_page)) {
            if (num_page != nb_pages) {
                move_to_page(num_page + 1)
            } else {
                if (verification_form()) {
                    document.querySelector('#formulaire_form').submit()
                }
            }
        }
    } else if (clicked.classList.contains('form_bouton_retour')) {
        if (num_page != 1) {
            move_to_page(num_page - 1)
        } else {
            console.log("ERROR")
        }
    }
}

function move_to_page(num) {
    var nb_pages = document.querySelectorAll('.form_page')
    var part_to_move = document.querySelector("#form_moving_part")
    part_to_move.style.transform = "translate(-" + (100 * (num - 1)) + "%, 0)"
    for (i = 0; i < nb_pages.length; i++) {
        if (i == (num - 1)) {
            nb_pages[i].style.visibility = ""
        } else {
            nb_pages[i].style.visibility = "hidden"
        }
    }
}

document.addEventListener("keydown", function(e) { // Passe directement à la page suivante lors de l'appui de la touche entrée en focus sur le dernier input
    if (e.key == 'Enter') {
        if (e.path[0].classList.contains('form_notLast_input') == false) {
            var f = e.path[0]
            while (f.classList.contains('form_page') == false) {
                f = f.parentNode
            }
            form_navig_pages(f)
        }
    }
})

// Boutton afficher le mot de passe

function activation_case(e) {
    if (e.classList.contains("form_text_option_cocher")) {
        e.parentNode.querySelector('.case_a_cocher').classList.toggle('actif')
    } else {
        e.classList.toggle('actif')
    }
}

var inp_mdp_con = document.getElementsByClassName('form_input_ins_mdp')[0]
var case_coch = document.getElementsByClassName('case_a_cocher')[0]

function affiche_mdp(e) {
    while (e.classList.contains('form_option_cocher') == false) {
        e = e.parentNode
    }
    var f = e
    while (f.classList.contains('form_page') == false) {
        f = f.parentNode
    }
    if (e.querySelector('.case_a_cocher').classList.contains('actif')) {
        f.querySelector('.form_affichermotdepasse').type = "password"
    } else {
        f.querySelector('.form_affichermotdepasse').type = "text"
    }
}

// Format de la date de naissance

var form_dateNaissance = document.querySelector('#form_input_ins_birth')

if (form_dateNaissance != null) {
    form_dateNaissance.addEventListener('keydown', function(e) {
        if (e.code != "Backspace") {
            this.value = this.value.replace(/[^\d\/]/g, '');
            var num = this.value.replace(/[^\d]/g, '');
            if (num.length < 2) {
                this.value = num.slice(0, 2);
            } else if (num.length >= 2 && num.length < 4) {
                this.value = num.slice(0, 2) + "/" + num.slice(2, 4);
            } else {
                this.value = num.slice(0, 2) + "/" + num.slice(2, 4) + "/" + num.slice(4, 8);
            };
        };
    });
    form_dateNaissance.addEventListener('keyup', function(e) {
        var cur_pos = e.target.selectionStart
        this.value = this.value.replace(/[^\d\/]/g, '');
        var num = this.value.replace(/[^\d]/g, '');
        if (num.length < 2) {
            this.value = num.slice(0, 2);
        } else if (num.length == 2) {
            if (e.code != "Backspace") {
                this.value = num.slice(0, 2) + "/";
                cur_pos += 1;
            }
        } else if (num.length > 2 && num.length < 4) {
            this.value = num.slice(0, 2) + "/" + num.slice(2, 4);
        } else if (num.length == 4) {
            if (e.code != "Backspace") {
                this.value = num.slice(0, 2) + "/" + num.slice(2, 4) + "/";
                cur_pos += 1;
            }
        } else {
            this.value = num.slice(0, 2) + "/" + num.slice(2, 4) + "/" + num.slice(4, 8);
        };
        e.target.selectionEnd = cur_pos
        e.target.selectionStart = cur_pos
    });
    form_dateNaissance.addEventListener('mousemove', function(e) {
        if (e.code != "Backspace") {
            this.value = this.value.replace(/[^\d\/]/g, '');
            var num = this.value.replace(/[^\d]/g, '');
            if (num.length < 2) {
                this.value = num.slice(0, 2);
            } else if (num.length >= 2 && num.length < 4) {
                this.value = num.slice(0, 2) + "/" + num.slice(2, 4);
            } else if (num.length >= 4 && num.length < 8) {
                this.value = num.slice(0, 2) + "/" + num.slice(2, 4) + "/" + num.slice(4, 8);
            };
        };
    });
}

// Acceptation des CGU

function accept_cgu(e) {
    cb = e.querySelector('input#form_ins_checkCGU_accept')
    if (cb.checked) {
        cb.checked = false
        e.classList.remove('actif')
    } else {
        cb.checked = true
        e.classList.add('actif')
        e.classList.remove('erreur')
        e.classList.remove('erreur')
        document.querySelector('#form_message_erreur_cgu_notAccepted').classList.remove('erreur')
    }
}

if (document.querySelector('#form_option_cocher_cgu') != null) {
    e = document.querySelector('#form_option_cocher_cgu')
    cb = e.querySelector('input#form_ins_checkCGU_accept')
    if (cb.checked) {
        e.classList.add('actif')
    } else {
        e.classList.remove('actif')
    }
}

// Validation formulaire
// Connexion:
var part_connexion = document.querySelector('#form_connexion')
if (part_connexion != null) {
    function verif_con_email() {
        // Partie e-mail
        var email_page = part_connexion.querySelector('.form_email_con')
        var email = part_connexion.querySelector('#form_input_con_email')
        var email_content = email.value
        if (email_content != '') {
            var email_regex = /.+\@.+\..+/g
            if (email_content.replace(email_regex, '') == '') {
                part_connexion.querySelector('#form_message_erreur_email_vide').classList.remove('erreur')
                part_connexion.querySelector('#form_message_erreur_email_invalide').classList.remove('erreur')
                email_page.querySelector('.form_input_text_fond').classList.remove('erreur')
                email_page.querySelector('.form_encadr_input').classList.remove('erreur')
                return true
            } else { // L'email ne correspond pas à la norme
                part_connexion.querySelector('#form_message_erreur_email_vide').classList.remove('erreur')
                part_connexion.querySelector('#form_message_erreur_email_invalide').classList.add('erreur')
                email_page.querySelector('.form_input_text_fond').classList.add('erreur')
                email_page.querySelector('.form_encadr_input').classList.add('erreur')
                return false
            }
        } else { // Il n'y a pas d'email
            part_connexion.querySelector('#form_message_erreur_email_invalide').classList.remove('erreur')
            part_connexion.querySelector('#form_message_erreur_email_vide').classList.add('erreur')
            email_page.querySelector('.form_input_text_fond').classList.add('erreur')
            email_page.querySelector('.form_encadr_input').classList.add('erreur')
            return false
        }
    }

    function verif_con_mdp() {
        // Partie mot de passe
        var mdp_page = part_connexion.querySelector('.form_mdp_con')
        var mdp = part_connexion.querySelector('#form_input_con_mdp')
        var mdp_content = mdp.value
        if (mdp_content != '') {
            if (mdp_content.length >= 6) {
                part_connexion.querySelector('#form_message_erreur_mdp_vide').classList.remove('erreur')
                part_connexion.querySelector('#form_message_erreur_mdp_invalide').classList.remove('erreur')
                mdp_page.querySelector('.form_input_text_fond').classList.remove('erreur')
                mdp_page.querySelector('.form_encadr_input').classList.remove('erreur')
                return true
            } else { // Le mot de passe ne correspond pas à la norme
                part_connexion.querySelector('#form_message_erreur_mdp_vide').classList.remove('erreur')
                part_connexion.querySelector('#form_message_erreur_mdp_invalide').classList.add('erreur')
                mdp_page.querySelector('.form_input_text_fond').classList.add('erreur')
                mdp_page.querySelector('.form_encadr_input').classList.add('erreur')
                return false
            }
        } else { // Il n'y a pas de mot de passe
            part_connexion.querySelector('#form_message_erreur_mdp_invalide').classList.remove('erreur')
            part_connexion.querySelector('#form_message_erreur_mdp_vide').classList.add('erreur')
            mdp_page.querySelector('.form_input_text_fond').classList.add('erreur')
            mdp_page.querySelector('.form_encadr_input').classList.add('erreur')
            return false
        }
    }

    function verif_page(num) {
        var idPage = '#page' + String(num)
        var page = document.querySelector(idPage)
        if (page.querySelector('#form_input_con_email')) {
            if (verif_con_email()) {
                return true
            } else {
                return false
            }
        } else if (page.querySelector('#form_input_con_mdp')) {
            if (verif_con_mdp()) {
                return true
            } else {
                return false
            }
        } else {
            return false
        }
    }

    function verification_form() {
        // Vérification de tout le formulaire
        var email = verif_con_email()
        var mdp = verif_con_mdp()
        if (email && mdp) { // Tout est valide
            return true
        } else { // Un input est invalide
            if (!email) {
                var p = part_connexion.querySelector('#form_input_con_email')
                while (p.classList.contains('form_page') == false) {
                    p = p.parentNode
                }
                var goto = p.id.replace('page', '')
                move_to_page(goto)
                return false
            } else if (!mdp) {
                var p = part_connexion.querySelector('#form_input_con_mdp')
                while (p.classList.contains('form_page') == false) {
                    p = p.parentNode
                }
                var goto = p.id.replace('page', '')
                move_to_page(goto)
                return false
            }
        }
    }
}
// Inscription:
var part_inscription = document.querySelector('#form_inscription')
if (part_inscription != null) {
    function verif_ins_email() {
        var email_page = part_inscription.querySelector('.form_email_ins')
        var email = part_inscription.querySelector('#form_input_ins_email')
        var email_content = email.value
        part_inscription.querySelector('#form_message_erreur_email_vide').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_email_invalide').classList.remove('erreur')
        email_page.querySelector('.form_input_text_fond').classList.remove('erreur')
        email_page.querySelector('.form_encadr_input').classList.remove('erreur')

        // Partie e-mail
        if (email_content != '') {
            var email_regex = /.+\@.+\..+/g
            if (email_content.replace(email_regex, '') == '') {
                part_inscription.querySelector('#form_message_erreur_email_vide').classList.remove('erreur')
                part_inscription.querySelector('#form_message_erreur_email_invalide').classList.remove('erreur')
                email_page.querySelector('.form_input_text_fond').classList.remove('erreur')
                email_page.querySelector('.form_encadr_input').classList.remove('erreur')
                return true
            } else { // L'email ne correspond pas à la norme
                part_inscription.querySelector('#form_message_erreur_email_vide').classList.remove('erreur')
                part_inscription.querySelector('#form_message_erreur_email_invalide').classList.add('erreur')
                email_page.querySelector('.form_input_text_fond').classList.add('erreur')
                email_page.querySelector('.form_encadr_input').classList.add('erreur')
                return false
            }
        } else { // Il n'y a pas d'email
            part_inscription.querySelector('#form_message_erreur_email_invalide').classList.remove('erreur')
            part_inscription.querySelector('#form_message_erreur_email_vide').classList.add('erreur')
            email_page.querySelector('.form_input_text_fond').classList.add('erreur')
            email_page.querySelector('.form_encadr_input').classList.add('erreur')
            return false
        }
    }

    function verif_ins_pseudo() {
        var pseudo_page = part_inscription.querySelector('.form_pseudo_ins')
        var pseudo = part_inscription.querySelector('#form_input_ins_pseudo')
        var pseudo_content = pseudo.value
        part_inscription.querySelector('#form_message_erreur_pseudo_vide').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_pseudo_invalide').classList.remove('erreur')
        pseudo_page.querySelector('.form_input_text_fond').classList.remove('erreur')
        pseudo_page.querySelector('.form_encadr_input').classList.remove('erreur')

        // Partie pseudo
        if (part_inscription.querySelector('#form_message_erreur_pseudo_alreadyExist').classList.contains('erreur') == false) {
            if (pseudo_content != '') {
                var pseudo_regex = /[a-zA-Z0-9À-ÿ\/\_\-\.]{4,12}/g
                if (pseudo_content.replace(pseudo_regex, '') == '') {
                    part_inscription.querySelector('#form_message_erreur_pseudo_vide').classList.remove('erreur')
                    part_inscription.querySelector('#form_message_erreur_pseudo_invalide').classList.remove('erreur')
                    pseudo_page.querySelector('.form_input_text_fond').classList.remove('erreur')
                    pseudo_page.querySelector('.form_encadr_input').classList.remove('erreur')
                    return true
                } else { // Le pseudo ne correspond pas à la norme
                    part_inscription.querySelector('#form_message_erreur_pseudo_vide').classList.remove('erreur')
                    part_inscription.querySelector('#form_message_erreur_pseudo_invalide').classList.add('erreur')
                    pseudo_page.querySelector('.form_input_text_fond').classList.add('erreur')
                    pseudo_page.querySelector('.form_encadr_input').classList.add('erreur')
                    return false
                }
            } else { // Il n'y a pas de pseudo
                part_inscription.querySelector('#form_message_erreur_pseudo_invalide').classList.remove('erreur')
                part_inscription.querySelector('#form_message_erreur_pseudo_vide').classList.add('erreur')
                pseudo_page.querySelector('.form_input_text_fond').classList.add('erreur')
                pseudo_page.querySelector('.form_encadr_input').classList.add('erreur')
                return false
            }
        } else {
            return false
        }
    }

    function verif_ins_pseudo_dispo() {
        var pseudo = part_inscription.querySelector('#form_input_ins_pseudo').value
        var exist_deja = part_inscription.querySelector('#form_message_erreur_pseudo_alreadyExist')
        var exist_pas = part_inscription.querySelector('#form_message_erreur_pseudo_noExist')
        exist_deja.classList.remove('erreur')
        exist_pas.classList.remove('erreur')
        if (pseudo != '' && pseudo.replace(/[a-zA-Z0-9À-ÿ\/\_\-\.]{4,}/g, '') == '') {
            $.ajax({
                type: 'POST',
                url: '/ressources/fonctions/verif_dispo_pseudo.php',
                data: 'pseudo=' + pseudo,
                success: function(data) {
                    if (data) {
                        exist_deja.classList.add('erreur')
                        exist_pas.classList.remove('erreur')
                    } else {
                        exist_deja.classList.remove('erreur')
                        exist_pas.classList.add('erreur')
                    }
                },
            });
        }
    }

    function verif_ins_mdp() {
        var mdp_page = part_inscription.querySelector('.form_mdp_ins')
        var mdp = part_inscription.querySelector('#form_input_ins_mdp')
        var mdp_conf = part_inscription.querySelector('#form_input_ins_mdp_conf')
        var mdp_content = mdp.value
        var mdp_conf_content = mdp_conf.value
        part_inscription.querySelector('#form_message_erreur_mdp_vide').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_mdp_court').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_mdp_invalide').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_mdp_nonIdentique').classList.remove('erreur')
        mdp_page.getElementsByClassName('form_input_text_fond')[0].classList.remove('erreur')
        mdp_page.getElementsByClassName('form_input_text_fond')[1].classList.remove('erreur')
        mdp_page.getElementsByClassName('form_encadr_input')[0].classList.remove('erreur')
        mdp_page.getElementsByClassName('form_encadr_input')[1].classList.remove('erreur')

        // Partie mot de passe
        if (mdp_content != '') {
            if (mdp_content.length >= 6) {
                var mdp_regex = /[a-zA-Z0-9à-ÿ\/\_\-\.\,]{6,}/g
                if (mdp_content.replace(mdp_regex, '') == '') {
                    if (mdp_content == mdp_conf_content) {
                        part_inscription.querySelector('#form_message_erreur_mdp_vide').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_mdp_court').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_mdp_invalide').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_mdp_nonIdentique').classList.remove('erreur')
                        mdp_page.getElementsByClassName('form_input_text_fond')[0].classList.remove('erreur')
                        mdp_page.getElementsByClassName('form_input_text_fond')[1].classList.remove('erreur')
                        mdp_page.getElementsByClassName('form_encadr_input')[0].classList.remove('erreur')
                        mdp_page.getElementsByClassName('form_encadr_input')[1].classList.remove('erreur')
                        return true
                    } else { // Le mot de passe ne correspond pas à celui de confirmation
                        part_inscription.querySelector('#form_message_erreur_mdp_vide').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_mdp_court').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_mdp_invalide').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_mdp_nonIdentique').classList.add('erreur')
                        mdp_page.getElementsByClassName('form_input_text_fond')[0].classList.add('erreur')
                        mdp_page.getElementsByClassName('form_input_text_fond')[1].classList.add('erreur')
                        mdp_page.getElementsByClassName('form_encadr_input')[0].classList.add('erreur')
                        mdp_page.getElementsByClassName('form_encadr_input')[1].classList.add('erreur')
                        return false
                    }
                } else { // Le mot de passe ne correspond pas à la norme
                    part_inscription.querySelector('#form_message_erreur_mdp_vide').classList.remove('erreur')
                    part_inscription.querySelector('#form_message_erreur_mdp_court').classList.remove('erreur')
                    part_inscription.querySelector('#form_message_erreur_mdp_invalide').classList.add('erreur')
                    part_inscription.querySelector('#form_message_erreur_mdp_nonIdentique').classList.remove('erreur')
                    mdp_page.getElementsByClassName('form_input_text_fond')[0].classList.add('erreur')
                    mdp_page.getElementsByClassName('form_input_text_fond')[1].classList.add('erreur')
                    mdp_page.getElementsByClassName('form_encadr_input')[0].classList.add('erreur')
                    mdp_page.getElementsByClassName('form_encadr_input')[1].classList.add('erreur')
                    return false
                }
            } else { // Le mot de passe n'est pas assez long
                part_inscription.querySelector('#form_message_erreur_mdp_vide').classList.remove('erreur')
                part_inscription.querySelector('#form_message_erreur_mdp_court').classList.add('erreur')
                part_inscription.querySelector('#form_message_erreur_mdp_invalide').classList.remove('erreur')
                part_inscription.querySelector('#form_message_erreur_mdp_nonIdentique').classList.remove('erreur')
                mdp_page.getElementsByClassName('form_input_text_fond')[0].classList.add('erreur')
                mdp_page.getElementsByClassName('form_input_text_fond')[1].classList.add('erreur')
                mdp_page.getElementsByClassName('form_encadr_input')[0].classList.add('erreur')
                mdp_page.getElementsByClassName('form_encadr_input')[1].classList.add('erreur')
                return false
            }
        } else { // Il n'y a pas de mot de passe
            part_inscription.querySelector('#form_message_erreur_mdp_vide').classList.add('erreur')
            part_inscription.querySelector('#form_message_erreur_mdp_court').classList.remove('erreur')
            part_inscription.querySelector('#form_message_erreur_mdp_invalide').classList.remove('erreur')
            part_inscription.querySelector('#form_message_erreur_mdp_nonIdentique').classList.remove('erreur')
            mdp_page.getElementsByClassName('form_input_text_fond')[0].classList.add('erreur')
            mdp_page.getElementsByClassName('form_input_text_fond')[1].classList.add('erreur')
            mdp_page.getElementsByClassName('form_encadr_input')[0].classList.add('erreur')
            mdp_page.getElementsByClassName('form_encadr_input')[1].classList.add('erreur')
            return false
        }
    }

    function verif_ins_identite() {
        var identite_page = part_inscription.querySelector('.form_identite_ins')
        var nom = part_inscription.querySelector('#form_input_ins_nom')
        var prenom = part_inscription.querySelector('#form_input_ins_prenom')
        var birth = part_inscription.querySelector('#form_input_ins_birth')
        var nom_content = nom.value
        var prenom_content = prenom.value
        var birth_content = birth.value
        identite_page.getElementsByClassName('form_input_text_fond')[0].classList.remove('erreur')
        identite_page.getElementsByClassName('form_encadr_input')[0].classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_nom_vide').classList.remove('erreur')
        identite_page.getElementsByClassName('form_input_text_fond')[1].classList.remove('erreur')
        identite_page.getElementsByClassName('form_encadr_input')[1].classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_prenom_vide').classList.remove('erreur')
        identite_page.getElementsByClassName('form_input_text_fond')[2].classList.remove('erreur')
        identite_page.getElementsByClassName('form_encadr_input')[2].classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_bday_vide').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_bday_invalid_format').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_bday_notExist').classList.remove('erreur')
        part_inscription.querySelector('#form_message_erreur_bday_inFuture').classList.remove('erreur')

        // Partie identitée
        if (nom_content == '') {
            identite_page.getElementsByClassName('form_input_text_fond')[0].classList.add('erreur')
            identite_page.getElementsByClassName('form_encadr_input')[0].classList.add('erreur')
            part_inscription.querySelector('#form_message_erreur_nom_vide').classList.add('erreur')
            var verif_nom = false
        } else {
            identite_page.getElementsByClassName('form_input_text_fond')[0].classList.remove('erreur')
            identite_page.getElementsByClassName('form_encadr_input')[0].classList.remove('erreur')
            part_inscription.querySelector('#form_message_erreur_nom_vide').classList.remove('erreur')
            var verif_nom = true
        }
        if (prenom_content == '') {
            identite_page.getElementsByClassName('form_input_text_fond')[1].classList.add('erreur')
            identite_page.getElementsByClassName('form_encadr_input')[1].classList.add('erreur')
            part_inscription.querySelector('#form_message_erreur_prenom_vide').classList.add('erreur')
            var verif_prenom = false
        } else {
            identite_page.getElementsByClassName('form_input_text_fond')[1].classList.remove('erreur')
            identite_page.getElementsByClassName('form_encadr_input')[1].classList.remove('erreur')
            part_inscription.querySelector('#form_message_erreur_prenom_vide').classList.remove('erreur')
            var verif_prenom = true
        }
        if (birth_content != '') {
            if (birth_content.length == 10 && birth_content.replace(/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/g, '') == '') {
                var birth_content_list = birth_content.split('/')
                var jour_birth = birth_content_list[0]
                var mois_birth = birth_content_list[1]
                var annee_birth = birth_content_list[2]
                var birth_content_us = annee_birth + '/' + mois_birth + '/' + jour_birth
                var bday = new Date(birth_content_us)
                var nday = new Date()
                if (bday > nday || bday <= nday) {
                    if (bday < nday) {
                        identite_page.getElementsByClassName('form_input_text_fond')[2].classList.remove('erreur')
                        identite_page.getElementsByClassName('form_encadr_input')[2].classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_vide').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_invalid_format').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_notExist').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_inFuture').classList.remove('erreur')
                        var verif_birth = true
                    } else {
                        identite_page.getElementsByClassName('form_input_text_fond')[2].classList.add('erreur')
                        identite_page.getElementsByClassName('form_encadr_input')[2].classList.add('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_vide').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_invalid_format').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_notExist').classList.remove('erreur')
                        part_inscription.querySelector('#form_message_erreur_bday_inFuture').classList.add('erreur')
                        var verif_birth = false
                    }
                } else {
                    identite_page.getElementsByClassName('form_input_text_fond')[2].classList.add('erreur')
                    identite_page.getElementsByClassName('form_encadr_input')[2].classList.add('erreur')
                    part_inscription.querySelector('#form_message_erreur_bday_vide').classList.remove('erreur')
                    part_inscription.querySelector('#form_message_erreur_bday_invalid_format').classList.remove('erreur')
                    part_inscription.querySelector('#form_message_erreur_bday_notExist').classList.add('erreur')
                    part_inscription.querySelector('#form_message_erreur_bday_inFuture').classList.remove('erreur')
                    var verif_birth = false
                }
            } else {
                identite_page.getElementsByClassName('form_input_text_fond')[2].classList.add('erreur')
                identite_page.getElementsByClassName('form_encadr_input')[2].classList.add('erreur')
                part_inscription.querySelector('#form_message_erreur_bday_vide').classList.remove('erreur')
                part_inscription.querySelector('#form_message_erreur_bday_invalid_format').classList.add('erreur')
                part_inscription.querySelector('#form_message_erreur_bday_notExist').classList.remove('erreur')
                part_inscription.querySelector('#form_message_erreur_bday_inFuture').classList.remove('erreur')
                var verif_birth = false
            }
        } else {
            identite_page.getElementsByClassName('form_input_text_fond')[2].classList.add('erreur')
            identite_page.getElementsByClassName('form_encadr_input')[2].classList.add('erreur')
            part_inscription.querySelector('#form_message_erreur_bday_vide').classList.add('erreur')
            part_inscription.querySelector('#form_message_erreur_bday_invalid_format').classList.remove('erreur')
            part_inscription.querySelector('#form_message_erreur_bday_notExist').classList.remove('erreur')
            part_inscription.querySelector('#form_message_erreur_bday_inFuture').classList.remove('erreur')
            var verif_birth = false
        }
        if (verif_nom && verif_prenom && verif_birth) {
            return true
        } else {
            return false
        }
    }

    function verif_ins_cgu() {
        var cgu_page = part_inscription.querySelector('.form_cgu_ins')
        var cgu = part_inscription.querySelector('#form_ins_checkCGU_accept')
        cgu_page.querySelector('.form_option_cocher').classList.remove('erreur')
        cgu_page.querySelector('#form_message_erreur_cgu_notAccepted').classList.remove('erreur')

        // Partie CGU
        if (cgu.checked) {
            cgu_page.querySelector('.form_option_cocher').classList.remove('erreur')
            cgu_page.querySelector('#form_message_erreur_cgu_notAccepted').classList.remove('erreur')
            return true
        } else {
            cgu_page.querySelector('.form_option_cocher').classList.add('erreur')
            cgu_page.querySelector('#form_message_erreur_cgu_notAccepted').classList.add('erreur')
            return false
        }
    }

    function verif_page(num) {
        var idPage = '#page' + String(num)
        var page = document.querySelector(idPage)
        if (page.querySelector('#form_input_ins_email')) {
            if (verif_ins_email()) {
                return true
            } else {
                return false
            }
        } else if (page.querySelector('#form_input_ins_pseudo')) {
            if (verif_ins_pseudo()) {
                return true
            } else {
                return false
            }
        } else if (page.querySelector('#form_input_ins_mdp')) {
            if (verif_ins_mdp()) {
                return true
            } else {
                return false
            }
        } else if (page.querySelector('#form_input_ins_nom') && page.querySelector('#form_input_ins_prenom') && page.querySelector('#form_input_ins_birth')) {
            if (verif_ins_identite()) {
                return true
            } else {
                return false
            }
        } else if (page.querySelector('#form_ins_checkCGU_accept')) {
            if (verif_ins_cgu()) {
                return true
            } else {
                return false
            }
        } else {
            return false
        }
    }

    function verification_form() {
        // Vérification de tout le formulaire
        var email = verif_ins_email()
        var pseudo = verif_ins_pseudo()
        var mdp = verif_ins_mdp()
        var identite = verif_ins_identite()
        var acceptCGU = verif_ins_cgu()
        if (email && pseudo && mdp && identite && acceptCGU) { // Tout est valide
            return true
        } else { // Un input est invalide
            if (!email) {
                var p = part_inscription.querySelector('.form_email_ins')
                var goto = p.id.replace('page', '')
                move_to_page(goto)
                return false
            } else if (!pseudo) {
                var p = part_inscription.querySelector('.form_pseudo_ins')
                var goto = p.id.replace('page', '')
                move_to_page(goto)
                return false
            } else if (!mdp) {
                var p = part_inscription.querySelector('.form_mdp_ins')
                var goto = p.id.replace('page', '')
                move_to_page(goto)
                return false
            } else if (!identite) {
                var p = part_inscription.querySelector('.form_identite_ins')
                var goto = p.id.replace('page', '')
                move_to_page(goto)
                return false
            } else if (!acceptCGU) {
                var p = part_inscription.querySelector('.form_cgu_ins')
                var goto = p.id.replace('page', '')
                move_to_page(goto)
                return false
            }
        }
    }
}