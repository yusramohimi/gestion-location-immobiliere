<?php
require'database.php';
$locations=[];
if($_SERVER['REQUEST_METHOD'] && isset($_POST['date_debut']) && isset($_POST['date_fin'])){
   $date_debut = $_POST['date_debut'] ;
   $date_fin = $_POST['date_fin'];
   $statement = $pdo->prepare("SELECT location.*, client.nom, client.prenom, immobilier.titre, typeimmo.libelle 
   FROM location INNER JOIN client ON location.id_client = client.id_client  
   INNER JOIN immobilier ON location.id_immobilier = immobilier.id_immobilier
    INNER JOIN typeimmo ON immobilier.id_type = typeimmo.id_type  
    WHERE location.date_debut_location >= '$date_debut' AND location.date_fin_location <= '$date_fin'");
    $statement->execute();
    $locations = $statement ->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Les locations entre deux dates</title>
    </head>
    <body class="bg-gray-200">
    <div class="heading text-center font-bold text-3xl m-5 text-red-500">Les locations entre deux dates</div>
    <div class="heading text-center text-l m-5 text-black-400">Veuillez remplir tous les champs</div>
<style>
  body {background:white !important;}
</style>
  <!-- formulaire pour saisir les dates -->
    <form action="" method="POST">
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
            <div>
                <label for="date_debut"  class="mb-2 block text-base font-medium text-[#07074D]" > Date debut </label>
                <input type="date" name="date_debut" id="date_debut" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            <div>
                <label for="date_fin"  class="mb-2 block text-base font-medium text-[#07074D]" > Date fin </label>
                <input type="date" name="date_fin" id="date_fin" class="w-full bg-gray-100 p-2 mb-4 rounded-md border border-[#e0e0e0] text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
            
            <!-- buttons -->
            <div class="buttons flex">
            
            <input  class="btn border border-red-500 p-1 px-4 font-semibold cursor-pointer text-gray-100 ml-2 bg-red-500 hover:bg-red-600" type="submit" value="Chercher">
            
            </div>
        </div>
    </form>

    <!-- table d'affichage -->
    <table class="min-w-full border-collapse block md:table">
		<thead class="block md:table-header-group">
			<tr class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">ID Location</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Titre Immobilier</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Nom Client</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Prénom Client</th>
				<th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Libellé Type Immobilier</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Date Début</th>
                <th class="bg-gray-600 p-2 text-white font-bold md:border md:border-grey-500 text-left block md:table-cell">Date Fin</th>
			</tr>
		</thead>
		<tbody class="block md:table-row-group">
            <?php foreach ($locations as $location) :?>
                <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['id_location'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['titre'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['nom'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['prenom'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['libelle'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['date_debut_location'] ;?></td>
                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><?php echo $location['date_fin_location'] ;?></td>

                </tr>	
            <?php endforeach ?>
		</tbody>
	</table>

    </body>
</html>