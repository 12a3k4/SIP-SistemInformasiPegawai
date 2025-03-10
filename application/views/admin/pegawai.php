<a href="<?= base_url('admin/pegawai_tambah/') ?>" class="btn btn-primary">Tambah</a>
<br /><br /><br />
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
            style="width: 100px;height: 100xp"></td>
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
        <td>
    <a href="<?= base_url('admin/pegawai_edit/' . $admin['id_pegawai']) ?>" class="btn btn-info">Edit</a>
    <a href="<?= base_url('admin/pegawai_hapus/' . $admin['id_pegawai']) ?>" class="btn btn-danger">Hapus</a>
    <a href="<?= base_url('admin/pegawai_print/' . $admin['id_pegawai']) ?>" class="btn btn-warning">Selengkapnya</a>
    <a href="<?= base_url('admin/generate_surat/' . $admin['id_pegawai']) ?>" class="btn btn-success">Cetak Surat</a>
</td>
      </tr>
      <?php $no++; endforeach; ?>
  </tbody>
</table>