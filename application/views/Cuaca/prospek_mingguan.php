<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Cuaca Mingguan </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Bootstrap Colorpicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>asset/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Prospek Cuaca Mingguan</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <br>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar Prospek Cuaca Mingguan</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                  </div>
                  <div class="x_content" >
                    <br />

                    <form action="<?php site_url('Cuaca/cuaca_mingguan') ?>">
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
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                            
                        </div>
                      </div>
                  </form>

                    <form method="POST" action="<?php echo site_url('Cuaca/del_cuming') ?>" id="del">
                    <div class="table-responsive opt" > 
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No </th>
                            <th class="column-title">Tanggal awal</th>
                            <th class="column-title">Tanggal akhir</th>
                            <th class="column-title">Petugas</th>
                            <th class="column-title">Lihat</th>
                            <th class="column-title">Tanggal input </th>
                            <th class="column-title last">Aksi</th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $cuming; ?>

                        </tbody>
                        
                      </table>
                      
                    </div>
                    <button class=" btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                    </form>
                    <br>
                      
                  </div>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan Data Cuaca Mingguan</h5>
                  </div>
                  <div class="x_content input-data" style="display: none;" >
                    <br />
                      <form method="POST" action="<?php echo site_url('Cuaca/set_cuming') ?>" id="kirim-data">
                        <div class='col-sm-6'>
                          <div class="form-group">
                            <label>Tanggal mulai</label>
                            <div class='input-group col-md-7 col-sm-7 col-xs-12 date' id='myDatepicker4'>
                              <input id="tanggal_mulai" type='text' class="form-control tgal" readonly="readonly" name="tanggal_mulai" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class='col-sm-6'>
                          <div class="form-group">
                            <label>Tanggal akhir</label>
                            <div class='input-group col-md-7 col-sm-7 col-xs-12 date' id='myDatepicker1'>
                              <input type='text' class="form-control tgal" readonly="readonly" name="tanggal_akhir" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                          <label>Masukkan file PDF</label>
                          <input required="required" type="file" class="form-control" name="pdf">
                        </div>

                        
                        <div class=" form-group">
                          <div class="col-md-2 col-sm-2 col-xs-12 ">
                            <br>
                            <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Lihat Prospek Cuaca Mingguan</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content pdf" style="display: none;">
                    <br />
                      <span id="pdf"></span>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit Prospek Cuaca Mingguan</h5>  
                  </div>
                  <div class="x_content edit-form" style="display: none;">
                    <form method="POST" action="<?php echo site_url('Cuaca/edit_cuming') ?>" id="kirim-data">
                        <div class='col-md-12 col-xs-12 col-sm-12'>
                          <div class="form-group">
                            <label>ID Cuaca mingguan</label>
                              <input id="id_edit" type='text' class="form-control" readonly="readonly" name="id" />
                          </div>
                        </div>
                        <div class='col-md-6 col-xs-6 col-sm-12'>
                          <div class="form-group">
                            <label>Tanggal mulai</label>
                            <div class='input-group col-md-7 col-sm-7 col-xs-12 date' id='myDatepicker4'>
                              <input id="tanggal_mulai_edit" type='text' class="form-control tgal" readonly="readonly" name="tanggal_mulai" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class='col-md-6 col-xs-6 col-sm-12'>
                          <div class="form-group">
                            <label>Tanggal akhir</label>
                            <div class='input-group col-md-7 col-sm-7 col-xs-12 date' id='myDatepicker1'>
                              <input type='text' class="form-control tgal" readonly="readonly" name="tanggal_akhir" id="tanggal_akhir_edit" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                          <label>Masukkan file PDF jika diubah</label>
                          <input type="file" class="form-control" name="pdf">
                        </div>

                        
                        <div class=" form-group">
                          <div class="col-md-2 col-sm-2 col-xs-12 ">
                            <br>
                            <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                        </div>
                        <div class=" form-group">
                          <div class="col-md-2 col-sm-2 col-xs-12 ">
                            <br>
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
    <!--fungsi js-->
    <script src="<?php echo base_url() ?>asset/event/JSCuaca.js"></script>
    <script src="<?php echo base_url() ?>asset/event/Datepicker.js"></script> 
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
    $(document).ready(function(){
      edit_req_cuming('<?php echo site_url('Cuaca/get_cuming_id') ?>')
    })  
    </script>
  </body>
</html>