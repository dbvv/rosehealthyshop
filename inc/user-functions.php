<?php

add_action('mu_plugin_loaded', 'rhs_user_functions', 10);

function rhs_user_functions()
{
    /**
     * Create a new customer.
     *
     * @param  string $email    Customer email.
     * @param  string $username Customer username.
     * @param  string $password Customer password.
     * @param  array  $args     List of arguments to pass to `wp_insert_user()`.
     * @return int|WP_Error Returns WP_Error on failure, Int (user ID) on success.
     */
    function wc_create_new_customer($email, $username = '', $password = '', $args = array())
    {
        if (empty($email) || !is_email($email)) {
            return new WP_Error('registration-error-invalid-email', __('Please provide a valid email address.', 'woocommerce'));
        }

        if (email_exists($email)) {
            return new WP_Error('registration-error-email-exists', apply_filters('woocommerce_registration_error_email_exists', __('An account is already registered with your email address. Please log in.', 'woocommerce'), $email));
        }

        if ('yes' === get_option('woocommerce_registration_generate_username', 'yes') && empty($username)) {
            $username = wc_create_new_customer_username($email, $args);
        }

        $username = sanitize_user($username);

        if (empty($username) || !validate_username($username)) {
            return new WP_Error('registration-error-invalid-username', __('Please enter a valid account username.', 'woocommerce'));
        }

        if (username_exists($username)) {
            return new WP_Error('registration-error-username-exists', __('An account is already registered with that username. Please choose another.', 'woocommerce'));
        }

        // Handle password creation.
        $password_generated = false;
        if ('yes' === get_option('woocommerce_registration_generate_password') && empty($password)) {
            $password           = wp_generate_password();
            $password_generated = true;
        }

        if (empty($password)) {
            return new WP_Error('registration-error-missing-password', __('Please enter an account password.', 'woocommerce'));
        }

        // Use WP_Error to handle registration errors.
        $errors = new WP_Error();

        do_action('woocommerce_register_post', $username, $email, $errors);

        $errors = apply_filters('woocommerce_registration_errors', $errors, $username, $email);

        if ($errors->get_error_code()) {
            return $errors;
        }

        $new_customer_data = apply_filters(
            'woocommerce_new_customer_data',
            array_merge(
                $args,
                array(
                    'user_login' => $email,
                    'user_pass'  => $password,
                    'user_email' => $email,
                    'role'       => 'customer',
                )
            )
        );

        $customer_id = wp_insert_user($new_customer_data);

        if (is_wp_error($customer_id)) {
            return new WP_Error('registration-error', __('Couldn&#8217;t register you&hellip; please contact us if you continue to have problems.', 'woocommerce'));
        }

        do_action('woocommerce_created_customer', $customer_id, $new_customer_data, $password_generated);

        return $customer_id;
    }
}
