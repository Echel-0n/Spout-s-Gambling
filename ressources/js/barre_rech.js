// Recherche

if (document.querySelector('#search_game') != null) {
    $('#search_game').keyup(function() {
        var search_game_text = $(this).val();
        if (document.querySelector('.droite_part_content.grille_jeux') == null) { // En cas de recherche depuis la section Carousel
            if (afficher_plus()) {
                search()
            }
        } else {
            search()
        }

        var lang = document.querySelector('#lang_selection').value

        function search() {
            $.ajax({
                type: 'GET',
                url: '/ressources/fonctions/recherche_jeux.php',
                data: 'search_game=' + encodeURIComponent(search_game_text) + '&&lang=' + lang,
                success: function(data) {
                    if (data == "") {
                        document.querySelector('.droite_part_noresult').style.visibility = "visible";
                        document.querySelector('.droite_part_content.grille_jeux').style.visibility = "hidden";
                    } else {
                        document.querySelector('.droite_part_noresult').style.visibility = "hidden";
                        document.querySelector('.droite_part_content.grille_jeux').style.visibility = "visible";
                        document.querySelector('.droite_part_content.grille_jeux').innerHTML = data
                        adaptative_jeux_content()
                    }
                }
            });
        }
    });
}

if (document.querySelector('#search_user') != null) {
    $('#search_user').keyup(function() {
        var search_user_text = $(this).val();
        var lang = document.querySelector('#lang_selection').value
        var barre_rech = document.querySelector('#barre_search_user')
        if (search_user_text != '') {
            $.ajax({
                type: 'POST',
                url: '/ressources/fonctions/recherche_user.php',
                data: 'search_user=' + encodeURIComponent(search_user_text) + '&&lang=' + lang,
                success: function(data) {
                    barre_rech.classList.add('actifSearchUser')
                    document.querySelector('#affiche_searched_user').classList.add('actifSearchUser')
                    if (data == "") {
                        document.querySelector('#grille_searched_user').innerHTML = document.querySelector('#noResult_searched_user').innerHTML
                    } else {
                        document.querySelector('#grille_searched_user').innerHTML = data
                    }
                }
            });
        } else {
            barre_rech.classList.remove('actifSearchUser')
            document.querySelector('#affiche_searched_user').classList.remove('actifSearchUser')
        }
    });
}

if (document.querySelector('#search_question') != null) {
    $('#search_question').keyup(function() {
        var search_user_text = $(this).val();
        var lang = document.querySelector('#lang_selection').value
        $.ajax({
            type: 'POST',
            url: '/ressources/fonctions/recherche_question.php',
            data: 'search_question=' + encodeURIComponent(search_user_text) + '&&lang=' + lang,
            success: function(data) {
                document.querySelector('#faq_parent').innerHTML = data
            }
        });
    });
}

// Animation de la loupe

function animation_loupe(e) {
    e.classList.add('recherche_lancee')
    setTimeout(function() {
        e.classList.remove('recherche_lancee')
    }, 495);
}