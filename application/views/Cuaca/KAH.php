<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Kimia Air Hujan </title>

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

    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" style="height: 1600px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Kimia Air Hujan di DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Data Kimia Air Hujan di DIY</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <form method="GET" action="<?php echo site_url('Cuaca/KAH') ?>">
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="bulan">
                            <?php echo $bulan ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="opsi">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                        <button type="submit" class="btn btn-primary kirim">Tampilkan</button>
                      </form>
                    <br />
                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Minggu ke-</th>
                            <th class="column-title">Nilai ph</th>
                            <th class="column-title">Petugas </th>
                            <th class="column-title">Tanggal input</th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $kah['kah'] ?>
                        </tbody>
                      </table>
                    </div>
                    <?php echo $hapus ?>

                    <div class="form-input" style="display: none;">
                      <form method="POST" id="kirim-data" action="<?php echo site_url('Cuaca/set_kah') ?>" >
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <label>Minggu ke-</label>
                          <input type="text" class="form-control has-feedback-left " id="minggu-form" readonly="readonly" name="minggu">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
                          <label>Bulan</label>
                          <input type="text" class="form-control has-feedback-left " id="bulan-form" readonly="readonly" name="bulan">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <label>Tahun</label>
                          <input type="text" class="form-control has-feedback-left " id="tahun-form" readonly="readonly" name="tahun">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Indeks Ph</label>
                          <input autocomplete="off" required="required" type="text" class="form-control  " name="indeks">
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="button" class="btn btn-danger batal">Batal</button>
                      </div>
                      </form> 
                    </div>
                    <div class="form-keterangan set_form_ket"  style="display: none;">
                      <form method="POST" id="kirim-data"  action="<?php echo site_url('Cuaca/set_ket_ph') ?>">
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <label>Bulan</label>
                          <input type="text" class="form-control has-feedback-left " id="bulan-form-ket" readonly="readonly" name="bulan">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <label>Tahun</label>
                          <input type="text" class="form-control has-feedback-left " id="tahun-form-ket" readonly="readonly" name="tahun">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <label>Keterangan</label>
                          <textarea rows="10" class="form-control" name="keterangan"></textarea>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="button" class="btn btn-danger batal">Batal</button>
                        </div>
                      </form>
                      <!------------------------------->
                      <form  method="POST" id="kirim-data" class="edit_form_ket" action="<?php echo site_url('Cuaca/edit_ket_ph') ?>" >
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <label>Bulan</label>
                          <input type="text" class="form-control has-feedback-left " id="edit_ket_bulan" readonly="readonly" name="bulan">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <label>Tahun</label>
                          <input type="text" class="form-control has-feedback-left " id="edit_ket_tahun" readonly="readonly" name="tahun">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <label>Keterangan</label>
                          <textarea rows="10" class="form-control" id="edit_ket_isi" name="keterangan"></textarea>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="button" class="btn btn-danger batal">Batal</button>
                        </div>
                      </form>
                    </div>
                    <div class="form-edit-ph" style="display: none;">
                      <form method="POST" id="kirim-data" action="<?php echo site_url('Cuaca/edit_ph_kah') ?>" >
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                      <label>Minggu ke-</label>
                          <input type="text" class="form-control has-feedback-left " id="minggu-edit" readonly="readonly" name="minggu">
                          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <label>Bulan</label>
                          <input type="text" class="form-control has-feedback-left " id="bulan-edit" readonly="readonly" name="bulan">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                              <label>Tahun</label>
                              <input type="text" class="form-control has-feedback-left " id="tahun-edit" readonly="readonly" name="tahun">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                              <label>Indek Ph Kimia Air Hujan</label>
                          <input required="required" type="text" class="form-control has-feedback-left indeks-edit" name="indeks">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <button type="button" class="btn btn-danger batal">Batal</button>
                            </div>
                      </form>  
                    </div>
                    
                  </div>
                </div>
              </div>
<!--Golongan Kepangkatan PNS-->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Grafik Partikulat DIY</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content grafis" >
                    <br />
                       <div id = "container" style = "width: 1000px; height: 400px; margin: 0 auto"></div>
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
          <div class="pull-right">Dashboard design By Gentelella & Colorlib, system by KP Teknik Informatika UII 2015
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <style>
      textarea {
        resize: vertical;
      }
    </style>
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
    <!--Highchart-->
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="<?php echo base_url(); ?>asset/Highchart.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url() ?>asset/event/JSCuaca.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
       $(document).ready(function(){
        grafikKAH ('#container', JSON.parse('<?php echo  $grafik ?>'), '<?php echo  $tahunG ?>','<?php echo date('d-m-Y') ?>')
        del_ext('<?php echo site_url('Cuaca/del_ket_ph') ?>')
        get_edit_ket('<?php echo site_url('Cuaca/get_kah_ket') ?>')
      })
 
    </script>

  </body>
</html>