<?php

// Add a new menu entry in the admin interface
add_action('admin_menu', 'add_roles_management_page');
function add_roles_management_page()
{
  add_menu_page(
    'Roles Management',
    'Roles Management',
    'manage_options',
    'roles_management',
    'show_roles_management_page'
  );
}

// Function to display the roles management page
function show_roles_management_page()
{
  // add select cgn in head
  wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.0.13', true);
  wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.0.13', 'all');
  wp_enqueue_script('role-administrator', plugin_dir_url(__DIR__) . '/assets/js/role-administrator.js', array(), '1.0', true);
  wp_enqueue_style('role-administrator', plugin_dir_url(__DIR__) . '/assets/css/role-administrator.css', array(), '1.0', 'all');
  add_thickbox();

  include_once(plugin_dir_path(__DIR__) . 'templates/role_view.php');
}

// add custom table wp_roles_ to database who list all capabilities available
add_action('init', 'create_wp_roles_table');
function create_wp_roles_table()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'custom_roles';
  $charset_collate = $wpdb->get_charset_collate();
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    role varchar(255) NOT NULL,
    PRIMARY KEY (id)
  ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}

// add custom table wp_capabilities_ to database who list all capabilities available
add_action('init', 'create_wp_capabilities_table');
function create_wp_capabilities_table()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'custom_capabilities';
  $charset_collate = $wpdb->get_charset_collate();
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    capability varchar(255) NOT NULL,
    PRIMARY KEY (id)
  ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}
