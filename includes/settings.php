<?php
// Add settings page to the admin menu.
function add_plugin_settings_page() {
    add_options_page( 'Select Users Role', 'Two-Level Password', 'manage_options', 'two-level-password', 'render_plugin_settings_page' );
}
add_action( 'admin_menu', 'add_plugin_settings_page' );

// Render the plugin settings page.
function render_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'two-level-password' ); ?>
            <?php do_settings_sections( 'two-level-password' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Recruiter Role', 'two-level-password' ); ?></th>
                    <td>
                        <?php $recruiter_role = get_option( 'two_level_password_recruiter_role', 'recruiter' ); ?>
                        <select name="two_level_password_recruiter_role">
                            <?php 
                            // Add options to select the recruiter user role.
                            foreach ( wp_roles()->role_names as $role => $name ) {
                                printf( '<option value="%s" %s>%s</option>', $role, selected( $recruiter_role, $role, false ), $name );
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php esc_html_e( 'Administrator Role', 'two-level-password' ); ?></th>
                    <td>
                        <?php $administrator_role = get_option( 'two_level_password_administrator_role', 'administrator_custom' ); ?>
                        <select name="two_level_password_administrator_role">
                            <?php 
                            // Add options to select the administrator user role.
                            foreach ( wp_roles()->role_names as $role => $name ) {
                                printf( '<option value="%s" %s>%s</option>', $role, selected( $administrator_role, $role, false ), $name );
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings for the plugin.
function register_plugin_settings() {
    register_setting( 'two-level-password', 'two_level_password_recruiter_role' );
    register_setting( 'two-level-password', 'two_level_password_administrator_role' );
}
add_action( 'admin_init', 'register_plugin_settings' );
