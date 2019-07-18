//set weather function
function cuaca(wilayah, tanggal,waktu2){
	$('.wilayah').val(wilayah);
	$('.tanggal').val(tanggal);
	$('.waktu').val(waktu2);
	$('.dis-cuaca').hide();
	$('.set_cuaca').show();
}

function tambahHB(bulan,tahun){
        $('#bulan-form').val(bulan);
        $('#tahun-form').val(tahun);
        $('.form-kirim').show();
        document.getElementById("form-tambah").scrollIntoView();
}

function tambahProb(inten,bulan,tahun){
	var intens = ['< 50','< 100','< 150','> 50','> 100','> 150','> 100','> 150','> 200','> 300','> 400','> 500'];
	$('#bulan-form').val(bulan);
	$('#tahun-form').val(tahun);
	$('#intens-form').val(intens[inten]);
	$('.form-kirim').show();
}



//zero delete val prevention
	
$('.hapus').click(function(){
    var cek = document.querySelectorAll('input[data-nama=hapus]:checked').length
    if (cek==0) {
        return false;
    }
        
})

//edit cuaca

function edit_cuaca(id,link,waktu){
  $.ajax({
    url:link,
    type: 'GET',
    data: 'id='+id,
    dataType: 'json',
    success: function(data){
      if (data!=null) {
        $('.id_edit').val(data['id_cuhar'])
        $('.wilayah_edit').val(data['Wilayah'])
        $('.tanggal_edit').val(data['Tanggal'])
        $('.waktu_edit').val(waktu)
        $('.cuaca_edit').val(data['Jenis'])
        $('.mata-angin_edit').val(data['arah_angin'])
        $('.suhu_min_edit').val(data['suhu_min'])
        $('.suhu_maks_edit').val(data['suhu_maks'])
        $('.lembap_min_edit').val(data['kelembapan_min'])
        $('.lembap_maks_edit').val(data['kelembapan_maks'])
        $('.dis-cuaca').hide()
        $('.edit_cuaca').show()
      }
    }
  })
}

function cek_cuaca(id,link,waktu){
  $.ajax({
    url:link,
    type: 'GET',
    data: 'id='+id,
    dataType: 'json',
    success: function(data){
      if (data!=null) {
        //alert(data['cuaca'])
        $('#cek-cuaca').html(data['cuaca'])
        $('#suhu').html(data['suhu'])
        $('#lembap').html(data['lembap'])
        $('#wilayah').html(data['wilayah'])
        $('#tanggal_cuaca').html(data['tanggal'])
        $('#angin').html(data['angin'])
        $('#petugas').html(data['petugas'])
        $('#tanggal_input').html(data['tanggal_input'])
        $('#waktu').html(waktu)
        $('.cek_cuaca').show()
        document.getElementById("baca-cuaca").scrollIntoView();
      }
    }
  })
}

function cek_data_prob(link){

    $('.cek_prob').click(function(e){
        e.preventDefault();
        $.ajax({
            url: link,
            type: 'GET',
            data: 'id='+$(this).attr('href'),
            dataType: 'json',
            success: function(data){
                if (data!=null) {
                    
                }
            }
        })
    })

}



$('.cek_hb, .cek_prob, .cek_dinat_img').click(function(e){
    e.preventDefault()
    var link = $(this).attr('href')
    $('#gambar').html('<img width="990" src="'+link+'">')
    $('.cek-data').show()
})

$('.cek_dinat_pdf').click(function(e){
    e.preventDefault()
    var link = $(this).attr('href')
    $('#gambar').html('<iframe width="990" height="800" src="'+link+'"></iframe>')
    $('.cek-data').show()
})

$('.tutup').click(function(){
    document.getElementById("list-data").scrollIntoView();
    $(this).closest('.x_content').hide()
})

$('.tutup1').click(function(){
  $('.dis-cuaca').show()
  document.getElementById("list-data").scrollIntoView();
  $(this).closest('.x_content').hide()
})

function set_(m,t,i){
    $('#minggu-form').val(i)
    $('#bulan-form').val(m)
    $('#tahun-form').val(t)
    $('.form-keterangan, .form-edit-ph').hide()
    $('.form-input').show()
}

function ket(m,t){
  $('#bulan-form-ket').val(m)
  $('#tahun-form-ket').val(t)
  $('.form-input, .form-edit-ph, #edit_form_ket').hide()
  $('.form-keterangan, .set_form_ket').show()
}

function get_edit_ket(link){
  $('.edit_ket').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      dataType: 'json',
      data: 'id='+$(this).attr('data-id'),
      success: function(data){
        if (data!=null) {
            $('#edit_ket_bulan').val(data.bulan)
            $('#edit_ket_tahun').val(data.tahun)
            $('#edit_ket_isi').val(data.isi)
            $('.set_form_ket, #form-edit-ph, #form-input, #form-edit-ph').hide()
            $('.form-keterangan, .edit_form_ket').show()
        }
      }
    })
  })
}



$('#edit_form_ket').submit(function(e){
  e.preventDefault()
  $.ajax({
    url: $(this).attr('action'),
    type: $(this).attr('method'),
    data: $(this).serialize(),
    success: function(data){
      window.location.reload()
    }
  })
})

function del_(id){
  alert(id)
}

$('#edit_form_ph').submit(function(e){
  e.preventDefault()
 $.ajax({
   url: $(this).attr('action'),
   data: $(this).serialize(),
   type: 'POST',
   success: function(){
     window.location.reload()
   }
 })
})

$('.batal').click(function(){
  $(this).closest('.form-input, .form-keterangan, .form-edit-ph').hide()
})

function edit_(m,t,i,ind){
    $('#bulan-edit').val(m)
    $('#tahun-edit').val(t)
    $('#minggu-edit').val(ind)
    $('.indeks-edit').val(i)
    $('.form-input, .form-keterangan').hide()
    $('.form-edit-ph').show()
}

$('.batal-edit').click(function(){
    $('.edit-form').hide()
})

$('.batal').click(function(){
    $('.form-spm').hide()
    $('.grafis').show()
})

$('.tambah').click(function(){
        $('#tanggal_mulai').val($(this).val());

        $('.input-data').show()
})

$('.kirim').click(function(){
        //CKEDITOR.instances.ckedtor.insertHtml( '<p>This is a new paragraph.</p>' );
        if (CKEDITOR.instances.ckeditorc.getData()=='') {
          return false;          
        }

      })


$('.tambah-baru').click(function(){
      $('.form-tambah').show();
      document.getElementById("form-tambah").scrollIntoView();
    })

function baca_data(link){
  $('.cek_musim, .cek_dinat, .cek_ipt').click(function(){
    $.ajax({
      url: link,
      data: {'id':$(this).val()},
      dataType: 'json',
      type: 'GET',
      success: function(data){
        if (data!=null) {
          $('#ark-judul').html(data.judul)
          $('#creator').html(data.creator)
          $('#tambahan').html(data.tambahan)
          $('#dokpdf').prop('src',data.pdf)
          $('.cek-data').show()
        }
      }
    })
  })
}

function baca_data2(link){
  $('.cek_hth').click(function(){
    $.ajax({
      url: link,
      data: {'id':$(this).val()},
      dataType: 'json',
      type: 'GET',
      success: function(data){
        if (data!=null) {
          $('#ark-judul').html(data.judul)
          $('#creator').html(data.creator)
          $('#tambahan').html(data.tambahan)
          $('.cek-data').show()
        }
      }
    })
  })
}

$('.kirim-dinat, .kirim-ipt, .kirim').click(function(e){
  var x = document.getElementById("dokumen");
    if ('files' in x) {
        if (x.files.length!=2) {
          return false;
        }
    }
})

//tambah prospek mingguan & ipt
    $('.tambah').click(function(){
        $('#tanggal-mulai').val($(this).val());
        $('.formulir').show();
        document.getElementById("form-tambah").scrollIntoView();
      });


function edit_ctr(id,link){
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+id,
      success: function(data){
        if (data!=null) {
          $('#id-ctr').val(id)
          $('.edit-foto').html(data)
          $('.edit_ctr').show()
          document.getElementById("form-edit").scrollIntoView();
        }
      }
    })
    
   }

$('.prevent').click(function(e){
        e.preventDefault();
        var val = $(this).attr('data-ex');
        var isi = $(this).attr('href');
        if (val=='show') {
          $('#pdf').html('<iframe style="height: 700px;" class=" col-md-12 col-sm-12" src="'+isi+'"></iframe>');
          $('.pdf').show();
          document.getElementById("disp-data").scrollIntoView();
        }else{

        }
      })
//pilih prak musim untuk ditampilkan
function set(id,link){
  $.ajax({
    url: link,
    data: {'id':id},
    type: 'POST',
    success: function (){
      setopsi("Berhasil memperbarui",'#00ff95')
    },
    error:function() {
      gagal("Gagal memperbarui")
    }
  })
}



function kirim2(){
  $('form#set').submit(function(e){
    e.preventDefault()

    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: $(this).serialize(),
      success: function(){
        window.location.reload()
      }
    })

  })
}

$('#set_form, #edit_form, #set_form_ket').submit(function(e){
  
  e.preventDefault()
  $.ajax({
    url: $(this).attr('action'),
    type: $(this).attr('method'),
    data: $(this).serialize(),
    success: function(){
      window.location.reload()

    }
  })
})




function del_in(bulan,tahun,link,stat){
  if (stat==0) {
    return false
  }
  mscConfirm("Hapus semua data bulan ini ?",function(){
        $.ajax({
          url: link,
          type: 'POST',
          data: 'bulan='+bulan+'&tahun='+tahun,
          success: function(){
            notifjs("Berhasil menghapus data",'#ff6a00');
          },error: function(){
            gagal("Gagal menghapus data");
          }
      })
    })
}



function edit_req_cuming(link){
  $('.edit-req-cuming').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        $('#tanggal_mulai_edit').val(data['tanggal_mulai'])
        $('#tanggal_akhir_edit').val(data['tanggal_akhir'])
        $('#id_edit').val(data['id'])
        $('.edit-form').show()
        document.getElementById("form-edit").scrollIntoView();
      }
    })
  })
}

function edit_req_mus(link){
  CKEDITOR.instances.ckeditorc2.setData(null);
  $('.edit-req-pmus').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKEDITOR.instances.ckeditorc2.setData(data['teks']);
        $('#edit_judul').val(data['judul'])
        $('#id_edit').val(data['id_mus'])
        $('.edit-form').show()
        document.getElementById("form-edit").scrollIntoView();
      }
    })
  })
}

function edit_req_dinat(link){
  CKEDITOR.instances.ckeditorc2.setData(null);
  $('.edit-req-dinat').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKEDITOR.instances.ckeditorc2.setData(data['teks']);
        $('#tanggal_mulai_edit').val(data['awal'])
        $('#tanggal_akhir_edit').val(data['akhir'])
        $('#judul_edit').val(data['judul'])
        $('#id_edit').val(data['id'])
        $('.edit-form').show()
      }
    })
  })
}

function edit_req_ipt(link){
  $('.edit_req_ipt').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        $('#tanggal_mulai_edit').val(data['mulai'])
        $('#tanggal_akhir_edit').val(data['akhir'])
        $('#judul_edit').val(data['judul'])
        $('#id_edit').val(data['id'])
        $('.edit-form').show()
      }
    })
  })
}


function edit_req_tch(link){
  $('.edit_req_tch').click(function(){
    CKEDITOR.instances.ckeditorc2.setData(null);
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKEDITOR.instances.ckeditorc2.setData(data['tch']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['tch']['id_tch'])
        $('.edit-form').show()
      }
    })
  })
}

function edit_req_tsh(link){
  $('.edit_req_tsh').click(function(){
    CKEDITOR.instances.ckeditorc2.setData(null);
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKEDITOR.instances.ckeditorc2.setData(data['tsh']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['tsh']['id_tsh'])
        $('.edit-form').show()
      }
    })
  })
}

function edit_req_pnh(link){
  $('.edit_req_pnh').click(function(){
    CKEDITOR.instances.ckeditorc2.setData(null);
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKEDITOR.instances.ckeditorc2.setData(data['pch']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['pch']['id_pch'])
        $('.edit-form').show()
      }
    })
  })
}

function edit_req_epi(link){
  $('.edit_req_epi').click(function(){
    CKEDITOR.instances.ckeditorc2.setData(null);
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKEDITOR.instances.ckeditorc2.setData(data['epi']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['epi']['id_epi'])
        $('.edit-form').show()
      }
    })
  })
}

function del_ext(link){
  $('.del-ext').click(function(){
    var id = $(this).attr('data-id')
    mscConfirm("Hapus keterangan ?",function(){
      $.ajax({
        url: link,
        data: 'id='+id,
        type: 'POST',
        success: function(){
          notifjs("Berhasil menghapus data",'#ff6a00');
        },error: function(){
          gagal("Gagal menghapus data");
        }
      })
    })
  })
}

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

$('.new_hth').click(function(){
  $('#tanggal_mulai').val($(this).val())
  $('.input-data').show()
})

function edit_hth(link) {
  $('.ch-hth').click(function(e){
    CKEDITOR.instances.ckeditorc2.setData(null);
    $.ajax({
      url: link,
      data: {id: $(this).val()},
      type: 'GET',
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#id_edit').val(data.id)
          $('#tanggal_mulai_edit').val(data.tm)
          $('#tanggal_akhir_edit').val(data.ta)
          $('#judul_edit').val(data.judul)
          $('#id-foto').val(data.foto)
          CKEDITOR.instances.ckeditorc2.setData(data.ket);
          $('.edit-form').show()
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

function baca_gambar(link){
  $('.baca_gambar').click(function(){
    $.ajax({
      url: link,
      data: {'id':$(this).val()},
      type: 'GET',
      success: function(data){
        if (data!=null) {
          $('.display-foto').html(data)
          $('.display-citra').show()
        }
      }
    })
  })
}

function get_hbl_id(link){
  $('.get_hbl_id').click(function(){
    $.ajax({
      url:link,
      data: {'id':$(this).val()},
      type: 'GET',
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#edit-id').val(data.id_hujan)
          $('#edit-bulan-form').val(data.bulan)
          $('#edit-tahun-form').val(data.tahun)
          $('#curah-img').html(data.curah)
          $('#sifat-img').html(data.sifat)
          $('.form-edit').show()
          document.getElementById("form-edit").scrollIntoView();
        }
      }
    })
  })
}

$('.cekbut2, .cekbut3').change(function(){
  if ($('.cekbut2').val()+$('.cekbut3').val()!='') {
    $('.edit-but').prop('disabled',false)
  }else{
    $('.edit-but').prop('disabled',true)
  }
})
  

/*
var $fileUpload = $("input[type='file']");
               if (parseInt($fileUpload.get(0).files.length) > 3){
                  alert("You are only allowed to upload a maximum of 3 files");
               }
*/
