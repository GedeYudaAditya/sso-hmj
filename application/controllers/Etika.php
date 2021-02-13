<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */

// Halaman Administrator
class Etika extends CI_Controller
{
    // Email Help Desk
    private $email_admin = array('riyan@undiksha.ac.id');

    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            $id = $_SESSION['user_id'];
            $this->data['group'] = $this->ion_auth_model->getGroup($id);
            $this->data['kegiatan'] = $this->All_model->getAllKegiatanEtika();
            $this->data['title'] = "ETIKA - Manajemen ETIKA";
            $this->data['active'] = "10";
            $this->data['ckeditor'] = "false";
            $this->data['flip'] = "false";
            $this->load->view('admin/master/header', $this->data);
            $this->load->view('admin/page/etika/index', $this->data);
            $this->load->view('admin/master/footer', $this->data);
        }
    }
    public function tambah_kegiatan()
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Send Data
            $id = $_SESSION['user_id'];
            $this->data['group'] = $this->ion_auth_model->getGroup($id);
            $this->data['title'] = "ETIKA - Tambah Kegiatan ETIKA";
            $this->data['active'] = "10";
            $this->data['ckeditor'] = "etika";
            $this->data['flip'] = "false";
            // Form Validation
            $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|max_length[100]');
            $this->form_validation->set_rules('deskripsi_etika', 'Deskripsi', 'required|max_length[1000]');
            $this->form_validation->set_rules('waktu_mulai', 'Tanggal Mulai', 'required|min_length[19]');
            $this->form_validation->set_rules('waktu_selesai', 'Tanggal Selesai', 'required|min_length[19]');
            $this->form_validation->set_rules('mode', 'Mode Voting', 'required');
            // If Validation False, return view
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/master/header', $this->data);
                $this->load->view('admin/page/etika/tambah_kegiatan', $this->data);
                $this->load->view('admin/master/footer', $this->data);
            } else {
                $date = new DateTime(date('Y-m-d H:i:s'));
                $mulai = new DateTime($_POST['waktu_mulai']);
                $akhir = new DateTime($_POST['waktu_selesai']);
                if ($mulai >= $date && $akhir >= $date) {
                    if ($mulai < $akhir) {
                        if ($this->All_model->inputKegiatanEtika()) {
                            echo "Berhasil";
                        } else {
                            echo "Masalah pada server";
                        }
                    } else {
                        echo "Waktu Salah";
                    }
                } else {
                    echo "Error";
                }
            }
        }
    }

    public function ubah_kegiatan($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Send Data
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id = $_SESSION['user_id'];
            $this->data['group'] = $this->ion_auth_model->getGroup($id);
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $this->data['kegiatan'] = $cari;
            $this->data['title'] = "ETIKA - Ubah Kegiatan ETIKA";
            $this->data['active'] = "10";
            $this->data['ckeditor'] = "etika";
            $this->data['flip'] = "false";
            // Form Validation
            $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|max_length[100]');
            $this->form_validation->set_rules('deskripsi_etika', 'Deskripsi', 'required|max_length[1000]');
            $this->form_validation->set_rules('waktu_mulai', 'Tanggal Mulai', 'required|min_length[19]');
            $this->form_validation->set_rules('waktu_selesai', 'Tanggal Selesai', 'required|min_length[19]');
            $this->form_validation->set_rules('mode', 'Mode Voting', 'required');
            // If Validation False, return view
            if ($this->form_validation->run() == FALSE) {
                if (!empty($cari)) {
                    $this->load->view('admin/master/header', $this->data);
                    $this->load->view('admin/page/etika/ubah_kegiatan', $this->data);
                    $this->load->view('admin/master/footer', $this->data);
                } else {
                    show_404();
                }
            } else {
                $date = new DateTime(date('Y-m-d H:i:s'));
                $mulai = new DateTime($_POST['waktu_mulai']);
                $akhir = new DateTime($_POST['waktu_selesai']);
                if ($mulai >= $date && $akhir >= $date) {
                    if ($mulai < $akhir) {
                        if ($this->All_model->editKegiatanEtika($id_kegiatan)) {
                            echo "Berhasil";
                        } else {
                            echo "Masalah pada server";
                        }
                    } else {
                        echo "Waktu Salah";
                    }
                } else {
                    echo "Error";
                }
            }
        }
    }

    public function hapus_kegiatan($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Send Data
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            if (!empty($cari)) {
                if ($this->All_model->hapusKandidatAll($id_kegiatan)) {
                    if ($this->All_model->deleteKegiatanEtikaWhere($id_kegiatan)) {
                        echo "Berhasil dihapus";
                    } else {
                        echo "Gagal dihapus";
                    }
                } else {
                    echo "Server Error";
                }
            } else {
                show_404();
            }
        }
    }

    public function administrator($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id = $_SESSION['user_id'];
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $this->data['pemilih'] = $this->All_model->rowAllPemilih($id_kegiatan);
            $this->data['group'] = $this->ion_auth_model->getGroup($id);
            $this->data['title'] = "ETIKA - Administrator ETIKA";
            $this->data['active'] = "10";
            $this->data['kegiatan'] = $cari;
            $this->data['ckeditor'] = "false";
            $this->data['flip'] = "false";
            $this->data['id_kegiatan'] = $id_kegiatan;
            if (!empty($cari)) {
                $this->load->view('admin/master/header', $this->data);
                $this->load->view('admin/page/etika/administrator', $this->data);
                $this->load->view('admin/master/footer', $this->data);
            } else {
                show_404();
            }
        }
    }

    public function kandidat($id_kandidat = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            $id_kegiatan = (int)base64_decode(base64_decode($id_kandidat));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $id = $_SESSION['user_id'];
            $this->data['group'] = $this->ion_auth_model->getGroup($id);
            $this->data['title'] = "ETIKA - Administrator Kandidat ETIKA";
            $this->data['active'] = "10";
            $this->data['kegiatan'] = $cari;
            $this->data['ckeditor'] = "false";
            $this->data['flip'] = "false";
            $this->data['kandidat'] =  $this->All_model->getAllKandidat($id_kegiatan);
            $this->data['id_kegiatan'] = $id_kegiatan;
            if (!empty($cari)) {
                $this->load->view('admin/master/header', $this->data);
                $this->load->view('admin/page/etika/kandidat', $this->data);
                $this->load->view('admin/master/footer', $this->data);
            } else {
                show_404();
            }
        }
    }

    public function tambah_kandidat($id_kandidat = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Send Data
            $id_kegiatan = (int)base64_decode(base64_decode($id_kandidat));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_mulai'])) {
                $id = $_SESSION['user_id'];
                $this->data['group'] = $this->ion_auth_model->getGroup($id);
                $this->data['title'] = "ETIKA - Tambah Kandidat ETIKA";
                $this->data['active'] = "10";
                $this->data['ckeditor'] = "etika";
                $this->data['flip'] = "false";
                // Form Validation
                $this->form_validation->set_rules('no_urut', 'Nomor Urut', 'required|integer');
                $this->form_validation->set_rules('ketua', 'Nama Ketua', 'required|max_length[100]');
                $this->form_validation->set_rules('wakil_ketua', 'Nama Wakil Ketua', 'required|max_length[100]');
                $this->form_validation->set_rules('visi_kandidat', 'Visi Kandidat', 'required|max_length[1000]');
                $this->form_validation->set_rules('misi_kandidat', 'Misi Kandidat', 'required|max_length[1000]');
                // If Validation False, return view
                if ($this->form_validation->run() == FALSE) {
                    if (!empty($cari)) {
                        $this->load->view('admin/master/header', $this->data);
                        $this->load->view('admin/page/etika/tambah_kandidat', $this->data);
                        $this->load->view('admin/master/footer', $this->data);
                    } else {
                        show_404();
                    }
                } else {
                    if ($_FILES["file"]['error'] == 4) {
                        // if empty,, send message file is empty, return back
                        echo "Gambar Belum Diisi";
                    } else {
                        $id_sistem = "etika";
                        $id_file = "kandidat";
                        $tujuan = "etika";
                        $upload = $this->All_model->uploadFile($id_file, $id_sistem, $tujuan);
                        if ($upload['result'] == "success") {
                            if ($this->All_model->inputDataKandidat($upload, $id_kegiatan)) {
                                echo "Berhasil";
                            } else {
                                echo "Gagal ditambahkan";
                            }
                        } else {
                            echo "Periksa File";
                        }
                    }
                }
            } else {
                show_404();
            }
        }
    }

    public function ubah_kandidat($id_kegiatan = "", $id_kandidat = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Decode id
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id_kandidat = (int)base64_decode(base64_decode($id_kandidat));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $kandidat = $this->All_model->cariKandidat($id_kandidat);
            if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                // Send Data to views
                $id = $_SESSION['user_id'];
                $this->data['kandidat'] = $kandidat;
                $this->data['group'] = $this->ion_auth_model->getGroup($id);
                $this->data['title'] = "ETIKA - Ubah Kandidat ETIKA";
                $this->data['active'] = "10";
                $this->data['ckeditor'] = "etika";
                $this->data['flip'] = "false";
                // Form Validation
                $this->form_validation->set_rules('no_urut', 'Nomor Urut', 'required|integer');
                $this->form_validation->set_rules('ketua', 'Nama Ketua', 'required|max_length[100]');
                $this->form_validation->set_rules('wakil_ketua', 'Nama Wakil Ketua', 'required|max_length[100]');
                $this->form_validation->set_rules('visi_kandidat', 'Visi Kandidat', 'required|max_length[1000]');
                $this->form_validation->set_rules('misi_kandidat', 'Misi Kandidat', 'required|max_length[1000]');
                // If Validation False, return view
                if ($this->form_validation->run() == FALSE) {
                    if (!empty($cari) || !empty($kandidat)) {
                        $this->load->view('admin/master/header', $this->data);
                        $this->load->view('admin/page/etika/ubah_kandidat', $this->data);
                        $this->load->view('admin/master/footer', $this->data);
                    } else {
                        show_404();
                    }
                } else {
                    if ($_FILES["file"]['error'] == 4) {
                        // if empty,, input to database, return back
                        if ($this->All_model->editDataKandidat($id_kandidat)) {
                            echo "Berhasil";
                        } else {
                            echo "Gagal ditambahkan";
                        }
                    } else {
                        if ($this->All_model->deleteFileKandidat($kandidat[0]['foto'])) {
                            $id_sistem = "etika";
                            $id_file = "kandidat";
                            $tujuan = "etika";
                            $upload = $this->All_model->uploadFile($id_file, $id_sistem, $tujuan);
                            if ($upload['result'] == "success") {
                                if ($this->All_model->editDataKandidatFile($upload, $id_kandidat)) {
                                    echo "Berhasil";
                                } else {
                                    echo "Gagal ditambahkan";
                                }
                            } else {
                                echo "Periksa File";
                            }
                        } else {
                            echo "Terdapat kegagalan sistem";
                        }
                    }
                }
            } else {
                show_404();
            }
        }
    }

    public function hapus_kandidat($id_kegiatan = "", $id_kandidat = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Decode id
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id_kandidat = (int)base64_decode(base64_decode($id_kandidat));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                $kandidat = $this->All_model->cariKandidat($id_kandidat);
                if (!empty($cari) || !empty($kandidat)) {
                    if ($this->All_model->hapusKandidat($id_kandidat)) {
                        echo "Berhasil";
                    } else {
                        echo "Terjadi masalah pada sistem";
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }

    public function database_pemilih($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            include APPPATH . 'third_party/PHPExcel.php';
            // VARIABLE
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $id = $_SESSION['user_id'];
            // SEND DATA
            $group = $this->ion_auth_model->getGroup($id);
            $this->data['group'] = $group;
            $this->data['title'] = "ETIKA - Administrator Database Pemilih ETIKA";
            $this->data['active'] = "10";
            $this->data['kegiatan'] = $cari;
            $this->data['ckeditor'] = "false";
            $this->data['flip'] = "false";
            $this->data['pemilih'] =  $this->All_model->getAllPemilih($id_kegiatan);
            $this->data['id_kegiatan'] = $id_kegiatan;
            if (!empty($cari)) {
                if (isset($_POST['Submit']) && $_FILES["file"]['error'] != 4) {
                    if ($group[0]['group_id'] == "1" && new DateTime(date('Y-m-d H:i:s')) < new DateTime($cari[0]['waktu_mulai'])) {
                        $id_sistem = "etika";
                        $id_file = "excel";
                        $tujuan = "etika";
                        $upload = $this->All_model->uploadFile($id_file, $id_sistem, $tujuan);
                        if ($upload['result'] == "success") {
                            // Setelah file diupload, kemudian file excel dibaca,
                            $excelreader = new PHPExcel_Reader_Excel2007();
                            $loadexcel = $excelreader->load('assets/upload/Folder_etika/' . $upload['file']['file_name']); // Load file yang telah diupload ke folder excel
                            $data = array();
                            $sheet  = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
                            $numrow = 1;
                            foreach ($sheet as $row) {
                                if ($numrow > 1) {
                                    array_push($data, array(
                                        'id_kegiatan' => $id_kegiatan,
                                        'nama_pemilih' => $row['A'], // Insert data nama_pemilih dari kolom A di excel          
                                        'email' => $row['B'], // Insert data email dari kolom B di excel          
                                        'nim' => (int)$row['C'], // Insert data nim dari kolom C di excel
                                        'username' => (int)$row['C'] . '@evote.com',
                                        'prodi' => $row['D'],
                                        'semester' => $row['E']
                                    ));
                                }
                                $numrow++;
                            }
                            if ($this->All_model->inputPemilihExcel($data)) {
                                echo "berhasil";
                            } else {
                                echo "Gagal";
                            }
                            //delete file from server
                            unlink(realpath('assets/upload/Folder_etika/' . $upload['file']['file_name']));
                        } else {
                            echo "Gagal, kesalahan pada file";
                        }
                    } else {
                        show_404();
                    }
                } else {
                    $this->load->view('admin/master/header', $this->data);
                    $this->load->view('admin/page/etika/pemilih', $this->data);
                    $this->load->view('admin/master/footer', $this->data);
                }
            } else {
                show_404();
            }
        }
    }

    public function reset_all($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // VARIABLE
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $id = $_SESSION['user_id'];
            $group = $this->ion_auth_model->getGroup($id);
            if ($group[0]['group_id'] == "1" && new DateTime(date('Y-m-d H:i:s')) < new DateTime($cari[0]['waktu_mulai'])) {
                if (!empty($cari)) {
                    if ($this->All_model->resetAllPemilih($id_kegiatan)) {
                        echo "Berhasil direset";
                    } else {
                        echo "Kesalahan sistem";
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }
    public function unduh_excel($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            // VARIABLE
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $id = $_SESSION['user_id'];
            // SEND DATA
            $this->data['group'] = $this->ion_auth_model->getGroup($id);
            $this->data['kegiatan'] = $cari[0]['nama_kegiatan'];
            if (!empty($cari)) {
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=Data_Pemilih_Terdaftar.xls");
                $this->data['pendaftar'] = $this->All_model->getAllPemilih($id_kegiatan);
                $this->load->view('admin/page/etika/export_database_pemilih', $this->data);
            } else {
                show_404();
            }
        }
    }
    public function unduh_excel_manajemen($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            // VARIABLE
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $id = $_SESSION['user_id'];
            $group = $this->ion_auth_model->getGroup($id);
            // SEND DATA
            $this->data['group'] = $group;
            $this->data['kegiatan'] = $cari[0]['nama_kegiatan'];
            if (!empty($cari)) {
                if ($group[0]['group_id'] == "1" && new DateTime(date('Y-m-d H:i:s')) < new DateTime($cari[0]['waktu_mulai'])) {
                    header("Content-type: application/vnd.ms-excel");
                    header("Content-Disposition: attachment; filename=Data_Pemilih_Terdaftar.xls");
                    $this->data['pendaftar'] = $this->All_model->getAllPemilih($id_kegiatan);
                    $this->load->view('admin/page/etika/export_manajemen_evote', $this->data);
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }
    public function tambah_pemilih($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            // Send Data
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                $id = $_SESSION['user_id'];
                $this->data['group'] = $this->ion_auth_model->getGroup($id);
                $this->data['title'] = "ETIKA - Tambah Pemilih Manual ETIKA";
                $this->data['active'] = "10";
                $this->data['ckeditor'] = "etika";
                $this->data['flip'] = "false";
                // Form Validation
                $this->form_validation->set_rules('nim_pemilih', 'Nim Pemilih', 'required|integer');
                $this->form_validation->set_rules('nama_pemilih', 'Nama Pemilih', 'required|max_length[100]');
                $this->form_validation->set_rules('prodi', 'Prodi Pemilih', 'required');
                $this->form_validation->set_rules('semester', 'Nim Pemilih', 'required|integer');
                // If Validation False, return view
                if ($this->form_validation->run() == FALSE) {
                    if (!empty($cari)) {
                        $this->load->view('admin/master/header', $this->data);
                        $this->load->view('admin/page/etika/tambah_pemilih', $this->data);
                        $this->load->view('admin/master/footer', $this->data);
                    } else {
                        show_404();
                    }
                } else {
                    if ($this->All_model->cekDataPemilih($_POST['nama_pemilih'], $_POST['nim_pemilih'], $_POST['email_pemilih']) > 0) {
                        echo "Data Sudah Ada";
                    } else {
                        if ($this->All_model->inputDataPemilih($id_kegiatan)) {
                            echo "Berhasil Ditambahkan";
                        } else {
                            echo "Kegagalan Sistem";
                        }
                    }
                }
            } else {
                show_404();
            }
        }
    }

    public function ubah_pemilih($id_kegiatan = "", $id_pemilih = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Decode id
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id_pemilih = (int)base64_decode(base64_decode($id_pemilih));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $pemilih = $this->All_model->cariPemilih($id_pemilih);
            if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                // Send Data to views
                $id = $_SESSION['user_id'];
                $this->data['pemilih'] = $pemilih;
                $this->data['group'] = $this->ion_auth_model->getGroup($id);
                $this->data['title'] = "ETIKA - Ubah Pemilih ETIKA";
                $this->data['active'] = "10";
                $this->data['ckeditor'] = "etika";
                $this->data['flip'] = "false";
                // Form Validation
                $this->form_validation->set_rules('nim_pemilih', 'Nim Pemilih', 'required|integer');
                $this->form_validation->set_rules('nama_pemilih', 'Nama Pemilih', 'required|max_length[100]');
                $this->form_validation->set_rules('prodi', 'Prodi Pemilih', 'required');
                $this->form_validation->set_rules('semester', 'Nim Pemilih', 'required|integer');
                // If Validation False, return view
                if ($this->form_validation->run() == FALSE) {
                    if (!empty($cari) || !empty($pemilih)) {
                        $this->load->view('admin/master/header', $this->data);
                        $this->load->view('admin/page/etika/ubah_pemilih', $this->data);
                        $this->load->view('admin/master/footer', $this->data);
                    } else {
                        show_404();
                    }
                } else {
                    if ($_POST['nim_pemilih'] != $pemilih[0]['nim']) {
                        if ($this->All_model->cekNimPemilihWhere($_POST['nim_pemilih']) > 0) {
                            echo "Nim Sudah Terpakai";
                            redirect('etika/ubah_pemilih/' . base64_encode(base64_encode($id_kegiatan)) . '/' . base64_encode(base64_encode($id_pemilih)));
                        } else {
                            $nim_baru = $_POST['nim_pemilih'];
                        }
                    } else {
                        $nim_baru = $pemilih[0]['nim'];
                    }
                    if ($_POST['nama_pemilih'] != $pemilih[0]['nama_pemilih']) {
                        if ($this->All_model->cekNamaPemilihWhere($_POST['nama_pemilih']) > 0) {
                            echo "Nama Sudah Terpakai";
                            redirect('etika/ubah_pemilih/' . base64_encode(base64_encode($id_kegiatan)) . '/' . base64_encode(base64_encode($id_pemilih)));
                        } else {
                            $nama_baru = $_POST['nama_pemilih'];
                        }
                    } else {
                        $nama_baru = $pemilih[0]['nama_pemilih'];
                    }
                    if ($_POST['email_pemilih'] != $pemilih[0]['email']) {
                        if ($this->All_model->cekEmailPemilihWhere($_POST['email_pemilih']) > 0) {
                            echo "Email Sudah Terpakai";
                            redirect('etika/ubah_pemilih/' . base64_encode(base64_encode($id_kegiatan)) . '/' . base64_encode(base64_encode($id_pemilih)));
                        } else {
                            $email_baru = $_POST['email_pemilih'];
                        }
                    } else {
                        $email_baru = $pemilih[0]['email'];
                    }
                    if ($this->All_model->updateDataPemilih($nim_baru, $nama_baru, $email_baru, $id_pemilih)) {
                        echo "Benar";
                    } else {
                        echo "Gagal";
                    }
                }
            } else {
                show_404();
            }
        }
    }

    public function hapus_pemilih($id_kegiatan = "", $id_pemilih = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Decode id
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id_pemilih = (int)base64_decode(base64_decode($id_pemilih));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                $pemilih = $this->All_model->cariPemilih($id_pemilih);
                if (!empty($cari) || !empty($pemilih)) {
                    if ($this->All_model->hapusPemilih($id_pemilih)) {
                        echo "Berhasil";
                    } else {
                        echo "Terjadi masalah pada sistem";
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }
    public function manajemen_evote($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            // Variabel
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $id = $_SESSION['user_id'];
            $group =  $this->ion_auth_model->getGroup($id);
            // Send Data
            $this->data['group'] = $group;
            $this->data['title'] = "ETIKA - Administrator Kandidat ETIKA";
            $this->data['active'] = "10";
            $this->data['kegiatan'] = $cari;
            $this->data['ckeditor'] = "etika";
            $this->data['flip'] = "false";
            $this->data['pemilih'] =  $this->All_model->getAllPemilih($id_kegiatan);
            $this->data['id_kegiatan'] = $id_kegiatan;
            $this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai Token', 'required|min_length[19]');
            $this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai Token', 'required|min_length[19]');
            // If Validation False, return view
            if ($this->form_validation->run() == FALSE) {
                if (!empty($cari)) {
                    $this->load->view('admin/master/header', $this->data);
                    $this->load->view('admin/page/etika/manajemen_evote', $this->data);
                    $this->load->view('admin/master/footer', $this->data);
                } else {
                    show_404();
                }
            } else {
                if ($cari[0]['mode'] == "1" && !empty($_POST) && new DateTime(date('Y-m-d H:i:s')) < new DateTime($cari[0]['waktu_mulai']) && $group[0]['group_id'] == "1") {
                    if (new Datetime($_POST['waktu_mulai']) <= new Datetime(date('Y-m-d H:i:s')) || new Datetime($_POST['waktu_selesai']) <= new Datetime(date('Y-m-d H:i:s'))) {
                        echo "Waktu harus lebih dari waktu sekarang";
                    } else if (new Datetime($_POST['waktu_mulai']) >= new Datetime($_POST['waktu_selesai']) || new Datetime($_POST['waktu_selesai']) <= new Datetime($_POST['waktu_mulai'])) {
                        echo "Selisih tidak boleh minus atau nol";
                    } else if (new Datetime($_POST['waktu_mulai']) > new Datetime($cari[0]['waktu_mulai']) || new Datetime($_POST['waktu_selesai']) > new Datetime($cari[0]['waktu_selesai']) || new Datetime($_POST['waktu_selesai']) < new Datetime($cari[0]['waktu_mulai'])) {
                        echo "Sesuaikan dengan jadwal Kegiatan";
                    } else {
                        // Create Token and Duration
                        $data = array();
                        $sheet  = $this->All_model->getAllPemilih($id_kegiatan);
                        $string = "0123456789bcdfghjklmnpqrstvwxyz";
                        foreach ($sheet as $row) {
                            array_push(
                                $data,
                                array(
                                    'id_pemilih' => $row['id_pemilih'],
                                    'token' => substr(str_shuffle($string), 0, 12),
                                    'token_valid_start' => $_POST['waktu_mulai'],
                                    'token_valid_until' => $_POST['waktu_selesai'],
                                    'manage_by' => $group[0]['first_name'],
                                )
                            );
                        }
                        if ($this->All_model->createAllToken($data)) {
                            echo "berhasil";
                        } else {
                            echo "Gagal";
                        }
                    }
                } else {
                    show_404();
                }
            }
        }
    }
    public function generate_token_manual($id_kegiatan = "", $id_pemilih = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            // Decode id
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id_pemilih = (int)base64_decode(base64_decode($id_pemilih));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $pemilih = $this->All_model->cariPemilih($id_pemilih);
            $user =  $this->ion_auth_model->getGroup($_SESSION['user_id']);
            if (!empty($cari) || !empty($pemilih)) {
                // Create Token and Duration
                if (new DateTime(date('Y-m-d H:i:s')) >= new DateTime($cari[0]['waktu_mulai'])  && new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                    $string = "0123456789bcdfghjklmnpqrstvwxyz";
                    $token = substr(str_shuffle($string), 0, 12);
                    // Token Akan Aktif selama 2 jam, jika ingin mengganti, ganti 120 menjadi menit yang diinginkan
                    $time = date('Y-m-d H:i:s', time() + (60 * lama_token));
                    if ($cari[0]['mode'] == "1") {
                        if (empty($pemilih[0]['token'])) {
                            if ($this->All_model->createTokenManualMode($token, $id_pemilih, $user[0]['first_name'], $time)) {
                                echo "Token Berhasil di Generate";
                            }
                        } else {
                            echo "Tidak dapat mengenerate ulang token, silahkan Reset Token";
                        }
                    } else {
                        if (empty($pemilih[0]['token'])) {
                            // Content Email
                            $data = [
                                'identity' => $pemilih[0]['email'],
                                'username' => $pemilih[0]['username'],
                                'token_code' => $token,
                                'kegiatan' => $cari[0]['nama_kegiatan'],
                                'time' => $time . ' WITA',
                                'id_kegiatan' => $id_kegiatan,
                            ];
                            $template = $this->config->item('email_token', 'ion_auth');
                            $email = $pemilih[0]['email'];
                            // End Content Email
                            if ($this->send_mail($data, $template, $email)) {
                                if ($this->All_model->createTokenManual($token, $time, $id_pemilih, $user[0]['first_name'])) {
                                    echo "Token Berhasil di Generate";
                                }
                            }
                        } else {
                            echo "Tidak dapat mengenerate ulang token, silahkan Reset Token";
                        }
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }
    public function reset_token($id_kegiatan = "", $id_pemilih = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(etika)) {
            redirect('etika/home', 'refresh');
        } else {
            // Decode id
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $id_pemilih = (int)base64_decode(base64_decode($id_pemilih));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $pemilih = $this->All_model->cariPemilih($id_pemilih);
            if (!empty($cari) || !empty($pemilih)) {
                if (new DateTime(date('Y-m-d H:i:s')) >= new DateTime($cari[0]['waktu_mulai'])  && new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                    if ($cari[0]['mode'] == "1") {
                        if (!empty($pemilih[0]['token'])) {
                            if ($this->All_model->updateTokenManualMode($id_pemilih)) {
                                echo "Berhasil di reset";
                            } else {
                                echo "Gagal Di reset";
                            }
                        } else {
                            echo "Tidak dapat mengenerate ulang token, silahkan Reset Token";
                        }
                    } else {
                        if (!empty($pemilih[0]['token'])) {
                            if ($this->All_model->updateTokenManual($id_pemilih)) {
                                echo "Berhasil di reset";
                            } else {
                                echo "Gagal Di reset";
                            }
                        } else {
                            echo "Tidak dapat mengenerate ulang token, silahkan Reset Token";
                        }
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }
    public function reset_all_token($id_kegiatan = "")
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('etika/home', 'refresh');
        } else {
            // Decode id
            $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $id = $_SESSION['user_id'];
            $group =  $this->ion_auth_model->getGroup($id);
            if ($group[0]['group_id'] == "1" && new DateTime(date('Y-m-d H:i:s')) < new DateTime($cari[0]['waktu_mulai'])) {
                if (!empty($cari)) {
                    if ($this->All_model->resetTokenAll($id_kegiatan)) {
                        echo "Berhasil di reset";
                    } else {
                        echo "Gagal Di reset";
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        }
    }

    // Function Send Mail Token
    public function send_mail($data = "", $template = "", $to_email = "")
    {
        $this->load->library('encrypt');
        $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $template, $data, TRUE);
        $this->email->clear();
        $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
        $this->email->to($to_email);
        $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - Username dan Token Pemilihan');
        $this->email->message($message);
        $this->email->set_newline("\r\n");
        if ($this->email->send()) {
            return TRUE;
        } else {
            echo $this->email->print_debugger();
        }
    }
















    // Halaman User
    // Method Getter Email
    public function getEmailAdmin()
    {
        return $this->email_admin;
    }
    public function home()
    {
        $this->data['title'] = "Beranda";
        $this->data['kegiatan'] = $this->All_model->getAllKegiatanEtika();
        $this->data['body'] = 1;
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('nim', 'NIM', 'required|integer');
            $this->form_validation->set_rules('prodi', 'Prodi', 'required');
        } else if (isset($_POST['send'])) {
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject Pesan', 'required|max_length[250]');
            $this->form_validation->set_rules('message', 'Pesan Kamu', 'required|max_length[600]');
        }
        // If Validation False, return view
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('guest/etika/master/header', $this->data);
            $this->load->view('guest/etika/page/index', $this->data);
            $this->load->view('guest/etika/master/footer-home', $this->data);
        } else {
            if (isset($_POST['submit'])) {
                if ($_POST['prodi'] == "05") {
                    $prodi = "Pendidikan Teknik Informatika";
                } else if ($_POST['prodi'] == "02") {
                    $prodi = "Manajemen Informatika";
                } else if ($_POST['prodi'] == "09") {
                    $prodi = "Sistem Informasi";
                } else {
                    $prodi = "Ilmu Komputer";
                }
                $cek_hak_pilih = $this->All_model->getUserCekHakPilih($prodi, $_POST['nim']);
                $this->data['cek'] = $cek_hak_pilih;
                if (!empty($cek_hak_pilih)) {
                    $this->session->set_flashdata('ditemukan', $this->data['cek']);
                    return redirect('etika/home', 'refresh');
                } else {
                    $this->session->set_flashdata('tidak-ditemukan', "Anda Tidak Terdaftar Pada Kegiatan Manapun");
                    return redirect('etika/home', 'refresh');
                }
            } else if (isset($_POST['send'])) {
                $ip = $this->input->ip_address();
                $message = "[ Email Pengirim : " . $_POST['email'] . ", IP Address : " . $ip . " ] ~ " . $_POST['message'];
                $this->load->library('encrypt');
                $this->email->clear();
                $this->email->from($_POST['email'], "Dari [ " . $_POST['name'] . " ]");
                $this->email->to($this->getEmailAdmin());
                $this->email->subject($_POST['subject'] . ' - Help Desk SSO HMJ TI Undiksha');
                $this->email->message($message);
                $this->email->set_newline("\r\n");
                if ($this->email->send()) {
                    $this->session->set_flashdata('berhasil', "Dikirim");
                    return redirect('etika/home', 'refresh');
                } else {
                    $this->session->set_flashdata('gagal', 'Dikirim');
                    echo $this->email->print_debugger();
                    return redirect('admin', 'refresh');
                }
            }
        }
    }
    public function voting_kegiatan()
    {
        $this->data['title'] = "Daftar Kegiatan";
        $this->data['body'] = 2;
        $this->data['kegiatan'] = $this->All_model->getAllKegiatanEtika();
        $this->load->view('guest/etika/master/header', $this->data);
        $this->load->view('guest/etika/page/kegiatan', $this->data);
        $this->load->view('guest/etika/master/footer', $this->data);
    }
    public function login_kegiatan($id_kegiatan = "")
    {
        $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
        $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
        $this->data['title'] = "Login Kegiatan ETIKA";
        $this->data['kegiatan'] = $cari;
        $this->data['body'] = 3;
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('token', 'Token', 'required');
        if ($this->form_validation->run() == FALSE) {
            if (!empty($cari)) {
                if (!empty($this->session->userdata('id_pemilih'))) {
                    redirect('etika/dashboard', 'refresh');
                } else {
                    $this->load->view('guest/etika/master/header', $this->data);
                    $this->load->view('guest/etika/page/login-token', $this->data);
                    $this->load->view('guest/etika/master/footer', $this->data);
                }
            } else {
                show_404();
            }
        } else {
            if (isset($_POST['submit'])) {

                $pemilih = $this->All_model->cekEmailLoginPemilih($_POST['email'], $id_kegiatan);
                if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
                    if (!empty($pemilih)) {
                        if ($pemilih[0]['login_attempt'] > 4) {
                            $time = date('Y-m-d H:i:s');
                            // Jika user salah masuk sebanyak lebih dari 4 kali, maka block
                            $this->All_model->blockPemilih($pemilih[0]['id_pemilih'], $time);
                            echo "Anda Terblokir, Tunggu Beberapa Menit Lagi";
                        } else {
                            $date = date_create(date($pemilih[0]['block_time']));
                            // Set block selama 300 detik atau 5 menit
                            date_add($date, date_interval_create_from_date_string(lama_blokir));
                            $cek_block = new Datetime(date_format($date, 'Y-m-d H:i:s'));
                            // Cek apakah waktu saat ini masih kurang dari sama dengan waktu block atau kolom block time itu tidak kosong (ada isinya) yang bermakna terblokir
                            if (!empty($pemilih[0]['block_time']) && new DateTime(date('Y-m-d H:i:s')) <= $cek_block) {
                                echo "Anda Terblokir, Tunggu Beberapa Menit Lagi";
                            } else {
                                $this->All_model->unblockPemilih($pemilih[0]['id_pemilih']);
                                if (!empty($pemilih[0]['token'])) {
                                    if ($_POST['token'] == $pemilih[0]['token']) {
                                        if (new DateTime(date('Y-m-d H:i:s')) <= new DateTime($pemilih[0]['token_valid_until']) && $pemilih[0]['has_voting'] == 0) {
                                            // Buat Session Login Untuk User, Redirect kehalaman Administrator
                                            $this->session->set_userdata('nama_pemilih', $pemilih[0]['nama_pemilih']);
                                            $this->session->set_userdata('id_pemilih', $pemilih[0]['id_pemilih']);
                                            $this->session->set_userdata('id_kegiatan', $pemilih[0]['id_kegiatan']);
                                            redirect('etika/dashboard', 'refresh');
                                        } else {
                                            echo "Token Sudah Invalid atau Token Sudah Digunakan";
                                        }
                                    } else {
                                        $attempt = $pemilih[0]['login_attempt'] + 1;
                                        $this->All_model->loginAttempt($pemilih[0]['id_pemilih'], $attempt);
                                        echo "Token Salah";
                                    }
                                } else {
                                    echo "Token Belum di Generate";
                                }
                            }
                        }
                    } else {
                        echo "Username Salah";
                    }
                } else {
                    echo "Waktu Voting Telah Berakhir";
                }
            }
        }
    }
    public function verifikasi_akun($id_kegiatan = "")
    {
        $id_kegiatan = (int)base64_decode(base64_decode($id_kegiatan));
        $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
        $this->data['title'] = "Verifikasi Akun ETIKA";
        $this->data['kegiatan'] = $cari;
        $this->data['body'] = 4;
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required|integer');
        $this->form_validation->set_rules('semester', 'Semester', 'required|integer');
        if (new DateTime(date('Y-m-d H:i:s')) >= new DateTime($cari[0]['waktu_mulai']) && new DateTime(date('Y-m-d H:i:s')) <= new DateTime($cari[0]['waktu_selesai'])) {
            if ($this->form_validation->run() == FALSE) {
                if (!empty($cari)) {
                    $this->load->view('guest/etika/master/header', $this->data);
                    $this->load->view('guest/etika/page/verifikasi-akun', $this->data);
                    $this->load->view('guest/etika/master/footer', $this->data);
                } else {
                    show_404();
                }
            } else {
                var_dump($_POST);
            }
        } else {
            show_404();
        }
    }
    public function dashboard()
    {
        if (!empty($this->session->userdata('id_pemilih')) || !empty($this->session->userdata('id_kegiatan'))) {
            $id_kegiatan = $this->session->userdata('id_kegiatan');
            $id_pemilih = $this->session->userdata('id_pemilih');
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $this->data['title'] = "Dashboard Pemilihan ETIKA";
            $this->data['kegiatan'] = $cari;
            $this->data['kandidat'] = $this->All_model->getAllKandidat($id_kegiatan);
            $this->data['pemilih'] = $this->All_model->cariPemilih($id_pemilih);
            if (!empty($cari)) {
                $this->load->view('guest/etika/master/header-dashboard', $this->data);
                $this->load->view('guest/etika/page/administrator', $this->data);
                $this->load->view('guest/etika/master/footer-dashboard', $this->data);
            } else {
                show_404();
            }
        } else {
            redirect('etika/voting_kegiatan', 'refresh');
        }
    }
    public function save_vote($id_kandidat = "")
    {
        if (!empty($this->session->userdata('id_pemilih')) || !empty($this->session->userdata('id_kegiatan'))) {
            $id_kegiatan = $this->session->userdata('id_kegiatan');
            $id_pemilih = $this->session->userdata('id_pemilih');
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $cari_kandidat = $this->All_model->cariKandidat(base64_decode(base64_decode($id_kandidat)));
            $pemilih = $this->All_model->cariPemilih($id_pemilih);
            $this->data['title'] = "Dashboard Pemilihan ETIKA";
            $this->data['kegiatan'] = $cari;
            $this->data['kandidat'] = $this->All_model->getAllKandidat($id_kegiatan);
            $this->data['pemilih'] = $pemilih;
            if (
                !empty($cari) && $pemilih[0]['has_voting'] == 0 && !empty($cari_kandidat)
            ) {
                if ($this->All_model->saveVote(base64_decode(base64_decode($id_kandidat)), $id_pemilih, $id_kegiatan, $this->input->ip_address()) && $this->All_model->updateVote($id_pemilih)) {
                    redirect("etika/dashboard", 'refresh');
                } else {
                    echo "Gagal Melakukan Voting";
                }
            } else {
                show_404();
            }
        } else {
            redirect('etika/voting_kegiatan', 'refresh');
        }
    }
    public function logout()
    {
        if (!empty($this->session->userdata('id_pemilih')) || !empty($this->session->userdata('id_kegiatan'))) {
            $id_kegiatan = $this->session->userdata('id_kegiatan');
            $id_pemilih = $this->session->userdata('id_pemilih');
            $cari = $this->All_model->getAllKegiatanEtikaWhere($id_kegiatan);
            $this->data['pemilih'] = $this->All_model->cariPemilih($id_pemilih);
            if (!empty($cari)) {
                // unset session
                $this->session->unset_userdata(['id_pemilih', 'id_kegiatan', 'nama_pemilih']);
                // Destroy the session
                $this->session->sess_destroy();
                redirect('etika/voting_kegiatan', 'refresh');
            } else {
                show_404();
            }
        } else {
            redirect('etika/voting_kegiatan', 'refresh');
        }
    }
}