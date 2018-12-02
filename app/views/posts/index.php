POSTS INDEX

<?php require APPROOT . "/views/inc/header.php"; ?>
    <div class="row">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php URLROOT; ?>/?url=posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>



<?php
echo "Hello " . $_SESSION['user_name'];
require APPROOT . "/views/inc/footer.php"; ?>
