<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG | Citra radar </title>

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
        <div class="right_col" role="main"  id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Citra Radar DIY</h3>
              </div>
              <div id="snackbar" align="right"></div>
              
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar data citra radar</h5>
                  </div>

                  <div class="x_content" >
                    <br />
                    <form method="GET" action="<?php echo site_url('Cuaca/radar') ?>">
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
                      </form>
                      <form class="form-horizontal form-label-left input_mask" method="POST" id="del" action="<?php echo site_url('Cuaca/del_citra') ?>" >
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No</th>
                            <th class="column-title">Tanggal input</th>
                            <th class="column-title">Petugas </th>
                            <th class="column-title">Citra</th>
                            <th class="column-title no-link last">Aksi
                            </th>
                          </tr>
                        </thead>

                        <tbody>                
                          <?php echo $ctr ?>
                        </tbody>
                      </table>
                    </div>
                      </div>
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
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan data citra radar terbaru</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                  </div>

                  <div class="x_content form-ctr" style="display: none;">
                      <form action="<?php echo site_url('Cuaca/set_ctr') ?>" id="kirim-data" method="POST">
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <label>Masukkan file gambar</label>
                          <input style="margin-top: 10px; margin-bottom: 10px;" type="file" name="radar[]" multiple require />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit data citra radar</h5>
                  </div>
                  <div class="x_content edit_ctr" style="display: none;" id="form-edit">
                      <form action="<?php echo site_url('Cuaca/edit_ctr') ?>" id="kirim-data" method="POST">
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>ID</label>
                          <input type="text" readonly="readonly" name="id" class="form-control" id="id-ctr">
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <label>Daftar citra radar</label>
                          <div class="row edit-foto" style="margin-top: 10px; ">
                          </div>
                          <span>
                            <input style="margin-top: 10px; margin-bottom: 10px;" type="file" name="radar[]" multiple />
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
    <script src="<?php echo base_url() ?>asset/event/JSCuaca.js"></script> 
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/galeri.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/galeri.js"></script>
  </body>
  <script>
    $(document).ready(function(){
      baca_gambar('<?php echo site_url('Cuaca/display_citra') ?>')
      get_galeri('<?php echo site_url('Cuaca/baca_gambar') ?>','rdr')
    })
  </script>
</html>