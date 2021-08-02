<?php
require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<div class="container-book center">
    <p>Update Book info:</p>
    <hr size=0>
    <!-- this action will be directed to the controllers/Books.php file where create() method is runned -->
    <form action="<?php echo URLROOT; ?>/books/update/<?php echo $data['book']->id ?>" method="POST">
        <div class="form-item">
            <input type="text" name="title" value="<?php echo $data['book']->title ?>">

            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Enter the description of book here.."><?php echo $data['book']->body ?></textarea>
            
            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <div class="form-item">
            <input type="number" name="price" value="<?php echo $data['book']->price ?>">

            <span class="invalidFeedback">
                <?php echo $data['priceError']; ?>
            </span>
        </div>

        <button class="btn green" name="submit" type="submit">Create</button>
    </form>
</div>