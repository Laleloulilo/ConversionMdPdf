# Méthodologie Pandoc

## Utilité de l'outil

### Fonctionnement général

Au lancement du fichier ordonnanceur.bat, transforme via pandoc tous les fichier .md dans le répertoire sourceMd en pdf dans le dossier renduPDF 

### Pré-requis

- Path de Php est spécifié dans windows
- MikTeK installé sur votre poste
- Pandoc installé sur votre poste
- Pas d'espace dans les fichiers se trouvant dans le répertoire "sourceMd"

## Installation de Pandoc
Les explications originales relatives à l'installation de Pandoc sont accessibles sur le site Pandoc.

### Sous GNU/Linux
La méthode la plus simple consiste à installer la version de Pandoc packagée dans le dépôt officiel de votre distribution Linux. Sous Debian et dérivés ainsi que Fedora, il s'agit du package nommé pandoc que l'on installe donc de façon habituelle avec : sudo apt-get install pandoc (Debian/Ubuntu) ou yum install pandoc (Fedora). On obtiendra cependant ainsi des versions de Pandoc anciennes dans lesquelles nombre de possibilités présentées ci-dessus ne sont pas encore implémentées.

Pandoc évoluant très rapidement, si vous souhaitez bénéficier des dernières évolutions de ce convertisseur (et dernières extensions apportées à Markdown !), étant donné qu'il n'existe actuellement sous Ubuntu pas de PPA (dépôt alternatif de paquets logiciels) relatif à Pandoc, il s'agit donc de l'installer/compiler soi-même en procédant ainsi :

installation préalable de la plateforme Haskell (langage de programmation fonctionnel dans lequel est écrit Pandoc) avec : sudo apt-get install haskell-platform (une soixantaine de packages seront installés occupant ~500 MB)
puis installation/compilation proprement dite de Pandoc avec : cabal update && cabal install pandoc (ne prenez pas garde aux messages d'avertissement) ; cette commande pourra être ultérieurement répétée pour bénéficier des mises à jour de Pandoc

l'installation s'effectue alors pour l'utilisateur courant dans le répertoire ~/.cabal (arborescence standalone qui pourrait être copiée sur une autre machine), l'exécutable étant ~/.cabal/bin/pandoc
mettez à jour votre variable d'environnement PATH en conséquence (en introduisant p.ex. la ligne export PATH="$HOME/.cabal/bin:$PATH" au bas de votre prologue ~/.profile)
La procédure est similaire sous Fedora.

### Sous Windows
Téléchargez l'installeur pandoc-<version>-windows.msin, et exécutez-le avec des droits d'administration. L'installation s'effectue automatiquement dans le compte de l'utilisateur courant (dossier C:\Users\<username>\AppData\Local\Pandoc). La variable PATH de l'utilisateur est complétée de façon que la commande pandoc soit accessible depuis n'importe quel répertoire (dans une fenêtre "Invite de commande"). Finalement le menu Démarrer de l'utilisateur est complété par un raccourci vers le "Pandoc User's Guide".

### Sous Mac OS X
Téléchargez l'installeur pandoc-<version>-osx.pkg, exécutez-le et suivez les indications.

### Quel que soit le système d'exploitation
Pour être en mesure de faire une conversion directe Markdown → PDF, Pandoc nécessite qu'un environnement LaTeX soit présent sur votre machine, par exemple :

- TeX Live sous Linux : sous Debian, p.ex. installé via le méta-package texlive-latex-recommended(plus de 200 MB) outexlive-base (48 MB)
- MiKTeX sous Windows
- BasicTeX sous Mac OS X

Une alternative, présentée plus bas, consiste à effectuer une conversion Markdown → HTML avec Pandoc, puis HTML → PDF avec un autre outil.

## Utilisation du convertisseur Pandoc

## Template LaTeX utilisé

Template LaTeX issu de https://github.com/Wandmalfarbe/pandoc-latex-template et modifié


- Unix, Linux, macOS: `/Users/USERNAME/.local/share/pandoc/templates/` or `/Users/USERNAME/.pandoc/templates/`
- Windows Vista or later: `C:\Users\USERNAME\AppData\Roaming\pandoc\templates\`

## Entête LaTeX utilisé

Fichier entete.md utilisé pour poser standard de création de fichier pdf.

## Ligne de commande utilisée en création Pandoc

pandoc entree.md -o sortie.pdf --from markdown --template eisvogel --listings


