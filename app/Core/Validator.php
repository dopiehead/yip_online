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
}
