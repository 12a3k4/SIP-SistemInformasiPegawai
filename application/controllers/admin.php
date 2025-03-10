<?php
if (!defined('BASEPATH'))
  exit(header('Location:../'));
class Admin extends CI_controller
{
  function __construct()
  {
    parent::__construct();
    // error_reporting(0);
    if ($this->session->userdata('admin') != TRUE) {
      redirect(base_url(''));
      exit;
    }
    ;
    $this->load->model('m_admin');
  }

  public function index()
  {
    $x = array('judul' => 'Halaman Administrator');
    /*$table_to_count = ['pegawai','']
    for ($i=0; $i <=count($table_to_count) ; $i++) { 
      $count_data[i]=$this->m_admin->count_data($table);
    }*/
    tpl('admin/home', $x);
  }

  public function jabatan()
  {
    $x = array(
      'judul' => 'Data Jabatan',
      'data' => $this->db->get('jabatan')->result_array()
    );
    tpl('admin/jabatan', $x);
  }

  public function jabatan_tambah()
  {
    $x = array(
      'judul' => 'Tambah Data Jabatan',
      'aksi' => 'tambah',
      'nama_jabatan' => "",
      'golongan' => ""
      // 'tunjangan' => ""
    );
    if (isset($_POST['kirim'])) {
      $inputData = array(
        'nama_jabatan' => $this->input->post('nama_jabatan'),
        'golongan' => $this->input->post('golongan')
        // 'tunjangan' => $this->input->post('tunjangan')
      );
      $cek = $this->db->insert('jabatan', $inputData);
      if ($cek) {
        $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Ditambahkan.
              </div>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('admin/jabatan'));
      } else {
        echo "ERROR input Data";
      }
    } else {
      tpl('admin/jabatan_form', $x);
    }
  }

  public function jabatan_edit($id = '')
  {
    $sql = $this->db->get_where('jabatan', array('id_jabatan' => $id))->row_array();
    $x = array(
      'judul' => 'Tambah Data Jabatan',
      'aksi' => 'tambah',
      'nama_jabatan' => $sql['nama_jabatan'],
      'golongan' => $sql['golongan']
      // 'tunjangan' => $sql['tunjangan']
    );
    if (isset($_POST['kirim'])) {
      $inputData = array(
        'nama_jabatan' => $this->input->post('nama_jabatan'),
        'golongan' => $this->input->post('golongan')
        // 'tunjangan' => $this->input->post('tunjangan')
      );
      $cek = $this->db->update('jabatan', $inputData, array('id_jabatan' => $id));
      if ($cek) {
        $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Diedit.
              </div>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('admin/jabatan'));
      } else {
        echo "ERROR input Data";
      }
    } else {
      tpl('admin/jabatan_form', $x);
    }
  }


  public function jabatan_hapus($id = '')
  {
    $cek = $this->db->delete('jabatan', array('id_jabatan' => $id));
    if ($cek) {
      $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
      $this->session->set_flashdata('pesan', $pesan);
      redirect(base_url('admin/jabatan'));
    }
  }

public function jabatan_count()
{
    // Rincian jabatan
    $jabatan_rincian = [
        26 => 'ANGGOTA WANTIMPRES',
        27 => 'SEKRETARIS ANGGOTA WANTIMPRES',
        5 => 'PTT',
        6 => 'PTT',
        7 => 'PTT',
        8 => 'Staff Pendukung',
        9 => 'Staff Pendukung',
        12 => 'Staff Pendukung',
        16 => 'Staff Pendukung',
        20 => 'Staff Pendukung',
        21 => 'Outsource',
        22 => 'Outsource',
        23 => 'Outsource',
        24 => 'Magang',
        25 => 'Magang'
    ];

    $data = [];
    
    foreach ($jabatan_rincian as $id => $nama) {
        // Hitung pegawai aktif
        $aktif = $this->db->where('id_jabatan', $id)->where('status_kep', 'Aktif')->count_all_results('pegawai');
        // Hitung pegawai non-aktif
        $non_aktif = $this->db->where('id_jabatan', $id)->where('status_kep', 'Non-Aktif')->count_all_results('pegawai');

        $data[] = [
            'jabatan' => $nama,
            'aktif' => $aktif,
            'non_aktif' => $non_aktif
        ];
    }

    $x = array('judul' => 'Jumlah Pegawai Berdasarkan Jabatan', 'data' => $data);
    tpl('admin/home', $x); // Menggunakan tampilan home.php untuk menampilkan data
}

  public function pegawai($value = '')
  {
    $x = array(
      'judul' => ':: Data Pegawai ::',
      'data' => $this->m_admin->pegawai(),
    );
    tpl('admin/pegawai', $x);
  }

  public function ls_pegawai($value = '')
  {
    $data = $this->m_admin->pegawai()->row_array();
    echo json_encode($data);
  }

  public function pegawai_tambah($value = '')
  {
    $x = array(
      'judul' => 'Tambah Data Pegawai',
      'aksi' => 'Tambah',
      'jabatan' => $this->db->get('jabatan')->result_array(),
      // Initialize all fields
      'id_jabatan' => '',
      'nip' => '',
      'nik' => '',
      'nama' => '',
      'jk' => '',
      'ket_jabatan' => '',
      'foto' => 'placeholder.png',
      'tempat_lhr' => '',
      'tanggal_lhr' => '',
      'agama' => '',
      'pendidikan' => '',
      'status_kep' => '',
      'tgl_masuk' => '',
      'sk_masuk' => '',
      'tgl_keluar' => '',
      'sk_keluar' => '',
      'alamat' => '',
      'kk' => 'placeholder.png',
      'ktp_sim' => 'placeholder.png',
      'id_card' => 'placeholder.png',
      'username' => '',
      'dok_sk_masuk' => NULL,
      'dok_sk_keluar' => NULL,
      'cv' => NULL,
      'dok_lainnya' => NULL
    );

    if (isset($_POST['kirim'])) {
      $config['upload_path'] = FCPATH . 'template/data/';
      $config['allowed_types'] = 'bmp|jpg|png|jpeg|pdf';
      $config['max_size'] = 5120; // 5MB
      $this->load->library('upload', $config);

      $upload_errors = [];
      $SQLinsert = [];

      // Handle File Uploads (images + PDFs)
      $file_fields = [
        'gambar' => 'foto',
        'kk' => 'kk',
        'ktp_sim' => 'ktp_sim',
        'id_card' => 'id_card',
        'dok_sk_masuk' => 'dok_sk_masuk',
        'dok_sk_keluar' => 'dok_sk_keluar',
        'cv' => 'cv',
        'dok_lainnya' => 'dok_lainnya'
      ];

      foreach ($file_fields as $field => $db_column) {
        if (!empty($_FILES[$field]['name'])) {
          $config['file_name'] = $db_column . '_' . time();
          $this->upload->initialize($config);
          if ($this->upload->do_upload($field)) {
            $upload_data = $this->upload->data();
            $SQLinsert[$db_column] = (string) $upload_data['file_name'];
          } else {
            $upload_errors[] = ucfirst($db_column) . ': ' . $this->upload->display_errors();
          }
        } else {
          // Set default only for image fields
          if (in_array($db_column, ['foto', 'kk', 'ktp_sim', 'id_card'])) {
            $SQLinsert[$db_column] = NULL;
          } else {
            $SQLinsert[$db_column] = 'placeholder.png';
          }
        }
      }


      // Validate and Sanitize Post Data
      $post_fields = [
        'id_jabatan',
        'nip',
        'nama',
        'jk',
        'ket_jabatan',
        'tempat_lhr',
        'tanggal_lhr',
        'agama',
        'pendidikan',
        'status_kep',
        'tgl_masuk',
        'sk_masuk',
        'tgl_keluar',
        'sk_keluar',
        'alamat',
        'username'
      ];

      foreach ($post_fields as $field) {
        $value = $this->input->post($field, TRUE);
        if (is_array($value)) {
          die("Invalid array value received for field: $field");
        }
        $SQLinsert[$field] = $value;
      }

      // Password Handling
      $password = $this->input->post('password', TRUE);
      if (!empty($password)) {
        $SQLinsert['password'] = password_hash($password, PASSWORD_DEFAULT);
      }

      if ($this->db->insert('pegawai', $SQLinsert)) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data berhasil ditambahkan</div>');
        redirect(base_url('admin/pegawai'));
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal menyimpan data</div>');
        redirect('admin/pegawai_tambah');
      }
    } else {
      tpl('admin/pegawai_form', $x);
    }
  }

  public function pegawai_edit($id = '')
  {
    $data = $this->db->get_where('pegawai', array('id_pegawai' => $id))->row_array();
    $x = array(
      'aksi' => 'edit',
      'judul' => 'Edit Data Pegawai',
      'jabatan' => $this->db->get('jabatan')->result_array(),
      'id_jabatan' => $data['id_jabatan'],
      'nip' => $data['nip'],
      'nik' => $data['nik'],
      'nama' => $data['nama'],
      'jk' => $data['jk'],
      'ket_jabatan' => $data['ket_jabatan'],
      'foto' => $data['foto'],
      'tempat_lhr' => $data['tempat_lhr'],
      'tanggal_lhr' => $data['tanggal_lhr'],
      'agama' => $data['agama'],
      'pendidikan' => $data['pendidikan'],
      'status_kep' => $data['status_kep'],
      'tgl_masuk' => $data['tgl_masuk'],
      'sk_masuk' => $data['sk_masuk'],
      'tgl_keluar' => $data['tgl_keluar'],
      'sk_keluar' => $data['sk_keluar'],
      'alamat' => $data['alamat'],
      'kk' => $data['kk'],
      'ktp_sim' => $data['ktp_sim'],
      'id_card' => $data['id_card'],
      'username' => $data['username'],
      'dok_sk_masuk' => $data['dok_sk_masuk'],
      'dok_sk_keluar' => $data['dok_sk_keluar'],
      'cv' => $data['cv'],
      'dok_lainnya' => $data['dok_lainnya']
    );

    if (isset($_POST['kirim'])) {
      $config['upload_path'] = FCPATH . 'template/data/';
      $config['allowed_types'] = 'bmp|jpg|png|jpeg|pdf';
      $config['max_size'] = 5120;
      $this->load->library('upload', $config);

      $upload_errors = [];
      $SQLupdate = [];

      // Handle File Uploads
      $file_fields = [
        'gambar' => 'foto',
        'kk' => 'kk',
        'ktp_sim' => 'ktp_sim',
        'id_card' => 'id_card',
        'dok_sk_masuk' => 'dok_sk_masuk',
        'dok_sk_keluar' => 'dok_sk_keluar',
        'cv' => 'cv',
        'dok_lainnya' => 'dok_lainnya'
      ];

      foreach ($file_fields as $field => $db_column) {
        if (!empty($_FILES[$field]['name'])) {
          $config['file_name'] = $db_column . '_' . time();
          $this->upload->initialize($config);
          if ($this->upload->do_upload($field)) {
            $upload_data = $this->upload->data();
            $SQLupdate[$db_column] = (string) $upload_data['file_name'];
            // Delete old file if exists
            if (!empty($data[$db_column]) && $data[$db_column] != 'placeholder.png') {
              @unlink(FCPATH . 'template/data/' . $data[$db_column]);
            }
          } else {
            $upload_errors[] = ucfirst($db_column) . ': ' . $this->upload->display_errors();
          }
        }
      }

      if (!empty($upload_errors)) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">' . implode('<br>', $upload_errors) . '</div>');
        redirect('admin/pegawai_edit/' . $id);
        return;
      }

      // Collect other form data
      $post_fields = [
        'id_jabatan',
        'nip',
        'nik',
        'nama',
        'jk',
        'ket_jabatan',
        'tempat_lhr',
        'tanggal_lhr',
        'agama',
        'pendidikan',
        'status_kep',
        'tgl_masuk',
        'sk_masuk',
        'tgl_keluar',
        'sk_keluar',
        'alamat',
        'username'
      ];

      foreach ($post_fields as $field) {
        $SQLupdate[$field] = $this->input->post($field, TRUE);
      }

      // Password update if provided
      $password = $this->input->post('password', TRUE);
      if (!empty($password)) {
        $SQLupdate['password'] = password_hash($password, PASSWORD_DEFAULT);
      }

      // Update the database
      $this->db->where('id_pegawai', $id);
      if ($this->db->update('pegawai', $SQLupdate)) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data berhasil diperbarui</div>');
        redirect(base_url('admin/pegawai'));
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gagal memperbarui data</div>');
        redirect('admin/pegawai_edit/' . $id);
      }
    } else {
      tpl('admin/pegawai_form', $x);
    }
  }

  public function pegawai_hapus($id = '')
  {
    $foto = $this->db->get_where('pegawai', array('id_pegawai' => $id))->row_array();
    if ($foto['foto'] != "") {
      @unlink('template/data/' . $foto['foto']);
    } else {
    }

    $cek = $this->db->delete('pegawai', array('id_pegawai' => $id));
    if ($cek) {
      $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
      $this->session->set_flashdata('pesan', $pesan);
      redirect(base_url('admin/pegawai'));
    }
  }

public function download_excel()
{
    // Load model
    $this->load->model('m_admin');

    // Ambil data pegawai
    $data = $this->m_admin->pegawai()->result_array();

    // Set header untuk file CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data_pegawai.csv"');

    // Buat output
    $output = fopen('php://output', 'w');

    // Tulis header kolom
    fputcsv($output, ['No', 'NIP', 'Nama', 'Jenis Kelamin', 'Agama', 'Foto', 'Nama Jabatan', 'Tempat, Tanggal Lahir', 'Status Kepegawaian', 'Alamat Lengkap']);

    // Tulis data pegawai
    $no = 1;
    foreach ($data as $admin) {
        // Siapkan data untuk setiap kolom
        $row = [
            $no,
            $admin['nip'],
            $admin['nama'],
            $admin['jk'] == "L" ? "Laki-Laki" : "Perempuan",
            $admin['agama'],
            $admin['foto'], // Anda bisa mengubah ini jika ingin menampilkan URL atau nama file
            $admin['nama_jabatan'] . (isset($admin['golongan']) ? ' - ' . $admin['golongan'] : '') . (isset($admin['ket_jabatan']) ? ' - ' . $admin['ket_jabatan'] : ''),
            $admin['tempat_lhr'] . (isset($admin['tanggal_lhr']) ? ', ' . date('j F Y', strtotime($admin['tanggal_lhr'])) : ''),
            $admin['status_kep'],
            $admin['alamat']
        ];

        // Tulis baris data ke file CSV
        fputcsv($output, $row);
        $no++;
    }

    fclose($output);
    exit();
}

public function download_jabatan_csv()
{
    // Load model if necessary
    $this->load->model('m_admin');

    // Ambil data jabatan
    $jabatan_data = $this->db->get('jabatan')->result_array();

    // Set header untuk file CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data_jabatan.csv"');

    // Buat output
    $output = fopen('php://output', 'w');

    // Tulis header kolom
    fputcsv($output, ['Nama Jabatan', 'Golongan', 'Jumlah Pegawai Aktif', 'Jumlah Pegawai Non-Aktif']);

    foreach ($jabatan_data as $jabatan) {
        $id_jabatan = $jabatan['id_jabatan'];
        $nama_jabatan = $jabatan['nama_jabatan'];
        $golongan = $jabatan['golongan'];

        // Hitung pegawai aktif
        $jumlah_aktif = $this->db->where('id_jabatan', $id_jabatan)->where('status_kep', 'Aktif')->count_all_results('pegawai');
        // Hitung pegawai non-aktif
        $jumlah_non_aktif = $this->db->where('id_jabatan', $id_jabatan)->where('status_kep', 'Non-Aktif')->count_all_results('pegawai');

        // Tulis data jabatan ke file CSV
        fputcsv($output, [$nama_jabatan, $golongan, $jumlah_aktif, $jumlah_non_aktif]);
    }

    fclose($output);
    exit();
}

public function pegawai_print($id = '')
{
    // Ambil data pegawai berdasarkan id
    $data = $this->db->get_where('pegawai', array('id_pegawai' => $id))->row_array();
    
    // Pastikan data pegawai ditemukan
    if (!$data) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data pegawai tidak ditemukan.</div>');
        redirect('admin/pegawai');
    }

    // Ambil nama jabatan dari tabel jabatan
    $jabatan = $this->db->get_where('jabatan', array('id_jabatan' => $data['id_jabatan']))->row_array();
    $data['nama_jabatan'] = $jabatan['nama_jabatan'];
    $data['golongan'] = $jabatan['golongan']; // Menambahkan nama_jabatan ke array data

    // Siapkan data untuk tampilan
    $x = array(
        'judul' => 'Print Data Pegawai',
        'data' => $data
    );

    // Tampilkan view untuk mencetak
    $this->load->view('admin/print_pegawai', $x);
}

public function generate_surat($id = '')
{
    // Ambil data pegawai berdasarkan id
    $data = $this->db->get_where('pegawai', array('id_pegawai' => $id))->row_array();
    
    // Pastikan data pegawai ditemukan
    if (!$data) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data pegawai tidak ditemukan.</div>');
        redirect('admin/pegawai');
    }

    // Ambil nama jabatan dari tabel jabatan
    $jabatan = $this->db->get_where('jabatan', array('id_jabatan' => $data['id_jabatan']))->row_array();
    $data['nama_jabatan'] = $jabatan['nama_jabatan'];
    $data['golongan'] = $jabatan['golongan']; // Menambahkan nama_jabatan ke array data

    // Siapkan data untuk tampilan
    $x = array(
        'judul' => 'Print Data Pegawai',
        'data' => $data
    );

    // Tampilkan view untuk mencetak
    $this->load->view('admin/cetak_surat', $x);
}

  //bagian absensi  

  public function cari_pegawai()
  {
    if ($this->session->userdata('level') == "pegawai") {

      $id = $this->session->userdata('id_pegawai');
      $x['pegawai'] = $this->db->get_where('pegawai', array('id_pegawai' => $id));
      $this->load->view('admin/data_pegawai', $x);

    } elseif ($this->session->userdata('level') == "admin") {

      $id = $this->input->post('cari_p');
      $x['pegawai'] = $this->db->get_where('pegawai', array('id_pegawai' => $id));
      $this->load->view('admin/data_pegawai', $x);

    } elseif ($this->session->userdata('level') == "user") {
      $id = $this->input->post('cari_p');
      $x['pegawai'] = $this->db->get_where('pegawai', array('id_pegawai' => $id));
      $this->load->view('admin/data_pegawai', $x);
    }
  }

  public function cari_tpp()
  {
    $id = $this->input->post('cari_p');
    $x['data'] = $this->m_admin->tpp_id($id);
    $this->load->view('admin/tpp', $x);
  }

  public function absensi()
  {
    $id = ($this->session->userdata('level') == "pegawai") ? $this->session->userdata('id_pegawai') : $this->session->userdata('id_admin');
    $data = ($this->session->userdata('level') == "pegawai") ? $this->m_admin->cari_pegawai($id) : $this->m_admin->pegawai();
    $x = array(
      'judul' => 'Absensi Pegawai',
      'data' => $data
    );
    tpl('admin/absensi', $x);
  }


  public function aksi_abs()
  {

    $id_pegawai = $this->input->post('id_pegawai');
    $bulan = $this->input->post('bulan');

    $tanggal = date('Y-m-d');
    $hadir = $this->input->post('hadir');
    $izin = $this->input->post('izin');
    $tidak_hadir = $this->input->post('tidak_hadir');

    $hitung = $hadir + $izin + $tidak_hadir;
    if ($hitung > 31) {
      buat_alert('Data Hadir Izin Dan Tidak Hadir Yang Anda Entrikan Lebih Dari 30');
    } else {
      $cek = $this->db->query("SELECT * from absen where id_pegawai='$id_pegawai'
                          AND bulan='$bulan'");
      if ($cek->num_rows() > 0) {
        buat_alert('Data Absensi Sudah Ada .. Silahkan Pilih Abasensi Dengan Bulan Yang Lain');
      } else {

        if ($hadir >= 10) {
          $kehadiran = '30%';
        } else if ($hadir >= 20) {
          $kehadiran = '10%';
          if ($hadir > 25) {
            $kehadiran = '5%';
          }
        } else if ($hadir < 10) {
          $kehadiran = '50%';
        } else {
          $kehadiran = '0%';
        }

        $hasil = $this->m_admin->cari_jabatan($id_pegawai)->row_array();
        $tunjangan = $hasil['tunjangan'] - $kehadiran;
        $sql = array(
          'id_pegawai' => $id_pegawai,
          'jumlah_tpp' => $tunjangan,
          'jumlah_potongan' => $kehadiran,
          'bulan_t' => $bulan,
          'tahun' => date("Y"),
          'tgl' => date("Y-m-d")
        );
        $this->db->insert('tpp', $sql);
        $data = array(
          'id_pegawai' => $id_pegawai,
          'hadir' => $hadir,
          'izin' => $izin,
          'tidak_hadir' => $tidak_hadir,
          'bulan' => $this->input->post('bulan'),
          'tanggal' => date('Y-m-d')
        );
        $this->db->insert('absen', $data);
        buat_alert('Data Absensi Berhasil Di Tambahkan ..');
      }
    }


  }

  //bagian gaji

  public function cari_gaji_p()
  {

    $id = $this->input->post('cari_p');
    $x['pegawai'] = $this->m_admin->cari_pegawai($id);
    $this->load->view('admin/gaji_form', $x);

  }

  public function gaji_pegawai()
  {
    $x['judul'] = "Data Gaji Pegawai";
    $x['data'] = $this->m_admin->gaji_pegawai();
    tpl('admin/gaji', $x);
  }


  public function gaji_tambah()
  {
    if (isset($_POST['kirim'])) {
      $id_pegawai = $this->input->post('id_pegawai');
      $cek = $this->db->get_where('gaji', array('id_pegawai' => $id_pegawai));
      if ($cek->num_rows() > 0) {
        buat_alert('Maaf Data Gaji Pada Pegawai Ini Telah Ada');
      } else {
        $Sql = array(
          'id_pegawai' => $this->input->post('id_pegawai'),
          'jumlah' => $this->input->post('jumlah')
        );
        $this->db->insert('gaji', $Sql);
        $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Penggajian Berhasil Di Tambahkan.
              </div>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('admin/gaji_pegawai'));
      }
    } else {
      $x['judul'] = "Data Gaji Pegawai";
      $x['data'] = $this->m_admin->gaji_set();
      tpl('admin/set_gaji', $x);
    }

  }


  public function gaji_hapus($id = '')
  {
    $cek = $this->db->delete('gaji', array('id_gaji' => $id));
    if ($cek) {
      $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
      $this->session->set_flashdata('pesan', $pesan);
      redirect(base_url('admin/gaji_pegawai'));
    }
  }

  public function tpp()
  {
    $x = array(
      'judul' => 'Tunjangan Pendapatan Pegawai',
      'data' => $this->m_admin->pegawai_data()
    );
    tpl('admin/tpp_set', $x);
  }

  public function tpp_hapus($id)
  {
    $cek = $this->db->delete('tpp', array('id_pegawai' => $id));
    $cek = $this->db->delete('absen', array('id_pegawai' => $id));
    if ($cek) {
      $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
      $this->session->set_flashdata('pesan', $pesan);
      redirect(base_url('admin/tpp'));

    }
  }

  public function tpp_print($id = '')
  {
    $x = array(
      'judul' => 'Print TPP Data',
      'data' => $this->m_admin->tpp_print($id)->result_array()
    );
    $this->load->view('laporan/print_tpp', $x);
  }



  //bagian Login Administrais User..


  public function user_admin($value = '')
  {
    $x = array(
      'judul' => 'Data Hak Akses',
      'data' => $this->db->get('admin')
    );
    tpl('admin/user_admin', $x);
  }

  public function user_admin_tambah()
  {
    if (isset($_POST['kirim'])) {
      $data = array(
        'username' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'nama' => $this->input->post('nama'),
        'level' => $this->input->post('level'),
      );
      $cek = $this->db->insert('admin', $data);
      if ($cek) {
        $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Edit.
              </div>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('admin/user_admin'));
      } else {
        buat_alert('SYSTEM ERROR');
      }

    } else {
      $x = array(
        'judul' => 'Data Hak Akses',
        'username' => '',
        'nama' => '',
        'data' => $this->db->get('admin')
      );
      tpl('admin/user_admin_form', $x);
    }
  }

  public function user_admin_edit($id = '')
  {
    $sql = $this->db->get_where('admin', array('id_admin' => $id))->row_array();
    if (isset($_POST['kirim'])) {
      $data = array(
        'username' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'nama' => $this->input->post('nama'),
        'level' => $this->input->post('level'),
      );
      $cek = $this->db->update('admin', $data, array('id_admin' => $id));
      if ($cek) {
        $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Edit.
              </div>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('admin/user_admin'));
      } else {
        buat_alert('SYSTEM ERROR');
      }
    } else {
      $x = array(
        'judul' => 'Edit Data Hak Akses',
        'username' => $sql['username'],
        'nama' => $sql['nama'],
        'data' => $this->db->get('admin')
      );
      tpl('admin/user_admin_form', $x);
    }
  }
  public function user_admin_hapus($id = '')
  {
    if ($this->session->userdata('id_admin') == $id) {
      $pesan = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
              Anda Tidak Bisa Menghapus Anda Sendiri.
              </div>';
      $this->session->set_flashdata('pesan', $pesan);
      redirect(base_url('admin/user_admin'));

    } else {
      $this->db->delete('admin', array('id_admin' => $id));
      $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Hapus.
              </div>';
      $this->session->set_flashdata('pesan', $pesan);
      redirect(base_url('admin/user_admin'));
    }
  }

  public function profil()
  {
    if (isset($_POST['kirim'])) {
      $data = array(
        'password' => md5($this->input->post('password')),
        'nama' => $this->input->post('nama'),
      );
      $this->db->update('admin', $data, array('id_admin' => $this->session->userdata('id_admin')));
      $pesan = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
               Data Berhasil Di Edit Password Anda Adalah ' . $this->input->post('password') . ' .
              </div>';
      $this->session->set_flashdata('pesan', $pesan);
      redirect(base_url('admin/profil'));
    } else {
      $x = array(
        'judul' => 'Ubah Password Administrator',
        'data' => $this->db->get_where('admin', array('id_admin' => $this->session->userdata('id_admin')))->row_array(),
      );
      tpl('admin/ubah_password', $x);
    }

  }


  public function profil_pegawai($value = '')
  {
    if (isset($_POST['kirim'])) {
      $vaPassword = array('password' => $this->input->post('password'));
      $vaWhere = array('id_pegawai' => $this->session->userdata('id_pegawai'));
      if (isset($_FILES['gambar']['name'])) {
        $config['upload_path'] = './template/data/';
        $config['allowed_types'] = 'bmp|jpg|png';
        $config['file_name'] = 'foto_' . time();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('gambar')) {
          $vaFoto = array('foto' => $this->upload->file_name);
          $this->db->update('pegawai', $vaFoto, $vaWhere);
        } else {
          echo $this->upload->display_errors();
        }
      }

      if ($this->input->post('password') !== "") {
        $this->db->update('pegawai', $vaPassword, $vaWhere);
      }

      $sql = array(
        'nip' => $this->input->post('nip'),
        'nama' => $this->input->post('nama'),
        'jk' => $this->input->post('jk'),
        'agama' => $this->input->post('agama'),
        'pendidikan' => $this->input->post('pendidikan'),
        'alamat' => $this->input->post('alamat'),
        'username' => $this->input->post('username'),
      );


      $cek = $this->db->update('pegawai', $sql, $vaWhere);
      if ($cek) {
        $pesan = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                 Data Berhasil Di Edit.
                </div>';
        $this->session->set_flashdata('pesan', $pesan);
        redirect(base_url('admin/profil_pegawai'));
      } else {
        buat_alert('ERROR');
      }
    } else {
      $data = $this->db->get_where('pegawai', array('id_pegawai' => $this->session->userdata('id_pegawai')))->row_array();
      $x = array(
        'judul' => '.:: Edit Profil Anda ::.',
        'aksi' => 'edit',
        'foto' => $data['foto'],
        'nama' => $data['nama'],
        'jk' => $data['jk'],
        'alamat' => $data['alamat'],
        'nip' => $data['nip'],
        'agama' => $data['agama'],
        'pendidikan' => $data['pendidikan'],
        'username' => $data['username']
      );
      tpl('admin/profil_pegawai', $x);
    }
  }




  public function keluar($value = '')
  {

    $this->session->sess_destroy();
    echo "<scrip>alert('Anda Telah Keluar Dari Halaman Administrator')</script>";
    ;
    redirect(base_url(''));
  }

}