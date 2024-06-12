<?php

function error($alertMessage)
{
  $message = "<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <div>{$alertMessage}</div>
  </div>";
  echo $message;
}

function success($alertMessage)
{
  $message = "<div class='alert alert-success d-flex align-items-center' role='alert'>
  <div>{$alertMessage}</div>
  </div>";

  echo $message;
}


?>