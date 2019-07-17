<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Gempa Bumi </title>

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
    <!-- weather icons -->
    <link href="<?php echo base_url(); ?>asset/vendors/weather-icons-master/css/weather-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/vendors/weather-icons-master/css/weather-icons-wind.css" rel="stylesheet">
  </head>
  <!-- Bootstrap Colorpicker -->
    <link href="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <!--Clockpicker seconds-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/dist/bootstrap-clockpicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/src/standalone.css">
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('asset/event/paginasi.css') ?>">
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" style="height: 1600px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Informasi Gempa Bumi</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Data Gempa Bumi</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>
                  <div class="x_content" >
                    <form method="GET" action="<?php echo site_url('Aktlam/gempa') ?>">
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="status">
                            <option value="*">Semua</option>
                            <option value="Dirasakan">Dirasakan</option>
                            <option value="Terkini">Terkini</option>
                          </select>
                          <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      
                        <button type="submit" class="btn btn-primary kirim">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                            
                        </div>
                      </div>
                      </form>
                    <br />
                    <form method="POST" action="<?php echo site_url('Aktlam/del_gempa') ?>" id="del">
                      <div class="table-responsive">
                        <h2>Gempa Bumi Terkini & Tsunami</h2>
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No </th>
                            <th class="column-title">Waktu Gempa </th>
                            <th class="column-title">Lintang </th>
                            <th class="column-title">Bujur </th>
                            <th class="column-title">Magnitudo </th>
                            <th class="column-title">Kedalaman </th>
                            <th class="column-title">Wilayah </th>
                            <th class="column-title">Dirasakan </th>
                            <th class="column-title">Potensi Tsunami</th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $gempa['get_gempa'] ?>
                          
                        </tbody>
                      </table>
                    </div>
                    <div align="right">
                      <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                    </div>
                  </form>
                  <div>
                    <form action="<?php echo site_url('Aktlam/gempa') ?>">
                      <ul class="navigasi">
                        <?php echo $gempa['page'] ?>
                      </ul>
                    </form>
                  </div>
                  </div>
                </div>
              </div>

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
                      <form action="<?php echo site_url('Aktlam/set_gempa') ?>" class="form-horizontal form-label-left input_mask" method="POST" id="kirim-data">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Wilayah</label>
                        <input type="text" name="wilayah" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Wilayah gempa" required="required">
                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Tanggal gempa</label>
                        <div class='input-group date  tanggal_form' >
                            <input  type='text' class="form-control tgal" readonly="readonly" name="tanggal" placeholder="Tanggal gempa" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Waktu gempa</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' class="form-control clock" readonly="readonly" name="waktu" placeholder="Waktu gempa" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Status dirasakan</label><br>
                        <input type="radio" name="status" value="Ya" ><label>Dirasakan </label> 
                        <input style="margin-left: 8px;" type="radio" name="status" value="Tidak" checked><label>Tidak dirasakan</label>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Lokasi</label><br>
                        <input type="radio" name="lokasi" value="Darat" checked><label>Darat </label> 
                        <input style="margin-left: 8px;" type="radio" name="lokasi" value="Laut" ><label>Laut</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Jarak</label>
                        <input type="text" name="jarak" class="form-control has-feedback-left" id="inputSuccess5" placeholder="Jarak gempa" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Arah</label>
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
                        <label>Bujur</label>
                        <input type="text" name="bujur" class="form-control has-feedback-left" placeholder="Bujur" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Arah lintang</label><br>
                        <input type="radio" name="arah_lintang" value="LU" checked><label>LU </label> 
                        <input style="margin-left: 50px;" type="radio" name="arah_lintang" value="LS"><label>LS</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Arah bujur</label><br>
                        <input type="radio" name="arah_bujur" value="BB" checked><label>BB </label> 
                        <input style="margin-left: 50px;" type="radio" name="arah_bujur" value="BT"><label>BT</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Potensi tsunami</label><br>
                        <input type="radio" name="potensi" value="Ya"><label>Ya</label> 
                        <input style="margin-left: 40px;" type="radio" name="potensi" value="Tidak" checked><label>Tidak</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control has-feedback-left">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <label>Keterangan</label>
                        <textarea rows="6" class="form-control" name="keterangan"></textarea>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Skala MMI</label>
                        <textarea class="form-control" name="mmi" cols="5" rows="6"></textarea>
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit data Gempa</h5>
                  </div>
                  <div class="x_content edit_form" style="display: none;">
                    <br/>
                      <form action="<?php echo site_url('Aktlam/edit_gempa') ?>" class="form-horizontal form-label-left input_mask  edit_form" method="POST" id="kirim-data">

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <label>ID Gempa</label>
                        <input type="text" name="id" class="form-control has-feedback-left" id="id_gempa" readonly>
                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Wilayah</label>
                        <input type="text" name="wilayah" class="form-control has-feedback-left" id="edit_wilayah" placeholder="Wilayah gempa" required="required">
                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Tanggal gempa</label>
                        <div class='input-group date  tanggal_form' id='tanggal_edit'>
                            <input  type='text' class="form-control" readonly="readonly"  id="edit_tanggal" name="tanggal" placeholder="Tanggal gempa" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Waktu gempa</label>
                        <div class='input-group clockpicker' data-align="top" data-autoclose="true">
                            <input  type='text' id="edit_waktu" class="form-control clock" readonly="readonly" name="waktu"  />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Status dirasakan</label><br>
                        <input type="radio" checked id="rasakan" name="status" value="Ya" ><label for="rasakan">Dirasakan </label> 
                        <input style="margin-left: 8px;"  id="non_rasa" type="radio" name="status" value="Tidak"><label for="non_rasa">Tidak</label>
                      </div>

                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Lokasi</label><br>
                        <input type="radio" checked id="darat" name="lokasi" value="Darat" checked><label for="darat">Darat </label> 
                        <input style="margin-left: 8px;" id="laut"  type="radio" name="lokasi" value="Laut" ><label for="laut">Laut</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Jarak</label>
                        <input type="text" name="jarak" class="form-control has-feedback-left" id="edit_jarak" placeholder="Jarak gempa" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Arah</label>
                        <select id="edit_arah" class="form-control has-feedback-left" name="mata-angin">
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
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Magnitudo</label>
                        <input  id="edit_mag" type="text" name="magnitudo" class="form-control has-feedback-left" placeholder="Magnitudo" required="required">
                        <span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Kedalaman</label>
                        <input  id="edit_dalam" type="text" name="kedalaman" class="form-control has-feedback-left" placeholder="Kedalaman" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Lintang</label>
                        <input  id="edit_lintang" type="text" name="lintang" class="form-control has-feedback-left" placeholder="Lintang" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Bujur</label>
                        <input  id="edit_bujur" type="text" name="bujur" class="form-control has-feedback-left" placeholder="Arah bujur" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Arah lintang</label><br>
                        <input  id="lu" type="radio" name="arah_lintang" value="LU" checked><label  for="lu">LU </label> 
                        <input  id="ls" style="margin-left: 50px;" type="radio" name="arah_lintang" value="LS"><label for="ls">LS</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Arah bujur</label><br>
                        <input  id="bb" type="radio" name="arah_bujur" value="BB" checked><label  for="bb">BB </label> 
                        <input  id="bt" style="margin-left: 50px;" type="radio" name="arah_bujur" value="BT"><label for="bt">BT</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label style="margin-bottom: 10px;">Potensi tsunami</label><br>
                        <input  id="tsunami" type="radio" name="potensi" value="Ya"><label  for="tsunami">Ya</label> 
                        <input  id="non_tsunami" style="margin-left: 40px;" type="radio" name="potensi" value="Tidak" checked><label  for="non_tsunami">Tidak</label>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control has-feedback-left">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12 form-group has-feedback">
                        <label>Keterangan</label>
                        <textarea id="edit_keterangan" rows="6"  name="keterangan" class="form-control" cols="20" ></textarea>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                        <label>Skala MMI</label>
                        <textarea id="edit_mmi"  name="mmi" class="form-control" rows="6"></textarea>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <br>
                          <button type="submit" class="kirim btn btn-success">Simpan</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                          <br>
                          <button type="button" class="btn btn-danger tutup">Batal</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                  <div class="x_title">
                    <h5>Baca data gempa</h5>
                  </div>
                  <div class="x_content v-data" style="display:none;">
                    <h2>Data gempa bumi</h2>
                    <div class="col-md-6 col-sm-6 col-xs-12 garis" >
                      <h2>Wilayah gempa</h2>
                      <span id="v-wilayah" ><h4>16 km BaratDaya KARERA-SUMBATIMUR-NTT</h4></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 garis" >
                      <h2>Waktu gempa</h2>
                      
                      <span id="v-waktu" ><h4>17-Jun-19 12:43:31 WIB</h4></span>
                    </div>
                    
                    <div class="col-md-4 col-sm-4 col-xs-12 garis" >
                      <h2>Magnitudo</h2>
                      <span id="v-mag" ><h4>5.6 SR</h4></span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 garis" >
                      <h2>Koordinat gempa</h2>
                      <span id="v-koor" ><h4>-8.99 LU - 6.7 BT</h4></span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 garis" >
                      <h2>Status dirasakan</h2>
                      <span id="v-rasa" ><h4>Dirasakan</h4></span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 garis" >
                      <h2>Lokasi gempa</h2>
                      <span id="v-lok" ><h4>Laut</h4></span>
                    </div>
                    <div class="col-md- col-sm-4 col-xs-12 garis" >
                      <h2>Potensi tsunami</h2>
                      <span id="v-tsun" ><h4>Ya</h4></span>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 garis" >
                      <h2>Skala MMI</h2>
                      <span id="v-mmi" ><h4>MMI 1, MMI 2</h4></span>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 garis" >
                      <h2>Keterangan</h2>
                      <span id="v-ket" ></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                      <br>
                      <button type="button" class="btn btn-danger tutup">Selesai</button>
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
      textarea {
        resize: vertical;
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
    <!-- Bootstrap Colorpicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!--clockpiecker seconds-->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/vendors/clockpicker-seconds/src/clockpicker.js"></script>
    <!--parsley js-->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/vendors/parsleyjs/dist/parsley.js"></script>
    <script src="<?php echo base_url() ?>asset/event/aktlam.js"></script>
    <script src="<?php echo base_url() ?>asset/event/Datepicker.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
      $(document).ready(function(){
        $('.clockpicker').clockpicker();
        $('#myDatepicker4').datetimepicker({
                ignoreReadonly: true,
                format: 'DD-MM-YYYY'
                //allowInputToggle: true
        });
        $('#spage, button[value="empty"]').click(function(){
            return false;
          })
        view_gempa('<?php echo site_url('Aktlam/get_gempa_v') ?>')
      })
    </script>
  </body>
</html>