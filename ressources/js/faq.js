var quest = document.getElementsByClassName('faq_question')

function faq_afficheReponse(e) {
    var rep = e.parentNode.querySelector('.faq_reponse')
    rep.classList.toggle('reponse_deployer')
}