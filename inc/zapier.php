<?php


add_action( 'wpcf7_mail_sent', 'handle_zapier_form_submission' );

function handle_zapier_form_submission( $contact_form ) {
    $submission = WPCF7_Submission::get_instance();
    $webhook_url = get_theme_mod('zapier__contact_form');

    if ( $submission && $webhook_url ) {
        $posted_data = $submission->get_posted_data();
        // handle the data here e.g. submit to CRM
        // 'https://hooks.zapier.com/hooks/catch/8515865/owh69pi'

        $curl = curl_init();

        $opts = array(
            CURLOPT_URL             => $webhook_url,
            CURLOPT_HEADER          => false,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_POST            => true,
            CURLOPT_POSTFIELDS      => $posted_data
        );

        curl_setopt_array($curl, $opts);

        // Get the results
        $result = curl_exec($curl);

        // Close resource
        curl_close($curl);

        // echo $result;
    }
}