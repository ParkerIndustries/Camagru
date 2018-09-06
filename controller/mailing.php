<?php
require_once (realpath("./model/model_user.php"));

    function mailing(array $arrayUser, array $arrayMail, array $arrayPass)
    {
        $user = new model_user();

        if ($arrayUser[1] && $arrayMail[1] && $arrayPass[1]) {
            $user->saveUser($arrayUser[0], $arrayMail[0], hash('whirlpool', $arrayPass[0]));
            $user->sendMail();
        }
    }