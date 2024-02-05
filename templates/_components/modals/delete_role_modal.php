<div id="delete_role_modal" class="hidden">
  <h3>Delete Role</h3>
  <form id="deleteRoleForm" method="post">
    <input type="hidden" class="deleteRoleFormRoleName" name="roleName" value="<?= $roleName->role; ?>">
    <p>Are you sure you want to delete the role?</p>
    <input type="submit" class="button-primary" value="Delete">
  </form>
</div>