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

/* edit news function using jquery ajax */
function editBRT(id, link){
  CKValueEdit.setData('');
  $.ajax({
      url: link,
      type: 'GET',
      dataType: 'json',
      data: 'id='+id,
      success: function(data){
        if (data!=null) {
          $('#edit-id').val(id);
          $('#edit-judul').val(data['judul']);
          CKValueEdit.setData(data['teks']);
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
                  //$('#foto-edit').html(data['foto']);
                  $('.edit-page').show();
                  document.getElementById("form-edit").scrollIntoView();
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
        $('.form-nama').val(data['name'])
        $('.form-jabatan').val(data['posisi'])
        $('#form-kategori').val(data['kategori'])
        $('#foto-edit').html(data['foto'])
        $('#id-form').val(data['nomor'])
        $('#ft-form').val(data['img'])
        $('.form-edit').show();
        document.getElementById("form-edit").scrollIntoView();
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
  document.getElementById("list-data").scrollIntoView();
  $(this).closest('.x_content').hide()
})

$('.tutupSDM').click(function(){
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
          //$('#struktur').html(data['foto'])
          $('.view-page').show()
          document.getElementById("lihat-upt").scrollIntoView();
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
    mscConfirm("Hapus data ?",function(){
        $.ajax({
          url: $('form#del').attr('action'),
          type: 'POST',
          data: $('form#del').serialize(),
          success: function(data){
            if (data!=null) {
              notifjs("Berhasil menghapus "+data+" data",'#ff6a00');
            }else{
              gagal("Gagal menghapus data");
            }
            
          },error: function(){
            gagal("Gagal menghapus data");
          }
      })
    })
  })

function edit_req_peng(link){
  $('.edit-req-peng').click(function(){
    CKEDITOR.instances.ckeditorc2.setData(null);
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#judul_edit').val(data[0]['judul'])
          $('#id_edit').val(data[0]['id_peng'])
          CKEDITOR.instances.ckeditorc2.setData(data[0]['isi']);
          $('.edit-form').show()
          document.getElementById("form-edit").scrollIntoView();
        }
      }
    })
  })
}

function edit_req_jdih(link){
  $('.edit-req-jdih').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#id_edit').val(data[0]['id_jdih'])
          $('#kategori_edit').val(data[0]['jenis_aturan'])
          $('#nomor_edit').val(data[0]['nomor'])
          $('#tentang_edit').val(data[0]['tentang'])
          $('.edit-form').show()
          document.getElementById("edit-form").scrollIntoView();
        }
      }
    })
  })
}

$('#kirim-data, #kirim-data2, #kirim-data3').submit(function(e){
  e.preventDefault()
  var data = new FormData(this)
  if ($(this).attr('id')=='kirim-data2') {
    if (CKValue.getData()=='') {
      return false;
    }
    data.append('teks',CKValue.getData())  
  }else if($(this).attr('id')=='kirim-data3'){
    if (CKValueEdit.getData()=='') {
      return false;
    }
    data.append('teks',CKValueEdit.getData())  
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
          document.getElementById("edit-form").scrollIntoView();
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

function baca_peng(link){
  $('.baca-pengumuman').click(function(e){
    e.preventDefault()
    $.ajax({
      url:link,
      type: 'GET',
      data: {id : $(this).attr('href')},
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#judul').html(data.judul)
          $('#teks').html(data.isi)
          $('#pdf').html(data.file)
          $('#cek-data').show()
          document.getElementById("cek-data").scrollIntoView();
        }
      }
    })
  })
}

function baca_jdih(link){
  $('.baca-jdih').click(function(e){
    e.preventDefault()
    $.ajax({
      url: link,
      type: 'GET',
      data: {id: $(this).attr('href')},
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#jenis').html(data.jenis)
          $('#nomor-jdih').html(data.nomor)
          $('#tentang').html(data.tentang)
          $('#pdf').html(data.pdf)
          $('#cek-data').show()
          document.getElementById("cek-data").scrollIntoView();
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

function kirim_news(link){
  $('#kirim-data-news').submit(function(e){
    e.preventDefault()
    var data = new FormData(this)
    data.append('teks',CKValue.getData())  
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
          notifjsnews("Berhasil menambah data",'#34c231',link) 
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
}

//edit sejarah
