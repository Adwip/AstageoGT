function tambah_ttm(daerah, tanggal) {
	$('#form-wilayah').val(daerah);
	$('#form-tanggal').val(tanggal);
	$('.form-baru').show();
}

function edit_ttm(id) {
	alert('edit TTM '+id);

	// body...
}

function edit_gempa(id,link){
    $.ajax({
        url: link,
        type: 'GET',
        data: 'id='+id,
        dataType: 'json',
        success: function(data){
            if (data!=null) {
                 $('#edit_wilayah').val(data['gempa']['wilayah'])
                 $('#id_gempa').val(data['gempa']['id_gmp'])
                 $('#edit_tanggal').val(data['tanggal'])
                 $('#edit_waktu').val(data['waktu'])
                 $('#edit_jarak').val(data['gempa']['jarak'])
                 $('#edit_arah').val(data['gempa']['arah'])
                 $('#edit_mag').val(data['gempa']['magnitudo'])
                 $('#edit_dalam').val(data['gempa']['kedalaman'])
                 $('#edit_lintang').val(data['gempa']['lintang'])
                 $('#edit_bujur').val(data['gempa']['bujur'])
                 $('#edit_keterangan').val(data['gempa']['keterangan'])
                 $('#edit_mmi').val(data['gempa']['skala_mmi'])
                 $('.rasakan').val('Tidak')
                
                 if (data['gempa']['status_rasa']=='Tidak') {
                   $('#non_rasa').attr('checked','checked')
                 }
                 if (data['gempa']['lokasi']=='Laut') {
                  $('#laut').attr('checked','checked')
                }
                if (data['gempa']['arah_lintang']=='LS') {
                  $('#ls').attr('checked','checked')
                }
                if (data['gempa']['arah_bujur']=='BT') {
                  $('#bt').attr('checked','checked')
                }
                if (data['gempa']['potensi']=='Tidak') {
                  $('#non_tsunami').attr('checked','checked')
                }
                 $('.edit_form').show()           
            }
        }
    })
}

function view_gempa(link){
  $('.v-gempa').click(function(){
    $.ajax({
      url: link,
      type: 'GET',
      data: {id: $(this).attr('data-id')},
      dataType: 'json',
      success: function(data){
        if (data!=null) {
          $('#v-wilayah').html(data.wilayah)
          $('#v-waktu').html(data.waktu)
          $('#v-mag').html(data.mag+' SR')
          $('#v-koor').html(data.koor)
          $('#v-rasa').html(data.rasa)
          $('#v-lok').html(data.lok)
          $('#v-tsun').html(data.tsun)
          $('#v-mmi').html(data.mmi)
          $('#v-ket').html(data.ket)
          $('#img-gempa').html(data.gambar)
          $('#v-mmi').html(data.mmi)
          $('#v-dalam').html(data.dalam+' Km')
          $('#v-extend').html(data.tambahan)
          $('#gempa-cek').show()
        }
      }
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

$('.tutup').click(function(){
    $(this).closest('.x_content').hide()
    document.getElementById("list-data").scrollIntoView();
})

function set_ttm(bulan, tahun, wilayah){
  $('#form-wilayah').val(wilayah)
  $('#form-bulan').val(bulan)
  $('#form-tahun').val(tahun)
  $('.form-input').show()
  document.getElementById("form-input").scrollIntoView();
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

function set_ptr(bulan, tahun) {
  $('#bulan_form').val(bulan)
  $('#tahun_form').val(tahun)
  $('.form-tambah').show()
  document.getElementById("form-input").scrollIntoView();
}

function edit_spt(link){
  $('.edit').click(function() {
    $.ajax({
      url: link,
      data: {id: $(this).attr('data-id')},
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        
      }
    })
  })
}

function read_spt(link){
  $('.read_spt').click(function() {
    $.ajax({
      url: link,
      data: {id: $(this).attr('data-id')},
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        
      }
    })
  })
}

function req_ptr_id(link){
  $('.req_ptr_id').click(function(){
    var path = $(this).attr('data-link')
    $.ajax({
      url:link,
      data: {id: $(this).val()},
      type: 'GET',
      dataType: 'json',
      success:function(data){
        if (data!=null) {
          $('#bulan_edit').val(data.bulan)
          $('#tahun_edit').val(data.tahun)
          $('#judul_edit').val(data.judul)
          $('#rapat').html('<img src="'+path+data.kerapatan+'" alt="Kerapatan" width="400" height="200">')
          $('#sambar').html('<img src="'+path+data.sambaran+'" alt="Sambaran" width="400" height="200">')
          $('#ket_edit').val(data.ket)
          $('.form-edit').show()
          document.getElementById("form-edit").scrollIntoView();
        }
      }
    })
  })
}

$('.baca-ttm').click(function(){
  $('#dokpdf').prop('src',$(this).val())
  $('.cek-data').show()
  document.getElementById("baca-data").scrollIntoView();
})

function keluar(link){
  mscConfirm("Lanjutkan keluar ?","Anda harus login kembali jika ingin masuk",function(){
    window.location.replace(link)
  })
}
