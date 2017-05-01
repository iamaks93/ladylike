<?php

ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all


require_once "../../constants.php"; // Include Connection File

require_once CORE.'/base.php'; // Include Base Functions File
require_once CORE.'/connection.php'; // Include Connection File
require_once CORE.'/session.php'; // Include Connection File

$ObjBase = new Base(); // Create object to access Base Functions
$ConnObj = new Connection(); // Create object to access Connection

$ObjSession = Session::getInstance();

// If Session variable is not set then,sent back to login page

//header("location:http://localhost/xadmin/index.php");

$ObjSession->LAST_ACTIVITY = time(); // update last activity time stamp


if(empty($ObjSession->UserName))
{
    header("Location:../xadmin/index.php");
    die();
}
  // Required Layout structure added
  include  'requiredstyles.php'; // Required styles
  include "sidebar.php"; // Sidebar
  include "header.php";  // header file
?>
