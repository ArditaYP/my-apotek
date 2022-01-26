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
            $queryTransaksi = "SELECT * FROM tb_transaksi JOIN tb_pelanggan ON tb_transaksi.idpelanggan = tb_pelanggan.idpelanggan";
            $resultTransaksi = mysqli_query($conn, $queryTransaksi);
            $readTransaksi = readData($resultTransaksi);

            $queryPelanggan = "SELECT * FROM tb_pelanggan";
            $resultPelanggan = mysqli_query($conn, $queryPelanggan);
            $readPelanggan = readData($resultPelanggan);
            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <title>Transaksi</title>
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



            <h2>Transaksi</h2>
            <button><a href="Thalamancreate.php" class="btn btn-tambah">TambahTransaksi</a></button>
            <table width="100%" border=1>
                <tr>
                    <td>#</td>
                    <td>Tanggal</td>
                    <td>Pelanggan</td>
                    <td>Kategori</td>
                    <td>Total</td>
                    <td>Bayar</td>
                    <td>Kembali</td>
                    <td>aksi</td>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($readTransaksi as $row) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row['tgltransaksi'] ?></td>
                        <td><?= $row['namalengkap'] ?></td>
                        <td><?= $row['kategoripelanggan'] ?></td>
                        <td><?= $row['totalbayar'] ?></td>
                        <td><?= $row['bayar'] ?></td>
                        <td><?= $row['kembali'] ?></td>
                        <td>
                            <a href="Td.php?id=<?= $row['idtransaksi']; ?>">Detail| </a>
                                <a href="Hapus.php?idd=<?= $row['idtransaksi']; ?>">|hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
    </div>
</body>


</html>