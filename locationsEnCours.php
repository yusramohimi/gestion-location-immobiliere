<?php
session_start();
require 'database.php';

if (!isset($_SESSION["id_client"])) {
    header("Location: connexion.php");
    exit;
}

$id_client = $_SESSION["id_client"];

$statement = $pdo->prepare(' SELECT location.*, client.nom, client.prenom, immobilier.titre, typeimmo.libelle FROM location
    INNER JOIN client ON location.id_client = client.id_client
    INNER JOIN immobilier ON location.id_immobilier = immobilier.id_immobilier
    INNER JOIN typeimmo ON immobilier.id_type = typeimmo.id_type
    WHERE location.id_client = :id_client 
      AND location.date_debut_location <= CURDATE() 
      AND location.date_fin_location >= CURDATE()
');
$statement->execute([':id_client' => $id_client]);
$locations = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Locations en cours</title>
</head>
<body>
    <div class="heading text-center font-bold text-3xl m-5 text-blue-500">
        <?php echo ($_SESSION['prenom']) . " " . ($_SESSION['nom']); ?>
    </div>
    <table class="min-w-full border-collapse block md:table">
		<thead class="block md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">ID Location</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Titre Immobilier</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Type Immobilier</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Date Début</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Date Fin</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
            <?php foreach ($locations as $location) :?>
                <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['id_location'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['titre'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['libelle'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['date_debut_location'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['date_fin_location'] ;?></td>

                </tr>	
            <?php endforeach ?>
		</tbody>
	</table>
</body>
</html>
