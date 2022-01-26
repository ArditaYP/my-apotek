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

function readData($result)
{
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
// $querysupplier="SELECT * FROM tb_obat JOIN tb_supplier ON tb_obat.idsupplier = tb_supplier.idsupplier";
// $resultsupplier = mysqli_query($conn,$querysupplier);
// $readsupplier = readData($resultsupplier);

$querysupplier = "SELECT * FROM tb_supplier";
$resultsupplier = mysqli_query($conn,$querysupplier);
$readsupplier = readData($resultsupplier);
?>

<!DOCTYPE html>
<html>
<head>
    <title>tambahObat</title>
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
</style>
<body> 
    <form action="Ocreate.php" method="post" >
        <h1>Tambah Obat</h1>
        <label for="supplier">Supplier Obat</label>
            <select name="supplierObat" id="supplier" required>
                <option value="">-- Daftar Supplier --</option>
                <?php foreach ($readsupplier as $rp) : ?>
                    <option value="<?= $rp['idsupplier'] ?>"><?= $rp['perusahaan'] ?></option>
                <?php endforeach; ?>
            </select>
        <input type="text" name="namaobat" placeholder="namaobat">
        <input type="text" name="kategoriobat" placeholder="kategoriobat">
        <input type="text" name="hargajual" placeholder="hargajual">
        <input type="text" name="hargabeli" placeholder="hargabeli">
        <input type="text" name="stok_obat" placeholder="stok_obat">
        <input type="text" name="keterangan" placeholder="keterangan">
        <button type="submit" name="tambahobat" class="btn btn-tambah" >Tambah Obat</button>
    </form>
</body>
</html>
        </main>
    </div>
</body>


</html>