<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Edit Berita</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>asset/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>asset/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url(); ?>asset/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>asset/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('asset/event/paginasi.css') ?>">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view('Menu_kiri') ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Daftar Berita yang Telah Dimuat</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
              <div class="col-md-12 col-sm-12 col-xs-12" id="list-dta">
                <div class="x_panel">
                  <div class="x_title">
                  </div>

                  <div class="x_content" >
                    <form method="GET" action="<?php echo site_url('Informasi/List_berita') ?>">
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
                        <button type="submit" class="btn btn-primary kirim">Tampilkan</button>
                        <div class="form-group">
                          <div class="col-md-2 ">
                            
                        </div>
                      </div>
                      </form>
                    <br />
                    <br>
                    <form method="POST" action="<?php echo site_url('Informasi/del_berita') ?>" id="del">
                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Waktu Dibuat </th>
                            <th class="column-title">Judul </th>
                            <!--<th class="column-title">Gambar </th>-->
                            <th class="column-title">Penyusun </th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php echo $berita['berita'] ?>
                        </tbody>
                      </table>
                    </div>
                    <div>
                      <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                    </div>
                  </form>
                  </div>
                  <div>
                  <form action="<?php echo site_url('Informasi/List_berita') ?>">
                      <ul class="navigasi">
                      <input type="hidden" name="tahun" value="<?php echo $year ?>">
                      <input type="hidden" name="bulan" value="<?php echo $month ?>">
                        <?php echo $berita['page'] ?>
                      </ul>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>Edit berita</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content form-edit" id="form-edit" style="display: none;">
                    <br />
                    <form method="POST" action="<?php echo site_url('Informasi/edit_berita') ?>" id="kirim-data2">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="edit-judul" required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type='text' id="edit-id" class="form-control tgal" readonly="readonly" name="id" />
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <textarea name="berita" class="ckeditor beritav" id="ckeditorc"></textarea>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="row edit-foto" style="margin-top: 10px; ">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input style="margin-top: 10px; margin-bottom: 10px;" type="file" name="foto[]" multiple>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success kirim">Kirim</button>
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
                    <h2><small>Baca berita</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content baca-news" id="baca-news" style="display: none;">
                    <div  class="col-md-12 col-sm-12 col-xs-12" >
                      <h1 class="red-judul"></h1>
                    </div>
                    <div  class="col-md-12 col-sm-12 col-xs-12" >
                      <span class="red-isi"></span>
                    </div>
                      <div class="container">
                          <div class="row dis-foto">
                              
                          </div>
                    </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
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
      .btn:focus, .btn:active, button:focus, button:active {
        outline: none !important;
        box-shadow: none !important;
      }

      #image-gallery .modal-footer{
        display: block;
      }

      .thumb{
        margin-top: 15px;
        margin-bottom: 15px;
      }

      .red-judul, .red-isi{
        color: black;
      }
      #l-hr{
        color: black;
        height: 2px;
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
    <script src="<?php echo base_url(); ?>asset/editor-news.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/informasi.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
      $(document).ready(function(){
        $('#spage, button[value="empty"]').click(function(){
            return false;
        })
      })
    </script>
  </body>
      
</html>


