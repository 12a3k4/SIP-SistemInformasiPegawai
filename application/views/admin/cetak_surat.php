<?php
// Definisikan variabel untuk bagian yang bisa diinput manual
$nomorSurat = "Sket-";
$nomorUrut = isset($_POST['nomorUrut']) ? $_POST['nomorUrut'] : "01"; // Input manual untuk nomor urut
$set = "Set.Wantimpres/Um/";
$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : "02"; // Input manual untuk bulan
$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : "2025"; // Input manual untuk tahun

// Input manual untuk nama, NIP, dan jabatan
$namaPenandatangan = isset($_POST['namaPenandatangan']) ? $_POST['namaPenandatangan'] : "R.H Bambang B. Nugroho";
$nipPenandatangan = isset($_POST['nipPenandatangan']) ? $_POST['nipPenandatangan'] : "180004569";
$jabatanPenandatangan = isset($_POST['jabatanPenandatangan']) ? $_POST['jabatanPenandatangan'] : "Kepala Biro Umum";
?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Surat Keterangan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Arial:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        .indent {
            text-indent: 40px;
        }

        /* CSS untuk menyembunyikan elemen saat mencetak */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <script>
        function printSurat() {
            window.print();
        }
    </script>
</head>

<body class="font-sans p-2">
    <div class="max-w-2xl mx-auto p-5">
        <form method="POST" class="mb-4 no-print">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="nomorUrut" class="block">Nomor Urut:</label>
                    <input type="text" id="nomorUrut" name="nomorUrut" value="<?= htmlspecialchars($nomorUrut) ?>"
                        class="border p-1" />
                </div>
                <div>
                    <label for="bulan" class="block">Bulan:</label>
                    <input type="text" id="bulan" name="bulan" value="<?= htmlspecialchars($bulan) ?>"
                        class="border p-1" />
                </div>
                <div>
                    <label for="tahun" class="block">Tahun:</label>
                    <input type="text" id="tahun" name="tahun" value="<?= htmlspecialchars($tahun) ?>"
                        class="border p-1" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div>
                    <label for="namaPenandatangan" class="block">Nama Penandatangan:</label>
                    <input type="text" id="namaPenandatangan" name="namaPenandatangan"
                        value="<?= htmlspecialchars($namaPenandatangan) ?>" class="border p-1" />
                </div>
                <div>
                    <label for="nipPenandatangan" class="block">NIP Penandatangan:</label>
                    <input type="text" id="nipPenandatangan" name="nipPenandatangan"
                        value="<?= htmlspecialchars($nipPenandatangan) ?>" class="border p-1" />
                </div>
                <div>
                    <label for="jabatanPenandatangan" class="block">Jabatan Penandatangan:</label>
                    <input type="text" id="jabatanPenandatangan" name="jabatanPenandatangan"
                        value="<?= htmlspecialchars($jabatanPenandatangan) ?>" class="border p-1" />
                </div>
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white p-2">Generate Surat</button>
        </form>

        <!-- <div class="flex mb-2">
            <img alt="Logo of Kementerian Sekretariat Negara" class="mr-4" height="100"
                src="https://www.setneg.go.id/classic/topbar/assets/images/logo-blue2x.png" width="100" />
            <div class="text-left">
                <h1 class="text-lg font-bold">KEMENTERIAN SEKRETARIAT NEGARA</h1>
                <h2 class="text-lg font-bold">SEKRETARIAT DEWAN PERTIMBANGAN PRESIDEN</h2>
                <p class="text-sm">Jalan Veteran III, Jakarta 10110, Telepon (021) 3448801, Faksimile (021) 3865092</p>
                <p class="text-sm">Website: www.wantimpres.go.id</p>
            </div>
        </div>
        <div class="border-t border-gray-300 my-4"></div> -->

        <div class="text-center mb-8" style="margin-top: 4cm;">
            <h3 class="text-lg font-bold">SURAT KETERANGAN</h3>
            <p class="text-sm">NOMOR
                <?= htmlspecialchars($nomorSurat . $nomorUrut . '/' . $set . $bulan . '/' . $tahun) ?></p>
        </div>
        <div class="mb-8">
            <p class="mb-2">Yang bertanda tangan di bawah ini :</p>
            <div class="grid grid-cols-3">
                <p>Nama</p>
                <p class="col-span-2">: <?= htmlspecialchars($namaPenandatangan) ?></p>
                <p>Nip</p>
                <p class="col-span-2">: <?= htmlspecialchars($nipPenandatangan) ?></p>
                <p>Jabatan</p>
                <p class="col-span-2">: <?= htmlspecialchars($jabatanPenandatangan) ?></p>
            </div>
        </div>
        <div class="mb-8">
            <p class="mb-2">menerangkan dengan sebenarnya bahwa :</p>
            <div class="grid grid-cols-3">
                <p>Nama</p>
                <p class="col-span-2">:
                    <?= isset($data['nama']) ? htmlspecialchars($data['nama']) : 'Nama tidak tersedia' ?></p>
                <p>Jabatan</p>
                <p class="col-span-2">:
                    <?= isset($data['nama_jabatan']) ? htmlspecialchars($data['nama_jabatan']) : 'Jabatan tidak tersedia' ?>
                    <?= isset($data['golongan']) ? ' - ' . htmlspecialchars($data['golongan']) : '' ?>
                    <?= isset($data['ket_jabatan']) ? ' - ' . htmlspecialchars($data['ket_jabatan']) : '' ?></p>
                <p>Tempat Kerja</p>
                <p class="col-span-2">: Sekretariat Dewan Pertimbangan Presiden</p>
            </div>
        </div>
        <div class="mb-8">
            <p class="indent text-justify">Adalah benar merupakan Pegawai yang bekerja pada Sekretariat Dewan
                Pertimbangan Presiden mulai tanggal
                <?= isset($data['tgl_masuk']) ? htmlspecialchars(formatTanggal($data['tgl_masuk'], 'j F Y')) : 'Tanggal tidak tersedia' ?>
                sampai dengan
                <?= isset($data['tgl_keluar']) ? htmlspecialchars(formatTanggal($data['tgl_keluar'], 'j F Y')) : 'Tanggal tidak tersedia' ?>.
            </p>
            <p class="indent text-justify">Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
            </p>
        </div>
        <div class="text-right mb-8">
            <p>Jakarta, <?= htmlspecialchars(formatTanggalIndo(date('Y-m-d'))) ?></p>
            <p>Kepala Biro Umum,</p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p><?= htmlspecialchars($namaPenandatangan) ?></p>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
        <div class="text-center text-xs">
            <p>Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan
                oleh Balai Sertifikasi Elektronik (BSrE).</p>
        </div>

        <!-- Tombol untuk mencetak surat -->
        <button onclick="printSurat()" class="mt-4 bg-green-500 text-white p-2 no-print">Cetak Surat</button>
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

// Function to get the current date in Indonesian format
function formatTanggalIndo($date)
{
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $day = date('j', strtotime($date));
    $month = $months[date('n', strtotime($date))];
    $year = date('Y', strtotime($date));

    return "$day $month $year";
}
?>