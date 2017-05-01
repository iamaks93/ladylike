<?php
/**
 * Created by PhpStorm.
 * User: Maa
 * Date: 2/20/2017
 * Time: 9:57 PM
 */

echo "I am a home page";
$root = realpath($_SERVER["DOCUMENT_ROOT"]);

define("ASSESTS","http://localhost/ladylike/assests"); // Assests Path
?>
</br>
<link href="<?=ASSESTS?>/xadmin/js/jquery-notifications/css/messenger.css" rel="stylesheet">

<a href="contact.php">contact</a>
