<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Kandidat</h1>
        <p class="mb-4">Silahkan pilih kandidat yang sesuai dengan pandangan Anda, junjung tinggi asas
            LUBERJUDIL dalam berdemokrasi</p>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#kepengurusan" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="kepengurusan">
                <h6 class="m-0 font-weight-bold text-primary">Surat Suara Elektronik Sistem ETIKA</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="kepengurusan">
                <div class="card-body row justify-content-center">
                    <div class="row col-lg-12">
                        <?php if ($pemilih[0]['has_voting'] == 0) : ?>
                        <?php foreach ($kandidat as $data) : ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <h2 class="font-weight-bold text-primary text-uppercase mb-2 text-center">
                                                <?= $data['no_urut'] ?></h2>
                                            <img src="<?= base_url() ?>assets/upload/Folder_etika/<?= $data['foto'] ?>"
                                                alt="" width="60%">
                                            <h5 class="mb-4 mt-5"><?= $data['nama_ketua'] ?> -
                                                <?= $data['nama_wakil'] ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <a href="#"><button type="submit" class="btn btn-primary btn-user  btn-block mt-2"
                                            data-toggle="modal" data-target="#voting-<?= $data['id_kandidat'] ?>">
                                            Voting</button></a>
                                </div>
                            </div>
                        </div>
                        <!--====== Modal Developer Area Start ======-->
                        <div class="modal fade" id="voting-<?= $data['id_kandidat'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="devModalLabel-<?= $data['id_kandidat'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="devModalLabel-<?= $data['id_kandidat'] ?>">Visi dan
                                            Misi</h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h5>Visi</h5>
                                        <?= $data['visi'] ?>

                                        <hr>
                                        <h5>Misi</h5>
                                        <?= $data['misi'] ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <a
                                            href="<?= base_url() ?>etika/save_vote/<?= base64_encode(base64_encode($data['id_kandidat'])) ?>"><button
                                                type="button" class="btn btn-primary">Voting
                                                Kandidat</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--====== Modal Developer Area End ======-->
                        <?php endforeach; ?>
                        <?php else : ?>
                        <div class="col-lg-12">
                            <h4 class="text-center">Anda Telah Melakukan EVOTING</h4>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
<!-- End of Main Content -->