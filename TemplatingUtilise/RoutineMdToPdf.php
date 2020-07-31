<?php
$dossierRoutine = getcwd();
$sousDossierRoutine = "TemplatingUtilise";
$sousDossierRenduPDF = "./renduPDF";
$sousDossierSourceMd = "./sourceMd";
$adresseEnTeteMd = "./TemplatingUtilise/entete.md";

function nettoyageDossierDestinationIncluantSousDossier($directory)
{
    if (substr($directory, -1) == "/") {
        $directory = substr($directory, 0, -1);
    }
    if (file_exists($directory) || is_dir($directory) || is_readable($directory)) {
        $directoryHandle = opendir($directory);
        while ($contents = readdir($directoryHandle)) {
            if ($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if (is_dir($path)) {
                    nettoyageDossierDestinationIncluantSousDossier($path);
                }
                unlink($path);
            }
        }
        closedir($directoryHandle);
    }
}

function dossierExistantOuLeCreer($path)
{
    if (is_dir($path)) {
        return true;
    } else {
        return mkdir($path);
    }
}

function creerRequetesPandoc($adresseDossierSource, $adresseDossierRendu, $enTeteMd)
{
    echo "\n########## Début du traitement ##########";

    $listeCommandes = "";

    $repertoire = opendir($adresseDossierSource); // On définit le répertoire dans lequel on souhaite travailler.
    while (false !== ($nomFichier = readdir($repertoire))) {
        $info = new SplFileInfo($nomFichier);
        $extension = $info->getExtension();
        if ($extension == "md") {
            $listeCommandes .= "\n pandoc " . $enTeteMd . ' "' . $adresseDossierSource . "/" . $nomFichier . '" -o "' . $adresseDossierRendu . "/" . pathinfo($nomFichier, PATHINFO_FILENAME) . ".pdf" . '"';
            $listeCommandes .= " --from markdown --template eisvogel --listings";
        }
    }

    closedir($repertoire);
    return $listeCommandes;
}

dossierExistantOuLeCreer($sousDossierRenduPDF);
nettoyageDossierDestinationIncluantSousDossier($sousDossierRenduPDF);
$liste = creerRequetesPandoc($sousDossierSourceMd, $sousDossierRenduPDF, $adresseEnTeteMd);


$fichierListe = fopen($dossierRoutine . "/" . $sousDossierRoutine . "/routine.bat", 'w');
fwrite($fichierListe, $liste);
fclose($fichierListe);

