 <!-- Begin Page Content -->
 <div class="container-fluid">
     <!-- Begin Page Content -->
     <div class="container-fluid">
         <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">Ganti Token</h1>
         <p class="mb-4">Untuk mengamankan Token Anda, silahkan lakukan pergantian Token</p>
         <div class="card shadow mb-4">
             <!-- Card Header - Accordion -->
             <a href="#kepengurusan" class="d-block card-header py-3" data-toggle="collapse" role="button"
                 aria-expanded="true" aria-controls="kepengurusan">
                 <h6 class="m-0 font-weight-bold text-primary">Form Ganti Token</h6>
             </a>
             <div class="collapse show" id="kepengurusan">
                 <div class="card-body">
                     <div class="col-lg-12 row col-md-8 text-center justify-content-center">
                         <div class="card col-lg-6 border-left-primary shadow h-100 py-2">
                             <div class="card-body">
                                 <form class="user" action="auth/change_password" method="post">
                                     <div class="form-group">
                                         <h5><?= $pemilih[0]['username'] ?></h5>
                                         <div id="qrcode" class="mb-3 mt-3"></div>
                                         <h4><?= $pemilih[0]['token'] ?></h4>
                                         <p>Valid Until : <?= $pemilih[0]['token_valid_until'] ?> WITA</p>
                                     </div>
                                     <button type="submit" class="btn btn-primary btn-user btn-block">Request
                                         Token Baru</button>
                                     <button type="submit" class="btn btn-info btn-user btn-block">Unduh Token</button>
                                 </form>
                                 <script type="text/javascript">
                                 $(document).ready(function() {
                                     //your code here
                                     $('#qrcode').qrcode({
                                         text: "<?= $pemilih[0]['token'] ?>"
                                     });
                                 });
                                 </script>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>