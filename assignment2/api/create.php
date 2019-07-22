<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../config/Database.php';
  include_once '../models/Staff.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $staff = new Staff($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $staff->name = $data->name;
  $staff->senior = $data->senior;

  // Create Category
  if($staff->create()) {
    echo json_encode(
      array('message' => 'Staff Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Staff Not Created')
    );
  }
