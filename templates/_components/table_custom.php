<section id="role-custom" class="tabcontent">
  <table class="wp-list-table widefat fixed striped">
    <thead>
      <tr>
        <th scope="col">
          <span>Role</span>
          <a href="#TB_inline?&width=300&height=180&inlineId=add_role_modal" class="button-primary thickbox" data-action="add-role">Add Role</a>
        </th>
        <th scope="col">
          <span>Capabilities</span>
          <a href="#TB_inline?&width=300&height=180&inlineId=add_capability_modal" class="button-primary thickbox" data-action="add-capability" data-value="<?= $roleName ?>">Add Capability</a>
        </th>
        <th scope="col">
          <span>Actions</span>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($customRoles as $roleName) : ?>
        <?php $roleCapabilities = get_role_capabilities($roleName->role); ?>
        <tr>
          <td><?php echo esc_html(ucfirst($roleName->role)); ?></td>
          <td>
            <div class="badge-list">
              <?php foreach ($roleCapabilities as $capability) : ?>
                <span class="badge"><?= esc_html($capability); ?></span>
              <?php endforeach; ?>
            </div>
            <div class="editRoleFormContainer hidden">
              <select id="edit-<?= $roleName->role ?>" class="editRoleFormRoleCapabilities" name="roleCapabilities[]" multiple="true">
                <?php foreach ($customCapabilities as $capability) : ?>
                  <option value="<?= $capability->capability; ?>" <?php if (in_array($capability->capability, $roleCapabilities)) echo 'selected'; ?>>
                    <?= $capability->capability; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </td>
          <td>
            <form class="editRoleForm" data-role="<?= $roleName->role ?>" method="post">
              <button type="button" class="button editRoleBtn">Edit</button>
              <button type="submit" class="button-primary hidden">Save</button>
              <a href="#TB_inline?&width=300&height=160&inlineId=delete_role_modal" class="button thickbox" data-action="delete-role" data-role="<?= $roleName->role ?>">Delete</a>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<?php include_once(plugin_dir_path(__DIR__) . '../templates/_components/modals/add_role_modal.php'); ?>
<?php include_once(plugin_dir_path(__DIR__) . '../templates/_components/modals/add_capability_modal.php'); ?>
<?php include_once(plugin_dir_path(__DIR__) . '../templates/_components/modals/delete_role_modal.php'); ?>

<script>
  jQuery(document).ready(function($) {
    const ajax_url = '<?= admin_url('admin-ajax.php'); ?>';

    $('.editRoleFormRoleCapabilities').select2({
      width: '100%',
      parentDropdown: $('#edit_role_modal'),
    });

    // Add role form
    $('#addRoleForm').submit(function(e) {
      e.preventDefault();
      // get roleName by value="roleName"
      let roleName = $('#addRoleFormRoleName').val().toLowerCase();

      $.ajax({
        type: 'POST',
        url: ajax_url,
        data: {
          action: 'add_custom_role',
          roleName: roleName
        },
        success: function(response) {
          window.location.reload();
        }
      });
    });

    // Add capability form
    $('#addCapabilityForm').submit(function(e) {
      e.preventDefault();
      let capabilityName = $('#addCapabilityFormCapabilityName').val();
      $.ajax({
        type: 'POST',
        url: ajax_url,
        data: {
          action: 'add_custom_capability',
          capabilityName: capabilityName
        },
        success: function(response) {
          window.location.reload();
        }
      });
    });

    // Edit role
    $('.editRoleBtn').each(function() {
      let roleCapabilitiesContainer = $(this).closest('tr').find('.badge-list');
      let editRoleFormRoleCapabilitiesContainer = $(this).closest('tr').find('.editRoleFormContainer');
      let editRoleFormRoleCapabilities = $(this).closest('tr').find('.editRoleFormRoleCapabilities');
      let editBtn = $(this);
      let saveBtn = $(this).next();

      // Change to edit mode
      editBtn.click(function() {
        roleCapabilitiesContainer.addClass('hidden');
        editRoleFormRoleCapabilitiesContainer.removeClass('hidden');
        editBtn.addClass('hidden');
        saveBtn.removeClass('hidden');
      });
    });

    // Save edited role
    $('.editRoleForm').submit(function(e) {
      e.preventDefault();
      let roleName = $(this).data('role');
      let roleCapabilities = $('#edit-' + roleName).val();
      console.log($('#edit-' + roleName).val());

      $.ajax({
        type: 'POST',
        url: ajax_url,
        data: {
          action: 'edit_custom_role',
          roleName: roleName,
          roleCapabilities: roleCapabilities
        },
        success: function(response) {
          window.location.reload();
        }
      });
    });

    // Delete role
    $('#deleteRoleForm').submit(function(e) {
      e.preventDefault();
      let roleName = $(this).find('.deleteRoleFormRoleName').val();

      // TODO: fix delete

      $.ajax({
        type: 'POST',
        url: ajax_url,
        data: {
          action: 'delete_custom_role',
          roleName: roleName
        },
        success: function(response) {
          window.location.reload();
        }
      });
    });
  });
</script>