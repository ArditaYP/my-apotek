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
            // session_start();
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

            // read data obat
            $queryObat = "SELECT * FROM tb_obat";
            $resultObat = mysqli_query($conn, $queryObat);
            $readObat = readData($resultObat);

            // read data pelanggan
            $idp = $_SESSION['pelanggan'];
            $queryPelanggan = "SELECT * FROM tb_pelanggan WHERE idpelanggan = $idp";
            $resultPelanggan = mysqli_query($conn, $queryPelanggan);
            $readPelanggan = readData($resultPelanggan)[0];

            $grand = 0;
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Transaksi Lanjutan</title>
            </head>
            <style>
                /* simple reset css */
                * {
                    padding: 0;
                    margin: 0;
                    font-family: 'Poppins', sans-serif;

                    /* variables */
                }

                body {
                    height: 100vh;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                /* form */
                .form-group {
                    display: flex;
                    flex-direction: column;
                    margin-bottom: 1em;
                }

                .form-group input {
                    font-size: 1.2rem;
                    padding: .2em 1em;
                    height: 40px;
                    max-width: 250px;
                    border: 2px solid hsl(0, 0%, 80%);
                    box-shadow: 0 0 .1em rgba(0, 0, 0, .15);
                    outline-color: black;
                    outline: none;
                }

                .form-group input:hover {
                    border-color: hsl(0, 0%, 60%);
                }

                .form-group input:focus {
                    border-color: hsl(234, 100%, 62%);
                    box-shadow: 0 0 .5em rgba(60, 80, 255, 0.15);
                }

                .form-group select,
                option {
                    font-size: 1.2rem;
                    padding: .2em 1em;
                    height: 50px;
                    max-width: 290px;
                    border: 2px solid hsl(0, 0%, 80%);
                    box-shadow: 0 0 .1em rgba(0, 0, 0, .15);
                    outline: none;
                }

                .form-group select:hover {
                    border-color: hsl(0, 0%, 60%);
                }

                .form-group select:focus {
                    border-color: hsl(234, 100%, 62%);
                    box-shadow: 0 0 .5em rgba(60, 80, 255, 0.15);
                }

                .confirmButton {
                    margin: .5rem 0;
                    color: white;
                    background-color: hsl(220, 15%, 23%);
                    border: none;
                    padding: 1em 2em;
                    outline: none;
                }

                .confirmButton:active {
                    background-color: hsl(220, 15%, 40%);
                }

                .addButton {
                    margin: .5rem 0;
                    color: hsl(220, 15%, 23%);
                    border: 1px solid hsl(220, 15%, 23%);
                    padding: 1em 2em;
                    outline: none;
                }

                .addButton:active {
                    background-color: hsl(220, 15%, 40%);
                    color: white;
                }

                /* table */
                table {
                    width: 100%;
                }

                /* first */
                .first-table {
                    border-collapse: collapse;
                }

                .first-table td {
                    border: 1px solid hsl(224, 100%, 88%);
                    padding: .5rem 2rem;
                }

                /* second */
                .second-table {
                    margin-top: 1rem;
                    border-collapse: collapse;
                    text-align: center;
                }

                .second-table th,
                .second-table td {
                    padding: .5rem 2rem;
                }

                .second-table thead {
                    box-shadow: 0 5px 10px rgba(225, 229, 238, 1);
                }

                .second-table th {
                    text-transform: uppercase;
                    letter-spacing: .1rem;
                }

                .second-table tr:nth-child(even) {
                    background-color: hsl(223, 47%, 97%);
                }

                .second-table tfoot {
                    border-top: 1px solid black;
                }

                /* container */
                .container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                }

                .sticky-top {
                    position: sticky;
                    top: 0;
                }
            </style>

            <body>
                <div class="container">
                    <form action="Tcontroller.php" method="post" style="margin: 0 1rem;">

                        <!-- pesan -->
                        <?php if (isset($_SESSION['pesanobat'])) : ?>
                            <h4>Obat sudah masuk!</h4>
                        <?php endif; ?>

                        <div class="sticky-top">
                            <div class="form-group">
                                <label for="obat">Obat</label>
                                <select name="idObat" id="obat" required>
                                    <option value="">-- Pilih Obat --</option>
                                    <?php foreach ($readObat as $r) : ?>
                                        <option value="<?= $r['idobat']; ?>"><?= $r['namaobat'] . ' | Rp' . number_format($r['hargajual'], 0, ',', '.'); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" id="jumlah" name="jumlahObat" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="addButton" class="addButton" id="addButton">Tambah Obat Lainnya</button>
                            </div>
                        </div>
                    </form>

                    <form action="Tcontroller.php" method="post">
                        <input type="hidden" name="tanggalTransaksi" value="<?= $_SESSION['tanggalTransaksi']; ?>">
                        <input type="hidden" name="pelanggan" value="<?= $_SESSION['pelanggan']; ?>">
                        <input type="hidden" name="kategoriPelangganTransaksi" value="<?= $_SESSION['kategoriPelangganTransaksi']; ?>">
                        <div class="table">
                            <table class="first-table">
                                <thead>
                                    <tr>
                                        <td>Tanggal Transaksi</td>
                                        <td><?= $_SESSION['tanggalTransaksi']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pelanggan</td>
                                        <td><?= $readPelanggan['namalengkap']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Kategori Pelanggan</td>
                                        <td><?= $_SESSION['kategoriPelangganTransaksi']; ?></td>
                                    </tr>
                                </thead>
                            </table>

                            <table class="second-table">
                                <thead>
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $j = 1;
                                    $l = 1;
                                    ?>
                                    <?php if (isset($_SESSION['daftarObat'])) :  ?>
                                        <?php foreach ($_SESSION['daftarObat'] as $dob) : ?>
                                            <tr>
                                                <input type="hidden" name="idObat<?= $i++; ?>" value="<?= $dob['idobat'] ?>">
                                                <input type="hidden" name="hargaJual<?= $j++; ?>" value="<?= $dob['hargajual'] ?>">
                                                <input type="hidden" name="jumlahObat<?= $l++; ?>" value="<?= $dob['jumlahobat'] ?>">
                                                <input type="hidden" name="arrLength" value="<?= count($_SESSION['daftarObat']); ?>">
                                                <td><?= $dob['namaobat']; ?></td>
                                                <td><?= number_format($dob['jumlahobat'], 0, ',', '.'); ?></td>
                                                <td>Rp<?= number_format($dob['hargajual'], 0, ',', '.'); ?></td>

                                                <?php $grand += $dob['jumlahobat'] * $dob['hargajual']; ?>
                                                <td>Rp<?= number_format($dob['jumlahobat'] * $dob['hargajual'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Grand Total</td>
                                        <td>Rp<?= number_format($grand, 0, ',', '.'); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="bayar">Bayar</label>
                            <input type="number" name="bayar" id="bayar" placeholder="Rp">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="grandTotal" value="<?= $grand; ?>">
                            <button type="submit" class="confirmButton" name="finalTransaksi">Selesaikan Transaksi</button>
                        </div>
                    </form>
                </div>


            </body>

            </html>

    </div>
    </main>

    </div>

</body>

</html>