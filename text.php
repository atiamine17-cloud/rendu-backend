<?php
$personne = [
 "nom" => "Amine",
 "age" => "21",
 "ville" => "paris"
];

function carre($nombre) {
    $carre = $nombre **2;

    return $carre ;
}

$resultat = carre(8);
echo $resultat;
?>

<?php
function calculerMoyenne ($note1,$note2,$note3) {
    $moyenne = ($note1 + $note2 + $note3) / 3 ;
    return round($moyenne);

}

function afficherResultat ($nom, $moyenne) {
    if ($moyenne >= 10) { 
        echo "$nom,$moyenne félicitation";
    }
    else {
            echo "echoué";
        }

}
$moyenneAlice = calculerMoyenne(15, 12, 18);
afficherResultat ("alice", $moyenneAlice);

?>









<?php
require '../composer/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Configuration
$apiKey = "bcb83088011460755a76eba2a2454dcc"; 
$donnees = null;
$erreur = null;

// Traitement de la recherche
if (isset($_GET['ville']) && !empty($_GET['ville'])) {
    $ville = htmlspecialchars($_GET['ville']);
    $client = new Client();

    try {
        $reponse = $client->request('GET', "https://api.openweathermap.org/data/2.5/weather", [
            'query' => [
                'q' => $ville,
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'fr'
            ]
        ]);

        $donnees = json_decode($reponse->getBody(), true);

    } catch (RequestException $e) {
        $erreur = "Désolé, la ville de \"$ville\" est introuvable.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Météo PHP</title>
</head>
<body>
    <h1>Application Météo </h1>

    <form method="GET" action="">
        <input type="text" name="ville" placeholder="Entrez une ville (ex: Nice)" required>
        <button type="submit">Rechercher</button>
    </form>

    <hr>

    <?php if ($donnees): ?>
        <h2>Météo à <?php echo $donnees['name']; ?></h2>
        <p><strong>Ciel :</strong> <?php echo $donnees['weather'][0]['description']; ?></p>
        <p><strong>Température :</strong> <?php echo $donnees['main']['temp']; ?>°C</p>
        <p><strong>Humidité :</strong> <?php echo $donnees['main']['humidity']; ?>%</p>
    <?php endif; ?>

   <?php
   // Traitement des erreurs
 
     if ($erreur): ?>
        <p style="color: red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

</body>
</html>


<?php

require_once '../composer/vendor/autoload.php';

$faker = Faker\Factory ::create('fr_FR');

echo "<h1>";
echo $faker->name(); 
echo "</h1>";
echo "<br>";
?>

