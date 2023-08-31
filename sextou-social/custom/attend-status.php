<?php
// Include WordPress core functions.
require_once('wp-load.php');

// Check if it's a POST request (you can also use GET if preferred).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $attend_status = $_POST['rsvp_status'];

  echo "Meu novo status é $attend_status";

  // // Get the user's ID. Replace '123' with the actual user ID.
  // $user_id = 123;

  // // Define the old and new meta keys.
  // $old_meta_key = 'old_meta_key';
  // $new_meta_key = 'new_meta_key';

  // // Get the user's current meta value using the old key.
  // $meta_value = get_user_meta($user_id, $old_meta_key, true);

  // // Delete the old meta key and its value.
  // delete_user_meta($user_id, $old_meta_key);

  // // Update the user's meta with the new key and value.
  // update_user_meta($user_id, $new_meta_key, $meta_value);

  // // Send a JSON response indicating success.
  // echo json_encode(['success' => true]);
}

// else {
//   // Send a JSON response indicating failure if it's not a POST request.
//   echo json_encode(['success' => false]);
// }


// Handle the form submission.
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   // Get the RSVP status from the button's value.
//   $new_status = sanitize_text_field();

//   // Replace '123' with the event ID or get it from the loop if applicable.
//   $event_id =  get_the_ID();

//   // Get the current user's ID.
//   $user_id = get_current_user_id();

//   // Update the RSVP status using the set_user_event_rsvp function.
//   set_user_event_rsvp($user_id, $event_id, $new_status);
// }