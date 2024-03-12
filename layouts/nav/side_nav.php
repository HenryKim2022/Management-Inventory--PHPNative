<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <!-- Sidenav Menu Heading (Account)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <!-- <div class="sidenav-menu-heading d-sm-none">Account</div> -->
                    <!-- Sidenav Link (Alerts)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <!-- <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="bell"></i></div>
                        Alerts
                        <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                    </a> -->
                    <!-- Sidenav Link (Messages)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <!-- <a class="nav-link d-sm-none" href="#!">
                        <div class="nav-link-icon"><i data-feather="mail"></i></div>
                        Messages
                        <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                    </a> -->
                    <!-- Sidenav Menu Heading (Core)-->
                    <div class="sidenav-menu-heading m-0 mt-0">Home</div>
                    <!-- Sidenav Accordion (Dashboard)-->
                    <a class="nav-link collapsed" aria-expanded="false" aria-controls="collapseDashboards"
                        href="<?= $app_domain ?>">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        Dashboards
                        <div class="sidenav-collapse-arrow"><i class=""></i></div>
                    </a>
                    <!-- <a class="nav-link collapsed" aria-expanded="false" aria-controls="collapseDashboards"
                        onclick="dashboard_pg(event)">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        Dashboards
                        <div class="sidenav-collapse-arrow"><i class=""></i></div>
                    </a> -->

                    <!-- <script>
                    function dashboard_pg(event) {
                        // event.preventDefault();
                        window.location.replace($app_domain);
                    }
                    </script> -->



                    <!-- Sidenav Heading (Custom)-->
                    <div class="sidenav-menu-heading">Manage Goods</div>
                    <!-- Sidenav Accordion (Flows)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapseFlows" aria-expanded="false" aria-controls="collapseFlows">
                        <div class="nav-link-icon"><i data-feather="repeat"></i></div>
                        Flows
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseFlows" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="mg_in.php">Incoming</a>
                            <a class="nav-link" href="mg_out.php">Outcoming</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Item Stocks)-->
                    <a class="nav-link collapsed" href="mg_st.php" data-bs-toggle="" data-bs-target=""
                        aria-expanded="false" aria-controls="collapseSoG">
                        <div class="nav-link-icon"><i data-feather="package"></i></div>
                        Stocks
                        <div class="sidenav-collapse-arrow"><i class=""></i></div>
                    </a>
                    <!-- Sidenav Accordion (Goods Attribute)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapseGoodsAttribute" aria-expanded="false" aria-controls="collapseFlows">
                        <div class="nav-link-icon"><i data-feather="codesandbox"></i></div>
                        Attribute
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseGoodsAttribute" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="mg_parts.php">Goods Parts</a>
                        </nav>
                    </div>


                    <!-- Sidenav Heading (Custom)-->
                    <div class="sidenav-menu-heading">Manage Employee</div>
                    <!-- Nested Sidenav Accordion (Apps -> Employee Management)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#appsCollapseUserManagement" aria-expanded="false"
                        aria-controls="appsCollapseUserManagement">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Employee
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="appsCollapseUserManagement" data-bs-parent="#accordionSidenavAppsMenu">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="mg_empl.php">List of Employee</a>
                            <a class="nav-link" href="mg_div.php">Division</a>
                        </nav>
                    </div>


                    <!-- Sidenav Heading (Custom)-->
                    <div class="sidenav-menu-heading">Manage Sites</div>
                    <!-- Nested Sidenav Accordion (Apps -> User Management)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#appsCollapseUserLogins" aria-expanded="false"
                        aria-controls="appsCollapseUserManagement">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Site Users
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="appsCollapseUserLogins" data-bs-parent="#accordionSidenavAppsMenu">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link" href="mg_ulogins.php">List of Users</a>
                            <a class="nav-link" href="mg_ulev.php">List of UserLevels</a>
                        </nav>
                    </div>
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="nav-link-icon"><i data-feather="grid"></i></div>
                        General Informations
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                            <!-- Nested Sidenav Accordion (Pages -> Account)-->
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="" data-bs-target=""
                                aria-expanded="false" aria-controls="pagesCollapseAccount">
                                Dashboard Stands
                                <div class="sidenav-collapse-arrow"><i class=""></i></div>
                            </a>
                        </nav>
                    </div>



                    <!-- Sidenav Heading (Custom)-->
                    <div class="sidenav-menu-heading">About App</div>
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#aboutAppModal" aria-expanded="false" aria-controls="collapsePages">
                        <div class="nav-link-icon"><i data-feather="slack"></i></div>
                        About Us
                        <div class="sidenav-collapse-arrow"><i class=""></i></div>
                    </a>
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start(); // Jika belum dimulai, mulai sesi
                    }
                    // Cek apakah pengguna sudah login
                    if (isset($_SESSION['log']) && $_SESSION['log'] === 'true') {
                        // Akses nik dari session
                        $loggedin_nik = $_SESSION['loggedin_nik'];

                        $cekdb = mysqli_query(
                            $conn,
                            "SELECT tb_pegawai.nama_dpn, tb_pegawai.nama_blk, tb_pegawai.alamat_dom, tb_pegawai.created_at, tb_pegawai.updated_at, tb_level.user_level
                            FROM tb_login
                            INNER JOIN tb_pegawai ON tb_login.NIK = tb_pegawai.NIK
                            INNER JOIN tb_level ON tb_login.user_level = tb_level.user_level
                            WHERE tb_login.NIK = '$loggedin_nik';
                            "
                        );
                        $data = mysqli_fetch_all($cekdb, MYSQLI_ASSOC);

                        $nama_dpn = $_SESSION['nama_dpn'] = $data[0]['nama_dpn'];
                        $nama_blk = $_SESSION['nama_blk'] = $data[0]['nama_blk'];
                        $nama_lnkp =  "$nama_dpn " . "$nama_blk";
                        if (strlen($nama_lnkp) <= 22) {
                            $nama_lnkp =  "$nama_dpn " . "$nama_blk";
                        } else {
                            $nama_lnkp =  "$nama_dpn ";
                        }
                    } else {
                        // Redirect atau tampilkan pesan bahwa pengguna belum login
                        $nama_lnkp =  "None";
                    }
                    ?>
                    <div class="sidenav-footer-title overflow-auto"><?= $nama_lnkp ?></div>

                </div>
            </div>
        </nav>
    </div>


    <!-- Modal About Us -->
    <div class="modal fade" id="aboutAppModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">About Us</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" data-feather="slack"></button>
                    <!-- <div class="nav-link-icon"><i data-feather="slack"></i></div> -->
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-md-6 mb-4 text-center mt-3">
                        <h3 class="">
                            <u class="cust-u">
                                <?= $app_purpose ?>
                            </u>
                        </h3>
                    </div>
                    <div class="row">
                        <!-- Group Logo  -->
                        <div class="col-xl-12 col-md-6 mb-4 justify-content-center">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5 mr-2 Group3Logo">
                                            <table>
                                                <tr>
                                                    <td
                                                        class="d-flex align-content-sm-between justify-content-center align-middle">
                                                        <img src="dist/assets/img/logo.png" alt="SiteLogo"
                                                            style="height: 83%; width: 62%">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-center text-xs font-weight-bold text-uppercase mb-1 mt-1 justify-content-center"
                                                            style="color:#f6503b;">
                                                            <a>
                                                                <b><?= $institution_name ?></b>
                                                            </a>
                                                            <div
                                                                class="text-center text-xs font-weight-lighter text-uppercase mb-1 mt-1">
                                                                <a><i><?= $app_name ?></i></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>



                                        </div>
                                        <div class="col-7">
                                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                            <div class="text-md text-green font-weight-bold text-uppercase mb-1">
                                                <a class="text-orange">
                                                    Made By:
                                                </a>
                                            </div>

                                            <style>
                                            .li-mem {
                                                font-size: small;
                                            }
                                            </style>
                                            <div class="cust-ul pl-0 ml-4 grad-txt-2 text-md">
                                                <div class="row">
                                                    <!-- $group_members -->
                                                    <?php
                                                    for ($i = 0; $i < count($group_members); $i++) :
                                                    ?>
                                                    <span class="li-mem">
                                                        <i class="cust-j fad fa-laptop-code"></i>
                                                        <i class="fa-duotone fa-arrow-right-from-arc"></i>
                                                        <?php
                                                            for ($j = 0; $j < count($group_members[$i]); $j++) :
                                                                echo $group_members[$i][$j] . " ";
                                                            endfor;
                                                            ?>
                                                    </span>
                                                    <?php
                                                    endfor;
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button">Understood</button>
            </div> -->
            </div>
        </div>
    </div>




    <div id="layoutSidenav_content">
        <!-- <main>
            ?php include('layouts/contents.php') ?>
        </main>

        ?php include('layouts/footer.php') ?>
        ?php include('layouts/js_bundle.php') ?>
    </div>

</div> -->