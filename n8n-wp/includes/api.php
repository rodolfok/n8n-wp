<?php

add_action( 'rest_api_init', function () {
    register_rest_route( 'n8n-wp/v1', '/create-post', [
        'methods'             => 'POST',
        'callback'            => 'n8n_wp_create_post',
        'permission_callback' => '__return_true',
    ] );

    register_rest_route( 'n8n-wp/v1', '/teste', [
        'methods'             => 'GET',
        'callback'            => 'n8n_wp_teste',
        'permission_callback' => '__return_true',
    ] );
} );

function n8n_wp_teste( WP_REST_Request $request ) {
    return new WP_REST_Response( [
        'success' => true,
        'message' => __( 'API do plugin n8n-wp está funcionando corretamente!', 'n8n-wp' ),
        'time'    => current_time( 'mysql' ),
    ], 200 );
}

function n8n_wp_create_post( WP_REST_Request $request ) {
    $headers     = $request->get_headers();
    $auth_header = $headers['authorization'][0] ?? '';
    $token       = str_replace( 'Bearer ', '', $auth_header );

    $valid_token = get_option( 'n8n_wp_token' );
    if ( ! $token || $token !== $valid_token ) {
        return new WP_REST_Response( [ 'error' => 'Unauthorized' ], 401 );
    }

    $params = $request->get_json_params();

    // Categoria
    $category_name = sanitize_text_field( $params['category'] ?? '' );
    $category_id   = 1;

    if ( $category_name ) {
        $existing = get_term_by( 'name', $category_name, 'category' );
        if ( $existing ) {
            $category_id = $existing->term_id;
        } else {
            $new_term = wp_insert_term( $category_name, 'category' );
            if ( ! is_wp_error( $new_term ) ) {
                $category_id = $new_term['term_id'];
            }
        }
    }

    // Status seguro
    $post_status       = sanitize_key( $params['status'] ?? 'draft' );
    $allowed_statuses  = [ 'draft', 'publish', 'pending', 'private', 'future' ];
    if ( ! in_array( $post_status, $allowed_statuses, true ) ) {
        $post_status = 'draft';
    }

    $post_data = [
        'post_title'    => sanitize_text_field( $params['title'] ?? '' ),
        'post_content'  => wp_kses_post( $params['content'] ?? '' ),
        'post_status'   => $post_status,
        'post_type'     => 'post',
        'post_category' => [ $category_id ],
        'post_author'   => 1,
    ];

    if ( ! empty( $params['date'] ) ) {
        $date                        = sanitize_text_field( $params['date'] );
        $post_data['post_date']     = $date;
        $post_data['post_date_gmt'] = get_gmt_from_date( $date );
    }

    $post_id = wp_insert_post( $post_data );

    if ( is_wp_error( $post_id ) ) {
        return new WP_REST_Response( [ 'error' => 'Post not created' ], 500 );
    }

    return new WP_REST_Response( [
        'success' => true,
        'post_id' => $post_id,
        'link'    => get_permalink( $post_id ),
    ], 200 );
}