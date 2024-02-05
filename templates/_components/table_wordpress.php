<section id="role-wordpress" class="tabcontent" style="display: none;">
  <table class="wp-list-table widefat fixed striped">
    <thead>
      <tr>
        <th scope="col">Role</th>
        <th scope="col">Capabilities</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($wordpressRoles["roles"] as $roleName => $roleCapabilities) : ?>
        <tr>
          <td><?php echo esc_html($roleName); ?></td>
          <td>
            <div class="badge-list">
              <?php foreach ($roleCapabilities as $capability) : ?>
                <span class="badge"><?= esc_html($capability); ?></span>
              <?php endforeach; ?>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>