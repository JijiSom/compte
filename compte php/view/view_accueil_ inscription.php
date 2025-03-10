<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="Inscription.css" rel="stylesheet">
</head>

<body>
  <form name="RegForm" method="post" class="w3docs" id="inscription">
   
    <div>
      <label for="Nom">Nom de l'utilisateur:</label>
      <input type="text" id="Nom" size="60" name="Nom" />
    </div>

    <div id="inscirptionName">
    <div>
      <label for="Nom">Nom:</label>
      <input type="text" id="Nom" size="60" name="Nom" />
    </div>
   
    <div>
      <label for="Prenom">Prénom:</label>
      <input type="text" id="Nom" size="60" name="Prenom" />
    </div>
   
     </div>

     <div id="container2">
    <div>
      <label for="NouveaumotDepasse">Mot de passe</label>
      <input type="text" id="NouveauMotDePasse" size="60" name="Nmotdepasse" />
    </div>
   
    <div>
      <label for="Motdepasse">Confirmer Mot de passe:</label>
      <input type="text" id="Motdepasse" size="60" name="Motdepasse" />
    </div>
    
  </div>
   
    <button id="buttons" class="button" href="../projet.html"> S'inscrire!</button>
  </form> 
  <?php echo $messageSO?></php>
    <script src="inscription.js"></script>
   </body>
</html>