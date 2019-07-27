<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Berita</title>

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
          
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Berita hari ini</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan berita di sini</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content" style="height:auto;">
                    <br />
                    <form method="POST" action="<?php echo site_url('Informasi/setBerita') ?>" enctype="multipart/form-data" id="kirim-data-news">
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input required type="text"  class="form-control col-md-5 col-xs-12" autocomplete="off" name="judul">
                        </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div id="toolbar-container"></div>
                          <div style="height:500px; border: 1px solid grey; color:black;" id="ckeditorc">

                          </div>
                          <!--<textarea name="berita" class="ckeditorc beritav" id="ckeditorc"></textarea>-->
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12"><br>
                          <small>JPG, JPEG, GIF, PNG</small>
                          <input style="margin-top: 10px;margin-bottom: 10px;" required type="file" name="foto[]" multiple>
                        </div>
                      </div>
                      <br>
                      <br>
                      <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <button type="submit" class="btn btn-success kirim-cek">Kirim</button>
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
    <script src="<?php echo base_url(); ?>asset/build/js/custom.js"></script>
    <!-- CK Editor -->
    <script src="<?php echo base_url(); ?>asset/vendors/ckeditor5/ckeditor.js"></script>
    <!--<script src="<?php echo base_url(); ?>asset/ckedtorcstm.js"></script>-->
    <script src="<?php echo base_url(); ?>asset/ckeditor5set.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <script src="<?php echo base_url(); ?>asset/event/informasi.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>

    <script>
      $(document).ready(function(){
        
      })

      kirim_news('<?php echo site_url('Informasi/List_berita') ?>')
      $('.kirim-cek').click(function(){
       // CKEDITOR.instances.ckeditorc.insertHtml( '<p>This is a new paragraph<strong>Halo</strong>.</p>' );
        if (CKValue.getData()=='') {
          return false;         
        }
        
      })
      //CKEDITOR.instances.ckedtor.getData();
      function keluar(link){
        mscConfirm("Lanjutkan keluar ?",function(){
          window.location.replace(link)
        })
      }
    </script>
  </body>
</html>