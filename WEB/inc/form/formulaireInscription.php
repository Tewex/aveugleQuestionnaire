<?php
/*
*     Auteur              :  RUSSOTTI Leandro.
*     Projet              :  Stagiaire.
*     Page                :  Formulaire d'inscription.
*     Description         :  Sert a être include quand on en aura besoin.
*     Date début projet   :  29.11.2018.
*/

$ok = filter_input(INPUT_POST,"btnCreationCompte");

if ($ok)
{
    // Crée les variables
    $nom = filter_input(INPUT_POST,"nom", FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST,"prenom", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL);

    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_STRING);

    $erreur = [];

    // Vérifie si nom stagiaire n'est pas vide.
    if (!$nom)
    {
        $erreur["nom"] = "Nom incomplet";
    }

    // Vérifie si prénom stagiaire n'est pas vide.
    if (!$prenom)
    {
        $erreur["prenom"] = "Prénom incomplet";
    }

    // Vérifie si password stagiaire n'est pas vide.
    if (!$password)
    {
        $erreur["password"] = "Mot de passe incomplet";
    }

    // Vérifie si l'email du stagiaire est bien un email et n'est pas vide.
    if (!$email)
    {
        $erreur["email"] = "Email incomplet";
    }

    // Vérifie si il n'y a eu aucune valeur mal entrée dans le formulaire et envoie les données dans la bdd.
    if (count($erreur) == 0)
    {
        $password = sha1($emailStagiaire.$password);
        ajouterStagiaireBDD($nomStagiaire,$prenomStagiaire,$emailStagiaire,$password,$telephoneStagiaire,$ecoleStagiaireFinal,$degreStagiaire);
        header("Location: pingtoflop.php");
    }
}
?>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card text-light" style="background-color: #ffbb7e">
                <div class="card-header" style="background-color: #e26a00"><h5>Crée un compte</h5></div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="nom">Votre nom :</label>
                                    <?php if (isset($erreur["nom"])): ?>
                                        <input type="text" class="form-control is-invalid" id="nom" placeholder="nom ..." name="nom" required>
                                        <div class="invalid-feedback"> Veuillez rentrez un nom valide</div>
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="nom" placeholder="nom ..." name="nom" required value="<?php if(isset($nom)){echo $nom;}?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col">
                                    <label for="prenomStagiaire">Votre prénom :</label>
                                    <?php if (isset($erreur["prenom"])): ?>
                                        <input type="text" class="form-control is invalid" id="prenom" placeholder="Prénom" name="prenom" required>
                                        <div class="invalid-feedback"> Veuillez rentrez un prénom valide</div>
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" required value="<?php if(isset($prenom)){echo $prenom;}?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <?php if (isset($erreur["email"])): ?>
                                <input type="text" class="form-control is-invalid" id="email" placeholder="exemple@mail.ch" name="email" required>
                                <div class="invalid-feedback"> Veuillez rentrez une adresse email valide</div>
                            <?php else: ?>
                                <input type="text" class="form-control" id="email" placeholder="exemple@mail.ch" name="email" required value="<?php if(isset($email)){echo $email;}?>">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="pseudo">Pseudo :</label>
                            <?php if (isset($erreur["pseudo"])): ?>
                                <input type="text" class="form-control is-invalid" id="pseudo" placeholder="Pseudonyme ...." name="pseudo" required >
                                <div class="invalid-feedback"> Veuillez rentrez un pseudonyme valide</div>
                            <?php else: ?>
                                <input type="text" class="form-control" id="pseudo" placeholder="Pseudonyme ...." name="pseudo" required value="<?php if(isset($pseudo)){echo $pseudo;}?>">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="nom">Mot de passe :</label>
                                        <?php if (isset($erreur["password"])): ?>
                                            <input type="text" class="form-control is-invalid" id="password" placeholder="****" name="password" required>
                                            <div class="invalid-feedback"> Veuillez rentrez un mot de passe valide</div>
                                        <?php else: ?>
                                            <input type="text" class="form-control" id="password" placeholder="*****" name="password" required>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <label for="password2">Vérification mot de passe :</label>
                                        <?php if (isset($erreur["password"])): ?>
                                            <input type="text" class="form-control is invalid" id="password2" placeholder="*****" name="password2" required>
                                            <div class="invalid-feedback"> Veuillez rentrez un prénom valide</div>
                                        <?php else: ?>
                                            <input type="text" class="form-control" id="password2" placeholder="*****" name="password2" required>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <input type="submit" class="form-control btn btn-bouton1" value="Ajouter" name="btnCreationCompte">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function autreEcole(){
    if (document.getElementById("degreeStagiaire").value == "autre")
    {
        document.getElementById("autreEcoleStagiaire").removeAttribute("readOnly");
        document.getElementById("autreEcoleStagiaire").required = true;
        document.getElementById("ecoleStagiaire").readOnly = true;
        document.getElementById("ecoleStagiaire").required = false;
        document.getElementById("ecoleStagiaire").value = "";
    }
    else
    {
        document.getElementById("autreEcoleStagiaire").readOnly = true;
        document.getElementById("autreEcoleStagiaire").required = false;
        document.getElementById("autreEcoleStagiaire").value = "";
        document.getElementById("ecoleStagiaire").removeAttribute("readOnly");
        document.getElementById("ecoleStagiaire").required = true;
    }
}
</script>
