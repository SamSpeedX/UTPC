<?php

class Security
{
    public function guard($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
?>