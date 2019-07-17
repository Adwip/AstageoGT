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
        <div class="right_col" role="main" style="height: 1300px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Terbit terbenam matahari di DIY</h3>
              </div>
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
                        <div class='col-sm-4'>
                          <div class="form-group">
                        <div class='input-group date' id='myDatepicker4'>
                            <input placeholder="<?php echo $tanggal ?>"  type='text' class="form-control tgal" readonly="readonly" name="waktu" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary kirim">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                        </div>
                      </div>
                      </form>
                      <br>
                      <form method="POST" action="<?php echo site_url('Aktlam/del_ttm'); ?>">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Wilayah </th>
                            <th class="column-title pos-teks">Waktu Fajar </th>
                            <th class="column-title pos-teks">Waktu Terbit</th>
                            <th class="column-title pos-teks">Azimuth Terbit (°)</th>
                            <th class="column-title pos-teks">Waktu Transit
                            </th>
                            <th class="column-title pos-teks">Tinggi Transit (°)
                            </th>
                            <th class="column-title pos-teks">Waktu Terbenam
                            </th>
                            <th class="column-title pos-teks">Azimuth Terbenam (°)
                            </th>
                            <th class="column-title pos-teks">Waktu Senja
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
                <br>
                <br>
                <br>
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Tambah data terbit terbenam matahari </h5>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                  </div>

                  <div class="x_content form-baru" style="display: none;">
                      <form method="POST" class="form-horizontal form-label-left input_mask" action="<?php echo site_url('Aktlam/set_ttm') ?>">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Wilayah</label>
                        <input type="text" class="form-control has-feedback-left" readonly name="wilayah" id="form-wilayah">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Tanggal</label>
                        <input type="text" class="form-control has-feedback-left" readonly name="tanggal" required id="form-tanggal">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                        <label>Waktu fajar</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' class="form-control clock" readonly="readonly" name="waktu_fajar" placeholder="Waktu fajar" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                        <label>Waktu terbit</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' class="form-control clock" readonly="readonly" name="waktu_terbit" placeholder="Waktu terbit" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Waktu terbenam</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' class="form-control clock" readonly="readonly" name="waktu_terbenam" placeholder="Waktu terbenam" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Waktu senja</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' class="form-control clock" readonly="readonly" name="waktu_senja" placeholder="Waktu senja" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Waktu transit</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' class="form-control clock" readonly="readonly" name="waktu_transit" placeholder="Waktu transit" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Azimuth terbit</label>
                        <input type="text" autocomplete="off" class="form-control has-feedback-left" name="azimuth_terbit" placeholder="Azimuth terbit" required>
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Tinggi transit</label>
                        <input type="text" autocomplete="off" class="form-control has-feedback-left" name="tinggi_transit" required placeholder="Tinggi transit">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Azimuth terbenam</label>
                        <input type="text" autocomplete="off" class="form-control has-feedback-left" name="azimuth_terbenam" required placeholder="Azimuth terbenam">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      

                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                          <br>
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                      </div>

                    </form>

                  </div>
                </div>
                <br>
                <br>
                
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
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>asset/vendors/skycons/skycons.js"></script>
    <script src="<?php echo base_url() ?>asset/event/aktlam.js"></script>
    <!--clockpiecker seconds-->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/src/clockpicker.js"></script>

  </body>
</html>