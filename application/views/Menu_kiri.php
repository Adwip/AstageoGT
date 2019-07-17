
         <div class="col-md-3 left_col menu_fixed"> 
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo site_url('Login') ?>" class="site_title"><i class="fa"><img src="<?php echo base_url(); ?>favicon.ico"style="width:25px;height:25px;"></i> <span>BMKG DIY</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php
                $foto=$this->session->userdata('foto');
                if ($foto!='no-img.png') {
                  # code...
                  $foto='<img src="'.base_url().'../File_BMKG/Admin/'.$foto.'" alt="..." class="img-circle profile_img">';
                }else{
                  $foto=null;
                } 
                ?>
                <?php echo $foto ?>
              </div>
              <div class="profile_info">
                <span>Selamat datang,</span>
                <h2><?php echo $this->session->userdata('nama')?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                          <div class="menu_section">
                <h3>Umum</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-newspaper-o"></i> Berita & Artikel <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Informasi/Berita'); ?>">Buat Berita</a></li>
                      <li><a href="<?php echo site_url('Informasi/List_berita'); ?>">Lihat Berita</a></li>
                      <li><a href="<?php echo site_url('Informasi/artikel'); ?>">Artikel</a></li>
                    </ul>

                  </li>
                  <li><a><i class="fa fa-male"></i> Kepegawaian <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Informasi/upt'); ?>">UPT</a></li>
                      <li><a href="<?php echo site_url('Informasi/sdm'); ?>">Sumber Daya Manusia</a></li>
                      <li><a href="<?php echo site_url('Informasi/pejabat'); ?>">Pejabat BMKG DIY</a></li>
                    </ul>
                  </li>
            <!--      <li><a><i class="fa fa-building-o"></i> Profil <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('Informasi/sejarah'); ?>">Sejarah</a></li>
                      <li><a href="<?php echo site_url('Informasi/visi_misi'); ?>">Visi & Misi</a></li>
                      <li><a href="<?php echo site_url('Informasi/tugas_fungsi'); ?>">Tugas & Fungsi</a></li>
                      <li><a href="<?php echo site_url('Informasi/struktur'); ?>">Struktur Organisasi BMKG DIY</a></li>
                    </ul>
                  </li>-->
                  <li><a><i class="fa fa-cloud"></i>Cuaca<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Cuaca/prakiraan'); ?>">Prakiraan cuaca DIY</a></li>
                      <li><a href="<?php echo site_url('Cuaca/radar'); ?>">Citra Radar</a></li>
                      <li><a href="<?php echo site_url('Cuaca/cuaca_mingguan'); ?>">Prospek cuaca Mingguan</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bolt"></i>Iklim<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a>Prakiraan Musim<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo site_url('Cuaca/prak_hujan_bulanan'); ?>">Prakiraan Hujan Bulanan</a>
                            </li>
                        <!--<li class="sub_menu"><a href="<?php echo site_url('Cuaca/probabilistik'); ?>">Prakiraan hujan probabilistik DIY</a>-->
                            </li>
                            <li><a href="<?php echo site_url('Cuaca/prakiraan_musim'); ?>">Prakiraan Musim</a>
                            </li>
                          </ul>
                        </li>
                        <li><a>Analisis Iklim<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                        <!--<li class="sub_menu"><a href="<?php echo site_url('Cuaca/informasi_hujan_bulanan'); ?>">Informasi Hujan Bulanan</a>-->
                            </li>
                            <li><a href="<?php echo site_url('Cuaca/dinamika_atmosfer'); ?>">Dinamika Atmosfer</a>
                            </li>
                            <li><a href="<?php echo site_url('Cuaca/IPT'); ?>">Indeks Presipitasi Terstandarisasi</a>
                            </li>
                          </ul>
                        </li>
                        <li><a>Informasi Iklim<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo site_url('Cuaca/info_HTH'); ?>">Informasi HTH</a>
                            </li>
                          </ul>
                        </li>
                        <li><a>Perubahan Iklim<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="<?php echo site_url('Cuaca/TCH'); ?>">Tren Curah Hujan</a>
                            </li>
                            <li><a href="<?php echo site_url('Cuaca/Tren_suhu'); ?>">Tren Suhu</a>
                            </li>
                            <li><a href="<?php echo site_url('Cuaca/PNH'); ?>">Perubahan Normal Hujan</a>
                            </li>
                            <li><a href="<?php echo site_url('Cuaca/EPI'); ?>">Ekstrem Perubahan Iklim</a>
                            </li>
                          </ul>
                        </li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sun-o"></i>Kualitas Udara <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Cuaca/KAH'); ?>">Kimia Air Hujan</a></li>
                      <li><a href="<?php echo site_url('Cuaca/Informasi_partikular'); ?>">Informasi SPM mingguan</a></li>
                    <!--  <li><a href="<?php echo site_url('Cuaca/partikulat25'); ?>">Informasi Partikulat 2.5 µgram/m3</a></li>-->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-globe"></i>Gempa & Tsunami<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Aktlam/gempa'); ?>">Gempa Bumi</a></li>
                      <!--<li><a href="<?php echo site_url('Aktlam/tsunami'); ?>">Tsunami</a></li>-->
                      <li><a href="<?php echo site_url('Aktlam/terbit_terbenam_matahari'); ?>">Terbit Terbenam Matahari</a></li>
                      <li><a href="<?php echo site_url('Aktlam/peta_sambaran_petir'); ?>">Peta Sambaran Petir</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Umum<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Informasi/pengumuman'); ?>">Pengumuman</a></li>
                      <!--<li><a href="<?php echo site_url(''); ?>">Tsunami</a></li>-->
                    <!--<li><a href="<?php echo site_url('Informasi/'); ?>">Peringatan</a></li>-->
                  <!--<li><a href="<?php echo site_url(''); ?>">Peta Sambaran Petir</a></li>-->
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Ekstra</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i>Admin<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Pegawai/admin'); ?>">Daftar admin</a></li>
                    <!--  <li><a href="<?php echo site_url(''); ?>">Ubah admin</a></li>
                      <li><a href="<?php echo site_url(''); ?>">Aktivitas admin</a></li>-->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i>Akun<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('Pegawai/gp_page'); ?>">Panel akun</a></li>
                    <!--<li><a href="<?php echo site_url(''); ?>">Aktivitas akun</a></li>-->
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!--menu footer buttons -->
                      
            <div class="sidebar-footer hidden-small">
              <a href="<?php echo site_url('Pegawai/gp_page')?>" style="width: 115px;" data-toggle="tooltip" data-placement="top" title="Panel akun">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a onclick="keluar('<?php echo site_url('Login/keluar')?>')" style="width: 115px;" data-toggle="tooltip" data-placement="top" class="keluar" title="Keluar" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>../File_BMKG/Admin/<?php echo $this->session->userdata('foto')?>" alt=""><?php echo $this->session->userdata('nama')?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <!--<li>
                        <a href="javascript:;"> Profile</a></li>
                    <li>
                        <a href="javascript:;"><span class="badge bg-red pull-right">50%</span><span>Settings</span>
                            </a>
                          </li>
                          <li><a href="javascript:;">Help</a></li>-->
                <li>
                  <a onclick="keluar('<?php echo site_url('Login/keluar')?>')" href="#"><i class="fa fa-sign-out pull-right keluar"></i> Keluar</a></li>
              </ul>
                </li>       
            </ul>
          </nav>
        </div>
      </div>
        <!-- /top navigation -->
