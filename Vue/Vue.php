<?php

class Vue {

// Nom du fichier associé à la Vue
private $fichier;
// Titre de la Vue (défini dans le fichier Vue)
private $titre;

public function __construct($action) {
// Détermination du nom du fichier Vue à partir de l'action
$this->fichier = "Vue/Vue" . $action . ".php";
}

// Génère et affiche la Vue
public function generer($donnees) {
// Génération de la partie spécifique de la Vue
$contenu = $this->genererFichier($this->fichier, $donnees);
// Génération du gabarit commun utilisant la partie spécifique
$vue = $this->genererFichier('Vue/template.php',
array('titre' => $this->titre, 'contenu' => $contenu));
// Renvoi de la Vue au navigateur
echo $vue;
}

// Génère un fichier Vue et renvoie le résultat produit
private function genererFichier($fichier, $donnees) {
if (file_exists($fichier)) {
// Rend les éléments du tableau $donnees accessibles dans la Vue
extract($donnees);
// Démarrage de la temporisation de sortie
ob_start();
// Inclut le fichier Vue
// Son résultat est placé dans le tampon de sortie
require $fichier;
// Arrêt de la temporisation et renvoi du tampon de sortie
return ob_get_clean();
}
else {
throw new Exception("Fichier '$fichier' introuvable");
}
}
}