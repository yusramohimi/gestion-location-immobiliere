<?php
require 'database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['cin']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo '<script>alert("Veuillez remplir tous les champs.")</script>';
    }else{
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $cin = $_POST["cin"];
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        $statement = $pdo -> prepare("INSERT INTO client (nom,prenom,cin,email,password) VALUES
         (:nom, :prenom, :cin, :email ,:password)");
        $statement -> execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':cin' => $cin,
            ':email' => $email,
            ':password' => $password
    
        ]);
        header("Location:listerC.php");
        exit;
    }
    
}

