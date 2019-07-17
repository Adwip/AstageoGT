<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Artikel </title>

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
    <link href="<?php echo base_url(); ?>asset/style_tabel/style.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Artikel BMKG DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar artikel</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="GET" action="<?php echo site_url('Informasi/artikel') ?>">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="bulan">
                            <?php echo $bulan ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
                          </select>
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <button type="submit" class="btn btn-primary">Tampilkan</button>
                      </form>
                      <form class="form-horizontal form-label-left input_mask" method="POST" id="del" action="<?php echo site_url('Informasi/del_artikel') ?>" >
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Judul</th>
                            <th class="column-title">PDF </th>
                            <th class="column-title">Petugas</th>
                            <th class="column-title">Tanggal input</th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>                         
                          <?php echo $artikel ?>
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
                <br>
            </div>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan artikel baru</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                  </div>
                  <div class="x_content form-tambah"  style="display: none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('Informasi/set_artikel') ?>" id="kirim-data">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Judul</label>
                          <input required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Keterangan artikel</label>
                          <textarea class="form-control" name="berita" rows="4" style="width: 700px;"> 
                          </textarea>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-top: 10px;">Masukkan File PDF</label>
                          <input id="dokumen" required type="file" name="pdf"  style="margin-bottom: 10px;">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success">Kirim</button>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Batal</button>
                      </div>
                      </div>
                  </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" id="baca-artikel">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Baca artikel</h5>
                    
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
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit artikel</h5>
                  </div>
                  <div class="x_content edit-form"  style="display: none;">
                    <br />
                      <form method="POST" action="<?php echo site_url('Informasi/edit_artikel') ?>" id="kirim-data">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>ID Artikel</label>
                          <input required type="text" readonly class="form-control col-md-5 col-xs-12" id="id_edit" autocomplete="off" name="id">
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>Judul</label>
                          <input required type="text"  class="form-control col-md-5 col-xs-12" id="edit_judul" autocomplete="off" name="judul">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label>Keterangan artikel</label>
                          <textarea class="form-control" id="edit_ket" name="berita" rows="4" style="width: 700px;"> 
                          </textarea>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label style="margin-top: 10px;">Masukkan File PDF jika akan mengubah</label>
                          <input type="file" name="pdf"  style="margin-bottom: 10px;">
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success">Kirim</button>
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
    <script src="<?php echo base_url(); ?>asset/event/informasi.js"></script>
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
  </body>
  <script>
    $(document).ready(function(){
      get_art('<?php echo site_url('Informasi/get_art') ?>')
      baca_artikel('<?php echo site_url('Informasi/baca_artikel') ?>')
    })
  </script>
</html>
