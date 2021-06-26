<div class="messages">
    <?php
    if(isset($messages)){
        foreach($messages as $message) {
            echo '<p>'.$message.'</p>';
        }
    } ?>
</div>
