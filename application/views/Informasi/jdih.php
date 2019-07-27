<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | JDIH </title>

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
    <link rel="stylesheet" href="<?php echo base_url('asset/event/paginasi.css') ?>">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main" id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>JDIH <small>(Jaringan Data dan Informasi hukum)</small> BMKG DIY</h3>
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
                    <form method="GET" action="<?php site_url('Informasi/jdih') ?>">
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
                      <form class="form-horizontal form-label-left input_mask" method="POST" action="<?php echo site_url('Informasi/del_jdih') ?>" id="del" >

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Jenis aturan</th>
                            <th class="column-title">Nomor</th>
                            <th class="column-title">Petugas</th>
                            <th class="column-title">Tanggal input </th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>                         
                          <?php echo $jdih['jdih'] ?>
                        </tbody>
                      </table>
                    </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div align="right">
                        <button type="submit" class="btn btn-round btn-danger btn-xs hapus">Hapus</button>
                      </div>
                    </form>
                    <div>
                    <form action="<?php echo site_url('Informasi/jdih') ?>">
                      <ul class="navigasi">
                        <input type="hidden" name="tahun" value="<?php echo $year ?>">
                        <input type="hidden" name="bulan" value="<?php echo $month ?>">
                        <?php echo $jdih['page'] ?>
                      </ul>
                    </form>
                  </div>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Tambah data jdih baru</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                  </div>
                  <div class="x_content input-data" style="display: none;" >
                    <br />
                      <form method="POST" action="<?php echo site_url('Informasi/set_jdih') ?>"  id="kirim-data">
                      <div class="form-group">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                      <label>Kategori</label>
                          <select class="form-control has-feedback-left" name="kategori">
                            <option value="INTRUKSI">INTRUKSI</option>
                            <option value="KEPMEN">KEPMEN</option>
                            <option value="KEPPRES">KEPPRES</option>
                            <option value="MOU">MOU</option>
                            <option value="PERDEP">PERDEP</option>
                            <option value="PERKA">PERKA</option>
                            <option value="PERMEN">PERMEN</option>
                            <option value="PP">PP</option>
                            <option value="PERPRES">PERPRES</option>
                            <option value="PERKIT">PERKIT</option>
                            <option value="SOP">SOP</option>
                            <option value="EDARAN">EDARAN</option>
                            <option value="UU">UU</option>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        	<label>Nomor</label>
                            <input id="nomor" required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="nomor">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        	<label>Tentang</label>
                            <textarea rows="6" class="form-control" name="keterangan"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-top: 10px;" >Masukkan PDF</label>
                          <!--<input style="margin-bottom: 10px;" type="file" name="pdf">-->
                          <input style="margin-bottom: 10px;" required type="file" name='pdf' >
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button  type="submit" class="btn btn-success">Kirim</button>
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
                    <h5>Baca jdih</h5>
                  </div>
                  <div class="x_content cek-data" style="display: none; color: black;" id="cek-data">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <label for="jenis">Jenis aturan</label>
                          <span id="jenis"></span>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <label for="nomor">Nomor</label>
                          <span id="nomor-jdih"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="tentang">Tentang</label><br>
                          <span id="tentang"></span>
                        </div>
                      </div>
                      <hr>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <span id="pdf"></span>
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Selesai</button>
                      </div>
                    
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit JDIH di sini</h5>
                    
                  </div>
                  <div class="x_content edit-form" style="display: none;" id="edit-form">
                    <br />
                    <form method="POST" action="<?php echo site_url('Informasi/edit_jdih') ?>"  id="kirim-data">
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        	<label>ID JDIH</label>
                            <input id="id_edit" readonly type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="id">
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                      <label>Kategori</label>
                          <select id="kategori_edit" class="form-control has-feedback-left" name="kategori">
                            <option value="INTRUKSI">INTRUKSI</option>
                            <option value="KEPMEN">KEPMEN</option>
                            <option value="KEPPRES">KEPPRES</option>
                            <option value="MOU">MOU</option>
                            <option value="PERDEP">PERDEP</option>
                            <option value="PERKA">PERKA</option>
                            <option value="PERMEN">PERMEN</option>
                            <option value="PP">PP</option>
                            <option value="PERPRES">PERPRES</option>
                            <option value="PERKIT">PERKIT</option>
                            <option value="SOP">SOP</option>
                            <option value="EDARAN">EDARAN</option>
                            <option value="UU">UU</option>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        	<label>Nomor</label>
                            <input id="nomor_edit" required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="nomor">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        	<label>Tentang</label>
                            <textarea rows="6" id="tentang_edit" class="form-control" name="keterangan"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-top: 10px;" >Masukkan PDF <small>jika diubah</small></label>
                          <!--<input style="margin-bottom: 10px;" type="file" name="pdf">-->
                          <input style="margin-bottom: 10px;" type="file" name='pdf' >
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button  type="submit" class="btn btn-success">Kirim</button>
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
    <script src="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>asset/build/js/custom.js"></script>
     <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/moment/min/moment.min.js"></script>
    
    <script src="<?php echo base_url(); ?>asset/event/informasi.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
      $(document).ready(function(){
        //window.location.href = "<?php echo site_url('Informasi/pengumuman'); ?>"
        edit_req_jdih('<?php echo site_url('Informasi/get_jdih_id') ?>')
        baca_jdih('<?php echo site_url('Informasi/baca_jdih') ?>')
        $('#spage, button[value="empty"]').click(function(){
            return false;
        })
      })
    </script>
  </body>
</html>