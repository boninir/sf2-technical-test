# StadLine Technical Test

### Tache

Le sujet de base est simple : Il faut créer une page sécurisée qui permet à un utilisateur de se loguer et de faire un commentaire sur un dépôt publique d'un utilisateur GitHub.
La fonctionnalité de commentaire n'existe pas sur Github, vous devrez donc stocker et afficher ces commentaires dans votre espace sécurisé.

### Règles

* Le temps est libre mais il est tout de même conseillé de passer moins de 4h sur le sujet (temps de setup d'environnement compris)
* Il est conseillé de finir les points requis avant de s'attaquer au bonus. 
* Il est aussi conseillé de faire un maximum de commit pour bien détailler les étapes de votre raisonnement au cours du développement.
* N'hésitez pas à nous faire des retours et nous expliquer les éventuelles problématiques bloquantes que vous auriez rencontrées durant le développement vous empéchant de finir.

### Setup

* La charte graphique n'est pas imposée et sera jugée en bonus. L'emploi d'un framework CSS type Twitter Bootstrap est fortement conseillé. 
* Vous aurez besoin d'un environnement php5.5, Symfony2 et un serveur pour l'application. 

### Les pré-requis

* Vous êtes libre d'utiliser un bundle d'authentification externe ou votre propre bundle. 
* Le formulaire de connexion doit avoir une validation coté serveur. 
* Toutes les pages doivent être sécurisées et pointer sur la page de login si l'utilisateur n'est pas connecté. 
* Le choix du client HTTP est laissé à discrétion pour appeller l'API de GitHub.
* Une fois connecté, il est nécessaire d'implémenter un champ de recherche qui permette de chercher les utilisateurs GitHub. La documentation est disponible ici : https://developer.github.com/v3/search/#search-users . 
* Vous devez appeller l'API suivante avec q=searchFieldContent :
```
https://api.github.com/search/users
```
* Une fois le champ de recherche validé et l'utilisateur sélectionné, on arrive sur l'url /{username}/comment, on affiche un formulaire qui sera composé des champs suivants : un champ texte pour le nom d'un dépôt ({user}/{repos}, e.g : stadline/sf2-technical-test), un textArea pour le commentaire, un bouton valider permettant d'ajouter un commentaire. 
* On affichera en dessous la liste des commentaires déjà saisis pour l'utilisateur.
* Lors de la validation du formulaire, on vérifiera que le repository sélectionné est bien un dépôt appartenant à l'utilisateur précédement recherché.
* On attend aussi de vous que le code soit testable et testé.

### Bonus

* On changera le choix du dépôt par un multiselect afin de lister directement dans le formulaire les dépôts de l'utilisateur. 
* Utilisation d'un frameworkJS pour afficher les résultats
* Toutes les fonctionnalités que vous aurez le temps d'ajouter seront aussi bonnes à prendre. Un bonus autour de votre créativité pourra être considéré.

### Délivrabilité

* Forkez le projet sur GitHub et codez directement dans le projet forké. 
* Commitez aussi souvent que possible et commentez vos commits pour détailler votre chemin de pensée. 
* Mettez à jour le README pour ajouter le temps passé et tout ce que vous jugerez nécessaire de nous faire savoir. 
* Envoyez le lien avec le projet à recrutement@stadline.com. 

**Bonne chance !**

### Commentaires Raphael

* Je me suis efforcé de suivre toutes les directives au mieux, j'ai un peu bataillé et perdu du temps sur l'aspect 
authentification (j'en fais pas tout les jours, pour le coup, je me suis rendu compte que j'étais bien rouillé). On 
nottera aussi que la mise en page n'est pas trop travaillée, je suis un peu plus habitué au back qu'au front ^^'.
* Je n'ai pas totalement respecté les directives sur les url à appeler pour naviguer sur l'application 
(surtout sur le pattern décrit, mais globalement, la feature est la).
* Pas de soucis particulier pour le reste, concernant la partie bonus, comme évoqué plus haut la mise en page reste très
discutable (au vu du temps perdu, je me sentais pas la foie de gérer le front avec du ReactJS, en 4h c'était un peu ambitieux).
J'ai fait une partie des tests fonctionnel, je n'ai pas couvert toute l'application (je pense que le but ici n'était pas de tout
couvrir, mais plus de se faire une idée de la marche à suivre pour tester), j'ai aussi mis en place une CI en intégrant 
Travis pour lancer mes tests (c'est quand même bien pratique). J'ai aussi lancé une build sur scrutinizer histoire de 
checker le code (le tout est de se faire une idée globale du code quality, il est pas topissime, mais le code reste tout de meme
assez simple à la lecture d'apres le report :-) )
* temps passé : pour être totalement transparent, entre 5 et 6h

## Lancement

Pour faire tourner le projet chez vous, rien de plus simple :

```bash
git clone git@github.com:boninir/sf2-technical-test.git
cd sf2-technical-test.git
composer install
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
```

Vous pouvez ensuite lancer un serveur php via :

```bash
php app/console server:start
```

Pensez à générer un ou deux utilisateurs de tests :

```bash
php app/console fos:user:create bigg bigg@darkligther.com bigg
php app/console fos:user:create wedge wedge@antilles.com wedge
```

Vous pourrez ainsi accéder à l'application via le port 8000 de votre machine :

```
http://127.0.0.1:8000
```