<div class="postbtn">
    <?php
        $selected_post_ID = $_GET['post_ID'];
    ?>
    <a href="newComment.php?post_ID=<?php echo $selected_post_ID?>">
        <button type="post"> New Comment </button>
    </a>
</div>