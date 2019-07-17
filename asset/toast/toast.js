
function notifjs(pesan,bc){
    var x = $('#snackbar')
    x.css("background-color",bc)
    x.addClass("show")
    x.html(pesan)
    setTimeout(function (){x.removeClass('show'); window.location.reload() }, 3000)
}

function gagal(pesan){
    var x = $('#snackbar')
    x.css("background-color","#ff0000")
    x.addClass("show")
    x.html(pesan)
    setTimeout(function (){x.removeClass('show')}, 3000)
}

function setopsi(pesan,bc){
    var x = $('#snackbar')
    x.css("background-color",bc)
    x.addClass("show")
    x.html(pesan)
    setTimeout(function (){x.removeClass('show')}, 3000)
}