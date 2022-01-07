<?php
    if(isset($_SESSION['message'])){
        echo '<div class="alert alert-primary mt-1" role="alert">';
        echo $_SESSION['message'];
        echo '</div>';
        unset($_SESSION['message']);
    }
    if (!empty($global_error)) {
        echo '<div class="alert alert-danger mt-1" role="alert">';
        echo $global_error;
        echo '</div>';
    }
    if (!empty($global_message)) {
        echo '<div class="alert alert-primary mt-1" role="alert">';
        echo $global_message;
        echo '</div>';
    }
?>