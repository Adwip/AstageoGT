<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Tsunami </title>

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
    <!--Clockpicker seconds-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/dist/bootstrap-clockpicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/src/standalone.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" style="height: 1600px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Informasi Tsunami</h3>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Data Tsunami</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <form method="GET" action="<?php echo site_url('Aktlam/tsunami') ?>">
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <option value="*">Semua tahun</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                        <button type="submit" class="btn btn-primary kirim">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                            
                        </div>
                      </div>
                      </form>
                    <br />
                    <form method="POST" action="<?php echo site_url('Aktlam/del_tsunami') ?>">
                      <div class="table-responsive">
                        <h2>Tsunami</h2>
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No </th>
                            <th class="column-title">Tanggal Terjadi</th>
                            <th class="column-title">Magnitudo </th>
                            <th class="column-title">Kedalaman </th>
                            <th class="column-title">Wilayah </th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $tsunami ?>
                          
                        </tbody>
                      </table>
                    </div>
                    <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                  </form>
                  </div>
                </div>
                <br>
                <br>
                <br>
            </div>
<!--Golongan Kepangkatan PNS-->
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Input Data Gempa</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content" style="display: none;">
                    <br/>
                      <form action="<?php echo site_url('Aktlam/set_tsunami') ?>" class="form-horizontal form-label-left input_mask" method="POST" enctype="multipart/form-data">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Wilayah</label>
                        <input type="text" name="wilayah" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Wilayah tsunami" required="required">
                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Tanggal tsunami</label>
                        <div class='input-group date' id='myDatepicker4'>
                            <input  type='text' class="form-control tgal" readonly="readonly" name="tanggal" placeholder="Tanggal tsunami" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Waktu tsunami</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' class="form-control clock" readonly="readonly" name="waktu" placeholder="Waktu tsunami" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Jarak</label>
                        <input type="text" name="jarak" class="form-control has-feedback-left" id="inputSuccess5" placeholder="Jarak gempa" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Arah</label>
                        <select class="form-control has-feedback-left" name="mata-angin">
                            <option>North (Utara)</option>
                            <option>NNE</option>
                            <option>NE (Timur Laut)</option>
                            <option>ENE</option>
                            <option>East (Timur)</option>
                            <option>ESE</option>
                            <option>SE (Tenggara)</option>
                            <option>SSE</option>
                            <option>South (Selatan)</option>
                            <option>SSW</option>
                            <option>SW (Baratdaya)</option>
                            <option>NNW</option>
                          </select>
                        <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Magnitudo</label>
                        <input type="text" name="magnitudo" class="form-control has-feedback-left" placeholder="Magnitudo" required="required">
                        <span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Kedalaman</label>
                        <input type="text" name="kedalaman" class="form-control has-feedback-left" placeholder="Kedalaman" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Lintang</label>
                        <input type="text" name="lintang" class="form-control has-feedback-left" placeholder="Lintang" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Arah lintang</label><br>
                        <input type="radio" name="arah_lintang" value="LU" checked><label>LU </label> 
                        <input style="margin-left: 50px;" type="radio" name="arah_lintang" value="LS"><label>LS</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Bujur</label>
                        <input type="text" name="bujur" class="form-control has-feedback-left" placeholder="Arah bujur" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Arah bujur</label><br>
                        <input type="radio" name="arah_bujur" value="BB" checked><label>BB </label> 
                        <input style="margin-left: 50px;" type="radio" name="arah_bujur" value="BT"><label>BT</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group ">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control has-feedback-left">
                      </div>

                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                          <br>
                          <button type="submit" class="kirim btn btn-success">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <br>
<!--Batas golongan kepangkatan pns-->
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
    <!--<script src="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.js"></script>-->
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>asset/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- FastClick -->
    <!--<script src="<?php echo base_url(); ?>asset/vendors/fastclick/lib/fastclick.js"></script>-->
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.js"></script>
    <script src="<?php echo base_url() ?>asset/Informasi.js"></script>
        <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!--Highchart-->
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>asset/Highchart.js"></script>
    <!--clockpiecker seconds-->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/src/clockpicker.js"></script>
    <script src="<?php echo base_url() ?>asset/event/aktlam.js"></script>


  </body>
</html>