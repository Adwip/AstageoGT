<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Ekstrem Perubahan Iklim </title>

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
                <h3>Ekstrem perubahan iklim di DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar berita ekstrem perubahan iklim</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <form method="GET" action="<?php echo site_url('Cuaca/del_epi') ?>">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <select class="form-control has-feedback-left" name="tahun">
                            <?php echo $tahun ?>
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
                    <br>
                    <form method="POST" action="<?php echo site_url('Cuaca/del_EPI') ?>" id="del">
                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Waktu Dibuat </th>
                            <th class="column-title">Periksa </th>
                            <th class="column-title">Gambar</th>
                            <th class="column-title">Penyusun </th>
                            <th class="column-title">Pilih</th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $epi['get_epi'] ?>
                          <tr>
                            <td align="center" colspan="9"><button type="button" class="btn btn-xs btn-success add-form">Tambah</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div align="right">
                      <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                    </div>
                  </form>
                  <div>
                    <form action="<?php echo site_url('Cuaca/EPI') ?>">
                      <ul class="navigasi">
                        <input type="hidden" name="tahun" value="<?php echo $year ?>">
                        <?php echo $epi['page'] ?>
                      </ul>
                    </form>
                  </div>
                  </div>
                </div>
              </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tambah berita ekstrem perubahan iklim</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: none;" id="tambah-form">
                    <br />
                    <form method="POST" action="<?php echo site_url('Cuaca/set_epi') ?>" id="kirim-data2">
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea name="berita" class="ckeditor beritav" id="ckeditorc"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <br>
                          <label>Masukkan file gambar</label><br>
                          <small>JPG, JPEG, GIF, PNG</small>
                          <input style="margin-top: 10px;" type="file" name="foto[]" multiple>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button style="margin-top: 10px;" type="submit" class="btn btn-success kirim">Kirim</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12"><br>
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
                    <h5>Edit ekstrem perubahan iklim</h5>
                  </div>

                  <div class="x_content edit-form" style="display: none;" id="edit-form">
                      <form action="<?php echo site_url('Cuaca/edit_epi') ?>"  id="kirim-data3" method="POST">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>ID</label>
                          <input style="margin-bottom: 20px;" type="text" readonly="readonly" name="id" class="form-control" id="id_edit">
                          </div>
                        </div>
                       <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea name="berita" class="ckeditor beritav" id="ckeditorc2"></textarea>
                        </div>
                      </div>
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="row edit-foto" style="margin-top: 10px; ">
                          </div>
                          <span>
                            <label>Masukkan file gambar untuk ganti gambar</label><br>
                            <small>JPG, JPEG, GIF, PNG</small>
                            <input style="margin-top: 10px; margin-bottom: 10px;" type="file" name="epi[]" multiple />
                          </span>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
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
                    <h5>Baca data perubahan normal hujan</h5>    
                  </div>
                  <div class="x_content cek-data" style="display:none;" id="baca-data">
                    <br />
                      <h2 class="text-c" id="ark-judul"></h2>
                      <h6 class="text-c" id="creator"></h6>
                      <hr>
                      <span class="text-c" id="tambahan">
                      </span>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                        <button type="button" class="btn btn-danger tutup">Selesai</button>
                      </div>
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
    <div class="galeri posisi">
        <a href="#" class="tombol  kiri  btn btn-default"><span class="glyphicon glyphicon-arrow-left zindex"></span></a>
          <span id="img-loc"></span>
          <a href="#" class="tombol btn kanan btn-default"><span class="glyphicon glyphicon-arrow-right  zindex"></span></a>
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
    <script src="<?php echo base_url(); ?>asset/build/js/custom.min.js"></script>
    <!-- CK Editor -->
    <script src="<?php echo base_url(); ?>asset/vendors/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>asset/ckedtor.js"></script>
    <script src="<?php echo base_url() ?>asset/event/JSCuaca.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/galeri.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/galeri.js"></script>
    <script>
      $(document).ready(function(){
        edit_req_epi('<?php echo site_url('Cuaca/get_epi_id') ?>')
        baca_data2('<?php echo site_url('Cuaca/get_epi_r') ?>')
        get_galeri('<?php echo site_url('Cuaca/baca_gambar') ?>','epi')
        $('#spage, button[value="empty"]').click(function(){
            return false;
        })
      })
    </script>
  </body>
</html>