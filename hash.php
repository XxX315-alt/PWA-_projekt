<?php
$lozinka = '1952';  
$hash = password_hash($lozinka, PASSWORD_DEFAULT);
echo "Hashirana lozinka:\n" . $hash;
?>
