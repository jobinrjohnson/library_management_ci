<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $this->formlib->get_title(1); ?></title>
        <?php $this->load->view('include/head_includes'); ?>
        <link href="<?php echo base_url('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>" rel="stylesheet">
    </head>

    <body class="theme-blue">

        <?php $this->load->view('include/navbar'); ?>

        <section class="content">
            <div class="container-fluid">

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <?php echo $this->formlib->get_title(1); ?>
                                </h2>
                            </div>
                            <form id="add_area" method="post" action="<?php echo base_url('users/do_add'); ?>">
                                <div class="body">
                                    <?php $this->formlib->load_form(); ?>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="header" style="border-top: 1px solid rgba(204, 204, 204, 0.35);">
                                    <div class="alert bg-red" style="display: none;">
                                        Some error occured
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-lg" value="Add Store">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <?php $this->load->view('include/footer_includes'); ?>
        <link href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('assets/plugins/sweetalert/sweetalert.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js'); ?>"></script>

        <script>
            var form_selector = "#add_area";
            function showSuccessHTMLMessage() {
                swal({
                    title: "Success!",
                    text: "Store added successfully <br><br><a class=\"btn btn-sm btn-success\" href=\"<?php echo base_url('users'); ?>\">Okay<a>",
                    html: true,
                    showConfirmButton: false
                });
            }

            $(form_selector).on("submit", function (e) {
                $(form_selector + " .alert").slideUp("slow");
                $.ajax({
                    type: "POST",
                    url: $(form_selector).attr("action"),
                    data: $(form_selector).serialize(),
                    success: function (data) {
                        var obj = eval(data);
                        if (obj.status == 1) {
                            showSuccessHTMLMessage();
                        } else {
                            $(form_selector + " .alert").slideDown("slow");
                            $(form_selector + " .alert").html(obj.msg);
                        }
                    },
                    error: function () {
                        $(form_selector + " .alert").slideDown("slow");
                        $(form_selector + " .alert").text("Unable to connect");
                    }
                });
                e.preventDefault();
            });

        </script>

    </body>

</html>