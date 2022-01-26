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

            $query = "SELECT * FROM tb_karyawan";
            $result = mysqli_query($conn, $query);

            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }


            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <title>Karyawan</title>
            </head>


            <body>
                <H2>Karyawan</H2>
                <?php if ($_SESSION['leveluser'] == '1') : ?>
                    <a href="Khalamancreate.php" class="btn btn-tambah">tambahkaryawan</a>
                <?php endif; ?>

                <table width="100%" border=1>
                    <tr>
                        <td>#</td>
                        <td>Nama</td>
                        <td>Telp</td>
                        <td>Alamat</td>
                        <?php if ($_SESSION['leveluser'] == '1') : ?>
                            <td>aksi</td>
                        <?php endif; ?>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $row['namakaryawan'] ?></td>
                            <td><?= $row['telp'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <?php if ($_SESSION['leveluser'] == '1') : ?>
                                <td>
                                    <a href="Kedit.php?id=<?= $row['idkaryawan'] ?>">edit|</a>
                                    <a href="Khapus.php?id=<?= $row['idkaryawan'] ?>">hapus</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </body>

            </html>


    </div>
    </div>
    </div>

    </div>
    </main>

    </div>

</body>

</html>