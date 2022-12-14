<h1> TP symfony </h1>
<h2> Auteur : François Axel (fran0138), Franck Tony (fran0124), Legros Enzo (legr0109), Becker Chloé (Beck0018), Hureaux Lucas (Hure0006)</h2>
<br>
<h2> Installation / Configuration</h2>
<h3> Ajout dans le composeur.json : </h3>
<p> 
"start" : [ <br>
            "Composer\\Config::disableProcessTimeout",<br>
            "symfony serve"<br>
        ], 
<br>
-> Qui lance le serveur web symfony avec la commande composer start
</p>
<p>
"stop" : [ <br>
            "symfony server:stop" <br>
        ],
<br>
-> Qui stoppe le serveur web symfony avec la commande composer stop (pas besoin de l'exécuter en temps normal)
</p>
<p>      
"fix:cs": [ <br>
            "php-cs-fixer fix" <br>
        ],
<br>
-> Qui lance la commande de correction du code par PHP CS Fixer
</p>
<p>
"test:cs" : [ <br>
            "php-cs-fixer fix --dry-run" <br>
            ],
<br>
-> Qui lance la commande de vérification du code par PHP CS Fixer 
</p>
<p>
"test:codecept": [ <br>
                "php vendor/bin/codecept run" <br>
                ],
<br>
-> Qui lance les test avec codeception
</p>
<p>
"test": [ <br>
        "@test:cs", <br>
        "@test:codecept" <br>
        ],
<br>
-> Qui lance : le script Composer qui teste la mise en forme du code et le script Composer des tests avec Codeception
</p>
<p>
Nous avons rajouter les éléments suivant dans le composer.json
</p>
<p>
"db" : [ <br>
"php bin/console doctrine:database:drop --force --if-exists" -> Destruction forcée de la base de données <br>
"php bin/console doctrine:database:create"-> Création de la base de données <br>
"php bin/console doctrine:migrations:migrate --no-interaction" -> Application des migrations successives sans questions interactives <br> 
"php bin/console doctrine:fixtures:load --no-interaction" -> Génération des données factices sans questions interactives <br>
],
</p>
<p>On modifie le script test:codecept de la façon suivante :</p>
<p>
"test:codecept": [ <br>
            "php bin/console doctrine:database:drop --force --quiet --env=test"-> Destruction silencieuse forcée de la base de données <br>
            "php bin/console doctrine:database:create --quiet --env=test"-> Création silencieuse de la base de données <br>
            "php bin/console doctrine:schema:create --quiet --env=test"-> Création silencieuse du schéma de la base de données <br>
            "php vendor/bin/codecept run"
        ],
</p>