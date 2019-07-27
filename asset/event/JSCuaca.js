//set weather function
function cuaca(wilayah, tanggal,waktu2){
  $('#suhu-maks-set, #suhu-min-set, #lembap-min-set, #lembap-maks-set').focus().css({'border-color':"","box-shadow":""})
  $('#suhu-maks-set, #suhu-min-set, #lembap-min-set, #lembap-maks-set').css({'border-color':"","box-shadow":""})
  $('.set_cuaca input').val(null)
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
  $('#suhu-maks-edit, #suhu-min-edit, #lembap-min-edit, #lembap-maks-edit ').focus().css({'border-color':"","box-shadow":""})
  $('#suhu-maks-edit, #suhu-min-edit, #lembap-min-edit, #lembap-maks-edit ').css({'border-color':"","box-shadow":""})
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
        $('.suhu-min-edit').val(data['suhu_min'])
        $('.suhu-maks-edit').val(data['suhu_maks'])
        $('.lembap-min-edit').val(data['kelembapan_min'])
        $('.lembap-maks-edit').val(data['kelembapan_maks'])
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
  $('#form-input, #form-edit-ph, .edit_form_ket').hide()
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
        document.getElementById("form-tambah").scrollIntoView();
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
          document.getElementById("baca-data").scrollIntoView();
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
          document.getElementById("baca-data").scrollIntoView();
          
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
        $('#tanggal_akhir_set').val('')
        $('#cek-tgl').html('')
        $('#tanggal_akhir_set').focus().css({'border-color':"","box-shadow":""})
        $('#tanggal_akhir_set').css({'border-color':"","box-shadow":""})
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
    $('#cek-tgl-edit').html('')
    $('#tanggal_akhir_edit').focus().css({'border-color':"","box-shadow":""})
    $('#tanggal_akhir_edit').css({'border-color':"","box-shadow":""})
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
  $('.edit-req-pmus').click(function(){
    CKValueEdit.setData('');
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKValueEdit.setData(data['teks']);
        $('#edit_judul').val(data['judul'])
        $('#id_edit').val(data['id_mus'])
        $('.edit-form').show()
        document.getElementById("form-edit").scrollIntoView();
      }
    })
  })
}

function edit_req_dinat(link){
  $('.edit-req-dinat').click(function(){
    CKValueEdit.setData('');
    $('#cek-tgl-edit').html('')
    $('#tanggal_akhir_edit').focus().css({'border-color':"","box-shadow":""})
    $('#tanggal_akhir_edit').css({'border-color':"","box-shadow":""})
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKValueEdit.setData(data['teks']);
        $('#tanggal_mulai_edit').val(data['awal'])
        $('#tanggal_akhir_edit').val(data['akhir'])
        $('#judul_edit').val(data['judul'])
        $('#id_edit').val(data['id'])
        $('.edit-form').show()
        document.getElementById("edit-form").scrollIntoView();
      }
    })
  })
}

function edit_req_ipt(link){
  $('.edit_req_ipt').click(function(){
    $('#cek-tgl-edit').html('')
    $('#tanggal_akhir_edit').focus().css({'border-color':"","box-shadow":""})
    $('#tanggal_akhir_edit').css({'border-color':"","box-shadow":""})
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
        document.getElementById("edit-form").scrollIntoView();
      }
    })
  })
}


function edit_req_tch(link){
  $('.edit_req_tch').click(function(){
    CKValueEdit.setData('');
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKValueEdit.setData(data['tch']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['tch']['id_tch'])
        $('.edit-form').show()
        document.getElementById("edit-form").scrollIntoView();
      }
    })
  })
}

function edit_req_tsh(link){
  $('.edit_req_tsh').click(function(){
    CKValueEdit.setData('');
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKValueEdit.setData(data['tsh']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['tsh']['id_tsh'])
        $('.edit-form').show()
        document.getElementById("edit-form").scrollIntoView();
      }
    })
  })
}

function edit_req_pnh(link){
  $('.edit_req_pnh').click(function(){
    CKValueEdit.setData('');
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKValueEdit.setData(data['pch']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['pch']['id_pch'])
        $('.edit-form').show()
        document.getElementById("edit-form").scrollIntoView();
      }
    })
  })
}

function edit_req_epi(link){
  $('.edit_req_epi').click(function(){
    CKValueEdit.setData('');
    $.ajax({
      url: link,
      type: 'GET',
      data: 'id='+$(this).val(),
      dataType: 'json',
      success: function(data){
        CKValueEdit.setData(data['epi']['teks']);
        $('.edit-foto').html(data['fotos'])
        $('#id_edit').val(data['epi']['id_epi'])
        $('.edit-form').show()
        document.getElementById("edit-form").scrollIntoView();
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

$('.new_hth').click(function(){
  $('#cek-tgl').html('')
  $('#tanggal_akhir_set').focus().css({'border-color':"","box-shadow":""})
  $('#tanggal_akhir_set').css({'border-color':"","box-shadow":""})
  $('#tanggal_mulai').val($(this).val())
  $('.input-data').show()
  document.getElementById("tambah-form").scrollIntoView();
})

function edit_hth(link) {
  $('.ch-hth').click(function(e){
    $('#cek-tgl-edit').html('')
    $('#tanggal_akhir_edit').focus().css({'border-color':"","box-shadow":""})
    $('#tanggal_akhir_edit').css({'border-color':"","box-shadow":""})
    CKValueEdit.setData('');
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
          CKValueEdit.setData(data.ket);
          $('.edit-form').show()
          document.getElementById("edit-form").scrollIntoView();
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

$('.add-form').click(function(){
  $('#cek-tgl').html('')
  $('#tanggal_akhir_set').focus().css({'border-color':"","box-shadow":""})
  $('#tanggal_akhir_set').css({'border-color':"","box-shadow":""})
  $('#tambah-form').show()
  document.getElementById("tambah-form").scrollIntoView();
})

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

$('#suhu-maks-set, #lembap-maks-set').change(function(){
  if ($(this).attr('id')=='suhu-maks-set'&&($(this).val()<$('#suhu-min-set').val()||$(this).val()>60)) {
    $(this).focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).val(null)
  }else if($(this).attr('id')=='lembap-maks-set'&&($(this).val()<$('#lembap-min-set').val()||$(this).val()>100)){
    $(this).focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).val(null)
  }else{
    $(this).focus().css({'border-color':"","box-shadow":""})
    $(this).css({'border-color':"","box-shadow":""})
  }
})


$('#suhu-maks-edit, #lembap-maks-edit').change(function(){
  if ($(this).attr('id')=='suhu-maks-edit'&&($(this).val()<$('#suhu-min-set').val()||$(this).val()>60)) {
    $(this).focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).val(null)
  }else if($(this).attr('id')=='lembap-maks-edit'&&($(this).val()<$('#lembap-min-set').val()&&$(this).val()>100)){
    $(this).focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    $(this).val(null)
  }else{
    $(this).focus().css({'border-color':"","box-shadow":""})
    $(this).css({'border-color':"","box-shadow":""})
  }
})

$('#suhu-min-set, #lembap-min-set, #suhu-min-edit, #lembap-min-edit ').change(function(){
  var now = $(this)
  if ((now.attr('id')=='suhu-min-set'||now.attr('id')=='suhu-min-edit')&&(now.val()<-10||now.val()>50)) {
    now.focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    now.css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    now.val(null)
  }else if ((now.attr('id')=='lembap-min-set'||now.attr('id')=='lembap-min-edit')&&(now.val()<-10||now.val()>100)) {
    now.focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    now.css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
    now.val(null)
  }else{
    now.focus().css({'border-color':"","box-shadow":""})
    now.css({'border-color':"","box-shadow":""})
  }
})


$('.cek-tanggal').click(function(){
  if ($('#tanggal_akhir_set').val()!="") {
    var tanggal1 = $('#tanggal-mulai, #tanggal_mulai').val().split("-")
    tanggal1 = new Date(tanggal1[1]+'/'+tanggal1[0]+'/'+tanggal1[2])
    var tanggal2 = $('#tanggal_akhir_set').val().split("-")
    tanggal2 = new Date(tanggal2[1]+'/'+tanggal2[0]+'/'+tanggal2[2])

    if (tanggal2<=tanggal1) {
      $('#cek-tgl').html(' Tanggal tidak valid')
        $('#tanggal_akhir_set').focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
        $('#tanggal_akhir_set').css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
        return false
    }else{
      $('#cek-tgl').html('')
      $('#tanggal_akhir_set').focus().css({'border-color':"","box-shadow":""})
      $('#tanggal_akhir_set').css({'border-color':"","box-shadow":""})
    }
  }
})

$('.cek-tanggal-edit').click(function(){
    var tanggal1 = $('#tanggal_mulai_edit').val().split("-")
    tanggal1 = new Date(tanggal1[1]+'/'+tanggal1[0]+'/'+tanggal1[2])
    var tanggal2 = $('#tanggal_akhir_edit').val().split("-")
    tanggal2 = new Date(tanggal2[1]+'/'+tanggal2[0]+'/'+tanggal2[2])
    //alert(tanggal1)
    
    if (tanggal2<=tanggal1) {
      $('#cek-tgl-edit').html(' Tanggal tidak valid')
        $('#tanggal_akhir_edit').focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
        $('#tanggal_akhir_edit').css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
        return false;
    }else{
      $('#cek-tgl-edit').html('')
      $('#tanggal_akhir_edit').focus().css({'border-color':"","box-shadow":""})
      $('#tanggal_akhir_edit').css({'border-color':"","box-shadow":""})
    }
})

$('.baca-ket').click(function(){
  $('#modal-ket').show()
})

function edit_req_per(link){
  $('.edit_req_per').click(function(){
    $('#cek-tgl-edit').html('')
    $('#edit_tanggal').focus().css({'border-color':"","box-shadow":""})
    $('#edit_tanggal').css({'border-color':"","box-shadow":""})
    $.ajax({
      url:link,
      type:'GET',
      data:{id:$(this).val()},
      dataType:'json',
      success: function(data){
        if (data!=null) {
          $('#id_edit').val(data['id'])
          $('#edit_tanggal').val(data['tanggal'])
          $('#edit_wilayah').val(data['wilayah'])
          $('#edit_per').val(data['isi'])
          $('.edit-form').show()
          document.getElementById("edit-form").scrollIntoView();
        }
      }
    })
  })
}

function baca_warning(link){
  $('.baca_warning').click(function(){
    $.ajax({
      url:link,
      type:'GET',
      data:{id:$(this).val()},
      dataType:'json',
      success: function(data){
        if (data!=null) {
          $('#head-warn').html('Peringatan wilayah '+data.wilayah+' tanggal '+data.tanggal)
          $('#peringatan-read').html(data.isi)
          $('#modal-ket').show()
        }
      }
    })
  })
}

function cek_tanggal(tgl){
  $('.cek-tanggal').click(function(){
      var tanggal1 = tgl.split("-")
    
      var tanggal2 = $('#tanggal_akhir_set').val().split("-")

      for (let index = 2; index >= 0; index--) {
        if (tanggal2[index]<tanggal1[index]) {
          $('#cek-tgl').html(' Tanggal tidak valid')
          $('#tanggal_akhir_set').focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
          $('#tanggal_akhir_set').css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
          return false
        }else{
          $('#cek-tgl').html('')
          $('#tanggal_akhir_set').focus().css({'border-color':"","box-shadow":""})
          $('#tanggal_akhir_set').css({'border-color':"","box-shadow":""})
        }
      }
  })
}

function cek_tanggal_edit(tgl){
  $('.cek-tanggal-edit').click(function(){
    var tanggal1 = tgl.split("-")
  
    var tanggal2 = $('#edit_tanggal').val().split("-")

    for (let index = 2; index >= 0; index--) {
      if (tanggal2[index]<tanggal1[index]) {
        $('#cek-tgl-edit').html(' Tanggal tidak valid')
        $('#edit_tanggal').focus().css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
        $('#edit_tanggal').css({'border-color':"red","box-shadow":"inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6)"})
        return false
      }else{
        $('#cek-tgl-edit').html('')
        $('#edit_tanggal').focus().css({'border-color':"","box-shadow":""})
        $('#edit_tanggal').css({'border-color':"","box-shadow":""})
      }
    }
})
}
  

/*
var $fileUpload = $("input[type='file']");
               if (parseInt($fileUpload.get(0).files.length) > 3){
                  alert("You are only allowed to upload a maximum of 3 files");
               }
*/
