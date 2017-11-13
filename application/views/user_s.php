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

                <div class="col-md-9 content">
                    <h2 class="main-head">All Users</h2>


                    <table width="100%" border="1" cellpadding="10px" rules="all">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date of birth</th>
                                <th>Address</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><?php echo $user->name; ?></td>
                                    <td><?php echo $user->dob; ?></td>
                                    <td><?php echo nl2br($user->address); ?></td>
                                    <td><?php echo $user->email; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>



                </div>
            </div>

        </div>
    </body>
</html>
