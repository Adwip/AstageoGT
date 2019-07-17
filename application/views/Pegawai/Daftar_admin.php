<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Admin sistem</title>

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
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Bootstrap Colorpicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
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
                <h3>Daftar admin aktif</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h5>Admin aktif</h5>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                
                      </ul>
                    </div>
                    <div class="x_content" >
                      <form method="POST" action="<?php echo site_url('Pegawai/del_admin') ?>"  id="del">
                      <div class="table-responsive opt" >
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title pos-teks">No</th>
                            <th class="column-title pos-teks">Nama</th>
                            <th class="column-title pos-teks">Foto</th>
                            <th class="column-title pos-teks">Tanggal dimasukkan</th>
                            <th class="column-title pos-teks">Petugas</th>
                            <th class="column-title pos-teks">Aksi</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $admin['admin'] ?>
                        </tbody>
                      </table>
                    </div>
                    <div align="right">
                      <button class=" btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                    </div>
                    </form>
                    <div>
                    <form action="<?php echo site_url('Pegawai/admin') ?>">
                      <ul class="navigasi">
                        <?php echo $admin['page'] ?>
                      </ul>
                    </form>
                  </div>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h5>Tambah admin baru </h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>
                  <div class="x_content form-kirim" style="display: none;">
                      <form method="POST" action="<?php echo site_url('Pegawai/set_admin') ?>" id="kirim-data" >
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <h2 style="text-decoration-color: red;">Username dan password akan diambil dari nomor nip</h2>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label>Nama</label>
                          <input type="text" autocomplete="off" class="form-control has-feedback-left "  name="nama">
                          
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label>NIP</label>
                          <input type="text" autocomplete="off" class="form-control has-feedback-left "  name="username">
                      </div>
                      
                      <div  class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback  ">
                          <h5><label>Akses penuh</label></h5>
                          <input value="Ya"  type="checkbox" class="full-aks" name="berita">
                          
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback garis">
                          <h5><label>Berita</label></h5>
                          <input value="Ya" type="checkbox" class="super-admin" name="berita">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Artikel</label></h5>
                          <input value="Ya" type="checkbox" class="super-admin" name="artikel">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Kepegawaian</label></h5>
                          <input value="Ya" type="checkbox" class="super-admin" name="kepegawaian">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Cuaca</label></h5>
                          <input value="Ya" type="checkbox" class="super-admin" name="cuaca">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Prakiraan musim</label></h5>
                          <input value="Ya" type="checkbox"class="super-admin"  name="prak_musim">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Analisis iklim</label></h5>
                          <input value="Ya" type="checkbox"class="super-admin"  name="analis_iklim">
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Informasi iklim</label></h5>
                          <input value="Ya" type="checkbox"class="super-admin"  name="inf_iklim">
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Perubahan iklim</label></h5>
                          <input value="Ya" type="checkbox"class="super-admin"  name="per_iklim">
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Kualitas udara</label></h5>
                          <input value="Ya" type="checkbox"class="super-admin"  name="kual_udara">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Gempa</label></h5>
                          <input value="Ya" type="checkbox" class="super-admin" name="gempa">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>TTM & Petir</label></h5>
                          <input value="Ya" type="checkbox"class="super-admin"  name="ttm_petir">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Umum</label></h5>
                          <input value="Ya" type="checkbox" class="super-admin" name="umum">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Administrator</label></h5>
                          <input value="Ya" type="checkbox" class="super-admin" name="administrator">
                          
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <h5><label>Foto</label></h5>
                          <input  type="file" class="form-control has-feedback-left " name="foto">
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <button type="submit" class="btn btn-primary kirim">Kirim</button>
                      </div>
                      </form>

                  </div>
                </div>
              </div>
              <br>
              <br>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h5>Info admin </h5>
                  </div>
                  <div class="x_content cek" style="display: none;"  >
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <span id="gambar"></span>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <button type="button" class="btn btn-danger selesai">Selesai</button>
                      </div>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h5>Edit admin</h5>
                  </div>
                  <div class="x_content form-edit" style="display:none;">
                      <form method="POST" action="<?php echo site_url('Pegawai/edit_akses') ?>" id="kirim-data">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <label>ID</label>
                          <input type="text" class="form-control has-feedback-left "  id="id_edit" name="id" readonly>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label>Nama</label>
                          <input readonly type="text" class="form-control has-feedback-left" id="nama_edit" name="nama">
                      </div>
                      
                      <div  class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback  ">
                          <h5><label>Akses penuh</label></h5>
                          <input value="Ya"  type="checkbox" class="full-aks-edit" name="berita">
                          <div  class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback  ">
                          
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback garis">
                          <h5><label>Berita</label></h5>
                          <input value="Ya" type="checkbox"  id="berita_edit"  class="super-edit" name="berita">
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Artikel</label></h5>
                          <input value="Ya" type="checkbox" class="super-edit" name="artikel"   id="artikel_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Kepegawaian</label></h5>
                          <input value="Ya" type="checkbox" class="super-edit" name="kepegawaian"   id="pegawai_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Cuaca</label></h5>
                          <input value="Ya" type="checkbox" class="super-edit" name="cuaca"   id="cuaca_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Prakiraan musim</label></h5>
                          <input value="Ya" type="checkbox"class="super-edit"  name="prak_musim"  id="musim_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Analisis iklim</label></h5>
                          <input value="Ya" type="checkbox"class="super-edit"  name="analis_iklim"  id="iklim_edit" >
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Informasi iklim</label></h5>
                          <input value="Ya" type="checkbox"class="super-edit"  name="inf_iklim"   id="inf_iklim_edit" >
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Perubahan iklim</label></h5>
                          <input value="Ya" type="checkbox"class="super-edit"  name="per_iklim" id="per_iklim_edit" >
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Kualitas udara</label></h5>
                          <input value="Ya" type="checkbox"class="super-edit"  name="kual_udara" id="kulud_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Gempa</label></h5>
                          <input value="Ya" type="checkbox" class="super-edit" name="gempa" id="gempa_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>TTM & Petir</label></h5>
                          <input value="Ya" type="checkbox"class="super-edit"  name="ttm_petir" id="ttm_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Umum</label></h5>
                          <input value="Ya" type="checkbox" class="super-edit" name="umum" id="umum_edit" >
                          
                      </div>
                      <div  class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback  garis">
                          <h5><label>Administrator</label></h5>
                          <input value="Ya" type="checkbox" class="super-edit" name="administrator" id="admin_edit" >
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                          <button type="button" class="btn btn-danger tutup">Batal</button>
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

    <style>
      .pos-teks{
        text-align: center;
      }
      .garis{
        border: 1px solid black;
        
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
    <script src="<?php echo base_url(); ?>asset/build/js/custom.js"></script>

        <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Colorpicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url() ?>asset/event/admin.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
      $(document).ready(function(){
        edit('<?php echo site_url('Pegawai/get_akses_id') ?>')
        $('#spage, button[value="empty"]').click(function(){
            return false;
        })
      })
        
    </script>

  </body>
</html>