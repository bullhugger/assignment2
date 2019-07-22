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

  $result = $staff->read();

  $num = $result->rowCount();

  // Check if there a staff
  if($num > 0) {
    // Cat array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      
      $cat_item = array(
        'id' => $id,
        'name' => $name,
        'description' => $description
      );

      // Push to "data"
      array_push($cat_arr['data'], $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($cat_arr);

} else {
    // No staff
    echo json_encode(
      array('message' => 'No Staff Found')
    );
}