<?php
require APPROOT . '/views/includes/head.php';
?>
<div class="navbar">
	<?php
		require APPROOT . '/views/includes/navigation.php';
	?>
</div>

<div class="container-book center">
    <p>Post new book:</p>
    <hr size=0>
    <!-- this action will be directed to the controllers/Books.php file where create() method is runned -->
    <form action="<?php echo URLROOT; ?>/books/create" method="POST">
        <div class="form-item">
            <input type="text" name="title" placeholder="Title here..">

            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Enter the description of book here.."></textarea>
            
            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <div class="form-item">
            <input type="number" name="price" placeholder="Price here..">

            <span class="invalidFeedback">
                <?php echo $data['priceError']; ?>
            </span>
        </div>

        <button class="btn green" name="submit" type="submit">Create</button>
    </form>
</div>