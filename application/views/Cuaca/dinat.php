<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Dinamika atmosfer </title>

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
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main" id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Dinamika Atmosfer Yogyakarta</h3>
              </div>
              <div id="snackbar" align="right"></div> 
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Data Dinamika Atmosfer</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content" >
                    <br />
                    <form method="GET" action="<?php site_url('Cuaca/dinamika_atmosfer') ?>">
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
                    <br>
                      <form class="form-horizontal form-label-left input_mask" method="POST" action="<?php echo site_url('Cuaca/del_dinat') ?>" id="del" >

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Judul</th>
                            <th class="column-title">Tanggal mulai</th>
                            <th class="column-title">Tanggal akhir</th>
                            <th class="column-title">Baca</th>
                            <th class="column-title">Gambar </th>
                            <th class="column-title">Petugas</th>
                            <th class="column-title">Tanggal input </th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>                         
                          <?php echo $dinat ?>
                        </tbody>
                      </table>
                    </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <br>
                          <button type="submit" class="btn btn-round btn-danger btn-xs hapus">Hapus</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel"  id="form-tambah">
                  <div class="x_title">
                    <h5>Masukkan data dinamika atmosfer di sini</h5>
                  </div>
                  <div class="x_content input-data" style="display: none;" >
                    <br />
                      <form method="POST" action="<?php echo site_url('cuaca/setDinat') ?>" id="kirim-data2">
                      <div class="form-group">
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <div class="form-group">
                            <label>Tanggal mulai</label>
                            <div class='input-group col-md-8 col-sm-8 col-xs-12 date' id='myDatepicker4'>
                              <input id="tanggal_mulai" type='text' class="form-control tgal" readonly="readonly" name="tanggal_mulai" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class=' col-sm-6 col-sm-6 col-xs-12'>
                          <div class="form-group">
                            <label>Tanggal selesai</label>
                            <div class='input-group col-md-8 col-sm-8 col-xs-12 date' id='myDatepicker1'>
                              <input type='text' class="form-control" readonly="readonly" name="tanggal_akhir" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea name="teks" class="ckeditor beritav" id="ckeditorc"></textarea>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Masukkan Gambar & PDF</label>
                          <input required type="file" name="dok[]" id="dokumen" multiple>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button  type="submit" class="btn btn-success kirim-dinat">Kirim</button>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <button type="button" class="btn btn-danger tutup">Batal</button>
                        </div>
                      </div>
                  </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Baca data dinamika atmosfer</h5>
                  </div>
                  <div class="x_content cek-data" style="display:none;">
                    <br />
                      <h2 class="text-c" id="ark-judul"></h2>
                      <h6 class="text-c" id="creator"></h6>
                      <hr>
                      <span class="text-c" id="tambahan">
                      </span>
                      <hr>
                      <br>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit data dinamika atmosfer di sini</h5>
                    
                  </div>
                  <div class="x_content edit-form" style="display: none;" >
                    <br />
                      <form method="POST" action="<?php echo site_url('cuaca/editDinat') ?>" id="kirim-data3">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input id="id_edit" readonly required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="id">
                        </div>
                      <div class="form-group">
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <div class="form-group">
                            <label>Tanggal mulai</label>
                            <div class='input-group col-md-8 col-sm-8 col-xs-12 date' id='myDatepicker5'>
                              <input id="tanggal_mulai_edit" type='text' class="form-control tgal" readonly="readonly" name="tanggal_mulai" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                        <div class=' col-sm-6 col-sm-6 col-xs-12'>
                          <div class="form-group">
                            <label>Tanggal selesai</label>
                            <div class='input-group col-md-8 col-sm-8 col-xs-12 date' id='myDatepicker2'>
                              <input id="tanggal_akhir_edit" type='text' class="form-control" readonly="readonly" name="tanggal_akhir" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Judul</label>
                          <input id="judul_edit" required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      
                      <br>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-bottom: 5px; margin-top: 20px;">Isi teks</label>
                          <textarea name="teks" class="ckeditor beritav" id="ckeditorc2"></textarea>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Masukkan Gambar & PDF</label>
                          <input type="file" name="dok[]" id="dokumen" multiple>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button  type="submit" class="btn btn-success ">Kirim</button>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
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
    <div class="galeri galeri-dinat">
      <div id="clb"><button class="btn btn-xs btn-danger clb">Tutup</button></div>
      <span id="img-loc">
      </span>
    </div>
    <style>
      .text-c{
      color:black;
      }
      hr{
      border-color: grey;
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
    <!-- CK Editor -->
    <script src="<?php echo base_url(); ?>asset/vendors/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>asset/ckedtor.js"></script>
     <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Bootstrap Colorpicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <script src="<?php echo base_url(); ?>asset/event/JSCuaca.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/Datepicker.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/galeri.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/galeri.js"></script>
    <script>
      $(document).ready(function(){
        edit_req_dinat('<?php echo site_url('Cuaca/get_dinat_id') ?>')
        baca_data('<?php echo site_url('Cuaca/get_dinat_r') ?>')
        foto_hbl('<?php echo base_url('../File_BMKG/Iklim/Analisis_iklim/Dinamika_atmosfer/Gambar/') ?>','foto-size-musim')
      })
    </script>
  </body>
</html>