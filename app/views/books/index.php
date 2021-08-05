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
            <!-- <img src="" alt="book img"> -->
            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $book->user_id): ?>
                <a class="btn orange" 
                href="<?php echo URLROOT . "/books/update/" . $book->id ?>">
                    Update/Edit
                </a>
                <form action="<?php echo URLROOT . "/books/delete/" . $book->id ?>" method="post">
                    <input type="submit" name="delete" value="Delete" class="btn red">
                </form>
                <form action="<?php echo URLROOT . "/books/purchase/" . $book->id ?>" method="post">
                    <input type="submit" name="purchase" value="Purchase" class="btn blue">
                </form>
                <!-- when i click the purchase button of a particular book, it will redirect me controllers/Books.php inside the method purchase($id); -->
            <?php endif; ?>
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