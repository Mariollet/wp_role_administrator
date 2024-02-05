<?php

function get_wordpress_roles()
{
  $roles = get_editable_roles();
  $worpress_roles = [];
  $custom_roles = [];
  $custom_capabilities = [];

  foreach ($roles as $role) {
    $role_name = $role['name'];
    $role_capabilities = [];
    foreach ($role['capabilities'] as $key => $value) {
      array_push($role_capabilities, $key);
    }

    $role_capabilities = array_unique($role_capabilities);
    if (in_array($role_name, array_column(WORDPRESS_ROLES, 'name'))) {
      $worpress_roles[$role_name] = $role_capabilities;
    } else {
      $custom_roles[$role_name] = $role_capabilities;
      $custom_capabilities = array_merge($custom_capabilities, $role_capabilities);
      $custom_capabilities = array_unique($custom_capabilities);
    }
  }

  return [
    'roles' => $worpress_roles,
  ];
}

function get_custom_roles()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'custom_roles';
  $results = $wpdb->get_results("SELECT * FROM $table_name");

  return $results;
}

function get_role_capabilities($role_name)
{
  $role = get_role($role_name);
  $role_capabilities = [];
  foreach ($role->capabilities as $key => $value) {
    array_push($role_capabilities, $key);
  }

  return $role_capabilities;
}

function get_custom_capabilities()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'custom_capabilities';
  $results = $wpdb->get_results("SELECT * FROM $table_name");

  return $results;
}
