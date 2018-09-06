<?php
require_once(realpath('./model/model_filter.php'));
require_once("mailing.php");

  $usernameErr = $emailErr = $passwordErr = "";
  $username = $email = $password = "";
  $arrayUser = $arrayMail = $arrayPass = null;
  $filter = new model_filter();
  $user = new model_user();

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $arrayUser = $filter->usernameFilter($_POST['username']);
      $username = $arrayUser[0];
      $usernameErr = ($arrayUser[2] == "") ? "" : $arrayUser[2];

      $arrayMail = $filter->emailFilter($_POST['email'], 0);
      $email = $arrayMail[0];
      $emailErr = ($arrayMail[2] == "") ? "" : $arrayMail[2];

      $arrayPass = $filter->passFilter($_POST['password']);
      $password = $arrayPass[0];
      $passwordErr = ($arrayPass[2] == "") ? "" : $arrayPass[2];

      mailing($arrayUser, $arrayMail, $arrayPass);
  }

