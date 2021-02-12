<?php if ($kegiatan[0]['mode'] == 1) : ?>
<!-- ***** Welcome Area Manual ***** -->
<section id="home" class="section welcome-area bg-overlay d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <!-- Welcome Intro Start -->
            <div class="col-12 col-lg-7">
                <div class="welcome-intro">
                    <h1 class="text-white">Selamat Memilih</h1>
                    <p class="text-white my-4 text-justify">Untuk mulai melakukan pemilihan, Anda dapat login
                        menggunakan Username dan Token masing-masing. Pastikan Token dalam keadaan Aktif dan
                        Anda melakukan pemilihan pada rentang waktu kegiatan pemilihan</p>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-5">
                <!-- Contact Box -->
                <?php
                    $saat_ini = date_create(date('Y-m-d H:i:s'));
                    $kegiatan_mulai = date_create($kegiatan[0]['waktu_mulai']);
                    $kegiatan_selesai =  date_create($kegiatan[0]['waktu_selesai']);
                    $diff_1 = date_diff($saat_ini, $kegiatan_mulai);
                    $diff_2 = date_diff($saat_ini, $kegiatan_selesai);
                    if (new Datetime(date('Y-m-d H:i:s')) < new Datetime($kegiatan[0]['waktu_mulai'])) : ?>
                <div class="alert alert-info" role="alert">
                    Dimulai Dalam
                    <?= $diff_1->d . " Hari " . $diff_1->h . " Jam " . $diff_1->i . " Menit" ?>
                </div>
                <?php elseif (new Datetime(date('Y-m-d H:i:s')) >= new Datetime($kegiatan[0]['waktu_mulai']) && new Datetime(date('Y-m-d H:i:s')) <= new Datetime($kegiatan[0]['waktu_selesai'])) : ?>
                <div class="alert alert-info" role="alert">
                    Berakhir Dalam
                    <?= $diff_2->d . " Hari " . $diff_2->h . " Jam " . $diff_2->i . " Menit" ?>
                </div>
                <?php else : ?>
                <div class="alert alert-info" role="alert">
                    Sudah Berakhir, Sampai Jumpa Dikegiatan Berikutnya
                </div>
                <?php endif; ?>
                <div class="contact-box bg-white text-center rounded p-4 p-sm-5 mt-5 mt-lg-0 shadow-lg">
                    <!-- Contact Form -->
                    <form id="contact-form" method="POST" action="">
                        <div class="contact-top">
                            <h3 class="contact-title">Login Token</h3>
                            <h5 class="text-secondary fw-3 py-3">Gunakan Username dan Token yang Anda miliki
                            </h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                        </div>
                                        <input type="email" class="form-control"
                                            value="<?php echo set_value('email'); ?>" name="email"
                                            placeholder="Username" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="token"
                                            placeholder="Token Pemilihan" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-bordered w-100 mt-3 mt-sm-4" type="submit">Masuk</button>
                            </div>
                            <div class="col-12">
                                <span class="d-block pt-2 mt-4 border-top">Terjadi Masalah? <a
                                        href="<?= base_url() ?>etika/home#contact">Hubungi Kami</a></span>
                            </div>
                        </div>
                    </form>
                    <p class="form-message"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Shape Bottom -->
    <div class="shape-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path class="shape-fill" fill="#FFFFFF"
                d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7  c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4  c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z">
            </path>
        </svg>
    </div>
</section>
<!-- ***** Welcome Area End Manual***** -->
<?php elseif ($kegiatan[0]["mode"] == 0) : ?>
<!-- Welcome Area Otomatis -->
<!-- ***** Welcome Area Start ***** -->
<section id="home" class="section welcome-area bg-overlay d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <!-- Welcome Intro Start -->
            <div class="col-12 col-lg-7">
                <div class="welcome-intro">
                    <h1 class="text-white">Selamat Memilih</h1>
                    <p class="text-white my-4 text-justify">Untuk mulai melakukan pemilihan, Anda dapat login
                        menggunakan Username dan Token masing-masing. Jika Anda belum memiliki token, silahkan
                        pilih "Verifikasi Akun", kemudian Token akan dikirim melalui Email. Pastikan Token dalam
                        keadaan Aktif dan Anda
                        melakukan pemilihan pada rentang waktu kegiatan pemilihan</p>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-5">
                <!-- Contact Box -->
                <?php
                    $saat_ini = date_create(date('Y-m-d H:i:s'));
                    $kegiatan_mulai = date_create($kegiatan[0]['waktu_mulai']);
                    $kegiatan_selesai =  date_create($kegiatan[0]['waktu_selesai']);
                    $diff_1 = date_diff($saat_ini, $kegiatan_mulai);
                    $diff_2 = date_diff($saat_ini, $kegiatan_selesai);
                    if (new Datetime(date('Y-m-d H:i:s')) < new Datetime($kegiatan[0]['waktu_mulai'])) : ?>
                <div class="alert alert-info" role="alert">
                    Dimulai Dalam
                    <?= $diff_1->d . " Hari " . $diff_1->h . " Jam " . $diff_1->i . " Menit" ?>
                </div>
                <?php elseif (new Datetime(date('Y-m-d H:i:s')) >= new Datetime($kegiatan[0]['waktu_mulai']) && new Datetime(date('Y-m-d H:i:s')) <= new Datetime($kegiatan[0]['waktu_selesai'])) : ?>
                <div class="alert alert-info" role="alert">
                    Berakhir Dalam
                    <?= $diff_2->d . " Hari " . $diff_2->h . " Jam " . $diff_2->i . " Menit" ?>
                </div>
                <?php else : ?>
                <div class="alert alert-info" role="alert">
                    Sudah Berakhir, Sampai Jumpa Dikegiatan Berikutnya
                </div>
                <?php endif; ?>
                <div class="contact-box bg-white text-center rounded p-4 p-sm-5 mt-5 mt-lg-0 shadow-lg">
                    <!-- Contact Form -->
                    <form id="contact-form" method="POST" action="">
                        <div class="contact-top">
                            <h3 class="contact-title">Login Token</h3>
                            <h5 class="text-secondary fw-3 py-3">Gunakan Username dan Token yang Anda miliki
                            </h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                        </div>
                                        <input type="email" class="form-control"
                                            value="<?php echo set_value('email'); ?>" name="email"
                                            placeholder="Username" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="token"
                                            placeholder="Token Pemilihan" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <span class="d-block pt-2 ">Belum Memiliki Token? <a
                                        href="verifikasi-akun.html">Verifikasi Akun</a></span>
                                <button class="btn btn-bordered w-100 mt-3 mt-sm-4" type="submit">Masuk</button>
                            </div>
                            <div class="col-12">
                                <span class="d-block pt-2 mt-4 border-top">Terjadi Masalah? <a
                                        href="<?= base_url() ?>etika/home#contact">Hubungi Kami</a></span>
                            </div>
                        </div>
                    </form>
                    <p class="form-message"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Shape Bottom -->
    <div class="shape-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path class="shape-fill" fill="#FFFFFF"
                d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7  c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4  c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z">
            </path>
        </svg>
    </div>
</section>
<!-- ***** Welcome Area End ***** -->
<!-- End Welcome Area Otomatis -->
<?php endif; ?>

<!-- ***** Features Area Start ***** -->
<section id="features" class="section features-area style-two overflow-hidden ptb_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-7">
                <!-- Section Heading -->
                <div class="section-heading">
                    <span class="d-inline-block rounded-pill shadow-sm fw-5 px-4 py-2 mb-3">
                        <i class="far fa-lightbulb text-primary mr-1"></i>
                        <span class="text-primary">Go</span>
                        Technology
                    </span>
                    <h2>Live Count</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 my-3 res-margin">
                <!-- Image Box -->
                <div class="image-box text-center icon-1 p-5 wow fadeInLeft" data-aos-duration="2s"
                    data-wow-delay="0.4s">

                    <!-- Icon Text -->
                    <div class="icon-text">
                        <h3 class="mb-2">Berdasarkan Prodi</h3>
                        <p>Tanpa perlu mengunduh, Sistem ETIKA dapat diakses melalui browser pengguna</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 my-3 res-margin">
                <!-- Image Box -->
                <div class="image-box text-center icon-1 p-5 wow fadeInUp" data-aos-duration="2s" data-wow-delay="0.2s">

                    <!-- Icon Text -->
                    <div class="icon-text">
                        <h3 class="mb-2">Berdasarkan Semester</h3>
                        <p>Cukup login dengan Username dan Token, Anda dapat memulai melakukan
                            pemilihan</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 my-3 res-margin">
                <!-- Image Box -->
                <div class="image-box text-center icon-1 p-5 wow fadeInRight" data-aos-duration="2s"
                    data-wow-delay="0.4s">
                    <!-- Featured Image -->

                    <!-- Icon Text -->
                    <div class="icon-text">
                        <h3 class="mb-2">Berdasarkan Kandidat</h3>
                        <p>Hanya Anda yang mengetahui pilihan Anda, tidak ada yang lain diantaranya bahkan
                            panitia</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 my-3 res-margin">
                <!-- Image Box -->
                <div class="image-box text-center icon-1 p-5 wow fadeInLeft" data-aos-duration="2s"
                    data-wow-delay="0.8s">
                    <!-- Featured Image -->

                    <!-- Icon Text -->
                    <div class="icon-text">
                        <h3 class="mb-2">Perbandingan Jumlah Pemilih</h3>
                        <p>Proses penginputan kandidat, pemilih, dan perhitungan suara dilakukan oleh sistem</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Features Area End ***** -->
</div>