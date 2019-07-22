<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/Staff.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  
  $staff = new Staff($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $staff->name = $data->name;
  $staff->senior = $data->senior;
  // Get senior
  $staff->senior = isset($_GET['senior']) ? $_GET['senior'] : die();

  // Get post
  $staff->read_filter();

  // Create array
  $staff_arr = array(
    'senior' => $staff->senior,
    'name' => $staff->name
  );

  // Make JSON
  print_r(json_encode($staff_arr));