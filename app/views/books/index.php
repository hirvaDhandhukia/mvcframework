<?php
require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<div class="container-book">
    <?php if(isLoggedIn()): ?>
        <a class="btn green" href="<?php echo URLROOT; ?>/books/create">
            Create
        </a>
    <?php endif; ?>
    <?php foreach($data['books'] as $book): ?>
        <div class="container-item-book">
            <h2>
                <?php echo $book->title; ?>
            </h2>

            <h3>
                <?php echo 'Created on: ' . date('F j h:m' , strtotime($book->created_at)); ?>
            </h3>

            <p>
                <?php echo $book->body; ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>