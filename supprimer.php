<?php 
require 'database.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $statement = $pdo->prepare("DELETE FROM client WHERE id_client = :id_client");
    $statement->execute([
    ':id_client' => $id
]);

header('Location:listerC.php');
exit;
}