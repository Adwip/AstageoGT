<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Prakiraan musim </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>asset/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/style_tabel/style.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('asset/event/paginasi.css') ?>">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Prakiraan Musim Tahun-an</h3>
              </div>
              <div id="snackbar" align="right"></div> 
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar Prakiraan Musim Tahunan</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="GET" action="<?php echo site_url('Cuaca/prakiraan_musim') ?>">
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <button type="submit" class="btn btn-primary">Tampilkan</button>
                      </form>
                      <form class="form-horizontal form-label-left input_mask" method="POST" id="del" action="<?php echo site_url('Cuaca/del_prakmus') ?>" >
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Judul</th>
                            <th class="column-title">Tahun</th>
                            <th class="column-title">Lihat</th>
                            <th class="column-title">Gambar</th>
                            <th class="column-title">Petugas</th>
                            <th class="column-title">Pilih untuk ditampilkan</th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>                         
                          <?php echo $musim['prak_musim'] ?>
                        </tbody>
                      </table>
                    </div>
                      </div>
                      <div class="ln_solid"></div>
                        <div align="right" >
                          <button type="submit" class="btn btn-round btn-danger btn-xs hapus">Hapus</button>
                        </div>
                    </form>
                    <div>
                    <form action="<?php echo site_url('Cuaca/prakiraan_musim') ?>">
                      <ul class="navigasi">
                        <input type="hidden" name="tahun" value="<?php echo $year ?>">
                        <?php echo $musim['page'] ?>
                      </ul>
                    </form>
                    </div>
                  </div>
                </div>
                <br>
            </div>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan data musim di sini</h5>
                  </div>
                  <div class="x_content form-tambah"  style="display: none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('cuaca/setPrak_musim') ?>" id="kirim-data2">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea name="musim" class="ckeditor beritav" id="ckeditorc"></textarea>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-top: 10px;">Masukkan Gambar & File PDF</label>
                          <input id="dokumen" required type="file" name="dok[]" multiple style="margin-bottom: 10px;">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success kirim">Kirim</button>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Batal</button>
                      </div>
                      </div>
                  </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Baca data prakiraan musim</h5>
                    
                  </div>
                  <div class="x_content cek-data" style="display:none;">
                    <br />
                      <h2 class="text-c" id="ark-judul"></h2>
                      <h6 class="text-c" id="creator"></h6>
                      <hr>
                      <span class="text-c" id="tambahan">
                      </span>
                      <hr>
                      <br>
                      <div>
                        <iframe id="dokpdf" src="#" frameborder="0" width="1000" height="1100"></iframe>
                      </div>
                      <span id="dokumen"></span>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Selesai</button>
                      </div>
                      </div>
                  </div>
                </div>
            </div>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit prakiraan musim</h5>
                  </div>
                  <div class="x_content edit-form"  style="display: none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('cuaca/edit_musim') ?>" id="kirim-data3">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>ID Prakiraan musim</label>
                          <input required type="text" readonly class="form-control col-md-5 col-xs-12" id="id_edit" autocomplete="off" name="id">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Judul</label>
                          <input required type="text"  class="form-control col-md-5 col-xs-12" id="edit_judul" autocomplete="off" name="judul">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-top: 20px;margin-bottom: 5px;">Isi teks</label>
                          <textarea name="musim" class="ckeditor beritav" id="ckeditorc2"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-top: 10px;">Masukkan Gambar atau  File PDF jika akan mengubah</label>
                          <input type="file" name="dok[]" multiple style="margin-bottom: 10px;">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success">Kirim</button>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Batal</button>
                      </div>
                      </div>
                  </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">Dashboard design By Gentelella & Colorlib, system by KP Teknik Informatika UII 2015
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <div class="galeri galeri-musim">
      <div id="clb"><button class="btn btn-xs btn-danger clb">Tutup</button></div>
      <span id="img-loc">
      </span>
    </div>
    <style>
      .text-c{
      color:black;
    }
    hr{
      border-color: grey;
    }
    </style>
    
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>asset/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>asset/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.min.js"></script>
    <!-- CK Editor -->
    <script src="<?php echo base_url(); ?>asset/vendors/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>asset/ckedtor.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/JSCuaca.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/galeri.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/galeri.js"></script>
  </body>
  <script>
    $(document).ready(function(){
      edit_req_mus('<?php echo site_url('Cuaca/get_musim_id') ?>')
      baca_data('<?php echo site_url('Cuaca/get_musim_r') ?>')
      foto_hbl('<?php echo base_url('../File_BMKG/Iklim/Prakiraan_Musim/Prakiraan_musim/Gambar/') ?>','foto-size-musim')
      $('#spage, button[value="empty"]').click(function(){
        return false;
      })
    })
  </script>
</html>