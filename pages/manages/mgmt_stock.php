<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="package"></i></div>
                        MANAGE
                    </h1>
                    <div class="page-header-subtitle"><?= $pg_title ?></div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
    <!-- Example DataTable for Dashboard Demo-->
    <div id="media_wrapper" class="card mb-4 editor-preview-full">
        <!-- <div class="card card-header-actions h-100"> -->
        <div class="card card-header-actions d-flex card-scroll">
            <div class="card-header">
                <div class="row">
                    <div class="col-auto m-0">
                        <button class="btn btn-menutable btn-icon btn-transparent-dark me-2" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addGoodsStockModal"><i data-feather="plus"></i>
                            ADD
                        </button>
                    </div>

                </div>
                <div class="dropdown no-caret">
                    <button class="btn minMaxBtn btn-transparent-dark btn-icon" data-widget="fullscreen" id="areaChartDropdownExample0" role="button" aria-haspopup="true" aria-expanded="false" onclick="fullscreenFunct()"><i class="fas fa-expand-arrows-alt text-gray-500"></i></i></button>
                    <button class="btn minMaxBtn btn-transparent-dark btn-icon dropdown-toggle d-none" id="areaChartDropdownExample1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample1">
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
                        <th>No.</th>
                        <th>Part Name</th>
                        <th>Qty</th>
                        <th>Updated At</th>
                        <th>Actions</th>
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
                        "SELECT tb_stok.id_stockbarang, tb_stok.jmlh_ttl, tb_stok.namapart, tb_stok.created_at, tb_stok.updated_at, tb_part.namapart
                        FROM tb_stok
                        INNER JOIN tb_part ON tb_stok.namapart = tb_part.namapart;
                        "
                    );
                    $showtotable = $cekdb;
                    ?>

                    <?php $i = 1;
                    while ($res = mysqli_fetch_assoc($showtotable)) :  ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $res['namapart'] ?></td>
                            <td><?= $res['jmlh_ttl'] ?></td>
                            <td><?= $res['updated_at'] ?></td>
                            <td class="align-middle align-content-sm-between justify-content-center">
                                <div class="d-flex align-content-sm-between justify-content-center align-middle">
                                    <a id="<?= $res['id_stockbarang'] ?>" data-bs-toggle="modal" data-bs-target="#editStockModal" onclick="tfIDSTG(event, this.id)" class="view_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                        <i class="fi-ic-yellow" data-feather="edit"></i>
                                    </a>
                                    <a name="btnDelSelectedStock" href="/fungsi/stock_funct.php?act=del&stock_id=<?= $res['id_stockbarang'] ?>" class="btn btn-datatable btn-icon btn-transparent-dark me-2" onclick="return confirm('Are you sure want to delete *<?= $tbTxtref ?>(<?= $res['namapart'] ?>) ?')">
                                        <i class="fi-ic-red" data-feather="trash-2"></i>
                                    </a>
                                    <a href="#" class="show_data btn btn-datatable btn-icon btn-transparent-dark me-2">
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



    <script>
        function tfIDSTG(event, id) {
            event.preventDefault();
            $.ajax({
                url: 'layouts/f_wrapper.php',
                method: 'post',
                data: {
                    idtoedit: id,
                    action: "EDIT",
                    which: "STOCK"
                },
                success: function(data) {
                    $('#datatoedit').html(data)
                    $('#editGoodsStockModal').modal('show');
                }
            })
        }
    </script>

</div>







<!-- Modal Add Goods Stocks -->
<div class="modal fade" id="addGoodsStockModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Goods/Stocks</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                <!-- <div class="nav-link-icon"><i data-feather="slack"></i></div> -->
            </div>
            <form method="post" action="/fungsi/stock_funct.php">
                <div class="modal-body">
                    <div class="input-group mb-3 justify-content-between align-items-start">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text border-0" id="">
                                PartName</span>
                        </div>
                        <?php
                        if (session_status() == PHP_SESSION_NONE) : {
                                session_start();
                            }
                        endif;
                        $cekdb = mysqli_query(
                            $conn,
                            "SELECT tb_part.namapart
                                FROM tb_part
                            "
                        );
                        $showtotable = $cekdb;
                        ?>
                        <div class="col-8 pr-0 mr-0">
                            <select id="addStockPartID" name="addStockPartID" class="form-control choices-single-1">
                                <option value=""></option>
                                <?php $i = 1;
                                while ($res = mysqli_fetch_assoc($showtotable)) : ?>
                                    <option value="<?= $res['namapart'] ?>">
                                        <?= $res['namapart'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3 d-none">
                        <div class="input-group-prepend col-md-4">
                            <span class="input-group-text border-0">Quantity</span>
                        </div>
                        <input name="qtyStockIn" type="number" class="form-control col-sm-4" placeholder="Qty" value="0" max="0" readonly>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button> -->
                    <!-- <button class="btn btn-primary" type="button">Understood</button> -->
                    <button type="submit" class="btn btn-primary" name="btnAddNewStock">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>





<!-- Modal Edit Goods Stock -->
<div class="modal fade" id="editGoodsStockModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Goods Stock</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="datatoedit">
                <!-- Modal Body Content at f_wrapper -->
            </div>
            <!-- Footer at f_wrapper -->

        </div>
    </div>
</div>