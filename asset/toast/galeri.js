function get_galeri(link,tp){
    var i=0
    var galeri = null
    $('.show-gal').click(function(e){
        $.ajax({
            url: link,
            data: {'id':$(this).val(),'tp':tp},
            type: 'GET',
            dataType: 'json',
            success: function(data){
                if (data!=null) {
                    i=0
                    galeri=data
                    $('#img-loc').html(galeri[i])
                    $('.galeri').css("visibility","visible")
                }
            }
        })
    })
    $('.kiri, .kanan').click(function(){
        if ($(this).hasClass('kiri')) {
            if (i!=0) {
                i--
                $('#img-loc').html(galeri[i])
            }
        }else if ($(this).hasClass('kanan')){
            if ((galeri.length-1)!=i) {
                i++
                $('#img-loc').html(galeri[i])
            }
        }
    })
    $('.right_col').click(function(){
        $('.galeri').css("visibility","hidden")
    })
}

function foto_hbl(link,cls){
    $('.cek_hb, .cek_g_musim, .cek_g_dinat, .cek_g_ipt, .cek_g_hth, .cek_g_ptr ').click(function(e){
        $('#img-loc').html('<img class="'+cls+'" src="'+link+$(this).val()+'">')
        $('.galeri').css("visibility","visible")
    })
    $('.clb').click(function(e){
        $('.galeri').css("visibility","hidden")
    })
    
}

function tutupg(){
    $('.right_col').click(function(e){
        alert("Close")
        //$('.galeri').css("visibility","hidden")
    })
}





