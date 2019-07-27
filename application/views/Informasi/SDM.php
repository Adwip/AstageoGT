<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Sumber Daya Manusia </title>

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
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" style="height: 2300px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Sumber Daya Manusia BMKG DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
<!-- Distribusi Umur -->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Tabel distribusi umur di BMKG DIY</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>

                  <div class="x_content " >
                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                      <h2 style="margin-bottom: 20px;"><?php echo $sdm['bulan_umur'] ?></h2>
                    </div>  
                      <tr>
                          <div class="col-md-5">
                            <td><label>Perubahan terakhir : </label> 
                              <?php echo date('d-m-Y',strtotime($sdm['tgl_umur'])) ?>
                          </td>
                          </div>
                          <div class="col-md-6">
                            <td><label>Petugas terakhir : </label> 
                              <?php echo $sdm['petugas_umur'] ?>
                          </td>
                        </div>
                        <div class="col-md-1">
                            <td><button type="button" class="btn btn-round btn-info btn-xs edit-umur" >Edit</button>
                          </td>
                        </div>
                      </tr>
                      <br>
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title pos-teks">Gender</th>
                            <th class="column-title pos-teks"><=25</th>
                            <th class="column-title pos-teks">25 - 30</th>
                            <th class="column-title pos-teks">31 - 35</th><th class="column-title pos-teks">36 - 40</th>
                            <th class="column-title pos-teks">41 - 45</th>
                            <th class="column-title pos-teks">46 - 50</th>
                            <th class="column-title pos-teks">50 - 55</th>
                            <th class="column-title pos-teks"> >=55 </th>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $sdm['umur'] ?>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Grafik Distribusi Umur PNS BMKG DIY tahun 2019</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <br />
                       <canvas id="mybarChart1" style="width: 100%;"></canvas>
                  </div>
                </div>
            </div>

            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Input Data Ditribusi Umur</h5>
                  </div>
                  <div class="x_content form-umur" style="display: none;">
                   <table>
                    <thead>
                      <th>Kategori</th>
                      <th style="padding-left: 60px;">L</th>
                      <th style="padding-left: 60px;">P</th>
                    </thead>
                    <tbody>
                    <form  method="POST" id="kirim-data" action="<?php echo site_url('Informasi/set_SDM') ?>" class="form-horizontal form-label-left validasi" >
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" ><=25</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number" required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >25-30</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number" id="first-name2" required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number" required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >31-35</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number" required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >36-40</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number" required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >41-45</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >45-50</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="text"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >50-55</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" > >=55</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <br>
                      <tr >
                        <td></td>
                        <td><button name="button" value="umur" type="submit" class="btn btn-success batal submit" style="margin-top: 10px;">Simpan</button></td>
                        <td><button type="button" class="btn btn-danger tutupSDM" style="margin-top: 10px;">Batal</button></td>
                      </tr>
                    </form>
                    </tbody>
                    </table>
                  </div>
                </div>
            </div>
<!--Batas distribusi umur-->
<!--Golongan Kepangkatan PNS-->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Tabel golongan PNS di BMKG DIY</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>

                  <div class="x_content" >
                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                      <h2 style="margin-bottom: 20px;"><?php echo $sdm['bulan_golongan'] ?></h2>
                    </div>  
                      <tr>
                          <div class="col-md-5">
                            <td><label>Perubahan terakhir : </label> 
                              <?php echo date('d-m-Y',strtotime($sdm['tgl_golongan'])) ?>
                          </td>
                          </div>
                          <div class="col-md-6">
                            <td><label>Petugas terakhir : </label> 
                              <?php echo $sdm['petugas_golongan'] ?>
                          </td>
                        </div>
                        <div class="col-md-1">
                            <td><button type="button" class="btn btn-round btn-info btn-xs edit-golongan" >Edit</button>
                          </td>
                        </div>
                      </tr>
                      <br>
                      <form method="POST" action="<?php echo site_url('Informasi/del_sdm'); ?>">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title pos-teks">Gender</th>
                            <th class="column-title pos-teks">I</th>
                            <th class="column-title pos-teks">II</th>
                            <th class="column-title pos-teks">III</th>
                            <th class="column-title pos-teks">IV</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $sdm['golongan'] ?>
                        </tbody>
                      </table>
                      </form>
                  </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Grafik Distribusi Golongan Kepangkatan PNS BMKG DIY tahun 2019</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <br />
                       <canvas id="mybarChart2" style="width: 100%;"></canvas>
                  </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Input Data Golongan Kepangkatan</h5>
                  </div>
                  <div class="x_content form-golongan" style="display: none;">
                   <table>
                    <thead>
                      <th>Kategori</th>
                      <th style="padding-left: 60px;">L</th>
                      <th style="padding-left: 60px;">P</th>
                    </thead>
                    <tbody>
                    <form method="POST" id="kirim-data" action="<?php echo site_url('Informasi/set_SDM') ?>" class="form-horizontal form-label-left">
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >I</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >II</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >III</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >IV</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      
                      <br>
                      <tr >
                        <td></td>
                        <td><button name="button" value="grafik_golongan" type="submit" class="btn btn-success submit" style="margin-top: 10px;">Simpan</button></td>
                        <td><button type="button" class="btn btn-danger tutupSDM" style="margin-top: 10px;">Batal</button></td>
                      </tr>
                    </form>
                    </tbody>
                    </table>
                  </div>
                </div>
            </div>
<!--Batas golongan kepangkatan pns-->
<!--TIngkat Pendidikan-->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Tabel distribusi tingkat pendidikan di BMKG DIY</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>

                  <div class="x_content" >
                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                      <h2 style="margin-bottom: 20px;"><?php echo $sdm['bulan_akademik'] ?></h2>
                    </div>  
                      <tr>
                          <div class="col-md-5">
                            <td><label>Perubahan terakhir : </label> 
                              <?php echo date('d-m-Y',strtotime($sdm['tgl_akademik'])) ?>
                          </td>
                          </div>
                          <div class="col-md-6">
                            <td><label>Petugas terakhir : </label> 
                              <?php echo $sdm['petugas_akademik'] ?>
                          </td>
                        </div>
                        <div class="col-md-1">
                            <td><button type="button" class="btn btn-round btn-info btn-xs edit-akademik" >Edit</button>
                          </td>
                        </div>
                      </tr>
                      <form method="POST" action="<?php echo site_url('Informasi/del_sdm'); ?>">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title pos-teks">Gender</th>
                            <th class="column-title pos-teks">SLTA</th>
                            <th class="column-title pos-teks">D1</th>
                            <th class="column-title pos-teks">D2</th>
                            <th class="column-title pos-teks">D3</th>
                            <th class="column-title pos-teks">D4</th>
                            <th class="column-title pos-teks">Sarjana</th>
                            <th class="column-title pos-teks">Magister</th>
                            <th class="column-title pos-teks">Doktor</th>
                          </tr>
                        </thead>
                          <tbody>
                            <?php echo $sdm['akademik'] ?>
                        </tbody>
                      </table>
                      </form>
                  </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Grafik Distribusi Tingkat Pendidikan PNS BMKG DIY tahun 2019</h5>
                  </div>
                  <div class="x_content">
                    <br />
                       <canvas id="mybarChart3" style="width: 100%;"></canvas>
                  </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Input Data Tingkat Pendidikan</h5>
                  </div>
                  <div class="x_content form-akademik" style="display: none;">
                   <table>
                    <thead>
                      <th>Kategori</th>
                      <th style="padding-left: 60px;">L</th>
                      <th style="padding-left: 60px;">P</th>
                    </thead>
                    <tbody>
                    <form method="POST" id="kirim-data" action="<?php echo site_url('Informasi/set_SDM') ?>" class="form-horizontal form-label-left">
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >SLTA</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >D1</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >D2</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >D3</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >D4</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >Sarjana</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >Magister</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <tr>
                      <div class="form-group">
                        <td class="col-md-2"><label class="control-label" >Doktor</label></td>
                        <div class="col-md-3">
                          <td><input name="L_val[]" autocomplete="off" type="number"  required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                        <div class="col-md-3">
                          <td><input name="P_val[]" autocomplete="off" type="number" required="required" class="form-control col-md-7 col-xs-12"></td>
                        </div>
                      </div>
                      </tr>
                      <input name="L_val[]" type="hidden"  value="0" class="form-control col-md-7 col-xs-12">
                      <br>
                      <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-success submit" style="margin-top: 10px;">Simpan</button></td>
                        <td><button type="button" class="btn btn-danger tutupSDM" style="margin-top: 10px;">Batal</button></td>
                      </tr>
                    </form>
                    </tbody>
                    </table>
                  </div>
                </div>
            </div>
              <!--Batas Tingkat Pendidikan-->
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
    <script src="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>asset/vendors/Chart.js/dist/Chart.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.js"></script>
    <script src="<?php echo base_url() ?>asset/Informasi.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <script src="<?php echo base_url() ?>asset/event/informasi.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
    
      $(document).ready(function(){
        var M_Akademik=JSON.parse("[" +'<?php echo $sdm ['L-akademik'] ?>'+ "]");
        var F_Akademik=JSON.parse("[" +'<?php echo $sdm ['P-akademik'] ?>'+ "]");
        var M_Umur=JSON.parse("[" +'<?php echo $sdm ['L-umur'] ?>'+ "]");
        var F_Umur=JSON.parse("[" +'<?php echo $sdm ['P-umur'] ?>'+ "]");
        var M_Golongan=JSON.parse("[" +'<?php echo $sdm ['L-golongan'] ?>'+ "]");
        var F_Golongan=JSON.parse("[" +'<?php echo $sdm ['P-golongan'] ?>'+ "]");

        grafik(M_Umur, F_Umur,"mybarChart1");
        golongan(M_Golongan, F_Golongan,"mybarChart2");
        pendidikan(M_Akademik, F_Akademik,"mybarChart3");
      })
    </script>
  </body>
</html>