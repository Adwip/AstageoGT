<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Peringatan  </title>

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
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('asset/event/paginasi.css') ?>">
    <link href="<?php echo base_url() ?>asset/event/modal-style.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main" id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Peringatan di DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div style="z-index:0;" class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar berita peringatan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form method="GET" action="<?php echo site_url('Cuaca/peringatan') ?>">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="bulan">
                            <?php echo $bulan ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                            
                        </div>
                      </div>
                      </form>
                    <br />
                    <br>
                    <form method="POST" action="<?php echo site_url('Cuaca/del_peringatan') ?>" id="del" >
                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Wilayah</th>
                            <th class="column-title">Tanggal</th>
                            <th class="column-title">Baca</th>
                            <th class="column-title">Petugas</th>
                            <th class="column-title">Waktu Dibuat</th>
                            <th class="column-title">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $peringatan['peringatan'] ?>
                          <tr>
                            <td align="center" colspan="9"><button type="button" class="btn btn-xs btn-success add-form">Tambah</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div align="right">
                      <button class="btn btn-round btn-danger btn-xs hapus2" >Hapus</button>
                    </div>
                  </form>
                  <div>
                    <form action="<?php echo site_url('Cuaca/peringatan') ?>">
                      <ul class="navigasi">
                        <input type="hidden" name="tahun" value="<?php echo $year ?>">
                        <input type="hidden" name="bulan" value="<?php echo $month ?>">
                        <?php echo $peringatan['page'] ?>
                      </ul>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah berita peringatan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: none;" id="tambah-form">
                    <br />
                    <form method="POST" action="<?php echo site_url('Cuaca/set_peringatan') ?>" id="kirim-data">
                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                            <label>Wilayah</label>
                            <select id="set_wilayah" class="form-control has-feedback-left" name="wilayah">
                                <option value="Yogyakarta">Yogyakarta</option>
                                <option value="Sleman">Sleman</option>
                                <option value="Bantul">Bantul</option>
                                <option value="Kulonprogo">Kulonprogo</option>
                                <option value="Gunungkidul">Gunungkidul</option>
                            </select>
                            <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                            <label>Tanggal kejadian</label><small id="cek-tgl"></small>
                            <div class='input-group date  tanggal_form'>
                                <input value="<?php echo Date('d-m-Y') ?>" type='text' class="form-control" readonly="readonly"  id="tanggal_akhir_set" name="tanggal" placeholder="Tanggal kejadian" />
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                      </div>
                    </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea required rows="6" class="form-control" name="teks"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button style="margin-top: 10px;" type="submit" class="btn btn-success cek-tanggal">Kirim</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12"><br>
                          <button type="button" class="btn btn-danger tutup">Batal</button>
                        </div>
                      </div>
                  </form>
                  </div>
                </div>
              </div>
              <br>
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit data peringatan</h5>
                  </div>
                  <div class="x_content edit-form" style="display: none;" id="edit-form">
                      <form action="<?php echo site_url('Cuaca/edit_peringatan') ?>"  id="kirim-data" method="POST">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>ID</label>
                          <input style="margin-bottom: 20px;" type="text" readonly="readonly" name="id" class="form-control" id="id_edit">
                          </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
                            <label>Wilayah</label>
                            <select id="edit_wilayah" class="form-control has-feedback-left" name="wilayah">
                                <option value="Yogyakarta">Yogyakarta</option>
                                <option value="Sleman">Sleman</option>
                                <option value="Bantul">Bantul</option>
                                <option value="Kulonprogo">Kulonprogo</option>
                                <option value="Gunungkidul">Gunungkidul</option>
                            </select>
                            <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                            <label>Tanggal kejadian</label><small id="cek-tgl-edit"></small>
                            <div class='input-group date  tanggal_form'>
                                <input  type='text' class="form-control" readonly="readonly"  id="edit_tanggal" name="tanggal" placeholder="Tanggal kejadian" />
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                      </div>
                    </div>
                       <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea required rows="6" id="edit_per" class="form-control" name="teks"></textarea>
                        </div>
                      </div>
                        <div class="form-group">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <button type="submit" class="btn btn-success cek-tanggal-edit">Simpan</button>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <button type="button" class="btn btn-danger tutup">Batal</button>
                          </div>
                        </div>
                      </form>
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
    <div align="center" id="modal-ket" style="height: 250px;">
      <span id="head-warn"></span>
      <hr id="hr">
      <div style="text-align:justify;" id="peringatan-read">
        
      </div>
    </div>
    <style>
      .text-c{
      color:black;
    }
    hr{
      border-color: grey;
    }
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
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Bootstrap Colorpicker -->
    <script src="<?php echo base_url(); ?>asset/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/JSCuaca.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/Datepicker.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/galeri.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/galeri.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <script>
      $(document).ready(function(){
        cek_tanggal('<?php echo date('d-m-Y') ?>')
        cek_tanggal_edit('<?php echo date('d-m-Y') ?>')
          $('.body').click(function(){
              $('#modal-ket').hide()
          })
        edit_req_per('<?php echo site_url('Cuaca/get_peringatan_id') ?>')
        baca_warning('<?php echo site_url('Cuaca/get_peringatan_id') ?>')
        $('#spage, button[value="empty"]').click(function(){
          return false;
        })
      })
    </script>
  </body>
</html>
