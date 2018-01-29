<?php
$hi_user = 'there';
if (isset($_COOKIE['current_mode']) && $_COOKIE['current_mode'] !== 'open') {
    $hi_user = '<strong>Test user</strong>';
}
?>
Hi <?= $hi_user ?>! You are currently in <span class="current_mode"><?=$_COOKIE['current_mode']?></span> mode.
