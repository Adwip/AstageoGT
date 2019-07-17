/* prevent send null value of delete form */


/*show news function */

$('.lihat').click(function(e){
  e.preventDefault();
  
	var id = $(this).attr('data-id');
	var link = $(this).attr('href');

  $.ajax({
    url:  link,
    type: 'GET',
    dataType: 'json',
    data: 'id='+id,
    success:  function(data){
      $('.dis-foto').html(data['foto'])
      $('.red-judul').html(data['berita']['judul'])
      $('.red-isi').html(data['berita']['isi'])
      $('.baca-news').show()
      document.getElementById("baca-news").scrollIntoView();
    }
  })
})

function baca(id){
	alert(id);
}

/* edit news function using jquery ajax */
function editBRT(id, link){
  CKEDITOR.instances.ckeditorc.setData(null);
  $.ajax({
      url: link,
      type: 'GET',
      dataType: 'json',
      data: 'id='+id,
      success: function(data){
        if (data!=null) {
          $('#edit-id').val(id);
          $('#edit-judul').val(data['judul']);
          CKEDITOR.instances.ckeditorc.setData(data['teks']);
          $('.edit-foto').html(data['foto']);
          $('.form-edit').show();
          document.getElementById("form-edit").scrollIntoView();
        }
       }
    })
}

/*data['teks']*/

/* UPT edit function using jquery ajax */
function editUPT(id, link){
	$.ajax({
              url: link,
              type: 'GET',
              dataType: 'json',
              data: 'id='+id,
              success: function(data){
              	if (data!=null) {
              		$('#edit-id').val(id);
              		$('#edit-kan').val(data['data']['kantor']);
              		$('#edit-add').val(data['data']['Alamat']);
              		$('#edit-sur').val(data['data']['email']);
              		$('#edit-telp').val(data['data']['telepon']);
              		$('#edit-faks').val(data['data']['faksimili']);
              		$('#edit-head').val(data['data']['kepala']);
                  $('#nama').val(data['data']['nama']);
                  $('#t-input').val(data['data']['tanggal_input']);
                  $('#foto-edit').html(data['foto']);

              		$('.edit-page').show();
              	}
              }
    })
}

function editPJB(id,link){
  $.ajax({
    url: link,
    type: 'GET',
    dataType: 'json',
    data: 'id='+id,
    success: function(data){
      if (data!=null) {
        $('.form-nama').val(data['name']);
        $('.form-jabatan').val(data['posisi']);
        $('#foto-edit').html(data['foto']);
        $('#id-form').val(data['nomor']);
        $('#ft-form').val(data['img']);
        $('.form-edit').show();
      }

    }
  })
}

$('.edit-umur').click(function(){
  $('.form-umur').show();
})

$('.edit-golongan').click(function(){
  $('.form-golongan').show();
})

$('.edit-akademik').click(function(){
  $('.form-akademik').show();
})

$('.batal').click(function(){
  $('.form-edit').hide()
})

$('.baca-pdf').click(function(e){
  e.preventDefault()
  var pdf = $(this).attr('href')
  $('#pdf-profil').html('<iframe width="800" height="1000" src="'+pdf+'"></iframe>')
  $('.pdf-show').show()
})

$('.tutup').click(function(){
  //document.getElementById("list-dta").scrollIntoView();
  $(this).closest('.x_content').hide()
})

function baca_upt(link){
  $('.baca-upt').click(function(e){
    e.preventDefault()
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).attr('href'),
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#kantor').html(data['data']['kantor'])
          $('#alamat').html(data['data']['Alamat'])
          $('#kepala').html(data['data']['kepala'])
          $('#email').html(data['data']['email'])
          $('#telepon').html(data['data']['telepon'])
          $('#faksimili').html(data['data']['faksimili'])
          $('#petugas').html(data['data']['nama'])
          $('#tinput').html(data['data']['tanggal_input'])
          $('#struktur').html(data['foto'])
          $('.view-page').show()
        }
      }
    })
  })
}

$('#form-set').submit(function(e){
  e.preventDefault();
  $.ajax({
    url: $(this).attr('action'),
    type: $(this).attr('method'),
    data: $(this).serialize(),
    success: function(){
      window.location.reload()
    }
  })
})

$('form#del').submit(function(e){
    e.preventDefault()
    if ($(this).serialize()==false) {
      return false
    }
    mscConfirm("Hapus ?",function(){
        $.ajax({
          url: $('form#del').attr('action'),
          type: 'POST',
          data: $('form#del').serialize(),
          success: function(){
            notifjs("Berhasil menghapus data",'#ff6a00');
          },error: function(){
            gagal("Gagal menghapus data");
          }
      })
    })
  })

function edit_req_peng(link){
  CKEDITOR.instances.ckeditorc2.setData(null);
  $('.edit-req-peng').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKEDITOR.instances.ckeditorc2.setData(data[0]['isi']);
        $('#judul_edit').val(data[0]['judul'])
        $('#id_edit').val(data[0]['id_peng'])
        $('.edit-form').show()
      }
    })
  })
}

$('#kirim-data, #kirim-data2, #kirim-data3').submit(function(e){
  e.preventDefault()
  var data = new FormData(this)
  if ($(this).attr('id')=='kirim-data2') {
    data.append('teks',CKEDITOR.instances.ckeditorc.getData())  
  }else if($(this).attr('id')=='kirim-data3'){
    data.append('teks',CKEDITOR.instances.ckeditorc2.getData())  
  }
  $.ajax({
    url: $(this).attr('action'),
    type: $(this).attr('method'),
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function (){
      $('button').prop('disabled',true);
    },success: function (data) {
      if (data==1) {
        notifjs("Berhasil menambah data",'#34c231')
      }else if (data==2) {
        notifjs("Berhasil mengubah data",'#00e1ff')  
      }else{
        gagal("Gagal memproses data")
        $('button').prop('disabled',false)
      }
    },error: function(){
      gagal("Gagal memproses data")
      $('button').prop('disabled',false); 
    }
  });
})

// MDB Lightbox Init
$(function () {
  $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
  });

function get_art(link){
  $('.get-art').click(function(){
    $.ajax({
      url: link,
      data: {id: $(this).val()},
      type: 'GET',
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#id_edit').val(data.id)
          $('#edit_judul').val(data.judul)
          $('#edit_ket').val(data.ket)
          $('.edit-form').show()
        }
      }
    })
  })
}

function baca_artikel(link){
  $('.baca-artikel').click(function(e){
    e.preventDefault();
    $.ajax({
      url:link,
      data:{'id':$(this).attr('href')},
      type: 'GET',
      dataType: 'json',
      success: function(data){
        if (data!=null) {
            $('#ark-judul').html(data.judul)
            $('#creator').html(data.creator)
            $('#tambahan').html(data.tambahan)
            $('#dokpdf').prop('src',data.pdf)
            $('.cek-data').show()
            document.getElementById("baca-artikel").scrollIntoView();
        }
      }
    })
  })
}

function keluar(link){
  mscConfirm("Lanjutkan keluar ?","Anda harus login kembali jika ingin masuk",function(){
    window.location.replace(link)
  })
}

//edit sejarah
