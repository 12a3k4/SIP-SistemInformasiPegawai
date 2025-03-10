<h3>Jumlah Pegawai Keseluruhan</h3>
<?php
if ($this->session->userdata('level') == "admin") {
    // Using Query Builder CodeIgniter
    $query = $this->db->query("SELECT 
                COUNT(nip) AS total,
                SUM(CASE WHEN status_kep = 'Aktif' THEN 1 ELSE 0 END) AS aktif,
                SUM(CASE WHEN status_kep = 'Non-Aktif' THEN 1 ELSE 0 END) AS non_aktif,
                SUM(CASE WHEN status_kep = 'Magang / Intern' THEN 1 ELSE 0 END) AS magang
              FROM pegawai");

    // Getting query results
    $row = $query->row();

    // Initialize variables
    $total_pegawai = $row->total ?? 0;
    $aktif = $row->aktif ?? 0;
    $non_aktif = $row->non_aktif ?? 0;
    $magang = $row->magang ?? 0;
    ?>
    <div class="container"><?= $this->session->flashdata('pesan'); ?></div>
    <br /><br /><br />

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $total_pegawai ?></h3>
                    <p>Total Pegawai</p>
                </div>
                <div class="icon">
                    <i class="fa fa-database"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $aktif ?></h3>
                    <p>Pegawai Aktif</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $non_aktif ?></h3>
                    <p>Pegawai Non-Aktif</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
            </div>
        </div>

    </div>

<h3>Jumlah Pegawai Berdasarkan Jabatan</h3>

<!-- Input Pencarian -->
<input type="text" id="searchInput" placeholder="Cari jabatan..." onkeyup="searchTable()">

<!-- Tombol Print -->
<button class="btn btn-primary" onclick="printTable()">Print</button>

<!-- Tombol Download Excel -->
<button class="btn btn-success" onclick="window.location.href='<?= base_url('admin/download_jabatan_csv') ?>'">Download Excel</button>


<table class="table table-bordered" id="jabatanTable">
    <thead>
        <tr>
            <th onclick="sortTable(0)">Nama Jabatan</th>
            <th onclick="sortTable(1)">Golongan</th>
            <th onclick="sortTable(2)">Jumlah Pegawai Aktif</th>
            <th onclick="sortTable(3)">Jumlah Pegawai Non-Aktif</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Mengambil data jabatan
        $jabatan_data = $this->db->get('jabatan')->result_array();

        foreach ($jabatan_data as $jabatan) {
            $id_jabatan = $jabatan['id_jabatan'];
            $nama_jabatan = $jabatan['nama_jabatan'];
            $golongan = $jabatan['golongan'];

            // Hitung pegawai aktif
            $jumlah_aktif = $this->db->where('id_jabatan', $id_jabatan)->where('status_kep', 'Aktif')->count_all_results('pegawai');
            // Hitung pegawai non-aktif
            $jumlah_non_aktif = $this->db->where('id_jabatan', $id_jabatan)->where('status_kep', 'Non-Aktif')->count_all_results('pegawai');
        ?>
            <tr>
                <td><?= $nama_jabatan ?></td>
                <td><?= $golongan ?></td>
                <td><?= $jumlah_aktif ?></td>
                <td><?= $jumlah_non_aktif ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
function printTable() {
    var printContents = "<h3>Jumlah Pegawai Berdasarkan Jabatan</h3>" + document.getElementById('jabatanTable').outerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<script>
function searchTable() {
    var input = document.getElementById("searchInput");
    var filter = input.value.toLowerCase();
    var table = document.getElementById("jabatanTable");
    var tr = table.getElementsByTagName("tr");

    for (var i = 1; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td");
        var found = false;

        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                var txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        tr[i].style.display = found ? "" : "none";
    }
}

function sortTable(n) {
    var table = document.getElementById("jabatanTable");
    var switching = true;
    var dir = "asc"; // Set default sorting direction
    var switchcount = 0;

    while (switching) {
        switching = false;
        var rows = table.rows;
        for (var i = 1; i < (rows.length - 1); i++) {
            var shouldSwitch = false;
            var x = rows[i].getElementsByTagName("TD")[n];
            var y = rows[i + 1].getElementsByTagName("TD")[n];

            if (dir === "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir === "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount === 0 && dir === "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>

<?php } elseif ($this->session->userdata('level') == "user") { ?>

    <div class="container"><?= $this->session->flashdata('pesan'); ?></div>

    <div class="callout callout-success">
        <h4><i class="fa fa-cubes"></i>Selamat Datang </h4>
        <p>Anda Login Sebagai User Silahkan Pilih Menu Di Samping Untuk Menggunakan Sistem</p>
    </div>

<?php } elseif ($this->session->userdata('level') == "pegawai") { ?>

    <div class="container"><?= $this->session->flashdata('pesan'); ?></div>
    <div class="callout callout-info">
        <h4><i class="fa fa-cubes"></i>Selamat Datang </h4>
        <p>Anda Login Sebagai Pegawai Silahkan Pilih Menu Di Samping Untuk Menggunakan Sistem</p>
    </div>

<?php } ?>

