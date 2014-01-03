<?php
function cougar_setup_theme_admin_menus() {  
    add_submenu_page("options-general.php",
    "Notification Bar", "Notification Bar",
    "manage_options", "notification-bar", "cougar_notification_bar_settings"
  );
}    
add_action("admin_menu", "cougar_setup_theme_admin_menus");  

function cougar_notification_bar_settings() {
  if (!current_user_can('manage_options')) {  
    wp_die('You do not have sufficient permissions to access this page.');  
  }
  if (isset($_POST["update_settings"])) { 
    cougar_save_notification_bar_settings(); 
  }
?>
  <div class="wrap">  
   <h2>Notification Bar</h2>

    <?php if (isset($_POST["update_settings"])): ?>
    <div id="setting-error-settings_updated" class="updated settings-error"> 
      <p><strong>Settings saved.</strong></p>
    </div>
    <?php endif; ?>
    
    <form method="POST" action="">
      <input type="hidden" name="update_settings" value="Y" />   
      <table class="form-table">
        <tbody><tr valign="top">
          <th scope="row">Notification Bar</th>
          <td><fieldset>
            <label for="bar_enabled">
              <input name="bar_enabled" type="checkbox" id="bar_enabled" checked="<?php echo get_option("cougar_bar_enabled"); ?>"/>
              Enable notification bar for announcements</label>
            </fieldset></td>
          </tr>
          <tr valign="top">
            <th scope="row"><label for="notification_message">Notification Bar Message</label></th>
            <td>
              <input type="text" name="notification_message" id="notification_message" style="width: 50%; min-width: 300px;" value="<?php echo get_option("cougar_bar_message"); ?>" />
            </td>
          </tr>
          <tr valign="top">
            <th scope="row"><label for="notification_url">Message Followup URL</label></th>
            <td>
              <input type="text" name="notification_url" id="notification_url" value="<?php echo get_option("cougar_bar_url"); ?>" />
            </td>
          </tr>
        </tbody>
      </table>
      <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>
  </div>  
<?php
}

function cougar_save_notification_bar_settings() {
  $bar_enabled = esc_attr($_POST["bar_enabled"]);     
  update_option("cougar_bar_enabled", $bar_enabled);

  $notification_message = esc_attr($_POST["notification_message"]);     
  update_option("cougar_bar_message", $notification_message);  

  $notification_url = esc_url($_POST["notification_url"]);     
  update_option("cougar_bar_url", $notification_url);  
}

?>
