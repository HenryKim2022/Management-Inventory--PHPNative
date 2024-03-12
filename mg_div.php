<!DOCTYPE html>
<html lang="en" class="fontawesome-i2svg-active fontawesome-i2svg-complete">

<!-- HEADER -->
<?php include("layouts/header.php") ?>


<body class="nav-fixed">
    <?php include("layouts/nav/top_nav.php") ?>
    <?php include("layouts/nav/side_nav.php") ?>

    <main>
        <!-- TOAST -->
        <?php include('toasts/user_page_toast.php') ?>

        <!-- ISI HALAMAN -->
        <?php include('pages/manages/mgmt_divisions.php') ?>
        <!-- ./ISI HALAMAN -->
    </main>

    <?php include('layouts/footer.php') ?>
    <?php include_once('layouts/js_bundle.php') ?>
    </div>


    </div>
</body>

</html>