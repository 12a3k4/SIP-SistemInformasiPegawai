<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Profile Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-blue-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 w-full max-w-4xl shadow-lg"> <!-- Change gray to white for card background -->
        <div class="bg-blue-600 text-white text-center py-2 mb-4"> <!-- Changed to blue header -->
            <h1 class="text-2xl font-bold"><?= htmlspecialchars($data['nama']) ?></h1>
        </div>
        <div class="flex items-start">
            <div class="w-1/3">
                <img class="w-full rounded-full" height="100" src="<?= base_url('template/data/' . $data['foto']) ?>"
                    onerror="this.onerror=null; this.src='default-profile.png';" alt="Profile Picture" />
            </div>
            <div class="w-2/3 pl-4">
                <p class="text-sm">
                    <strong>NIP</strong><br />
                    <?= htmlspecialchars($data['nip']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Tempat Lahir</strong><br />
                    <?= htmlspecialchars($data['tempat_lhr']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Tanggal Lahir</strong><br />
                    <?= formatTanggal($data['tanggal_lhr']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Jabatan</strong><br />
                    <?= htmlspecialchars($data['nama_jabatan']) ?>
                    <?= isset($data['golongan']) ? ' - ' . htmlspecialchars($data['golongan']) : '' ?>
                    <?= isset($data['ket_jabatan']) ? ' - ' . htmlspecialchars($data['ket_jabatan']) : '' ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>S.K. Pengangkatan</strong><br />
                    <?= htmlspecialchars($data['sk_masuk']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Tanggal Masuk</strong><br />
                    <?= formatTanggal($data['tgl_masuk']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>S.K. Keluar</strong><br />
                    <?= htmlspecialchars($data['sk_keluar']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Tanggal Keluar</strong><br />
                    <?= formatTanggal($data['tgl_keluar']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Status</strong><br />
                    <?= htmlspecialchars($data['status_kep']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Alamat</strong><br />
                    <?= htmlspecialchars($data['alamat']) ?>
                </p>
                <p class="text-sm mt-2">
                    <strong>Pendidikan Terakhir</strong><br />
                    <?= htmlspecialchars($data['pendidikan']) ?>
                </p>

                <p class="text-sm mt-2">
                    <strong>Status Berkas</strong><br />
                    <?php
                    // Cek apakah semua kolom memiliki isi
                    $isComplete = !empty($data['foto']) && $data['foto'] !== 'placeholder.png' &&
                        !empty($data['kk']) && $data['kk'] !== 'placeholder.png' &&
                        !empty($data['ktp_sim']) && $data['ktp_sim'] !== 'placeholder.png' &&
                        !empty($data['id_card']) && $data['id_card'] !== 'placeholder.png' &&
                        !empty($data['dok_sk_masuk']) &&
                        !empty($data['cv']);

                    if ($isComplete) {
                        // Jika semua kolom ada isinya
                        echo '<span class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Centang Hijau" class="w-4 h-4 mr-2" />
                <span class="text-green-600 font-bold">Lengkap</span>
              </span>';
                    } else {
                        // Jika ada kolom yang kosong
                        echo '<span class="flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190426.png" alt="Silang Merah" class="w-4 h-4 mr-2" />
                <span class="text-red-600 font-bold">Belum Lengkap</span>
              </span>';
                    }
                    ?>
                </p>

            </div>
        </div>
        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            onclick="window.print()">Print</button>
    </div>
</body>

</html>

<?php
function formatTanggal($tanggal)
{
    // Array untuk nama bulan dalam bahasa Indonesia
    $bulanIndonesia = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    // Format tanggal ke dalam bentuk "tanggal bulan tahun"
    $tanggalFormat = date('j F Y', strtotime($tanggal));

    // Ganti nama bulan dari Inggris ke Indonesia
    foreach ($bulanIndonesia as $en => $id) {
        $tanggalFormat = str_replace($en, $id, $tanggalFormat);
    }

    return $tanggalFormat;
}
?>