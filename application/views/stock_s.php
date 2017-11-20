<!DOCTYPE html>
<html>

    <head>
        <title>Stocks,Library Manage</title>
        <?php $this->load->view('include/head_includes'); ?>
        <link href="<?php echo base_url('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    </head>

    <body class="theme-blue">

        <?php $this->load->view('include/navbar'); ?>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Stock MANAGEMENT
                                    <small><?php echo'Total ' . count($books) . ' books added'; ?></small>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="button-demo">
                                    <a href="<?php echo base_url('stocks/add'); ?>" class="btn btn-primary waves-effect">Add Stocks</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    ALL Books AND Stock
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">


                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Book</th>
                                                <th>Total Stock</th>
                                                <th>In STock</th>
                                                <th>Percent left</th>
                                            </tr>
                                        </thead>        
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Book</th>
                                                <th>Total Stock</th>
                                                <th>In STock</th>
                                                <th>Percent left</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($books as $book): ?>
                                                <tr>
                                                    <td><?php echo $book->bookid; ?></td>
                                                    <td><?php echo $book->name; ?></td>
                                                    <td><?php echo $book->total; ?></td>
                                                    <td><?php
                                                        echo $book->remaining;
                                                        $percent = $book->remaining * 100 / ($book->total > 0 ? $book->total : 1);
                                                        ?></td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-info" role="progressbar"style="width: <?php echo $percent; ?>%">
                                                                <span class="sr-only">20% Complete</span>
                                                            </div>
                                                        </div>
                                                    </td>  
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Exportable Table -->



            </div>
        </section>
        <?php $this->load->view('include/footer_includes'); ?>
        <script src="<?php echo base_url('assets/plugins/jquery-datatable/jquery.dataTables.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/jquery-datatable/extensions/export/jszip.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="<?php echo base_url('assets/'); ?>plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script>
            $(function () {

                $('.js-exportable').DataTable({
                    dom: 'Bfrtip',
                    responsive: true,
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>
    </body>

</html>