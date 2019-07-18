<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Cuaca Harian</title>

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
    <!--Weather icons-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/vendors/weather-icons-master/css/weather-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>asset/vendors/weather-icons-master/css/weather-icons-wind.css">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main" style="height: 1300px;" id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Cuaca Harian Daerah Istimewa Yogyakarta</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Cuaca hari ini</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>

                  <div class="x_content dis-cuaca">
                    
                      <form method="GET" action="<?php echo site_url('Cuaca/prakiraan') ?>">
                        <div class='col-md-4 col-sm-4 col-xs-12'>
                          <div class="form-group">
                        <div class='input-group date' id='myDatepicker4'>
                            <input  type='text' class="form-control tgal" readonly="readonly" value="<?php echo $tanggal ?>" name="waktu" />
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
                      <form method="POST" action="<?php echo site_url('Cuaca/del_cuaca'); ?>" id="del">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Wilayah </th>
                            <th class="column-title pos-teks">Pagi </th>
                            <th class="column-title pos-teks">Siang</th>
                            <th class="column-title pos-teks">Malam </th>
                            <th class="column-title no-link last pos-teks">Dinihari</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="">
                            <td><strong>Yogyakarta</strong></td>
                            <?php echo $cuaca ['Yogyakarta'] ['cuaca_harian_pagi'] ?>
                            <?php echo $cuaca ['Yogyakarta'] ['cuaca_harian_siang'] ?>
                            <?php echo $cuaca ['Yogyakarta'] ['cuaca_harian_malam'] ?>
                            <?php echo $cuaca ['Yogyakarta'] ['cuaca_harian_dinihari'] ?>
                          </tr>
                          <tr>
                            <td><strong>Sleman</strong></td>
                            <?php echo $cuaca ['Sleman'] ['cuaca_harian_pagi'] ?>
                            <?php echo $cuaca ['Sleman'] ['cuaca_harian_siang'] ?>
                            <?php echo $cuaca ['Sleman'] ['cuaca_harian_malam'] ?>
                            <?php echo $cuaca ['Sleman'] ['cuaca_harian_dinihari'] ?>
                          </tr>
                          <tr>
                            <td><strong>Bantul</strong></td>
                            <?php echo $cuaca ['Bantul'] ['cuaca_harian_pagi'] ?>
                            <?php echo $cuaca ['Bantul'] ['cuaca_harian_siang'] ?>
                            <?php echo $cuaca ['Bantul'] ['cuaca_harian_malam'] ?>
                            <?php echo $cuaca ['Bantul'] ['cuaca_harian_dinihari'] ?>
                          </tr>
                          <tr>
                            <td><strong>Kulonprogo</strong></td>
                            <?php echo $cuaca ['Kulonprogo'] ['cuaca_harian_pagi'] ?>
                            <?php echo $cuaca ['Kulonprogo'] ['cuaca_harian_siang'] ?>
                            <?php echo $cuaca ['Kulonprogo'] ['cuaca_harian_malam'] ?>
                            <?php echo $cuaca ['Kulonprogo'] ['cuaca_harian_dinihari'] ?>
                          </tr>
                          <tr>
                            <td><strong>Gunungkidul</strong></td>
                            <?php echo $cuaca ['Gunungkidul'] ['cuaca_harian_pagi'] ?>
                            <?php echo $cuaca ['Gunungkidul'] ['cuaca_harian_siang'] ?>
                            <?php echo $cuaca ['Gunungkidul'] ['cuaca_harian_malam'] ?>
                            <?php echo $cuaca ['Gunungkidul'] ['cuaca_harian_dinihari'] ?>
                          </tr>
                        </tbody>
                      </table>
                      <button class="btn btn-round btn-danger btn-xs " >Hapus</button>
                      </form>
                  </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Data Cuaca </h5>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                  </div>

                  <div class="x_content set_cuaca" style="display: none;">
                      <form method="POST" id="kirim-data" class="form-horizontal form-label-left input_mask" action="<?php echo site_url('Cuaca/set_cuaca') ?>">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left wilayah" readonly="readonly" name="wilayah">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left tanggal" readonly="readonly" name="tanggal">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left waktu" readonly="readonly" name="waktu">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="cuaca">
                            <option>Cerah</option>
                            <option>Berawan</option>
                            <option>Udara kabur</option>
                            <option>Kabut</option>
                            <option>Cerah berawan</option>
                            <option>Hujan ringan</option>
                            <option>Hujan lebat</option>
                            <option>Hujan petir</option>
                            <option>Hujan lokal</option>
                            <option>Hujan sedang</option>
                            <option>Panas</option>
                          </select>
                          <span class="fa fa-cloud form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="mata-angin">
                          <option value="North (Utara)">North (Utara)</option>
                            <option value="NNE">NNE</option>
                            <option value="NE (Timur Laut)">NE (Timur Laut)</option>
                            <option value="ENE">ENE</option>
                            <option value="East (Timur)">East (Timur)</option>
                            <option value="ESE">ESE</option>
                            <option value="SE (Tenggara)">SE (Tenggara)</option>
                            <option value="SSE">SSE</option>
                            <option value="South (Selatan)">South (Selatan)</option>
                            <option value="SSW">SSW</option>
                            <option value="SW (Baratdaya)">SW (Baratdaya)</option>
                            <option value="WSW">WSW</option>
                            <option value="West (Barat)">West (Barat)</option>
                            <option value="WNW">WNW</option>
                            <option value="NW (Baratlaut)">NW (Baratlaut)</option>
                            <option value="NNW">NNW</option>
                          </select>
                          <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left" placeholder="Suhu minimal" name="suhu_minimal" required="required">
                        <span class="fa fa-umbrella form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left" placeholder="Suhu maksimal" name="suhu_maksimal" required="required">
                        <span class="fa fa-umbrella form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left" placeholder="Kelembapan minimal" name="lembap_min" required="required">
                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left" placeholder="Kelembapan maksimal" name="lembap_maks" required="required">
                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <button type="button" class="btn btn-danger tutup1">Batal</button>
                        </div>

                    </form>

                  </div>
              </div> 
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit Data Cuaca </h5>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                  </div>

                  <div class="x_content edit_cuaca" style="display: none;">
                      <form method="POST" id="kirim-data" class="form-horizontal form-label-left input_mask" action="<?php echo site_url('Cuaca/edit_cuaca') ?>">
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left id_edit" readonly="readonly" name="id">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left wilayah_edit" readonly="readonly" name="wilayah">
                        <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left tanggal_edit" readonly="readonly" name="tanggal">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left waktu_edit" readonly="readonly" name="waktu">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left cuaca_edit" name="cuaca">
                            <option value="Cerah">Cerah</option>
                            <option value="Berawan">Berawan</option>
                            <option value="Udara kabur">Udara kabur</option>
                            <option value="Kabut">Kabut</option>
                            <option value="Cerah berawan">Cerah berawan</option>
                            <option value="Hujan ringan">Hujan ringan</option>
                            <option value="Hujan lebat">Hujan lebat</option>
                            <option value="Hujan petir">Hujan petir</option>
                            <option value="Hujan lokal">Hujan lokal</option>
                            <option value="Hujan sedang">Hujan sedang</option>
                            <option value="Panas">Panas</option>
                          </select>
                          <span class="fa fa-cloud form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left mata-angin_edit" name="mata-angin">
                          <option value="North (Utara)">North (Utara)</option>
                            <option value="NNE">NNE</option>
                            <option value="NE (Timur Laut)">NE (Timur Laut)</option>
                            <option value="ENE">ENE</option>
                            <option value="East (Timur)">East (Timur)</option>
                            <option value="ESE">ESE</option>
                            <option value="SE (Tenggara)">SE (Tenggara)</option>
                            <option value="SSE">SSE</option>
                            <option value="South (Selatan)">South (Selatan)</option>
                            <option value="SSW">SSW</option>
                            <option value="SW (Baratdaya)">SW (Baratdaya)</option>
                            <option value="WSW">WSW</option>
                            <option value="West (Barat)">West (Barat)</option>
                            <option value="WNW">WNW</option>
                            <option value="NW (Baratlaut)">NW (Baratlaut)</option>
                            <option value="NNW">NNW</option>
                          </select>
                          <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left suhu_min_edit" placeholder="Suhu minimal" name="suhu_minimal" required="required">
                        <span class="fa fa-umbrella form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left suhu_maks_edit" placeholder="Suhu maksimal" name="suhu_maksimal" required="required">
                        <span class="fa fa-umbrella form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left lembap_min_edit" placeholder="Kelembapan minimal" name="lembap_min" required="required">
                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input autocomplete="off" type="number" class="form-control has-feedback-left lembap_maks_edit" placeholder="Kelembapan maksimal" name="lembap_maks" required="required">
                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                      </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <button type="button" class="btn btn-danger tutup1">Batal</button>
                        </div>
                    </form>
                  </div>
              </div> 
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Periksa Data Cuaca </h5>
                    <ul class="nav navbar-right panel_toolbox">
                      
                    </ul>
                  </div>

                  <div class="x_content cek_cuaca" style="display: none;">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="weather-icon " style="text-align: center;" id="baca-cuaca">
                            <span id="cek-cuaca"></span>
                        </div><br>
                        <!--Tempat simbol cuaca-->
                        <div class="row tile_count">
                            <div class="col-md-5 col-sm-5 col-xs-6 tile_stats_count">
                              
                              <span id="suhu"></span>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 tile_stats_count">

                              <span id="lembap"></span>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <span id="wilayah"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 ">
                        <span id="tanggal_cuaca"></span>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12 "><br>
                        <label>Waktu</label><br>
                        <h1 id="waktu"></h1>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12 "><br>
                          <span id="angin"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 "><br>
                          <span id="petugas"></span>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-12"><br>
                          <span id="tanggal_input"></span>
                      </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                          <button type="button" class="btn btn-danger tutup1">Selesai</button>
                        </div>
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
      input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
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
    <!--fungsi js-->
    <script src="<?php echo base_url(); ?>asset/event/JSCuaca.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/Datepicker.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
      $(document).ready(function(){
        //hapus2()
        kirim2()
      })
    </script>
  </body>

</html>