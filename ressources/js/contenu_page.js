// Selection jeux

if (document.querySelector("#cont_jeux") != null) {
    window.addEventListener('resize', function() {
        var content = document.querySelector(".droite_part_content.grille_jeux")
        if (content != null) { // Réglage de la grille dans "Afficher plus +"
            var width = content.offsetWidth - 2 * 15 - 2 * 5
            var ideal_num_col = (width / 400 >> 0) + 1
            content.style.gridTemplateColumns = "repeat(" + String(ideal_num_col) + ", auto)"
        }

        if (document.querySelector(".jeux_tendance_content" != null)) {
            var case_jeux = document.querySelectorAll(".jeux_tendance_content")
        } else if (document.querySelector('.jeux_pres_content') != null) {
            var case_jeux = document.querySelectorAll(".jeux_pres_content")
        }
        var case_jeux_plus = document.querySelectorAll(".jeux_pres_content")
        var height = case_jeux_plus[0].offsetHeight
        for (i = 0; i < case_jeux.length; i++) {
            case_jeux[i].style.fontSize = String((25 * height) / 100) + "px" //Pourcentage de la hauteur du text par rapport à celle de la cellule
            case_jeux[i].style.lineHeight = String(((25 * height) / 100) + 8) + "px"
        }
    })

    function adaptative_jeux_content() {
        var content = document.querySelector(".droite_part_content.grille_jeux")
        if (content != null) { // Réglage de la grille dans "Afficher plus +"
            var width = content.offsetWidth - 2 * 15 - 2 * 5
            var ideal_num_col = (width / 400 >> 0) + 1
            content.style.gridTemplateColumns = "repeat(" + String(ideal_num_col) + ", auto)"
        }

        if (document.querySelector(".jeux_tendance_content" != null)) {
            var case_jeux = document.querySelectorAll(".jeux_tendance_content")
        } else if (document.querySelector('.jeux_pres_content') != null) {
            var case_jeux = document.querySelectorAll(".jeux_pres_content")
        }
        var case_jeux_plus = document.querySelectorAll(".jeux_pres_content")
        if (case_jeux_plus.length != 0) { // Réglage de la grille dans "Afficher plus +"
            var height = case_jeux[0].offsetHeight
            for (i = 0; i < case_jeux.length; i++) {
                case_jeux[i].style.fontSize = String((25 * height) / 100) + "px" //Pourcentage de la hauteur du text par rapport à celle de la cellule
                case_jeux[i].style.lineHeight = String(((25 * height) / 100) + 8) + "px"
            }
        }
    }

    var men_gau_anim_end = document.getElementsByClassName('menu_gauche')[0]
    men_gau_anim_end.addEventListener('transitionend', function() {
        adaptative_jeux_content()
    })

    adaptative_jeux_content()
}