<?php
require 'config.php';
require ('templates/header.php');
require ('templates/sidebar.php');
require ('templates/topbar.php');
//Update Data Karyawan
if (isset($_POST['updatedata'])) {
    $token = filter($_GET['token']);
    $nama = filter($_POST['nama']);
    $nip = filter($_POST['nip']);
    $status = filter($_POST['status']);
    $departemen = filter($_POST['departemen']);
    $jabatan = filter($_POST['jabatan']);
    if (!$nama || !$nip || !$status || !$departemen || !$jabatan) {
        notif(false, "Harap mengisi semua data");
    } else {
        if ($yaz->query("UPDATE pegawai SET NIP_pegawai='$nip',Nm_pegawai='$nama',Kd_departemen='$departemen',Status_kepegawaian='$status',Kd_jabatan='$jabatan' WHERE NIP_pegawai='$token'")) {
            notif(true, "Data baru berhasil diUpdate");
            // echo '<script>window.location.href = "' . base_url() . '";</script>';
        } else {
            notif(false, "Terjadi kesalahan sistem");
        }
    }
}


if ($_GET['token']) {
    $token = filter($_GET['token']);
    if ($yaz->query("SELECT * FROM pegawai WHERE NIP_pegawai='$token'")->num_rows < 1) {
        notif(false, "Token Tidak Valid");
    }
    $cek_data = $yaz->query("SELECT * FROM pegawai WHERE NIP_pegawai='$token'")->fetch_assoc();
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Karyawan</h6>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nip</label>
                    <input type="number" class="form-control" value="<?= $cek_data['NIP_pegawai']; ?>" name="nip">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" value="<?= $cek_data['Nm_pegawai']; ?>" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" name='status'>
                        <option value="<?= $cek_data['Status_kepegawaian']; ?>"><?= $cek_data['Status_kepegawaian']; ?></option>
                        <option value="Tidak Tetap">Tidak Tetap</option>
                        <option value="Tetap">Tetap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlahkursi">Departemen</label>
                    <select class="form-control" name='departemen'>
                        <option value="<?= $cek_data['Kd_departemen']; ?>"><?= departemen($cek_data['Kd_departemen']); ?></option>

                        <?php
                        $data_dprt = $yaz->query("SELECT * FROM departemen");
                        while ($row = $data_dprt->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['Kd_departemen']; ?>"><?= $row['Nm_departemen']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlahkursi">Jabatan</label>
                    <select class="form-control" name='jabatan'>
                        <option value="<?= $cek_data['Kd_jabatan']; ?>"><?= jabatan($cek_data['Kd_jabatan']); ?></option>

                        <?php
                        $data_dprt = $yaz->query("SELECT * FROM jabatan");
                        while ($row = $data_dprt->fetch_assoc()) {
                        ?>
                            <option value="<?= $row['Kd_jabatan']; ?>"><?= $row['Nm_Jabatan']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" name='updatedata' class="btn btn-primary">Update Data</button>
            </form>
        </div>
        </form>
    </div>
</div>
</div>
<!-- /.container-fluid -->

<?php

require ('templates/footer.php');
