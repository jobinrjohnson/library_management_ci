<?php if ($this->session->flashdata('msg')): ?>
    <script>
        alert("<?php echo ($this->session->flashdata('msg')); ?>");
    </script>
<?php endif; ?>

<div class="col-md-3">
    <ul class="list-sidebar">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>
            <a href="#">Users</a>
            <ul>
                <li><a href="">View users</a></li>
                <li><a href="">Add users</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Books</a>

            <ul>
                <li><a href="<?php echo base_url('books/'); ?>">View Books</a></li>
                <li><a href="<?php echo base_url('books/add'); ?>">Add Books</a></li>
            </ul>
        </li>
        <li><a href="<?php echo base_url('authorize/logout'); ?>">Logout</a></li>
    </ul>
</div>
