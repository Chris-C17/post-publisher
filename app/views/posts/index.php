<?php require APPROOT . "/views/inc/header.php"; ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URLROOT;?>/?url=posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
    <p>Hello <?php echo $_SESSION['user_name']; ?>, what is your main focus today?</p>
    <?php foreach($data['posts'] as $post) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3">
        <!-- Using alias to differentiate between the two created_at columns (was returning
        created_at from users, which I didn't want) -->
            Written by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
        </div>
            <p class="card-text"><?php echo $post->body; ?></p>
            <a href="<?php echo URLROOT; ?>/?url=posts/show/<?php echo $post->postID; ?>"
               class="btn btn-dark">More</a>
        </div>
    <?php endforeach; ?>

<pre>
    <?php print_r($data['posts']); ?>
</pre>

<?php require APPROOT . "/views/inc/footer.php"; ?>
