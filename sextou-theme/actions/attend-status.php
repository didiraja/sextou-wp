<?php

require_once('../../../../wp-load.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $user_id = $_REQUEST["user"];
  $event_id = $_REQUEST["event"];
  $status = $_REQUEST['rsvp_status'];

  set_user_event_rsvp($user_id, $event_id, $status);

  http_response_code(200);

  header('Location: ' . $_SERVER['HTTP_REFERER']);

  exit;
}
