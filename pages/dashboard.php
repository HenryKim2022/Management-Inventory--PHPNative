<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <!-- Toast button trigger -->
                    <h1 id="toastBasicTrigger" class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        DASHBOARD
                    </h1>
                    <div class="page-header-subtitle">
                    </div>
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                        <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin"
                            placeholder="Select date range..." />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <!-- Example Colored Cards for Dashboard Demo-->
    <div class="row">
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <?php include('fungsi/koneksi.php');
                    $check = mysqli_query(
                        $conn,
                        "SELECT COUNT(*) AS jmlstokbr FROM tb_stok;"
                    );
                    $data = mysqli_fetch_all($check, MYSQLI_ASSOC);
                    $totalstok = $data[0]['jmlstokbr'];
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Total Stocks</div>
                            <div class="text-lg fw-bold"><?= $totalstok ?></div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="package"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" onclick="stocks_pg(event)">View Data</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <?php include('fungsi/koneksi.php');
                    $check = mysqli_query(
                        $conn,
                        "SELECT COUNT(*) AS jmlbrin FROM tb_br_in;"
                    );
                    $data = mysqli_fetch_all($check, MYSQLI_ASSOC);
                    $totalbrin = $data[0]['jmlbrin'];
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Incoming Goods</div>
                            <div class="text-lg fw-bold"><?= $totalbrin ?></div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="repeat"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" onclick="incoming_pg(event)">View Data</a>
                    <!-- <a class="text-white stretched-link" href="pages/manages/mgmt_in.php">View Data</a> -->
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <?php include('fungsi/koneksi.php');
                    $check = mysqli_query(
                        $conn,
                        "SELECT COUNT(*) AS jmlbrout FROM tb_br_out;"
                    );
                    $data = mysqli_fetch_all($check, MYSQLI_ASSOC);
                    $totalbrout = $data[0]['jmlbrout'];
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">Outcoming Goods</div>
                            <div class="text-lg fw-bold"><?= $totalbrout ?></div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="repeat"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" onclick="outcoming_pg(event)">View Data</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <?php include('fungsi/koneksi.php');
                        $check = mysqli_query(
                            $conn,
                            "SELECT COUNT(*) AS jmlusr FROM tb_pegawai;"
                        );
                        $data = mysqli_fetch_all($check, MYSQLI_ASSOC);
                        $totalempl = $data[0]['jmlusr'];
                        ?>
                        <div class="me-3">
                            <div class="text-white-75 small">Total Employee</div>
                            <div class="text-lg fw-bold"><?= $totalempl ?></div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="users"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between small">
                    <a class="text-white stretched-link" onclick="users_pg(event)">View Data</a>
                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <script>
        function incoming_pg(event) {
            event.preventDefault();
            window.location.replace('mg_in.php');
        }

        function outcoming_pg(event) {
            event.preventDefault();
            window.location.replace('mg_out.php');
        }

        function stocks_pg(event) {
            event.preventDefault();
            window.location.replace('mg_st.php');
        }

        function users_pg(event) {
            event.preventDefault();
            window.location.replace('mg_empl.php');
        }
        </script>

    </div>
    <!-- Example Charts for Dashboard Demo-->
    <div class="row">
        <div class="col-xl-6 mb-4 d-none">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    Earnings Breakdown
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample"
                            type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="text-gray-500" data-feather="more-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                            aria-labelledby="areaChartDropdownExample">
                            <a class="dropdown-item" href="#!">Last 12 Months</a>
                            <a class="dropdown-item" href="#!">Last 30 Days</a>
                            <a class="dropdown-item" href="#!">Last 7 Days</a>
                            <a class="dropdown-item" href="#!">This Month</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area"><canvas id="myAreaChart" width="100%" height="30"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-4 d-none">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    Monthly Revenue
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample"
                            type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="text-gray-500" data-feather="more-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                            aria-labelledby="areaChartDropdownExample">
                            <a class="dropdown-item" href="#!">Last 12 Months</a>
                            <a class="dropdown-item" href="#!">Last 30 Days</a>
                            <a class="dropdown-item" href="#!">Last 7 Days</a>
                            <a class="dropdown-item" href="#!">This Month</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-bar"><canvas id="myBarChart" width="100%" height="30"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Example DataTable for Dashboard Demo-->
    <?php if ($noDasbhoardTB == true) : ?>
    <div id="media_wrapper" class="card mb-4 editor-preview-full d-none">
        <?php else : ?>
        <div id="media_wrapper" class="card mb-4 editor-preview-full">
            <?php endif; ?>
            <!-- <div class="card card-header-actions h-100"> -->
            <div class="card card-header-actions d-flex card-scroll">
                <div class="card-header">
                    Goods Flows Monitor
                    <div class="dropdown no-caret">
                        <button class="btn minMaxBtn btn-transparent-dark btn-icon" data-widget="fullscreen"
                            id="areaChartDropdownExample0" role="button" aria-haspopup="true" aria-expanded="false"
                            onclick="fullscreenFunct()"><i
                                class="fas fa-expand-arrows-alt text-gray-500"></i></i></button>
                        <button class="btn minMaxBtn btn-transparent-dark btn-icon dropdown-toggle d-none"
                            id="areaChartDropdownExample1" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                            aria-labelledby="areaChartDropdownExample1">
                            <a class="dropdown-item" href="#!">Last 12 Months</a>
                            <a class="dropdown-item" href="#!">Last 30 Days</a>
                            <a class="dropdown-item" href="#!">Last 7 Days</a>
                            <a class="dropdown-item" href="#!">This Month</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!">Custom Range</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive-sm overflow-auto">
                <table id="datatablesSimple" cellspacing="0" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- part, namabrg, tgl, jmlh, nama org, divisi -->
                            <th>No.</th>
                            <th>Part Name</th>
                            <th>D/T In</th>
                            <th>Qty In</th>
                            <th>D/T Out</th>
                            <th>Qty Out</th>
                            <th>Current Stocks</th>
                            <th>Last Modified</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr></tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (session_status() == PHP_SESSION_NONE) : {
                                session_start();
                            }
                        endif;
                        $cekdb = mysqli_query(
                            $conn,

                            // V2 (BELOW)
                            "SELECT tb_br_in.id_brin, tb_br_in.tanggal AS tglin, tb_br_in.jmlh AS jmlhin, tb_br_in.NIK, 
                        tb_br_out.id_brout, tb_br_out.tanggal AS tglout, tb_br_out.jmlh AS jmlhout, tb_br_out.NIK, 
                        tb_stok.namapart, tb_stok.updated_at AS tglupstock,
                        tb_stok.jmlh_ttl
                        FROM tb_br_in
                        LEFT JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                        LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                        LEFT JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                        LEFT JOIN tb_br_out ON tb_stok.id_stockbarang = tb_br_out.id_stockbarang
                        ORDER BY tb_stok.updated_at DESC;
                        "

                            // // V8
                            // "WITH cte AS (
                            //     -- Common Table Expression (CTE) to retrieve initial data
                            //     SELECT
                            //         tb_stok.id_stockbarang,
                            //         tb_stok.jmlh_ttl,
                            //         tb_part.namapart,
                            //         tb_stok.created_at AS tglupstock,
                            //         tb_br_in.tanggal AS tglin,
                            //         tb_br_in.jmlh AS jmlhin,
                            //         tb_br_in.NIK AS br_in_NIK,
                            //         tb_br_out.id_brout,
                            //         tb_br_out.tanggal AS tglout,
                            //         tb_br_out.jmlh AS jmlhout,
                            //         tb_br_out.NIK AS br_out_NIK,
                            //         LAG(tb_stok.jmlh_ttl) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_jmlh_ttl,
                            //         LAG(tb_br_in.tanggal) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_tglin,
                            //         LAG(tb_br_in.jmlh) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_jmlhin,
                            //         LAG(tb_br_out.tanggal) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_tglout,
                            //         LAG(tb_br_out.jmlh) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_jmlhout,
                            //         LAG(tb_stok.created_at) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_tglupstock
                            //     FROM tb_stok
                            //     JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            //     LEFT JOIN tb_br_in ON tb_stok.id_stockbarang = tb_br_in.id_stockbarang
                            //     RIGHT JOIN tb_br_out ON tb_stok.id_stockbarang = tb_br_out.id_stockbarang
                            //     WHERE tb_part.namapart NOT IN (
                            //         -- Subquery to exclude parts with associated records in tb_br_in or tb_br_out
                            //         SELECT tb_part.namapart
                            //         FROM tb_part
                            //         LEFT JOIN tb_br_in ON tb_part.namapart = tb_br_in.id_stockbarang
                            //         LEFT JOIN tb_br_out ON tb_part.namapart = tb_br_out.id_stockbarang
                            //         WHERE tb_br_in.id_stockbarang IS NOT NULL OR tb_br_out.id_stockbarang IS NOT NULL
                            //     )
                            //     AND tb_stok.jmlh_ttl <> 0 -- Exclude rows with jmlh_ttl = 0
                            //     ORDER BY tb_stok.updated_at DESC
                            // )
                            // SELECT
                            //     id_stockbarang,
                            //     namapart,
                            //     CASE WHEN tglin = prev_tglin THEN '' ELSE tglin END AS tglin,
                            //     CASE WHEN jmlhin = prev_jmlhin THEN '' ELSE jmlhin END AS jmlhin,
                            //     CASE WHEN tglout = prev_tglout THEN '' ELSE tglout END AS tglout,
                            //     CASE WHEN jmlhout = prev_jmlhout THEN '' ELSE jmlhout END AS jmlhout,
                            //     CASE WHEN jmlh_ttl = prev_jmlh_ttl THEN '' ELSE jmlh_ttl END AS jmlh_ttl,
                            //     CASE WHEN tglupstock = prev_tglupstock THEN '' ELSE tglupstock END AS tglupstock,
                            //     br_in_NIK,
                            //     id_brout,
                            //     br_out_NIK
                            // FROM cte
                            // UNION
                            // SELECT
                            //     id_stockbarang,
                            //     namapart,
                            //     CASE WHEN tglin = prev_tglin THEN '' ELSE tglin END AS tglin,
                            //     CASE WHEN jmlhin = prev_jmlhin THEN '' ELSE jmlhin END AS jmlhin,
                            //     CASE WHEN tglout = prev_tglout THEN '' ELSE tglout END AS tglout,
                            //     CASE WHEN jmlhout = prev_jmlhout THEN '' ELSE jmlhout END AS jmlhout,
                            //     CASE WHEN jmlh_ttl = prev_jmlh_ttl THEN '' ELSE jmlh_ttl END AS jmlh_ttl,
                            //     CASE WHEN tglupstock = prev_tglupstock THEN '' ELSE tglupstock END AS tglupstock,
                            //     br_in_NIK,
                            //     id_brout,
                            //     br_out_NIK
                            // FROM cte
                            // WHERE id_stockbarang IS NULL;
                            // "


                            // // V7
                            // "WITH cte AS (
                            //         SELECT tb_br_in.id_brin, tb_br_in.tanggal AS tglin, tb_br_in.jmlh AS jmlhin, tb_br_in.NIK AS br_in_NIK,
                            //             tb_br_out.id_brout, tb_br_out.tanggal AS tglout, tb_br_out.jmlh AS jmlhout, tb_br_out.NIK AS br_out_NIK,
                            //             tb_stok.namapart, tb_stok.updated_at AS tglupstock,
                            //             tb_stok.jmlh_ttl,
                            //             LAG(tb_br_in.jmlh) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_jmlhin,
                            //             LAG(tb_br_in.tanggal) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_tglin,
                            //             LAG(tb_br_out.tanggal) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_tglout,
                            //             LAG(tb_br_out.jmlh) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_jmlhout
                            //         FROM tb_br_in
                            //         LEFT JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                            //         LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                            //         LEFT JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            //         INNER JOIN tb_br_out ON tb_br_in.id_stockbarang = tb_br_out.id_stockbarang
                            //         ORDER BY tb_stok.updated_at DESC
                            //     )
                            //     SELECT
                            //         id_brin,
                            //         CASE WHEN jmlhin = prev_jmlhin THEN '' ELSE namapart END AS namapart,
                            //         CASE WHEN tglin = prev_tglin THEN '' ELSE tglin END AS tglin,
                            //         CASE WHEN jmlhin = prev_jmlhin THEN '' ELSE jmlhin END AS jmlhin,
                            //         CASE WHEN tglout = prev_tglout THEN '' ELSE tglout END AS tglout,
                            //         CASE WHEN jmlhout = prev_jmlhout THEN '' ELSE jmlhout END AS jmlhout,
                            //         jmlh_ttl,
                            //         tglupstock,
                            //         br_in_NIK,
                            //         id_brout,
                            //         br_out_NIK
                            //     FROM cte;
                            // "

                            // // V6
                            // "WITH cte AS (
                            //     SELECT
                            //       tb_br_in.id_brin,
                            //       tb_br_in.tanggal AS tglin,
                            //       tb_br_in.jmlh AS jmlhin,
                            //       tb_br_in.NIK AS br_in_NIK,
                            //       tb_br_out.id_brout,
                            //       tb_br_out.tanggal AS tglout,
                            //       tb_br_out.jmlh AS jmlhout,
                            //       tb_br_out.NIK AS br_out_NIK,
                            //       tb_stok.namapart,
                            //       tb_stok.updated_at AS tglupstock,
                            //       tb_stok.jmlh_ttl
                            //     FROM tb_br_in
                            //     LEFT JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                            //     LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                            //     LEFT JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            //     INNER JOIN tb_br_out ON tb_br_in.id_stockbarang = tb_br_out.id_stockbarang
                            //     ORDER BY tb_stok.updated_at DESC
                            //   )

                            //   SELECT
                            //     ROW_NUMBER() OVER (ORDER BY cte.tglupstock) AS `No.`,
                            //     cte.namapart AS `namapart`,
                            //     cte.tglin AS `tglin`,
                            //     cte.jmlhin AS `jmlhin`,
                            //     cte.tglout AS `tglout`,
                            //     cte.jmlhout AS `jmlhout`,
                            //     cte.jmlh_ttl AS `jmlh_ttl`,
                            //     cte.tglupstock AS `tglupstock`,
                            //     '#' AS `#`
                            //   FROM cte
                            //   WHERE cte.namapart = :partName;
                            // "
                            // // Fatal error: Uncaught mysqli_sql_exception: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ':partName' at line 33 in G:\laragon\www\pages\dashboard.php:264 Stack trace: #0 G:\laragon\www\pages\dashboard.php(264): mysqli_query(Object(mysqli), 'WITH cte AS (\r\n...') #1 G:\laragon\www\index.php(16): include('G:\\laragon\\www\\...') #2 {main} thrown in G:\laragon\www\pages\dashboard.php on line 264




                            // // V5
                            // "WITH cte AS (
                            //         SELECT tb_br_in.id_brin, tb_br_in.tanggal AS tglin, tb_br_in.jmlh AS jmlhin, tb_br_in.NIK AS br_in_NIK,
                            //             tb_br_out.id_brout, tb_br_out.tanggal AS tglout, tb_br_out.jmlh AS jmlhout, tb_br_out.NIK AS br_out_NIK,
                            //             tb_stok.namapart, tb_stok.updated_at AS tglupstock,
                            //             tb_stok.jmlh_ttl,
                            //             LAG(tb_br_in.jmlh) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_jmlhin,
                            //             LAG(tb_br_in.tanggal) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_tglin,
                            //             LAG(tb_br_out.tanggal) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_tglout,
                            //             LAG(tb_br_out.jmlh) OVER (ORDER BY tb_stok.updated_at DESC) AS prev_jmlhout
                            //         FROM tb_br_in
                            //         LEFT JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                            //         LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                            //         LEFT JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            //         INNER JOIN tb_br_out ON tb_br_in.id_stockbarang = tb_br_out.id_stockbarang
                            //         ORDER BY tb_stok.updated_at DESC
                            //     )
                            //     SELECT
                            //         id_brin,
                            //         CASE WHEN jmlhin = prev_jmlhin THEN '' ELSE namapart END AS namapart,
                            //         CASE WHEN tglin = prev_tglin THEN '' ELSE tglin END AS tglin,
                            //         CASE WHEN jmlhin = prev_jmlhin THEN '' ELSE jmlhin END AS jmlhin,
                            //         CASE WHEN tglout = prev_tglout THEN '' ELSE tglout END AS tglout,
                            //         CASE WHEN jmlhout = prev_jmlhout THEN '' ELSE jmlhout END AS jmlhout,
                            //         jmlh_ttl,
                            //         tglupstock,
                            //         br_in_NIK,
                            //         id_brout,
                            //         br_out_NIK
                            //     FROM cte;
                            // "

                            //// V4 (BELOW)
                            // "SELECT tb_br_in.id_brin, tb_br_in.tanggal AS tglin, tb_br_in.jmlh AS jmlhin, tb_br_in.NIK, 
                            // tb_br_out.id_brout, tb_br_out.tanggal AS tglout, tb_br_out.jmlh AS jmlhout, tb_br_out.NIK, 
                            // tb_stok.namapart, tb_stok.updated_at AS tglupstock,
                            // tb_stok.jmlh_ttl
                            // FROM tb_br_in
                            // LEFT JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                            // LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                            // LEFT JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            // INNER JOIN tb_br_out ON tb_br_in.id_stockbarang = tb_br_out.id_stockbarang
                            // ORDER BY tb_stok.updated_at DESC;
                            // "


                            //// V3 (BELOW)
                            // "SELECT tb_br_in.id_brin, tb_br_in.tanggal AS tglin, tb_br_in.jmlh AS jmlhin, tb_br_in.NIK, 
                            // tb_br_out.id_brout, tb_br_out.tanggal AS tglout, tb_br_out.jmlh AS jmlhout, tb_br_out.NIK, 
                            // tb_stok.namapart, tb_stok.updated_at AS tglupstock,
                            // tb_stok.jmlh_ttl
                            // FROM tb_br_in
                            // LEFT JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                            // LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                            // LEFT JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            // LEFT JOIN tb_br_out ON tb_br_in.id_stockbarang = tb_br_out.id_stockbarang
                            // ORDER BY tb_stok.updated_at DESC;
                            // "
                            //// V2 (BELOW)
                            // "SELECT tb_br_in.id_brin, tb_br_in.tanggal AS tglin, tb_br_in.jmlh AS jmlhin, tb_br_in.NIK, 
                            // tb_br_out.id_brout, tb_br_out.tanggal AS tglout, tb_br_out.jmlh AS jmlhout, tb_br_out.NIK, 
                            // tb_stok.namapart, tb_stok.updated_at AS tglupstock,
                            // tb_stok.jmlh_ttl
                            // FROM tb_br_in
                            // LEFT JOIN tb_pegawai ON tb_br_in.NIK = tb_pegawai.NIK
                            // LEFT JOIN tb_stok ON tb_br_in.id_stockbarang = tb_stok.id_stockbarang
                            // LEFT JOIN tb_part ON tb_stok.namapart = tb_part.namapart
                            // LEFT JOIN tb_br_out ON tb_stok.id_stockbarang = tb_br_out.id_stockbarang
                            // ORDER BY tb_stok.updated_at DESC;
                            // "
                            //// V1 (BELOW)
                            // "SELECT tb_br_out.id_brout, tb_br_out.tanggal, tb_br_out.jmlh, tb_br_out.id_stockbarang, 
                            //     tb_br_out.updated_at, tb_br_out.NIK, tb_stok.namapart
                            //     FROM tb_br_out
                            //     LEFT JOIN tb_pegawai ON tb_br_out.NIK = tb_pegawai.NIK
                            //     LEFT JOIN tb_stok ON tb_br_out.id_stockbarang = tb_stok.id_stockbarang
                            //     ORDER BY tb_stok.updated_at DESC;
                            // "
                        );
                        $showtotable = $cekdb;
                        ?>

                        <?php $i = 1;
                        while ($res = mysqli_fetch_assoc($showtotable)) :  ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $res['namapart'] ?></td>
                            <td>
                                <?php
                                    $date = $res['tglin'];
                                    if (!empty($date)) :
                                        $formattedDate = date('Y-m-d', strtotime($date));
                                        echo $formattedDate;
                                    else :
                                    // echo 'None';
                                    endif;
                                    ?>
                            </td>
                            <td>
                                <?php
                                    if ($res['jmlhin'] != '') :
                                        echo $res['jmlhin'];
                                    else :
                                    // echo 'None';
                                    endif;
                                    ?>
                            </td>
                            <td><?php
                                    $date = $res['tglout'];
                                    if (!empty($date)) :
                                        $formattedDate = date('Y-m-d', strtotime($date));
                                        echo $formattedDate;
                                    else :
                                    // echo 'None';
                                    endif;
                                    ?></td>
                            <td>
                                <?php
                                    // if (!empty($res['jmlhout'])) :
                                    echo $res['jmlhout'];
                                    // else :
                                    // echo 'None';
                                    // endif;
                                    ?>
                            </td>
                            <td><?= $res['jmlh_ttl'] ?></td>
                            <td>
                                <?php
                                    $date = $res['tglupstock'];
                                    if (!empty($res['tglupstock'])) :
                                        echo $date;
                                    else :
                                    // echo 'None';
                                    endif;
                                    ?>
                            </td>
                            <td class="align-middle align-content-sm-between justify-content-center">
                                <div class="d-flex align-content-sm-between justify-content-center align-middle">
                                    <a data-bs-toggle="modal" data-bs-target="#editDivisionModal"
                                        onclick="tfIDDASH(event, this.id)"
                                        class="show_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                        <i class="fi-ic-gray" data-feather="info"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>



    </div>



    <!-- <td>
    <div class="badge bg-secondary text-white rounded-pill">Part-time</div>
    <div class="badge bg-primary text-white rounded-pill">Full-time</div>
</td>
<td>
    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="more-vertical"></i></button>
    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
</td> -->