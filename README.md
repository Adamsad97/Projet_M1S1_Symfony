<<<<<<< HEAD
PROJET Symfony-Intégrayion TainwindCss:

Cahier de charge:
Mise en place d'une plateforme d'e-commerce Symfony.


Fonctionnalités:
Pour utilisateur ordinaire:
1. Permettre à l'utilisateur de s'inscrire
2. Permettre à l'utilisateur de se connecter
3. Permettre à l'utilisateur de modifier son mot de passe
4. Permettre à l'utilisateur réinitialiser son mot de passe en cas d'oublie
5. Permettre à l'utilisateur de parcourir les catégories de produits
6. permettre à l'utilisateur consulter les produit par catégorie
7. Permettre à l'utilisateur d'ajouter un/des produit(s) à son panier
8. Permettre à l'utilisateur de supprimer des produits de son panier
9. Permttre à l'utilisateur de d'augmenter ou de diminuer la quantité d'une série produits ajoutée à son panier
10. Permettre à l'utilisateur de saisir ses adresses de livraison
11. Permettre à l'utilisateur de son choisir un transporteur
12. Permettre à l'utilisateur de voir le récapitulatif de son panier à de procéder au peiement
13. Permettre à l'utilisateur de passer sa commande
14. Permettre à l'utilisateur après paiement, de consulter ou d'imprimer sa facture
15. Permettre à l'utilisateur d'ajouter des produits à sa liste de  souhaits
16. Permettre à l'utilisateur de supprimer des produits de sa liste de souhaits
17. Permettre à l'utilisateur de se deéconnecter

Pour Administrateur
18. Permettre à l'administrateur de créer des catégories de produits, des produits, des produits à la Une, des transporteurs
19. Permettre à l'adminstrateur de consulter les commandes payées ou en attente de payement
20. Permettre à l'administrateur de voir ou d'imprimer la facture des commandes
21. Ne pas permettre à l'administrateur de créer une commande, de modifier une commande, de supprimer une commande, ou de modifier les coordonnées d'un utilisateur
22. Permettre à l'administrateur d'attribuer un rôle à un utilisateur et lui le rétirer éventuellement
23. Permettre à l'administrateur de modifier des produits, des catégories de produits
24. permettre à l'administrateur de créer des produits
25. Permettre à l'administrateur de publier des produits à la Une

Prérequis:

1. Une adrresse mail valide est obligatoire
2. Ne pas s'inscrire avec une adresse mail fictive, sinon vous ne pourrez pas vous y connecter. La la validation est une étape obligatoire
3. Saisir un mot mot de passe d'au moins 4 caractères (au moins 1 lettre majuscule, au moins une lettre minuscule, au moins 1 chiffre, au moins un caractère spécial)
4. Pour modifier votre mot de passe, il faut saisir obligatoirement votre ancien mot de passe
5. Pour réinitialiser votre mot de passe, la saisie de votre adresse mail d'inscription est obligatoire (Pour des mesures de sécurité, même si vous rentrez une adresse autre que celle avec laquelle vous vous êtes inscrit, vous n'aurez pas un message explicite pour vous le dire)
6. 

GUIDE D'INSTALLATION DU PROJET EN LOCAL:
1. Back-end: Symfony (Symfony 7)
2. Front-end: TailwindCss (v4)
3. Version PHP (PHP 8.3.1)
4. Récuprez le projet depuis le depot github ()
5. Ouvrez 2 terminaux
6. Installer les dépendances symfony ( composer install)
7. Installer les dépendances TailwindCss (npm Install)
8. Démarrer le server symfony (symfony server:start ou symfony serve)
9. Démarrer npm (npm run watch)
10. Pour passer une commande, merci d'utiliser la CB fictive mise à disposition par Stripe pour des tests (CB pour le test : 4242 4242 4242 4242)


=======
PROJET : Mise en place d'une plateforme e-commerce.
Back-end : Symfony 7
Front-end : TailwindCss v4

Cahier de Charge:
Fonctionnalités:

Pour Utilisateur ordinaire:
  1. Permettre à l’utilisateur  des consulter les produits par catégories
  2. Permettre à l’utilisateur  de s'inscrire
  3. Envoi de mail de vérification de compte
  4. Envoi de lien de réinitialisation de mot de passe par mail
  5. Permettre à l'utilisateur de modifier son mot de passe
  6. Permettre à l’utilisateur  de s’authentifier
  7. Permettre à l’utilisateur  d'ajouter des produits à son panier
  8. Permettre à l’utilisateur  d'ajouter des produits à sa liste de souhait (Whistlist)
  9. Permettre à l’utilisateur  de consulter son panier
  10. Permettre à l’utilisateur  d'ajouter ou de diminuer la quantité de produits dans son panier
  11. Permettre à l’utilisateur  de vider son panier
  12. Permettre à l’utilisateur  de supprimer des produits de sa liste de souhait
  13. Permettre à l’utilisateur  de passer sa commande
  14. Permettre à l’utilisateur  de voir le récapitulatif de son panier
  15. Permettre à l’utilisateur  de payer ses produits
  16. Permettre à l’utilisateur  de consulter après paiement, sa facture
  17. Permettre à l’utilisateur  de télécharger sa facture
  18.  Ne pas permettre à l’utilisateur  de consulter des commandes qui ne lui appartiennent pas
  19. Permettre à l’utilisateur  de se déconnecter
  
Pour Administrateur
  17. Permettre à L'administrateur d'ajouter de catégories de produits
  18. Permettre à L'administrateur d'ajouter des produits
  19. Permettre à L'administrateur de mettre des produits à la Une
  20. Permettre à L'administrateur d'ajouter des transporteurs
  21. Permettre à L'administrateur de consulter des commandes payées/en attente de paiement
  22. Permettre à L'administrateur de voir ou d'imprimer des factures
  23. Ne pas permettre à l'utilisateur de créer une commande
  23. Ne pas permettre à L'administrateur des modifier les cordonnées de connexion des utilisateurs
  24. Ne pas permettre à l'administrateur de modifier ou de supprimer une commande


GUIDE D'INSTALLATION EN LOCAL:
 1. Cloner la branche concernée (git clone -b Symfony_Integration_TailwindCss https://github.com/Adamsad97/Projet_M1S1_Symfony.git)
 2. Merci de récuprer la base de donnéés (maboutique.sql) après le clonage du projet, elle est parmi les fichiers clonés, merci de l'importer sur votre machine
3. Rendez-vous dans le dossier du projer
4. Installer les dépendances symfony (Composer install)
5. Installer les dépendances TailwindCss (npm install)
6. Assurez-vous d'avoir deux(2) terminaux ouverts
7. Lancez le serveur symfony (symfony serve ou symfony server:start
8. Lancez TailwindCss (npm run watch)
9. Assurez-vous d'avoir un Gestion de Base de Données (XAMPP, MAMP ..)
10. Lancez vos server SQL et APACHE)
11. N’oubliez pas d'importer la base de données mise à disposition
12. Exécutez le projet à l'aide d'un navigateur (Chrome, Firefox, Edge ...)
13. Inscrivez-vous avec une vraie adresse mail, car la vérification de votre compte est obligatoire pour la validation de votre compte
14. Pour le mot de passe, il faut vous faut: au moins 4 caractères (Au moins 1 majuscule, au moins une minuscule, au moins 1 chiffre, au moins un caractère spécial)
15. Pour la confirmer votre mot de passe, vous devez saisir le même mot de passe
16. Pour modifier votre mot de passe, il vous faut obligatoirement saisir l'ancien mot de passe
17. Pour réinitialiser votre mot de passe, assurez-vous il vous faut obligatoirement l'adresse mail avec laquelle vous vous êtes inscrit(e)
18. Vous recevrez un lien de réinitialisions, ce lien est valide que pour 10 minutes
19. Pour passer une commande, merci d'utiliser la CB fictive mise à disposition par Stripe pour des tests (CB pour le test : 4242 4242 4242 4242)

URL Github : https://github.com/Adamsad97/Projet_M1S1_Symfony/tree/Symfony_Integration_TailwindCss

Pour cloner : git clone -b Symfony_Integration_TailwindCss https://github.com/Adamsad97/Projet_M1S1_Symfony.git

URL PRODUCTION : https://elecsmart-dev.fr

Email Admin : diawaraad97@gmail.com
Mot de passe Admin : Ad97#

UTILISATEUR BANNI:
Email User Banni : diawaraad79@gmail.com
Email User Banni : Ad97#





Vous avez à disposition, une Base de données avec des vraies données.
>>>>>>> Symfony_Integration_TailwindCss
