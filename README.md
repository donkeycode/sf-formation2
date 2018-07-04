# sf-formation2


## Application de vente de biens PAP (multilangue) 

Front 
 - User Login
 - Possibilité de poster un bien et modifier un bien si c’est le mien
 - Possibilité de retrouver toutes les demandes reçues dans mon espace
 - Le bien doit suivre un workflow de validation a chaque modifications (draft -> review -> published)
 - API Rest permettant de retrouver / modifier le bien et pousser des leads intéressés par mon bien
 - A chaque nouveau lead un mail est envoyé au propriétaire du bien
 - En option pour ceux qui auront du temps une recherche ElasticSearch pour retrouver les bien proche de moi avec des critères “a la seloger”.

Admin 
 - Pour gérer les biens et suivre les leads
 - Pour modifier via un champ de texte la formule de calcul des commissions appliqué en cas de vente en fonction de l’abonnement de l’utilisateur connecté en utilisant des fonctions de calcul de TVA deja implémenté coté PHP dans la fonction tva($amount)
 - Un état de stats 
    - Avec le nombre moyen d’appartement par utilisateur (groupé par etat)
    - Avec un suivi mois par mois du nombre de données

Cron
 - Une tache cron permettra d’envoyer une piece jointe format CSV ou XLS un mail avec l’ensemble des bien actifs ajouté depuis la dernière execution de la cron avec les colonnes (nom proprio, etat, nom du bien, localisation)

Tests
