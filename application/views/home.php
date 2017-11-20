<!DOCTYPE html>
<html>

    <head>
        <title>Authors,Library Manage</title>
        <?php $this->load->view('include/head_includes'); ?>
        <!-- Morris Css -->
        <link href="<?php echo base_url('assets/plugins/morrisjs/morris.css'); ?>" rel="stylesheet" />

    </head>

    <body class="theme-blue">

        <?php $this->load->view('include/navbar'); ?>

        <section class="content">
            <div class="container-fluid">


                <!-- Widgets -->
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">dns</i>
                            </div>
                            <div class="content">
                                <div class="text">Books</div>
                                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $status->book_count; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">verified_user</i>
                            </div>
                            <div class="content">
                                <div class="text">Users</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $status->user_count; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">forum</i>
                            </div>
                            <div class="content">
                                <div class="text">CATEGORIES</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $status->category_count; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">person_add</i>
                            </div>
                            <div class="content">
                                <div class="text">AUTHORS</div>
                                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?php echo $status->author_count; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Widgets -->
                <div class="row">
                    <!-- Donut Chart -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>STOCK CHART</h2>
                            </div>
                            <div class="body">
                                <div id="donut_chart" class="graph"></div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Donut Chart -->



                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Books Due</h2>
                            </div>
                            <div class="body">
                                
                            </div>
                        </div>
                    </div>



                </div>




            </div>
        </section>
        <?php $this->load->view('include/footer_includes'); ?>

        <!-- Morris Plugin Js -->
        <script src="<?php echo base_url('assets/plugins/raphael/raphael.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/morrisjs/morris.js'); ?>"></script>
        <script>



            $(function () {
                getMorris('donut', 'donut_chart');
            });


            function getMorris(type, element) {
                Morris.Donut({
                    element: element,
                    data: [{
                            label: 'In Stock',
                            value: <?php echo $dc->remaining * 100 / ($dc->total > 0 ? $dc->total : 1); ?>
                        }, {
                            label: 'Off stock',
                            value: <?php echo ($dc->total - $dc->remaining) * 100 / ($dc->total > 0 ? $dc->total : 1); ?>
                        }],
                    colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)'],
                    formatter: function (y) {
                        return y + '%'
                    }
                });
            }


        </script>
    </body>

</html>