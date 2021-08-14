<?php
require 'config.php';
require ('templates/header.php');
require ('templates/sidebar.php');
require ('templates/topbar.php');
if (isset($_POST['tambahpegawai'])) {
    $nama = filter($_POST['nama']);
    $nip = filter($_POST['nip']);
    $status = filter($_POST['status']);
    $departemen = filter($_POST['departemen']);
    $jabatan = filter($_POST['jabatan']);
    if (!$nama || !$nip || !$status || !$departemen || !$jabatan) {
        notif(false, "Harap mengisi semua data");
    } else {
        if ($yaz->query("INSERT INTO pegawai VALUES ('$nip','$nama','$departemen','$status','$jabatan')")) {
            notif(true, "Data baru berhasil di masukan");
        } else {
            notif(false, "Terjadi kesalahan sistem");
        }
    }
}

if (isset($_GET['delet'])) {
    $id = filter($_GET['delet']);
    if ($yaz->query("SELECT * FROM pegawai WHERE NIP_pegawai='$id'")->num_rows < 1) {
        notif(false, "Data Tidak kami temukan");
    } else {
        if ($yaz->query("DELETE FROM pegawai WHERE pegawai.NIP_pegawai='$id'")) {
            notif(true, "Data Pegawai Berhasil di Delete");
        } else {
            notif(false, "Terjadi kesalahan Sistem");
        }
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
        </div>
        <div class="card-body">
            <div class="col-md mb-4">
                <button type="button" class="btn btn-info tombolTambahData" data-toggle="modal" data-target="#formModal">
                    Tambah Data
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nip</th>
                            <th>Nama</th>
                            <th>Departemen</th>
                            <th>Status</th>
                            <th>Jabatan</th>
                            <th>Lama Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cek_pegawai = $yaz->query("SELECT * FROM pegawai INNER JOIN departemen ON pegawai.Kd_departemen=departemen.Kd_departemen INNER JOIN jabatan ON pegawai.Kd_jabatan = jabatan.Kd_jabatan");
                        while ($row = $cek_pegawai->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $row['NIP_pegawai']; ?></td>
                                <td><?= $row['Nm_pegawai']; ?></td>
                                <td><?= $row['Nm_departemen']; ?></td>
                                <td><?= $row['Status_kepegawaian']; ?></td>
                                <td><?= $row['Nm_Jabatan']; ?></td>
                                <td><?= $row['Lama_jabatan']; ?> Tahun</td>
                                <td>
                                    <a href="?delet=<?= $row['NIP_pegawai']; ?>" class="btn btn-danger">Delete</a>
                                    <a href="edit.php?token=<?= $row['NIP_pegawai']; ?>" class="btn btn-info">Edit</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="jumlahkursi">Nip</label>
                        <input type="number" class="form-control" name="nip">
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Status</label>
                        <select class="form-control" name='status'>
                            <option value="">Pilih Status</option>
                            <option value="Tidak Tetap">Tidak Tetap</option>
                            <option value="Tetap">Tetap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Departemen</label>
                        <select class="form-control" name='departemen'>
                            <option value="">Pilih Departemen</option>

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
                            <option value="">Pilih Jabatan</option>

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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name='tambahpegawai' class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

require ('templates/footer.php');
