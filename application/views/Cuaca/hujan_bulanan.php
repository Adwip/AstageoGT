<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Hujan  bulanan </title>

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
    <!--Style tabel-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/style_tabel/style.css">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main" id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Prakiraan hujan bulanan Daerah Istimewa Yogyakarta</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Prakiraan hujan bulanan</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>
    
                  <div class="x_content">
                    <br />
                      <form action="#">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                        <button type="submit" class="btn btn-primary ">Tampilkan</button>
                      </form>
                      <br>
                      <br>
                      
                      <form method="POST" action="<?php echo site_url('Cuaca/del_hbl')?>" id="del" >
                      <div class="table-responsive opt" style="height: 400px;">
                        
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title pos-teks">Bulan </th>
                            <th class="column-title pos-teks">Prakiraan Curah Hujan </th>
                            <th class="column-title pos-teks">Prakiraan Sifat Hujan</th>
                            </th>
                            <th class="column-title pos-teks">Petugas</th>
                            </th>
                            <th class="column-title pos-teks">Tanggal</th>
                            </th>
                            <th class="column-title pos-teks">Aksi</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $hujan ?>
                        </tbody>
                      </table>
                    </div>
                    <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                  </form> 
                  </div>
                </div>
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Tambah Data Hujan bulanan </h5>
                  </div>
                  <div class="x_content form-kirim" style="display: none;" id="form-tambah" >
                      <form method="POST" class="form-horizontal form-label-left input_mask" action="<?php echo site_url('Cuaca/set_hujan_bulanan') ?>" id="kirim-data">
                        <div class="col-md-5 col-sm-4 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left wilayah" id="bulan-form" readonly="readonly" name="bulan">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-5 col-sm-4 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left wilayah" id="tahun-form" readonly="readonly" name="tahun">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <label>Curah hujan <small>File gambar</small></label>
                          <input required="required" type="file" class="form-control has-feedback-left" name="curah_hujan">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <label>Sifat hujan <small>File gambar</small></label>
                          <input required="required" type="file" class="form-control has-feedback-left " name="sifat_hujan">
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <button type="button" class="btn btn-danger tutup">Batal</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit Data Hujan Bulanan</h5>
                  </div>
                  <div class="x_content form-edit" style="display:none;" id="form-edit">                      
                    <form method="POST" class="form-horizontal form-label-left input_mask" action="<?php echo site_url('Cuaca/edit_hbl') ?>" id="kirim-data">
                        <div class="col-md-10 col-sm-10 col-xs-10 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left wilayah" id="edit-id" readonly="readonly" name="id">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-5 col-sm-4 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left wilayah" id="edit-bulan-form" readonly="readonly" name="bulan">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-5 col-sm-4 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left wilayah" id="edit-tahun-form" readonly="readonly" name="tahun">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                          <span id="curah-img">
                            
                          </span>
                          <label>Curah hujan <small>File gambar</small></label>
                          <input type="file" class="form-control has-feedback-left cekbut2" name="curah">
                          <small> Tambahkan gambar jika akan mengganti</small>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                          <span id="sifat-img">
                            
                          </span>
                          <label>Sifat hujan <small>File gambar</small></label>
                          <input type="file" class="form-control has-feedback-left cekbut3" name="sifat">
                          <small> Tambahkan gambar jika akan mengganti</small>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <button type="submit" class="btn btn-primary edit-but" disabled>Kirim</button>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
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
    <div class="galeri galeri2">
      <div id="clb"><button class="btn btn-xs btn-danger clb">Tutup</button></div>
      <span id="img-loc">
      </span>
    </div>

    <style>

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

        <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Colorpicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url() ?>asset/event/JSCuaca.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/galeri.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/galeri.js"></script>
  </body>
  <script>
    $(document).ready(function(e){
      get_hbl_id('<?php echo site_url('Cuaca/get_hbl_id') ?>')
      foto_hbl('<?php echo base_url('../File_BMKG/Iklim/Prakiraan_Musim/Hujan_bulanan/')?>','foto-size2')
    })
  </script>
</html>