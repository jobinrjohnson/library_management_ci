<!DOCTYPE html>
<?php
/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */
?>
<html>
    <head>
        <?php $this->load->view('include/head_includes'); ?>
        <title>Home | Library Management</title>
    </head>
    <body>

        <div class="container">

            <div class="row">

                <?php $this->load->view('include/navbar'); ?>

                <div class="col-md-9">
                    <h2>Welcome Admin</h2>
                   
                    <table width="100%" cellpadding="20px">
                        <tr>
                            <td>
                                <h2><?php echo $status->user_count; ?></h2>
                                <br>
                                Users
                            </td>
                            <td>
                                <h2><?php echo $status->book_count; ?></h2>
                                <br>
                                Books
                            </td>
                        </tr>
                    </table>


                </div>
            </div>

        </div>
    </body>
</html>
