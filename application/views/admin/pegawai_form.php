<table class="table table-striped">
    <form action="" method="POST" enctype="multipart/form-data">

        <tr>
            <th>NIP</th>
            <td><input type="number" name="nip" value="<?= $nip ?>" class="form-control"></td>
        </tr>
        <tr>
            <th>NIK</th>
            <td><input type="number" name="nik" value="<?= $nik ?>" class="form-control"></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><input type="text" name="nama" value="<?= $nama ?>" class="form-control" required=""></td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td><select class="form-control" name="jk" required="">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select></td>
        </tr>

        <tr>
            <th>Jabatan</th>
            <td>
                <select name="id_jabatan" class="form-control" required="">
                    <?php if ($aksi !== "edit") { ?>
                        <option value="">--Pilih Data Jabatan--</option> <?php } ?>
                    <?php foreach ($jabatan as $jab):
                        $selected = ($jab['id_jabatan'] == $id_jabatan) ? "selected" : "";
                        ?>

                        <option value="<?= $jab['id_jabatan'] ?>" <?= $selected; ?>><?= ucfirst($jab['nama_jabatan']) ?>
                            (<?= $jab['golongan']; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr>
            <th>Keterangan Jabatan</th>
            <td><input type="text" name="ket_jabatan" value="<?= $ket_jabatan ?>" class="form-control"></td>
        </tr>

        <?php
        $tempat_lhr = isset($tempat_lhr) ? $tempat_lhr : '';
        $tanggal_lhr = isset($tanggal_lhr) ? $tanggal_lhr : '';
        ?>

        <tr>
            <th>Tempat Lahir</th>
            <td>
                <input type="text" name="tempat_lhr" value="<?= $tempat_lhr ?>" class="form-control">
            </td>
        </tr>

        <tr>
            <th>Tanggal Lahir</th>
            <td>
                <input type="date" name="tanggal_lhr" value="<?= isset($tanggal_lhr) ? $tanggal_lhr : '' ?>"
                    class="form-control">
            </td>
        </tr>


        <tr>
            <th>Agama</th>
            <td><select class="form-control" name="agama" required="">
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Budha">Budha</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Konghucu">Konghucu</option>
                    <option value="Lainnya">Lainnya</option>
                </select></td>
        </tr>
        <tr>
            <th>Pendidikan Terakhir</th>
            <td>
                <select name="pendidikan" class="form-control">
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="Tidak/Belum Sekolah" <?= ($pendidikan == "Tidak/Belum Sekolah") ? "selected" : "" ?>>
                        Tidak/Belum Sekolah</option>
                    <option value="SD/Sederajat" <?= ($pendidikan == "SD/Sederajat") ? "selected" : "" ?>>SD/Sederajat
                    </option>
                    <option value="SMP/Sederajat" <?= ($pendidikan == "SMP/Sederajat") ? "selected" : "" ?>>SMP/Sederajat
                    </option>
                    <option value="SMA/SMK/Sederajat" <?= ($pendidikan == "SMA/SMK/Sederajat") ? "selected" : "" ?>>
                        SMA/SMK/Sederajat</option>
                    <option value="Diploma 1 (D1)" <?= ($pendidikan == "Diploma 1 (D1)") ? "selected" : "" ?>>Diploma 1
                        (D1)</option>
                    <option value="Diploma 2 (D2)" <?= ($pendidikan == "Diploma 2 (D2)") ? "selected" : "" ?>>Diploma 2
                        (D2)</option>
                    <option value="Diploma 3 (D3)" <?= ($pendidikan == "Diploma 3 (D3)") ? "selected" : "" ?>>Diploma 3
                        (D3)</option>
                    <option value="Strata 1 (S1) / Sarjana" <?= ($pendidikan == "Strata 1 (S1) / Sarjana") ? "selected" : "" ?>>Strata 1 (S1) / Sarjana</option>
                    <option value="Strata 2 (S2) / Magister" <?= ($pendidikan == "Strata 2 (S2) / Magister") ? "selected" : "" ?>>Strata 2 (S2) / Magister</option>
                    <option value="Strata 3 (S3) / Doktor" <?= ($pendidikan == "Strata 3 (S3) / Doktor") ? "selected" : "" ?>>Strata 3 (S3) / Doktor</option>
                    <option value="Lainnya" <?= ($pendidikan == "Lainnya") ? "selected" : "" ?>>Lainnya</option>
                </select>
            </td>
        </tr>


        <tr>
            <th>Status Kepegawaian</th>
            <td>
                <select name="status_kep" class="form-control" required>
                    <option value="Aktif" <?= ($status_kep == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                    <option value="Non-Aktif" <?= ($status_kep == 'non-aktif') ? 'selected' : '' ?>>Non-Aktif</option>
                </select>
            </td>
        </tr>

        <tr>
            <th>Tanggal Masuk</th>
            <td><input type="date" name="tgl_masuk" value="<?= $tgl_masuk ?>" class="form-control"></td>
        </tr>

        <tr>
            <th>S.K. Pengangkatan</th>
            <td><input type="text" name="sk_masuk" value="<?= $sk_masuk ?>" class="form-control"></td>
        </tr>

        <tr>
            <th>Tanggal Keluar</th>
            <td><input type="date" name="tgl_keluar" value="<?= $tgl_keluar ?>" class="form-control"></td>
        </tr>

        <tr>
            <th>S.K. Keluar</th>
            <td><input type="text" name="sk_keluar" value="<?= $sk_keluar ?>" class="form-control"></td>
        </tr>

        <tr>
            <th>Alamat </th>
            <td><input type="text" name="alamat" value="<?= $alamat ?>" class="form-control"></td>
        </tr>

        <tr>
            <th>Foto</th>
            <td>
                <?php
                $img_path = base_url('template/data/' . ($foto ?? 'placeholder.png'));
                ?>
                <img src="<?= $img_path ?>" class="img-responsive preview-image" style="width:200px;height:200px">
                <input type="file" name="gambar" class="form-control" onchange="previewFile('gambar', 'preview-image')">
            </td>
        </tr>

        <tr>
            <th>Kartu Keluarga</th>
            <td>
                <?php
                $img_path = base_url('template/data/' . ($kk ?? 'placeholder.png'));
                ?>
                <img src="<?= $img_path ?>" class="img-responsive preview-kk" style="width:200px;height:200px">
                <input type="file" name="kk" class="form-control" onchange="previewFile('kk', 'preview-kk')">
            </td>
        </tr>

        <tr>
            <th>KTP/SIM</th>
            <td>
                <?php
                $img_path = base_url('template/data/' . ($ktp_sim ?? 'placeholder.png'));
                ?>
                <img src="<?= $img_path ?>" class="img-responsive preview-ktp" style="width:200px;height:200px">
                <input type="file" name="ktp_sim" class="form-control" onchange="previewFile('ktp_sim', 'preview-ktp')">
            </td>
        </tr>

        <tr>
            <th>ID Card</th>
            <td>
                <?php
                $img_path = base_url('template/data/' . ($id_card ?? 'placeholder.png'));
                ?>
                <img src="<?= $img_path ?>" class="img-responsive preview-id" style="width:200px;height:200px">
                <input type="file" name="id_card" class="form-control" onchange="previewFile('id_card', 'preview-id')">
            </td>
        </tr>

        <tr>
            <th>Dokumen SK Masuk (PDF)</th>
            <td>
                <input type="file" name="dok_sk_masuk" class="form-control" accept="application/pdf">
                <?php if (!empty($dok_sk_masuk) && $dok_sk_masuk != 'placeholder.png'): ?>
                    <a href="<?= base_url('template/data/' . $dok_sk_masuk) ?>" target="_blank"
                        class="btn btn-xs btn-success mt-2">
                        <i class="fa fa-file-pdf-o"></i> View PDF
                    </a>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <th>Dokumen SK Keluar (PDF)</th>
            <td>
                <input type="file" name="dok_sk_keluar" class="form-control" accept="application/pdf">
                <?php if (!empty($dok_sk_keluar) && $dok_sk_keluar != 'placeholder.png'): ?>
                    <a href="<?= base_url('template/data/' . $dok_sk_keluar) ?>" target="_blank"
                        class="btn btn-xs btn-success mt-2">
                        <i class="fa fa-file-pdf-o"></i> View PDF
                    </a>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <th>Curriculum Vitae (PDF)</th>
            <td>
                <input type="file" name="cv" class="form-control" accept="application/pdf">
                <?php if (!empty($cv) && $cv != 'placeholder.png'): ?>
                    <a href="<?= base_url('template/data/' . $cv) ?>" target="_blank" class="btn btn-xs btn-success mt-2">
                        <i class="fa fa-file-pdf-o"></i> View CV
                    </a>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <th>Dokumen Lainnya (PDF)</th>
            <td>
                <input type="file" name="dok_lainnya" class="form-control" accept="application/pdf">
                <?php if (!empty($dok_lainnya) && $dok_lainnya != 'placeholder.png'): ?>
                    <a href="<?= base_url('template/data/' . $dok_lainnya) ?>" target="_blank"
                        class="btn btn-xs btn-success mt-2">
                        <i class="fa fa-file-pdf-o"></i> View Dokumen
                    </a>
                <?php endif; ?>
            </td>
        </tr>

        <script>
            function previewFile(inputName, previewClass) {
                const input = document.querySelector(`input[name="${inputName}"]`);
                const preview = document.querySelector(`.${previewClass}`);
                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "#";
                    preview.style.display = "none";
                }
            }
        </script>

        <!-- <tr>
            <th>Username</th>
            <td><input type="text" name="username" value="<?= $username ?>" class="form-control" required=""></td>
        </tr>
        <?php
        $disabled = "";
        if ($aksi == "edit") {
            $disabled = "disabled";
        }
        ?>
        <tr>
            <th>Password</th>
            <td><input type="password" name="password" value="" class="form-control" <?= $disabled; ?>></td>
        </tr> -->

        <tr>
            <td></td>
            <td><input type="submit" name="kirim" value="Submit" class="btn btn-primary"> &nbsp;&nbsp;<input
                    type="reset" name="g" value="Batal" class="btn btn-danger"></td>
        </tr>

    </form>
</table>
</table>
<?php if ($aksi == "edit"): ?>
    <span class="text-muted"><i>Kosongkan file jika tidak ingin mengganti. Format file: PDF (maks. 5MB)</i></span>
<?php endif; ?>