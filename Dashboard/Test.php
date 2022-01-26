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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-clinic-medical"></span> <span>Apotek</span></h2>
        </div>
        <!--Secciones-del-tablero-->
        <div class="sidebar-menu">
            <ul>
                <?php if ($_SESSION['leveluser'] == '1') : ?>
                    <li>
                        <a href="" class="active"><span class="las la-home"></span>
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
                <img src="img/Avatar.png" width="40px" height="40px" alt="">
                <div>
                    <h4><?= $_SESSION['userlogin'] ?></h4>
                </div>
            </div>
        </header>
        <?php if ($_SESSION['leveluser'] == '1') : ?>
            <main>
                <div class="cards">

                    <div class="card-single">
                        <div>
                            <h1>5</h1>
                            <span>Karyawan</span>
                        </div>
                        <div>
                            <span class="las la-users"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1>12</h1>
                            <span>Obat</span>
                        </div>
                        <div>
                            <span class="las la-stethoscope"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1>25</h1>
                            <span>Pelanggan</span>
                        </div>
                        <div>
                            <span class="las la-wheelchair"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1>2</h1>
                            <span>Supplier</span>
                        </div>
                        <div>
                            <span class="lab la-wpforms"></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
    
    </main>

    </div>

</body>

</html>