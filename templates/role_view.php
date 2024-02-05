<?php

$wordpressRoles = get_wordpress_roles();
$customRoles = get_custom_roles();
$customCapabilities = get_custom_capabilities();

?>

<h1>Roles Management</h1>

<hr>

<div class="tab">
  <button class="button tablink" data-tab="role-wordpress">Wordpress</button>
  <button class="button tablink active" data-tab="role-custom">Custom</button>
</div>

<?php include_once(plugin_dir_path(__DIR__) . 'templates/_components/table_wordpress.php'); ?>

<?php include_once(plugin_dir_path(__DIR__) . 'templates/_components/table_custom.php'); ?>
