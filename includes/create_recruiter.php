<?php
// Create a new user account for the general job posting, editing, and updating.
function create_recruiter_user() {
    $username = 'recruiter';
    $password = wp_generate_password( 12, false );
    $email = 'recruiter@example.com';
    $user_id = username_exists( $username );
    if ( !$user_id && email_exists( $email ) == false ) {
        $recruiter_role = get_option( 'two_level_password_recruiter_role', 'recruiter' );
        $user_id = wp_create_user( $username, $password, $email );
        wp_update_user( array(
            'ID' => $user_id,
            'role' => $recruiter_role
        ) );
    }
}
add_action( 'init', 'create_recruiter_user' );