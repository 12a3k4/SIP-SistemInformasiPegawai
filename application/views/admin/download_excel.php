<?php
// Mengambil data jabatan
$jabatan_data = $this->db->get('jabatan')->result_array();

// Set header untuk download CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data_jabatan.csv"');
header('Cache-Control: max-age=0');

// Buka output untuk menulis
$output = fopen('php://output', 'w');

// Set header CSV
fputcsv($output, ['Nama Jabatan', 'Golongan', 'Jumlah Pegawai Aktif', 'Jumlah Pegawai Non-Aktif']);

// Mengisi data
foreach ($jabatan_data as $jabatan) {
    $id_jabatan = $jabatan['id_jabatan'];
    $nama_jabatan = $jabatan['nama_jabatan'];
    $golongan = $jabatan['golongan'];

    // Hitung pegawai aktif
    $jumlah_aktif = $this->db->where('id_jabatan', $id_jabatan)->where('status_kep', 'Aktif')->count_all_results('pegawai');
    
    // Hitung pegawai non-aktif
    $jumlah_non_aktif = $this->db->where('id_jabatan', $id_jabatan)->where('status_kep', 'Non-Aktif')->count_all_results('pegawai');

    // Tulis data ke CSV
    fputcsv($output, [$nama_jabatan, $golongan, $jumlah_aktif, $jumlah_non_aktif]);
}

// Tutup output
fclose($output);
exit;
?>