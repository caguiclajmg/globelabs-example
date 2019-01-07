<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        header('Location: https://developer.globelabs.com.ph/dialog/oauth/' . getenv('APP_ID'));
        die();
    }
