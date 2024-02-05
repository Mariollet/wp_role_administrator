<?php

add_action('wp_ajax_add_custom_role', 'add_custom_role');
function add_custom_role()
{
  $role_name = $_POST['roleName'];
  if (get_role(strtolower($role_name)) == null) {
    add_role(strtolower($role_name), $role_name, array());
  }

  global $wpdb;
  $table_name = $wpdb->prefix . 'custom_roles';
  $wpdb->insert($table_name, array('role' => $role_name));

  return [
    "status" => "success",
    "message" => "Role added successfully"
  ];
}

add_action('wp_ajax_edit_custom_role', 'edit_custom_role');
function edit_custom_role()
{
  $role_name = $_POST['roleName'];
  $role = get_role(strtolower($role_name));

  $old_capabilities = $role->capabilities;
  $new_capabilities = $_POST['roleCapabilities'];
  foreach ($old_capabilities as $key => $value) {
    $role->remove_cap($key);
  }
  foreach ($new_capabilities as $capability) {
    $role->add_cap($capability);
  }

  return [
    "status" => "success",
    "message" => "Role edited successfully"
  ];
}

add_action('wp_ajax_delete_custom_role', 'delete_custom_role');
function delete_custom_role()
{
  $role_name = $_POST['roleName'];
  if (get_role(strtolower($role_name)) != null) {
    remove_role(strtolower($role_name));
  }

  global $wpdb;
  $table_name = $wpdb->prefix . 'custom_roles';
  $wpdb->delete($table_name, array('role' => $role_name));

  return [
    "status" => "success",
    "message" => "Role deleted successfully"
  ];
}

add_action('wp_ajax_add_custom_capability', 'add_custom_capability');
function add_custom_capability()
{
  $capability = $_POST['capabilityName'];

  // add to db
  global $wpdb;
  $table_name = $wpdb->prefix . 'custom_capabilities';
  $wpdb->insert($table_name, array('capability' => $capability));

  return [
    "status" => "success",
    "message" => "Capability added successfully"
  ];
}

add_action('wp_ajax_delete_custom_capability', 'delete_custom_capability');
function delete_custom_capability()
{
  $role_name = $_POST['roleName'];
  $capability = $_POST['capability'];

  $role = get_role(strtolower($role_name));
  $role->remove_cap($capability);

  return [
    "status" => "success",
    "message" => "Capability deleted successfully"
  ];
}
