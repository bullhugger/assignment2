<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/Staff.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $staff = new Staff($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $staff->id = $data->id;
  $staff->senior = $data->senior;
  $staff->name = $data->name;

  // Update post
  if($staff->update()) {
    echo json_encode(
      array('message' => 'Staff Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Staff not updated')
    );
  }