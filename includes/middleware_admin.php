<?php
require_once 'auth.php';

if ($currentUser['hierarchy_level'] != 1) {
    die("Access Denied.");
}