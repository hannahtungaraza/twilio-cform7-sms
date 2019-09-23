// define the wpcf7_mail_sent callback
function action_wpcf7_mail_sent( $contact_form ) {
    $submission = WPCF7_Submission::get_instance();
    //Below statement will return all data submitted by form.
       if ( $submission ) {
          $posted_data = $submission->get_posted_data();

                 $form_fields = array(
        //variables can be changed acc to your form field names
                    $user_passed_name =  $posted_data['your-name'],
                    $user_passed_num =  $posted_data['tel-num'],
                    $user_passed_email =  $posted_data['your-email'],
                    $user_passed_address =  $posted_data['dco_address_gmaps-776'],
                    $user_passed_enquiry =  $posted_data['menu-200']
                );

                $form_output = implode( ",\n ", $form_fields );

       }

    $args = array(
    'number_to' => 'your_twilio_number',
    'message' => "New Quote Enquiry: \n " . $form_output,
    );
twl_send_sms( $args );
};

// add the action
add_action( 'wpcf7_mail_sent', 'action_wpcf7_mail_sent', 10, 1 );
