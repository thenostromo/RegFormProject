<?php
namespace Core\Validator;

class FormValidator
{
    /**
     * @param string $data
     * @return string
     */
    public static function makeValidData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
