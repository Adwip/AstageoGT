<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <title>BMKG DIY | UPT </title>

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
        <div class="right_col" role="main" id="list-data">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Stasiun dan UPT BMKG Yogyakarta</h3>
              </div>
              <div id="snackbar" align="right"></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Daftar Stasiun & UPT Saat Ini</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                
                    </ul>
                    
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" action="<?php echo site_url('Informasi/hapus_upt')?>" id="del">
                      <div class="table-responsive opt" >
                        
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">No </th>
                            <th class="column-title">Stasiun </th>
                            <th class="column-title">Alamat</th>
                            <th class="column-title">Kepala </th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php echo $upt ?>
                        </tbody>
                        
                      </table>
                      
                    </div>
                    <div align="right">
                    <button class="btn btn-round btn-danger btn-xs hapus" >Hapus</button>
                    </div>
                  </form>
                  </div>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Masukkan data UPT baru di sini</h5>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    
                  </div>
                  <div class="x_content" style="display: none;">
                    <br />
                      <form action="<?php echo site_url('Informasi/set_upt') ?>" class="form-horizontal form-label-left input_mask" id="kirim-data" method="POST" data-validate="parsley">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Nama stasiun</label>
                        <input type="text" name="stasiun" class="form-control has-feedback-left" autocomplete="off"  placeholder="Nama Stasiun" required>
                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Alamat stasiun</label>
                        <input type="text" name="alamat" autocomplete="off" class="form-control has-feedback-left"  placeholder="Alamat" required>
                        <span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>E-mail</label>
                        <input type="text" name="surel" autocomplete="off" class="form-control has-feedback-left" required placeholder="Alamat E-Mail" data-parsley-type="email" data-parsley-trigger="change">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Nomor telepon</label>
                        <input type="text" name="telepon" autocomplete="off" class="form-control has-feedback-left" required placeholder="Nomor Telepon" data-inputmask="'mask' : '(9999) 999-9999'">
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Alamat faksimili</label>
                        <input type="text" name="faksimili" autocomplete="off" class="form-control has-feedback-left" required placeholder="Alamat Faksimili" data-inputmask="'mask' : '(9999) 999-9999'">
                        <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Kepala stasiun</label>
                        <input type="text" name="kepala" autocomplete="off" class="form-control has-feedback-left"  placeholder="Kepala Stasiun / UPT" required>
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <!--<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Struktur organisasi <small>file gambar</small></label>
                        <input type="file" required name="struktur" class="form-control">
                      </div>-->

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                          <br>
                          <button type="submit" class="kirim btn btn-success">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Edit Unit Pelayanan Teknis</h5>
                  </div>
                  <div class="x_content edit-page" style="display: none;" id="form-edit">
                    <br />
                      <form method="POST" action="<?php echo site_url('Informasi/edit_upt') ?>" class="form-horizontal form-label-left input_mask" id="kirim-data">
                      <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                        <label>ID UPT</label>
                        <input  type='text' id="edit-id" class="form-control tgal" readonly="readonly" name="id" />
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                        <label>Petugas</label>
                        <input  type='text' id="nama" class="form-control tgal" readonly="readonly"/>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-12 form-group">
                          <label>Tanggal input</label>
                          <input  type='text' id="t-input" class="form-control tgal" readonly="readonly" />
                        </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Nama stasiun</label>
                        <input type="text" name="stasiun" class="form-control has-feedback-left" id="edit-kan" placeholder="Nama Stasiun" required="required">
                        <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Alamat stasiun</label>
                        <input type="text" name="alamat" class="form-control has-feedback-left" id="edit-add" placeholder="Alamat" required="required">
                        <span class="fa fa-road form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Alamat e-mail</label>
                        <input id="edit-sur" type="text" name="surel" autocomplete="off" class="form-control has-feedback-left" required placeholder="Alamat E-Mail" data-parsley-type="email" data-parsley-trigger="change">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Nomor telepon</label>
                        <input id="edit-telp" type="text" name="telepon" autocomplete="off" class="form-control has-feedback-left" required placeholder="Nomor Telepon" data-inputmask="'mask' : '(9999) 999-9999'">
                        <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Nomor Faksimili</label>
                        <input id="edit-faks" type="text" name="faksimili" autocomplete="off" class="form-control has-feedback-left" required placeholder="Alamat Faksimili" data-inputmask="'mask' : '(9999) 999-9999'">
                        <span class="fa fa-fax form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Kepala stasiun</label>
                        <input type="text" name="kepala" class="form-control has-feedback-left" id="edit-head" placeholder="Kepala Stasiun / UPT" required="required">
                        <span class="fa fa-male form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <!--<div class="col-md-5 col-sm-5 col-xs-12">
                      <label>Tambah struktur oraganisasi jika akan mengganti</label>
                        <input type="file" name="struktur" >
                        </div>-->
                      <!--<div class="col-md-12 col-sm-12 col-xs-12">
                      <br>
                        <span id="foto-edit"></span>
                      </div>-->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <br>
                          <button type="submit" class="kirim btn btn-success">Simpan</button>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12 ">
                          <br>
                          <button type="button" class="tutup btn btn-danger tutup">Batal</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <div class="x_title">
                    <h5>Data Unit Pelayanan Teknis</h5>
                  </div>
                  <div class="x_content view-page" style="display: none; color:black;" id="lihat-upt">
                    <br />
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                      <br>
                      <label><h5>Nama Unit Pelayanan Teknis</h5></label>
                      <span>
                        <h4><strong id="kantor"></strong></h4>
                      </span>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                      <br>
                      <label><h5>Alamat UPT</h5></label>
                      <span>
                        <h4><strong id="alamat"></strong></h4>
                      </span>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 ">
                      <br>
                      <label><h5>Kepala UPT</h5></label>
                      <span>
                        <h4><strong id="kepala"></strong></h4>
                      </span>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 ">
                      <br>
                      <label><h5>Email UPT</h5></label>
                      <span>
                        <h4><strong id="email"></strong></h4>
                      </span>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 ">
                      <br>
                      <label><h5>Telepon UPT</h5></label>
                      <span>
                        <h4><strong id="telepon"></strong></h4>
                      </span>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 ">
                      <br>
                      <label><h5>Faksimili UPT</h5></label>
                      <span>
                        <h4><strong id="faksimili"></strong></h4>
                      </span>
                    </div>
                    <!--<div class="col-md-12 col-sm-12 col-xs-12 ">
                      <br>
                      <label><h5>Struktur Organisasi UPT</h5></label>
                      <span>
                        <h4><strong id="struktur"></strong></h4>
                      </span>
                    </div>-->
                    <div class="col-md-5 col-sm-5 col-xs-12 ">
                      <br>
                      <label><h5>Petugas</h5></label>
                      <span>
                        <h4><strong id="petugas"></strong></h4>
                      </span>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 ">
                      <br>
                      <label><h5>Tanggal input</h5></label>
                      <span>
                        <h4><strong id="tinput"></strong></h4>
                      </span>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                      <br>
                      <button type="button" class="tutup btn btn-danger tutup">Selesai</button>
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
    <script src="<?php echo base_url(); ?>asset/vendors/Parsley2/Parsley.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.js"></script>
    <!-- jquery.inputmask -->
    <script src="<?php echo base_url(); ?>asset/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>asset/confirm/ms-conf.js"></script>
    <link href="<?php echo base_url(); ?>asset/confirm/ms-conf.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/event/informasi.js"></script>
    <link href="<?php echo base_url(); ?>asset/toast/toast.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/toast/toast.js"></script>
    <script>
              
   
   $(document).ready(function(){
    init_InputMask();
    //$('#validasi').parsley();
    baca_upt('<?php echo site_url('Informasi/get_UPTID') ?>')

   })
    </script>
  </body>
</html>