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

// read all data supplier
$querySupplier = "SELECT * FROM tb_supplier";
$resultSupplier = mysqli_query($conn, $querySupplier);
$readSupplier = readData($resultSupplier);

// get spesific data obat 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM tb_obat JOIN tb_supplier ON tb_obat.idsupplier = tb_supplier.idsupplier  WHERE idobat = $id");
    $readObat = readData($result)[0]; // read spesific 
}

// edit data obat
if (isset($_POST['editObatButton'])) {
    $supplierObat = $_POST['supplierObat'];
    $namaObat = $_POST['namaobat'];
    $kategoriObat = $_POST['kategoriobat'];
    $hargajualObat = $_POST['hargajualobat'];
    $hargabeliObat = $_POST['hargabeliobat'];
    $stokObat = $_POST['stokobat'];
    $keteranganObat = $_POST['keteranganobat'];
    $id = $_POST['id'];

    $query = "UPDATE tb_obat SET idsupplier='$supplierObat', namaobat='$namaObat', kategoriobat='$kategoriObat', hargajual='$hargajualObat', hargabeli='$hargabeliObat', stok_obat='$stokObat', keterangan='$keteranganObat' WHERE idobat = $id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
            alert('Obat berhasil diubah');
            document.location.href = 'Otampilan.php';
        </script>";
    } else {
        echo "<script>
            alert('Obat gagal diubah');
            document.location.href = 'Otampilan.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
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
    .formgroup{
        display:flex;
        flex-direction:column;
    }
</style>

<body>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $readObat['idobat']; ?>">
        
        <div class="formgroup">
            <label for="supplier">Supplier Obat</label>
            <select name="supplierObat" id="supplier">
                <?php foreach ($readSupplier as $rp) : ?>
                    <option value="<?= $rp['idsupplier']; ?>"><?= $rp['perusahaan']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="formgroup">
            <label for="nama">Nama Obat</label>
            <input type="text" name="namaobat" id="nama" value="<?= $readObat['namaobat']; ?>" required>
        </div>
        <div class="formgroup">
            <label for="kategori">Kategori Obat</label>
            <input type="text" name="kategoriobat" id="kategori" value="<?= $readObat['kategoriobat']; ?>" required>
        </div>
        <div class="formgroup">
            <label for="hargajual">Harga Jual</label>
            <input type="number" name="hargajualobat" id="hargajual" value="<?= $readObat['hargajual']; ?>" required>
        </div>
        <div class="formgroup">
            <label for="hargabeli">Harga Beli</label>
            <input type="number" name="hargabeliobat" id="hargabeli" value="<?= $readObat['hargabeli']; ?>" required>
        </div>
        <div class="formgroup">
            <label for="stok">Stok</label>
            <input type="number" name="stokobat" id="stok" value="<?= $readObat['stok_obat']; ?>" required>
        </div>
        <div class="formgroup">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keteranganobat" id="keterangan" value="<?= $readObat['keterangan']; ?>" required>
        </div>

        <button type="submit" name="editObatButton" class="btn btn-tambah">Ubah Obat</button>
    </form>
</body>

</html>
        </main>
    </div>
</body>


</html>