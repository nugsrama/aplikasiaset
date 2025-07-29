<!DOCTYPE html>
<html lang="en">

<?php
$page = "home";
?>

<head>


    <link rel="icon" size="200x200" href="image/logonobby.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


</head>
</head>
<style type="text/css">
    .main {
        height: 100vh;
        min-height: -webkit-fill-avilable;
    }

    .sidebar {
        background: green;

        height: 100%;
        position: fixed !important;

    }

    .sidebar a {
        color: rgb(243, 241, 241);
        text-decoration: none;
        display: block;
        padding: 20px 10px;

    }

    .navbar {
        position: fixed;
    }

    .sidebar .active a {
        color: red;
        text-align: center;
    }

    .active a:hover {
        background-color: black;
        color: black;
    }
</style>

<body>
    <div class="main d-flex flex-column justify-content-end">
        <nav class="navbar navbar-light navbar-expand-lg " style="background-color: black;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collaps d-lg-block" id="navbarTogglerDemo03">
                    <h1 width="200px" style=" line-height: 2;border-bottom: 5px solid black;text-indent: 25px; margin-top: 10px;font-size: 30px; margin: 0px;padding: 2px,1px; color:white ; font-family:  Times New Roman, Times, serif;"> ASSETGA</h1>
                    <li></li>

                    <h4 style="color:white; font-variant: small-caps; text-indent: 15px;  tab-size: 4;   font-style: oblique;">Hello <?php echo $this->session->userdata('name') ?></h4>
                    <a href="<?php echo base_url('home') ?>">Master</a>
                    <a href="<?php echo base_url('assetmasuk/') ?>">Asset Masuk</a>

                    <a href="<?php echo base_url('assetkeluar/') ?>">Asset Keluar</a>
                    <a href="<?php echo base_url('assetadjustment/') ?>">Asset Adjusment</a>
                    <a href="<?php echo base_url('assetwriteoff/') ?>">Write Asset</a>
                    <a href="<?php echo base_url('cekstock/') ?>">Cek stok</a>
                    <?php if ($this->session->userdata('access') != 'User') { ?>
                        <a href="<?php echo base_url('closingbulanan/') ?>">Closing Bulanan</a>
                    <?php } ?>z
                    <a href="<?php echo site_url('logout'); ?>">Logout</a>





                </div>


            </div>
        </div>
    </div>
    <div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script>
            // Add active class to the current button (highlight it)
            var header = document.getElementById("navbarTogglerDemo03");
            var btns = header.getElementsByClassName("a");
            for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("active");
                    current[0].className = current[0].className.replace(" active", "");
                    this.className += " active";
                });
            }
        </script>
</body>

</html>