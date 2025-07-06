PROJET : Mise en place d'une plateforme d'e-commerce.
Back-end : Symfony 7
Front-end : TailwindCss v4

Cahier de Charge:
Fonctionnalités:

Pour Utilisateur ordinaire:
  1. Permettre à l'uttilisateur des consulter les produits par catégories
  2. Permettre à l'uttilisateur de s'inscrire
  3. Envoi de mail de verification de compte
  4. Envoi de lien de réinitialisation de mot de passe par mail
  5. Permettre à l'utilisateur de modifier son mot de passe
  6. Permettre à l'uttilisateur de ss'authentifier
  7. Permettre à l'uttilisateur d'ajouter des produit à son panier
  8. Permettre à l'uttilisateur d'ajouter des produits à sa liste de souhait (Whistlist)
  9. Permettre à l'uttilisateur de consulter son panier
  10. Permettre à l'uttilisateur d'ajouter ou de diminuer la quantité de produits dans son panier
  11. Permettre à l'uttilisateur de vider son panier
  12. Permettre à l'uttilisateur de supprimer des produits de sa liste de souhait
  13. Permettre à l'uttilisateur de passer sa commande
  14. Permettre à l'uttilisateur de voir le récapitulatif de son panier
  15. Permettre à l'uttilisateur de payer ses produits
  16. Permettre à l'uttilisateur de consulter après après paiement, sa facture
  17. Permettre à l'uttilisateur de télécharger sa facture
  18.  Ne pas permettre à l'uttilisateur de consulter des commandes qui ne lui appartient pas
  19. Permettre à l'uttilisateur de se déconnecter
  
Pour Administrateur
  17. Permettre à L'administrateur d'ajouter de catégories de produits
  18. Permettre à L'administrateur d'ajouter des produits
  19. Permettre à L'administrateur de mettre des produits à la Une
  20. Permettre à L'administrateur d'ajputer des transporteurs
  21. Permettre à L'administrateur de consulter des commandes payées/en attente de paiement
  22. Permettre à L'administrateur de voir ou d'imprimer des facture
  23. Ne pas permettre à l'utilisateur de créer une commande
  23. Ne pas ermettre à L'administrateur des modifier les cordonnées de connexion des utilisateurs
  24. Ne pas permettre à l'administrateur de modifier ou de supprimer une commande


GUIDE D'INSTALLATION EN LOCAL:
 1. Cloner la branche concernée (git clone -b Symfony_Integration_TailwindCss https://github.com/Adamsad97/Projet_M1S1_Symfony.git)
2. Rendez-vous dans le dossier du projer
3. Installer les dépendances symfony (Composer install)
4. Installer les dépendances TailwindCss (npm install)
5. Assurez-vous d'avoir deux(2) terminaux ouverts
6. Lancez le serveur symfony (symfony serve ou symfony server:start
7. Lancez TailwindCss (npm run watch)
8. Assurez-vous d'avoir un Gestion de Base de Données (XAMPP, MAMP ..)
9. Lancez vos server SQL et APACHE)
10. Exécutez le projet à l'aide d'un navigateur (Chrome, Firefox, Edge ...)
11. Inscrivez-vous avec une vraie adresse mail, car la vérification de votre compte est obligatoire pour la validation de votre compte
12. Pour le mot de passe, il faut vous faut: au moins 4 caractères (Au moins 1 majuscule, au moins une minuscule, au moins 1 chiffre, au moins un caractère spécial)
13. Pour la confirmer votre mot de passe, vous devez saisir le même mot de passe
14. Pour modifier votre mot de passe, il vous faut obligatoirement saisir l'ancien mot de passe
15. Pour réinitialiser votre mot de passe, assurez-vous il vous faut obligatoirement l'adresse mail avec laquelle vous vous êtes inscrit(e)
16. Vous recevrez un lien de réinitialition, ce lien est valide que pour 10 minutes
17. Pour passer une commande, merci d'utiliser la CB fictive mise à disposition par Stripe pour des tests (CB pour le test : 4242 4242 4242 4242)

URL Github : https://github.com/Adamsad97/Projet_M1S1_Symfony/tree/Symfony_Integration_TailwindCss
Pour cloner : git clone -b Symfony_Integration_TailwindCss https://github.com/Adamsad97/Projet_M1S1_Symfony.git

URL PRODUCTION : https://elecsmart-dev.fr

Vous avez à dispositon, une Base de données avec des vraies données.
