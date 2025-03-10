<!DOCTYPE html>
    <html>
      <head>
        <title>Titre du document</title>
        <link href="compte.css" rel="stylesheet">
      </head>
      
      <body>
        
        

        <h2 style="text-align: center;"> Se Connecter </h2>
        <form name="RegForm" action="/submit.php" onsubmit="return W3docs()" method="post" class="w3docs" id="compte">
          <div>
            <label for="Nom">Nom d'utilisateur:</label>
            <input type="text" id="Nom" size="60" name="loginCo" />
          </div>
          <br />
          <div>
           
          <div>
            <label for="E-mail" l>Adresse Mail:</label>
            <input type="text" id="E-mail" size="60" name="Email" />
          </div>
          <br />
          <div>
            <label for="Mot de passe">Mot de passe:</label>
            <input type="text" id="Motdepasse" size="60" name="MdpCo" />
          </div>
          <br />
          <div>
           
          </div>
          <button id="buttons" href="../projet.html"> <h3 id="go">Go!</h3></button>
        </form>
        <p> <?php echo $message ?></p>
        <script src="compte.js"></script>
        </body>
        </html>