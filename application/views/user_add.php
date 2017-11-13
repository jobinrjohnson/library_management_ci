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
                    <h2 class="main-head">Add A User</h2>

                    <form id="sign_in" method="POST" action="<?php echo base_url('users/add'); ?>">
                        <div class="input-group">
                            <label>User name</label>
                            <input type="text" class="form-control" name="name" placeholder="User name" required>
                        </div>
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-group">
                            <label>Date of birth</label>
                            <input type="date" class="form-control" name="dob" value="19/12/2000">
                        </div>   
                        <div class="input-group">
                            <label>Address</label>
                            <textarea class="form-control" style="height: 100px;" name="address" rows="5" placeholder="Address"></textarea>
                        </div>
                        <?php if (isset($msg)): ?>
                            <div class="row">

                                <?php echo $msg; ?>

                            </div>
                        <?php endif; ?>
                        <div class="input-group">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">Submit</button>
                        </div>

                    </form>



                </div>
            </div>

        </div>
    </body>
</html>
