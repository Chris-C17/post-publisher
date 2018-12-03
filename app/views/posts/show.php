<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?php echo URLROOT; ?>/?url=posts" class="btn btn-light">
    <i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
</div>
<p><?php echo $data['post']->body; ?></p>

<!-- If the user who wrote the post is viewing then show edit/delete buttons -->
<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
<!-- Edit -->
<hr>
    <a href="<?php echo URLROOT; ?>/?url=posts/edit/<?php echo $data['post']->id; ?>"
       class="btn btn-dark">Edit</a>

<!-- Delete -->
    <form action="<?php echo URLROOT; ?>/?url=posts/delete/<?php echo $data['post']->id; ?>"
    method = "post" class="pull-right">
        <input type="submit" value="Delete" class="btn btn-danger">

    </form>
<?php endif; ?>

<?php require APPROOT . "/views/inc/footer.php"; ?>
