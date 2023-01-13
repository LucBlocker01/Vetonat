iutinfo<h1> Machine virtuel de la SAE" </h1>
<h2> Auteur : François Axel (fran0138), Franck Tony (fran0124), Legros Enzo (legr0109), Becker Chloé (Beck0018), Hureaux Lucas (Hure0006)</h2>
<br>
<h2> Fonctionnement de la VM</h2>
<p>Lors de votre connection sur la VM rentrer le login <strong>'iutinfo'</strong> avec le mot de passe <strong>'iutinfo'</strong> pour vous connecter<p>
<p> taper la commande <strong>'sudo loadkeys fr'</Strong> pour basculer le clavier en AZERTY (rappel : appuyer sur la lettre q pour faire un a en QWERTY)</p>
<p>Taper ensuite la commande <strong>'sudo systemctl start apache2.service'</strong> pour lancer le serveur apache2</p>
<p>Taper ensuite dans votre navigateur l'adresse IP suivante <strong>'10.31.11.109'</strong> directement accéder au site web.</p>
<p>Pour consulter la base de données pour se connecter avec les user déjà existant taper la commande suivante <strong>'sudo mysql'</strong></p>
<p> Taper ensuite la requête suivante : <strong>'SELECT login_pers,roles from fran0138_vetonat.personne'</strong> Pour avoir la liste des users et leur mot de passe</p>