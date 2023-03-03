<?php
// Create a new user account for the administrator who can do overall site edits.
function create_administrator_user() {
    $username = 'administrator_custom';
    $password = wp_generate_password( 12, false );
    $email = 'admin@example.com';
    $user_id = username_exists( $username );
    if ( !$user_id && email_exists( $email ) == false ) {
        $administrator_role = get_option( 'two_level_password_administrator_role', 'administrator_custom' );
        $user_id = wp_create_user( $username, $password, $email );
        wp_update_user( array(
            'ID' => $user_id,
            'role' => $administrator_role
        ) );
    }
}
add_action( 'init', 'create_administrator_user' );
