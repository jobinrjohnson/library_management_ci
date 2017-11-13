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
                    <h2 class="main-head">All books</h2>


                    <table width="100%" border="1" cellpadding="10px" rules="all">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>RFID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book): ?>
                                <tr>
                                    <td><?php echo $book->id; ?></td>
                                    <td><?php echo $book->name; ?></td>
                                    <td><?php echo $book->author; ?></td>
                                    <td><?php echo $book->category; ?></td>
                                    <td><?php echo $book->rfid; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>



                </div>
            </div>

        </div>
    </body>
</html>
