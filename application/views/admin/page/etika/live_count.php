<!-- Begin Page Content -->

<input type="hidden" id="id_kegiatan" value="<?= $kegiatan[0]['id_kegiatan'] ?>">
<div class="container-fluid">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Kandidat EVOTING Kegiatan <span
                class="text-primary "><?= $kegiatan[0]['nama_kegiatan'] ?></span> </h1>
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#kepengurusan" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="kepengurusan">
                <h6 class="m-0 font-weight-bold text-primary">Live Count Kegiatan</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="kepengurusan">
                <div class="card-body row justify-content-center">
                    <div class="row col-lg-12">

                        <div class="col-lg-6 col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-2 text-center">
                                                Berdasarkan Prodi</h5>
                                            <div id="form-diagram">

                                            </div>
                                            <div class="col-12">
                                                <canvas id="prodiChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-2 text-center">
                                                Berdasarkan Semester</h5>
                                            <div id="form-diagram-semester">

                                            </div>
                                            <div class="col-12">
                                                <canvas id="semesterChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-2 text-center">
                                                Berdasarkan Kandidat</h5>
                                            <div id="form-diagram-kandidat">

                                            </div>
                                            <div class="col-12">
                                                <canvas id="kandidatChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2 text-center">
                                            <h5 class="font-weight-bold text-primary text-uppercase mb-2 text-center">
                                                Berdasarkan Pemilih</h5>
                                            <div id="form-diagram-pemilih">

                                            </div>
                                            <div class="col-12">
                                                <canvas id="pemilihChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--====== Modal Developer Area End ======-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End of Main Content -->