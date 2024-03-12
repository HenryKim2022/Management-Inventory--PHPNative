<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="codesandbox"></i></div>
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
                        <button class="btn btn-menutable btn-icon btn-transparent-dark me-2" data-bs-toggle="modal"
                            data-bs-target="#addPartModal"><i data-feather="plus"></i>
                            ADD
                        </button>
                    </div>

                </div>
                <div class="dropdown no-caret">
                    <button class="btn minMaxBtn btn-transparent-dark btn-icon" data-widget="fullscreen"
                        id="areaChartDropdownExample0" role="button" aria-haspopup="true" aria-expanded="false"
                        onclick="fullscreenFunct()"><i class="fas fa-expand-arrows-alt text-gray-500"></i></i></button>
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
                        <th>No.</th>
                        <th>Part Name</th>
                        <th>Created At</th>
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
                        "SELECT tb_part.namapart, tb_part.created_at
                            FROM tb_part
                        "
                    );
                    $showtotable = $cekdb;
                    ?>
                    <?php $i = 1;
                    while ($res = mysqli_fetch_assoc($showtotable)) :  ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <!-- <td>?= $res['id_divisi'] ?></td> -->
                        <td><?= $res['namapart'] ?></td>
                        <td><?= $res['created_at'] ?></td>
                        <td class="align-middle align-content-sm-between justify-content-center">
                            <div class="d-flex align-content-sm-between justify-content-center align-middle">
                                <a id="<?= $res['namapart'] ?>" data-bs-toggle="modal" data-bs-target="#editPartModal"
                                    onclick="tfIDPART(event, this.id)"
                                    class="view_data btn btn-datatable btn-icon btn-transparent-dark me-2">
                                    <i class="fi-ic-yellow" data-feather="edit"></i>
                                </a>
                                <a name="btnDelSelectedPart"
                                    href="/fungsi/part_funct.php?act=del&partname=<?= $res['namapart'] ?>"
                                    class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    onclick="return confirm('Are you sure want to delete *<?= $tbTxtref ?>(<?= $res['namapart'] ?>) ?')">
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
    function tfIDPART(event, id) {
        event.preventDefault();
        $.ajax({
            url: 'layouts/f_wrapper.php',
            method: 'post',
            data: {
                idtoedit: id,
                action: "EDIT",
                which: "PART"
            },
            success: function(data) {
                $('#datatoedit').html(data)
                $('#editPartModal').modal('show');
            }
        })
    }
    </script>




</div>




<!-- Modal Add User Level -->
<div class="modal fade" id="addPartModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Part</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="/fungsi/part_funct.php">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend col-sm-4">
                            <span class="input-group-text" id="">Part Name</span>
                        </div>
                        <input id="addPartName" name="addPartName" type="text" class="form-control"
                            placeholder="e.g. HD 19504-PLC-OOO">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btnAddNewPart">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>




<!-- Modal Edit Parts -->
<div class="modal fade" id="editPartModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Part</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="datatoedit">
                <!-- Modal Body Content at f_wrapper -->
            </div>
            <!-- Footer at f_wrapper -->

        </div>
    </div>
</div>