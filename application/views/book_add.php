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
                    <h2 class="main-head">Add A book</h2>

                    <form id="sign_in" method="POST" action="<?php echo base_url('books/add'); ?>">
                        <div class="input-group">
                            <label>Book name</label>
                            <input type="text" class="form-control" name="name" placeholder="Bookname" required>
                        </div>
                        <div class="input-group">
                            <label>RFID</label>
                            <input type="text" class="form-control" name="rfid" placeholder="RFID" required>
                        </div>
                        <div class="input-group">
                            <label>Author</label>
                            <input type="text" class="form-control" name="author" placeholder="Author">
                        </div>
                        <div class="input-group">
                            <label>Published On</label>
                            <input type="date" class="form-control" name="published" placeholder="Published On">
                        </div>      
                        <div class="input-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option>Story</option>
                                <option>SCience</option>
                            </select>
                        </div>                        
                        <div class="input-group">
                            <label>Descriptions</label>
                            <textarea class="form-control" style="height: 100px;" name="descr" rows="5" placeholder="Description"></textarea>
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
