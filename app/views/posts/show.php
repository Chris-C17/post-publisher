<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?php echo URLROOT; ?>/?url=posts" class="btn btn-light">
    <i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<?php require APPROOT . "/views/inc/footer.php"; ?>
