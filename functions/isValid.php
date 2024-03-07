<?php
function isValid($data, $fields) {
    foreach($fields as $field) {
        if(!isset($data->$field) || empty($data->$field)) {
            return false;
        }
    }
    return true;
}
?>
