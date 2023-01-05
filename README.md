# ECF - Installation en local

Afin de pouvoir installer le site sur sa machine, en local, veuillez suivre les étapes suivantes :

## Récupération du repo et installation

- Ouvrez VisualStudio Code (ou un autre éditeur de texte, mais VS Code possède un terminal, pratique pour la suite).

- Ouvrir la palette de commande avec la combinaison de touche :
    
    Windows : *ctrl + shift + p*
    
    Mac : *cmd + shift + p*
    
- Taper *gitc* et choisir *Git: Clone*

- Entrer l’url du dépôt :
    
    ```
    https://github.com/plumedours/restaurant-ecf
    ```
    
- Choisir le dossier local (ou le créer) dans lequel cloner le dépôt
    
    *Patientez le temps que tout soit chargé, cela peut prendre plusieurs secondes*
    

- Un message proposant d’ouvrir le dépôt apparait, cliquer sur Open

- Ouvrir le Terminal avec VS Code :
    
    Windows : *ctrl + shift + ‘*
    
    Mac : *control + shit + <*
    
    Ou par la barre des tâches : *Terminal > Nouveau terminal*
    
- Installer les bibliothèques de noeuds en tapant la ligne :
    
    ```
    yarn
    ```
    
    *Ou*
    
    ```
    npm -i
    ```
    

- Une fois que tout est installé, lancer le serveur local PHP selon la configuration, en tapant la ligne :
    
    ```
    php -S [localhost:8000](http://localhost:8000) -t public
    ```
    
    *Ou*
    
    ```
    symfony server:start
    ```
    

- Démarrer le ***vite watcher*** en tapant la commande :
    
    ```
    yarn dev
    ```
    
    *Ou*
    
    ```
    npm run dev
    ```
    

## Création de la base de données

- Ouvrir votre logiciel MySql (comme MySQL Workbench), et taper la requête SQL suivante pour créer la base de données :
    
    ```sql
    CREATE DATABASE quaiantique
    ```
    

- Exécuter ensuite le fichier quaiantique.sql fourni dans le dossier Annexes du repo Github. Ce fichier contient toutes les requêtes pour créer les tables nécessaires au bon fonctionnement du site.

- À la racine du projet, créer un fichier nommé ***.env.local*** et copier / coller tout ce qui se trouve dans le fichier ***.env***. Le fichier *.env.local* sera lu en priorité. *(dupliquer le fichier .env et le renommer en .env.local)*
    - Modifier les informations concernant votre base de données (nom d’utilisateur, mot de passe, etc…). *(de mon côté, j’utilise MySQL, donc je commente la ligne postgresql et je décommente la ligne mysql)*
    - Ne pas oublier de modifier les informations dans Mailer avec vos infos SMTP *(en local, j’ai utilisé MailTrap qui fonctionne très bien pour le développement)*

- Si tout s’est bien passé, taper l’adresse suivant de le navigateur :
    
    ```
    [https://127.0.0.1:8000/](https://127.0.0.1:8000/)
    ```
    

## Création de l’utilisateur Admin

- Dans le Terminal VS Code, taper la commande suivante :
    
    ```
    symfony console security:hash-password
    ```
    

- Entrer votre mot de passe *(attention, il ne s’affiche pas à l’écran, c’est normal)*, puis valider avec la touche Entrer. Sauvegarder le mot de passe hashé obtenu.

- Retourner sur MySQL Workbench et taper la requête SQL suivante :
    
    ```sql
    INSERT INTO user (email, roles, password, firstname, lastname, is_verified) VALUES ('mon-mail@mon-mail.com', '["ROLE_ADMIN"]', 'mot_de_passe_hashe', 'mon_prenom', 'mon_nom', true);
    ```
    
    *Modifiez les champs ‘mon-mail’, ‘mot_de_passe_hashe’, ‘mon_prenom’ et ‘mon_nom’ par vos informations. Le champs ‘mot_de_passe_hashe’ doit être le mot de passe que vous avez obtenu au préalable.* 
    

Si tout s’est bien passé, vous devriez pouvoir afficher le site sans erreur et vous connecter avec votre email et votre mot de passe **non hashé** ! Si vous rencontrez un problème, merci de me contacter.
