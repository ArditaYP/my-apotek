<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../Dashboard/css/style.css">
</head>
<style>
    /* button */
    .btn {
        font-size: 1.2em;
        padding: .1em .8em;
        cursor: pointer;
    }

    .btn.btn-tambah {
        background-color: hsl(0, 0%, 20%);
        border: none;
        color: white;
        border-radius: 4px;
        outline: none;
    }
</style>

<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-clinic-medical"></span> <span>MyApotek</span></h2>
        </div>
        <!--Secciones-del-tablero-->
        <div class="sidebar-menu">
            <ul>
                <?php if ($_SESSION['leveluser'] == '1') : ?>
                    <li>
                        <a href="../Dashboard/index.php" class="active"><span class="las la-home"></span>
                            <span>Home</span></a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="../Obat/Otampilan.php"><span class="las la-stethoscope"></span>
                        <span>Obat</span></a>
                </li>
                <li>
                    <a href="../karyawan/Ktampilan.php"><span class="las la-user"></span>
                        <span>Karyawan</span></a>
                </li>
                <li>
                    <a href="../Pelanggan/Ptampilan.php"><span class="las la-user-injured"></span>
                        <span>Pelanggan</span></a>
                </li>
                <li>
                    <a href="../Transaksi/Ttampilan.php"><span class="las la-history"></span>
                        <span>Transaksi</span></a>
                </li>
                <li>
                    <a href="../Supplier/Stampilan.php"><span class="las la-book-medical"></span>
                        <span>Supplier</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-search"></span>
                        <span>Search</span></a>
                </li>
                <li>
                    <a href="../login/logout.php"><span class="las la-bars"></span>
                        <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label> Dashboard
            </h2>

            <div class="user-wrapper">
                <img src="../Dashboard//img/Avatar.png" width="40px" height="40px" alt="">
                <div>
                    <h4><?= $_SESSION['userlogin'] ?></h4>
                </div>
            </div>
        </header>
        <?php if ($_SESSION['leveluser'] == '1') : ?>
            <main>
                <?php
                require_once '../koneksi.php';
                // read data
                function readData($result)
                {
                    $rows = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $rows[] = $row;
                    }

                    return $rows;
                }

                // get spesific data karyawan 
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $rqkar = mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE idpelanggan = $id");

                    $readKaryawan = readData($rqkar)[0]; // read spesific 
                }

                // edit data karyawan
                if (isset($_POST['editPelangganButton'])) {
                    $namalengkap = $_POST['namalengkap'];
                    $alamat = $_POST['alamat'];
                    $telp = $_POST['telp'];
                    $usia = $_POST['usia'];
                    $buktifotoresep = $_POST['buktifotoresep'];
                    $id = $_POST['id'];

                    $ukar = "UPDATE tb_pelanggan SET namalengkap='$namalengkap', alamat='$alamat', telp='$telp',usia='$usia',buktifotoresep='$buktifotoresep'WHERE idpelanggan = $id";

                    $rkar = mysqli_query($conn, $ukar);

                    if ($rkar) {
                        echo "<script>
                    alert('Pelanggan berhasil diubah');
                        document.location.href = 'Ptampilan.php';
                        </script>";
                    } else {
                        echo "<script>
            alert('Pelanggan gagal diubah');
            document.location.href = 'Ptampilan.php';
        </script>";
                    }
                }
                ?>

                <!DOCTYPE html>
                <html lang="en">

                <head>

                    <title>Pelanggan</title>


                </head>
                <style>
                    form {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                    }

                    form input {
                        margin-bottom: 1em;
                        padding: 1em;
                    }

                    /* button */
                    .btn {
                        font-size: 1.2em;
                        padding: .1em .8em;
                        cursor: pointer;
                    }

                    .btn.btn-tambah {
                        background-color: hsl(0, 0%, 20%);
                        border: none;
                        color: white;
                        border-radius: 4px;
                        outline: none;
                    }
                </style>


                <body>

                    <form action="" method="post">
                        <h1>Edit Pelanggan</h1>
                        <input type="hidden" name="id" value="<?= $readKaryawan['idpelanggan']; ?>">
                        <input type="text" name="namalengkap" id="namalengkap" value="<?= $readKaryawan['namalengkap'] ?>" required>
                        <input type="text" name="alamat" id="alamat" value="<?= $readKaryawan['alamat'] ?>" required>
                        <input type="text" name="telp" id="telp" value="<?= $readKaryawan['telp'] ?>" required>
                        <input type="text" name="usia" id="usia" value="<?= $readKaryawan['usia'] ?>" required>
                        <input type="text" name="buktifotoresep" id="buktifotoresep" value="<?= $readKaryawan['buktifotoresep'] ?>" required>

                        <button type="submit" name="editPelangganButton" class="btn btn-tambah">Tambah Pelanggan</button>
                    </form>
                </body>

            <?php endif; ?>
            </main>

</html>