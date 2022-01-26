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
                    <a href=""><span class="las la-user-injured"></span>
                        <span>Pelanggan</span></a>
                </li>
                <li>
                    <a href="../Transaksi/Ttampilan.php"><span class="las la-history"></span>
                        <span>Transaksi</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-book-medical"></span>
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
        <main>
            <?php
            require_once '../koneksi.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $result = mysqli_query($conn, "SELECT * FROM tb_supplier WHERE idsupplier = $id");

                $rows = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }

                $reads = $rows;
            }

            if (isset($_POST['tambahsupplier'])) {
                $perusahaan = $_POST['perusahaan'];
                $alamatsupplier = $_POST['alamatsup'];
                $telpsupplier = $_POST['telpsup'];
                $keterangansupplier = $_POST['keterangansup'];
                $id = $_POST['id'];

                $isp = "UPDATE tb_supplier SET perusahaan='$perusahaan', telp='$telpsupplier', alamat='$alamatsupplier', keterangan='$keterangansupplier' WHERE idsupplier=$id";

                $rsp = mysqli_query($conn, $isp);

                return header("Location: Stampilan.php");
            }
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <title>editsupplier</title>
            </head>
            <style>
                form {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
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



                <?php foreach ($reads as $r) : ?>
                    <form action="" method="post">
                        <h1>Edit Supplier</h1>
                        <input type="hidden" name="id" value="<?= $r['idsupplier'] ?>">
                        <input type="text" name="perusahaan" placeholder="Perusahaan" value="<?= $r['perusahaan'] ?>">
                        <input type="text" name="telpsup" placeholder="Telp" value="<?= $r['telp'] ?>">
                        <input type="text" name="alamatsup" placeholder="Alamat" value="<?= $r['alamat'] ?>">
                        <input type="text" name="keterangansup" placeholder="Keterangan" value="<?= $r['keterangan'] ?>">
                        <button type="submit" name="tambahsupplier" class="btn btn-tambah">Edit Supplier</button>
                    </form>
                <?php endforeach; ?>
            </body>

            </html>
        </main>
    </div>
</body>


</html>