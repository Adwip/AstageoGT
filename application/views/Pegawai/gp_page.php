<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | Panel akun</title>

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
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Panel akun</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                  <div class="x_title">
                    <h5>Profil</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>
                    <div class="x_content" >
                      <form method="POST" action="<?php echo site_url('Pegawai/edit_akun') ?>" id="kirim-data4" >
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="form-group">
                            <img src="<?php echo base_url('../File_BMKG/Admin/'.$foto) ?>" alt="<?php echo $nama ?>" height="200" width="200">
                          </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <div class="form-group">
                            <h3 class="wrn">Nama</h3>
                            <h2><strong class="wrn"><?php echo $nama ?></strong></h2>
                            <hr>
                            <h3 class="wrn"><i>Logout</i> terakhir</h3>
                            <h2><strong class="wrn"><?php echo $login ?></strong></h2>
                            <hr>
                            <h3 class="wrn">Hak akses</h3>
                            <span>
                            <ul>
                              <?php
                                for ($i=0; $i < count($akses); $i++) { 
                                  echo $akses[$i];
                                }
                              ?>
                            </ul>
                            </span>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <?php echo $form ?>
                        </div>
                       </form>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                  <div class="x_title">
                    <h5>Ganti password</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>
                    <div class="x_content" style="display:none;" >
                      <form method="POST" action="<?php echo site_url('Pegawai/ch_pass') ?>" id="kirim-data" >
                        <div class="text-center">
                        <div class="form-group">
                          <label for="baru">Password baru</label>
                          <input type="password" name="pass" required class="form-control" id="baru" placeholder="Password baru">
                        </div>
                        <div class="form-group">
                          <label for="baru2">Konfirmasi Password baru</label>
                          <input type="password" name="baru2" required class="form-control" id="baru2" placeholder="Password baru">
                        </div>
                        <div class="form-group">
                          <label for="old">Password saat ini</label>
                          <input required type="password" name="old_pass" class="form-control" id="old" placeholder="Password saat ini">
                        </div>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <button disabled style="width: 200px; "class=" btn btn-success btn-md " id="ganti_conf" >Ganti</button>
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
      .pos-teks{
        text-align: center;
      }
      .garis{
        border: 1px solid black;
      }
      input[type="password"]::placeholder {  
                  
                  /* Firefox, Chrome, Opera */ 
                  text-align: center; 
              }
      .wrn{
        color: black;
      }
      .clr{
        font-size:11pt;
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
    <script src="<?php echo base_url() ?>asset/event/admin.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
      $(document).ready(function(){
        edit('<?php echo site_url('Pegawai/get_akses_id') ?>')
        $('#baru2').keyup(function(){
          if ($(this).val()==$('#baru').val()) {
            $('#ganti_conf').prop('disabled',false);
          }else{
            $('#ganti_conf').prop('disabled',true);
          }
        })

      })
        
    </script>

  </body>
</html>