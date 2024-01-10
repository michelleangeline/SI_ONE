<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "si_one";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$hari = "";
$mk = "";
$kode_mk = "";
$sks = "";
$kls = "";
$wkt = "";
$ruang = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "delete from tb_mk where id = '$kode_mk'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "select * from tb_mk where id = '$kode_mk'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $hari = $r1['hari'];
    $mk = $r1['mk'];
    $kode_mk = $r1['kode_mk'];
    $sks = $r1['sks'];
    $kls = $r1['kls'];
    $wkt = $r1['wkt'];
    $ruang = $r1['ruang'];

    if ($kode_mk == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $hari = $_POST['hari'];
    $mk = $_POST['mk'];
    $kode_mk = $_POST['kode_mk'];
    $sks = $_POST['sks'];
    $kls = $_POST['kls'];
    $wkt = $_POST['wkt'];
    $ruang = $_POST['ruang'];

    if ($hari && $mk && $kode_mk && $sks && $kls && $wkt && $ruang) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update tb_mk set hari = '$hari',mk='$mk',kode_mk = '$kode_mk',sks='$sks',kls='$kls',wkt='$wkt' ,ruang='$ruang' where id = '$kode_mk'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into tb_mk(hari,mk,kode_mk,sks,kls,wkt,ruang) values ('$hari','$mk','$kode_mk','$sks','$kls','$wkt','$ruang')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hari" name="hari" value="<?php echo $hari ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="mk" class="col-sm-2 col-form-label">Mata_Kuliah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mk" name="mk" value="<?php echo $mk ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kode_mk" class="col-sm-2 col-form-label">Kode_MK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_mk" name="kode_mk"
                                value="<?php echo $kode_mk ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sks" class="col-sm-2 col-form-label">SKS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sks" name="sks" value="<?php echo $sks ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kls" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kls" name="kls" value="<?php echo $kls ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="wkt" class="col-sm-2 col-form-label">Waktu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="wkt" name="wkt" value="<?php echo $wkt ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ruang" class="col-sm-2 col-form-label">Ruang</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="ruang" id="ruang">
                                <option value="">- Pilih Ruang -</option>
                                <option value="ent_2" <?php if ($ruang == "ent_2")
                                    echo "selected" ?>>Ent 2</option>
                                    <option value="ent_1" <?php if ($ruang == "ent_1")
                                    echo "selected" ?>>Ent 1</option>
                                    <option value="prg_1" <?php if ($ruang == "prg_1")
                                    echo "selected" ?>>Prog 1</option>
                                    <option value="prg_2" <?php if ($ruang == "prg_2")
                                    echo "selected" ?>>Prog 2</option>
                                    <option value="net" <?php if ($ruang == "net")
                                    echo "selected" ?>>Net</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- untuk mengeluarkan data -->
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Jadwal
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Hari</th>
                                <th scope="col">Mata_Kuliah</th>
                                <th scope="col">Kode_MK</th>
                                <th scope="col">SKS</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Ruang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql2 = "select * from tb_mk";
                                $q2 = mysqli_query($koneksi, $sql2);
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $hari = $r2['hari'];
                                    $mk = $r2['mk'];
                                    $kode_mk = $r2['kode_mk'];
                                    $sks = $r2['sks'];
                                    $kls = $r2['kls'];
                                    $wkt = $r2['wkt'];
                                    $ruang = $r2['ruang'];

                                    ?>
                            <tr>
                                <td scope="row">
                                    <?php echo $hari ?>
                                </td>
                                <td scope="row">
                                    <?php echo $mk ?>
                                </td>
                                <td scope="row">
                                    <?php echo $kode_mk ?>
                                </td>
                                <td scope="row">
                                    <?php echo $sks ?>
                                </td>
                                <td scope="row">
                                    <?php echo $kls ?>
                                </td>
                                <td scope="row">
                                    <?php echo $wkt ?>
                                </td>
                                <td scope="row">
                                    <?php echo $ruang ?>
                                </td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                            class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>"
                                        onclick="return confirm('Yakin mau delete data?')"><button type="button"
                                            class="btn btn-danger">Delete</button></a>
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
</body>

</html>