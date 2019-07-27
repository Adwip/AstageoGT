$('.hapus').click(function(){
    var cek = document.querySelectorAll('input[data-nama=hapus]:checked').length
    if (cek==0) {
        return false;
    }
        
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

$('.tutup').click(function(){
    $(this).closest('.x_content').hide()
})

function edit(link){
    $('.edit').click(function(){
        $.ajax({
            url:link,
            data: 'id='+$(this).val(),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.db!=null) {
                    $('#id_edit').val(data.db[0].id_admin)
                    $('#nama_edit').val(data.db[0].nama)

                    $('#berita_edit,#artikel_edit,#pegawai_edit,#cuaca_edit,#musim_edit,#iklim_edit,#inf_iklim_edit,#per_iklim_edit,#kulud_edit,#gempa_edit,#ttm_edit,#umum_edit,#admin_edit').prop('checked',false)
                    if (data.akses.administrator=='Ya') {
                        $('#admin_edit').prop('checked',true)
                    }
                    if (data.akses.berita=='Ya') {
                        $('#berita_edit').prop('checked',true)
                    }
                    if (data.akses.artikel=='Ya') {
                        $('#artikel_edit').prop('checked',true)
                    }
                    if (data.akses.kepegawaian=='Ya') {
                        $('#pegawai_edit').prop('checked',true)
                    }
                    if (data.akses.cuaca=='Ya') {
                        $('#cuaca_edit').prop('checked',true)
                    }
                    if (data.akses.prak_musim=='Ya') {
                        $('#musim_edit').prop('checked',true)
                    }
                    if (data.akses.analis_iklim=='Ya') {
                        $('#iklim_edit').prop('checked',true)
                    }
                    if (data.akses.inf_iklim=='Ya') {
                        $('#inf_iklim_edit').prop('checked',true)
                    }
                    if (data.akses.per_iklim=='Ya') {
                        $('#per_iklim_edit').prop('checked',true)
                    }
                    if (data.akses.kual_udara=='Ya') {
                        $('#kulud_edit').prop('checked',true)
                    }
                    if (data.akses.gempa=='Ya') {
                        $('#gempa_edit').prop('checked',true)
                    }
                    if (data.akses.ttm_petir=='Ya') {
                        $('#ttm_edit').prop('checked',true)
                    }
                    if (data.akses.umum=='Ya') {
                        $('#umum_edit').prop('checked',true)
                    }
                    
                    $('.form-edit').show()
                    
                    
                }

            }
        })
    })
}

$('.full-aks').change(function(){
    if ($(this).is(":checked")) {
      $('.super-admin').prop('checked','checked');
    }
  })

  $('.super-admin').change(function(){
    if ($(this).is(":not(:checked)")) {
      $('.full-aks').prop('checked',false);
    }
  })

  $('.full-aks-edit').change(function(){
    if ($(this).is(":checked")) {
      $('.super-edit').prop('checked','checked');
    }
  })

  $('.super-edit').change(function(){
    if ($(this).is(":not(:checked)")) {
      $('.full-aks-edit').prop('checked',false);
    }
  })

  $('#kirim-data, #kirim-data2, #kirim-data3,  #kirim-data4').submit(function(e){
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

  function keluar(link){
    mscConfirm("Lanjutkan keluar ?","Anda harus login kembali jika ingin masuk",function(){
      window.location.replace(link)
    })
  }
var val=null;
  $('.cekbut, .cekbut3').keyup(function(){
    val=$('.cekbut3').val()+$('.cekbut').val()
    if (val!='') {
      $('.ganp').prop('disabled',false)
    }else{
      $('.ganp').prop('disabled',true)
    }
  })
  $('.cekbut2').change(function(){
    if ($(this).val()!='') {
      $('.ganp').prop('disabled',false)
    }else{
      $('.ganp').prop('disabled',true)
    }
  })