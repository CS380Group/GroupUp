<?php

    function displayRedirect() {
        // This will provide the user with a link that will take them to the previous page. Can be changed later.
        $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);

        // Handles whether the redirect will be php or javascript
        if (!empty($referer)) {
            echo '<p><a href="'. $referer .'" title="Return to the previous page">&laquo; Go back</a></p>';
        } else {
            echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>';
        }
    }
?>