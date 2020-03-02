# Cahier des charges – Test Home-Viewer

## Objectif du projet :

Le but de ce projet est de créer une **application web** basée sur **symfony** permettant de **mettre en ligne des images** sous forme d’une **galerie**. Les images devront être **stockées sur le serveur**, et possèderont chacune un **nom** associé, ainsi que la **date de mise** en ligne. Il sera possible de **supprimer** des images de la galerie.

## Installation

Le projet repose sur **composer** pour gérer les différentes dépendances. Pour les installer, il suffit tout d'abord de créer le fichier *.env* à partir du *.env.dist*, qui est le fichier de variables d'environnement par défaut. Il suffit ensuite d'installer les dépendences avec:

```
composer install
```

Le projet se réparti en plusieurs fichiers principaux:

- *src/Controller/MainController.php*, le controlleur symfony principal, où il vous faut coder le processus d'upload des photos.
- *templates/main/index.html.twig*, le template html où vous pourrez coder le comportement client.

Vous aurez potentiellement besoin d'une base de donnée, ainsi que des entités Symfony (Doctrine ORM), afin de gérer le stockage des images, auquel cas vous pouvez simplement indiquer l'url de cette bdd dans le fichier .env

## Contraintes :

-	Le projet devra être codé en php avec le framework symfony, à partir d’un fork du projet initial (…)
-	Le projet utilisera uniquement des dépendances composer (aucun programme externe au php)
-	L’interface html devra être celle fournie
-	La page ne doit pas être rechargée lors de l’upload d’une image, et il devra être possible de mettre plusieurs images en ligne en même temps
-	Il sera possible de mettre des images en ligne via un glisser-déposer ou via le champ de formulaire

## Extra

Cette section comprend les fonctionnalités complémentaires, à faire uniquement si vous avez passé moins d'une heure / d'une heure trente sur le projet jusque la.

-	Il sera possible de supprimer les images
-	Barre de chargement de l’upload (pour une ou plusieurs images)
-	Plusieurs galeries séparées
-	Date de dernière modification
- Il sera possible de reommer les images
-	Plusieurs images peuvent avoir le même nom
- Visualiser les images en plein écran
