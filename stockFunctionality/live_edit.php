<?php

include_once("../database.php");
$input = filter_input_array(INPUT_POST);

print_r($input);

// if ($input['action'] == 'edit') {
//     $update_field = '';

//     if (isset($input['name'])) {
//         $update_field .= "Name='" . $input['name'] . "'";

//     } elseif (isset($input['specification'])) {

//         $spec = $input['specification'];
//         $specification_query = $connection->query("SELECT * FROM `specifications` WHERE `Name`='$spec'");
//         $specification_info = $specification_query->fetch_assoc();
//         $id_spec = $specification_info["ID_Specification"];

//         $update_field .= "ID_Specification='" . $id_spec . "'";
    
//     } elseif (isset($input['factory_id'])) {
    
//         $update_field .= "factory_id='" . $input['factory_id'] . "'";
        
//     } elseif (isset($input['cost'])) {
    
//         $update_field .= "cost='" . $input['cost'] . "'";
    
//     }

//     if ($update_field && $input['id']) {
//         $sql_query = "UPDATE details SET $update_field WHERE ID_Detail='" . $input['id'] . "'";
//         mysqli_query($connection, $sql_query) or die("database error:" . mysqli_error($conn));
//     }
// }
?>