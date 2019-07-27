<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Terbit Terb Matahari </title>

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
    <!--Clockpicker seconds-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/dist/bootstrap-clockpicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/src/standalone.css">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main" style="height: 1300px;" id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Terbit terbenam matahari di DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar terbit terbenam matahari</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>

                  <div class="x_content" >
                    
                      <form method="GET" action="<?php echo site_url('Aktlam/terbit_terbenam_matahari') ?>">
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="bulan">
                            <?php echo $bulan ?>
                          </select>
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                        <button type="submit" class="btn btn-primary kirim">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                        </div>
                      </div>
                      </form>
                      <br>
                      <form method="POST" action="<?php echo site_url('Aktlam/del_ttm'); ?>" id="del">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title pos-teks">Wilayah </th>
                            <th class="column-title pos-teks">Dokumen</th>
                            <th class="column-title pos-teks">Petugas
                            </th>
                            <th class="column-title pos-teks">Tanggal input
                            </th>
                            <th class="column-title pos-teks">Aksi
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $ttm ?>
                        </tbody>
                      </table>
                      <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                      </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" id="form-input">
                  <div class="x_title">
                    <h5>Input data Terbit terbenam baru</h5>
                  </div>
                  <div class="x_content form-input" style="display: none;">
                    <form method="POST" class="form-horizontal form-label-left input_mask" action="<?php echo site_url('Aktlam/set_ttm') ?>" id="kirim-data">
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label>Wilayah</label>
                          <input type="text" class="form-control has-feedback-left" readonly name="wilayah" id="form-wilayah">
                          <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label>Bulan</label>
                          <input type="text" class="form-control has-feedback-left" readonly name="bulan" id="form-bulan">
                          <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label>Tahun</label>
                          <input type="text" class="form-control has-feedback-left" readonly name="tahun" id="form-tahun">
                          <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label>Dokumen PDF</label>
                          <input type="file" required class="form-control"  name="pdf">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                          <button type="submit" class="btn btn-md btn-success">Simpan</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                          <button type="button" class="btn btn-md btn-danger tutup">Batal</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel"  id="baca-data">
                  <div class="x_title">
                    <h5>Baca data terbit terbenam matahari</h5>
                  </div>
                  <div class="x_content cek-data" style="display:none;">
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
          </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>



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
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>asset/vendors/skycons/skycons.js"></script>
    <script src="<?php echo base_url() ?>asset/event/aktlam.js"></script>
    <!--clockpiecker seconds-->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/src/clockpicker.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
  </body>
</html>