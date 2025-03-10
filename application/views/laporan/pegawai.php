<?php if ($print == TRUE): ?>
  <script>window.print()</script>
  <link rel="stylesheet" href="<?= base_url('/template/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <h2>Laporan Data Pegawai</h2>
  <hr />
<?php else: ?>
  <a href="<?= base_url('admin/download_excel') ?>" class="btn btn-success">
    <i class="fa fa-file-excel-o"></i> Download Excel
  </a>
  <a href="javascript:void(0);" class="btn btn-primary" onclick="printFilteredTable()">
    <i class="fa fa-print"></i> Print Laporan
  </a>
  <br /><br /><br />
<?php endif; ?>

<script>
function printFilteredTable() {
    var printContents = "<h2 style='font-size: 16px; text-decoration: underline; margin: 0;'>KEMENTERIAN SEKRETARIAT NEGARA</h2>";
    printContents += "<h2 style='font-size: 16px; text-decoration: underline; margin: 0;'>SEKRETARIAT DEWAN PERTIMBANGAN PRESIDEN</h2>";
    printContents += "<h2 style='text-align: center; font-weight: bold;'>LAPORAN DATA PEGAWAI</h2><hr />";
    printContents += "<table border='1' style='width: 100%; border-collapse: collapse;'>";
    printContents += "<thead><tr><th style='padding: 10px;'>No</th><th style='padding: 10px;'>NIP</th><th style='padding: 10px;'>Nama</th><th style='padding: 10px;'>Jenis Kelamin</th><th style='padding: 10px;'>Agama</th><th style='width: 150px; padding: 10px;'>Foto</th><th style='padding: 10px;'>Nama Jabatan</th><th style='padding: 10px;'>Tempat, Tanggal Lahir</th><th style='padding: 10px;'>Status Kepegawaian</th><th style='padding: 10px;'>Alamat Lengkap</th></tr></thead><tbody>";

    var table = document.getElementById("example1");
    var rows = table.rows;

    for (var i = 1; i < rows.length; i++) { // Mulai dari 1 untuk melewati header
        if (rows[i].style.display !== "none") { // Hanya ambil baris yang terlihat
            // Ambil semua sel kecuali kolom aksi (kolom terakhir)
            var cells = rows[i].cells;
            printContents += "<tr>";
            for (var j = 0; j < cells.length - 1; j++) { // Menghindari kolom aksi
                printContents += "<td style='padding: 10px;'>" + cells[j].innerHTML + "</td>";
            }
            printContents += "</tr>";
        }
    }

    printContents += "</tbody></table>";

    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>


<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Agama</th>
      <th>Foto</th>
      <th>Nama Jabatan</th>
      <th>Tempat, Tanggal Lahir</th>
      <th>Status Kepegawaian</th>
      <th>Alamat Lengkap</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    foreach ($data->result_array() as $admin): ?>
      <tr>
        <td><?= $no ?></td>
        <td><?= $admin['nip'] ?></td>
        <td><?= $admin['nama'] ?></td>
        <td><?php if ($admin['jk'] == "L") {
          echo "Laki-Laki";
        } else {
          echo "Perempuan";
        } ?></td>
        <td><?= $admin['agama'] ?></td>
        <td><img src="<?= base_url('template/data/' . $admin['foto']) ?>" class="img-responsive"
            style="width: 100px;height: 100px"></td>
        <td>
          <?= $admin['nama_jabatan'] ?>
          <?= isset($admin['golongan']) ? ' - ' . $admin['golongan'] : '' ?>
          <?= isset($admin['ket_jabatan']) ? ' - ' . $admin['ket_jabatan'] : '' ?>
        </td>
        <td>
          <?= $admin['tempat_lhr'] ?>
          <?php
          if (isset($admin['tanggal_lhr'])) {
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
            $tanggal = date('j F Y', strtotime($admin['tanggal_lhr']));

            // Ganti nama bulan dari Inggris ke Indonesia
            foreach ($bulanIndonesia as $en => $id) {
              $tanggal = str_replace($en, $id, $tanggal);
            }

            echo ' , ' . $tanggal;
          }
          ?>
        </td>
        <td><?= $admin['status_kep'] ?></td>
        <td><?= $admin['alamat'] ?></td>
        <td><a href="<?= base_url('admin/pegawai_print/' . $admin['id_pegawai']) ?>" class="btn btn-warning">Selengkapnya</a></td>
      </tr>
      <?php $no++; endforeach; ?>
  </tbody>
</table>