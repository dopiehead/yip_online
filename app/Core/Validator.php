<?php

namespace App\Core;

class Validator {
    public static function required($data, $fields) {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                throw new \Exception("$field is required");
            }
        }
    }

    public static function type($field){
        foreach ($fields as $field) {
            if (!is_numeric($_POST['price'])) {
                throw new \Exception("Price must be a valid number");
            }
        }
    }
}
