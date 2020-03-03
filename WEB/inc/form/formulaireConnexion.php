<?php
/*
*     Auteur              :  RUSSOTTI Leandro.
*     Projet              :  Stagiaire.
*     Page                :  Formulaire de connexion.
*     Description         :  Sert a être include quand on en aura besoin.
*     Date début projet   :  29.11.2018.
*/

// Variable qui se crée a l'appuie du bouton.
$ok = FILTER_INPUT(INPUT_POST,"formLogin");

// Lance le script a l'appuie du bouton.
if($ok)
{
    // Crée les variables
    $mailConnexion = FILTER_INPUT(INPUT_POST,"mailConnexion",FILTER_VALIDATE_EMAIL);
    $password = FILTER_INPUT(INPUT_POST,"password",FILTER_SANITIZE_STRING);
    $admin = False;
    $erreur = [];

    // Vérifie si le champ email est bien une email
    if (!$mailConnexion)
    {
        $erreur["email"] = ".";
    }

    // Vérifie si le champ password n'est pas vide ou faux.
    if (!$password)
    {
        $erreur["password"] = ".";
    }

    // Vérifie si les informations de connexion sont bonnes.
    if (!connectUser($mailConnexion,hashPassword($mailConnexion,$password)))
    {
        $erreur["login"] = "Email ou mot de passe incorrect.";
    }

    // Continue si il n'y a aucune érreur.
    if (count($erreur) == 0)
    {
        connecterUser($mailConnexion);
        exit;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="shadow-lg card text-dark" style="background-color: #EEEEEE;">
                <?php if (isset($erreur["login"]) && !isset($erreur["email"])): ?>
                    <div class="card-header bg-danger"><h5>Email ou mot de passe incorrect</h5></div>
                <?php else: ?>
                    <div class="card-header text-light p-3 pl-4" style="background-color: #35393C"><h4>Se connecter</h4></div>
                <?php endif; ?>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="nomStagiaire"><h5>Votre adresse email :</h5></label>
                                    <?php if (isset($erreur["email"])): ?>
                                        <input type="text" class="form-control is-invalid" id="mailConnexion" placeholder="Erreur dans votre email" name="mailConnexion" required>
                                        <div class="invalid-feedback">Veuillez rentrez une adresse mail valide.</div>
                                    <?php else: ?>
                                        <input type="text" class="form-control" id="mailConnexion" placeholder="Email" name="mailConnexion" required value="<?php if(isset($mailConnexion)){echo $mailConnexion;}?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col">
                                    <label for="password"><h5>Votre mot de passe :</h5></label>
                                    <?php if (isset($erreur["password"])): ?>
                                        <input type="password" class="form-control is-invalid" id="password" placeholder="******" name="password" required>
                                        <div class="invalid-feedback">Veuillez rentrez un mot de passe valide.</div>
                                    <?php else: ?>
                                        <input type="password" class="form-control" id="prenomStagiaire" placeholder="******" name="password" required value="<?php if(isset($password)){echo $password;}?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <input type="submit" class="form-control btn btn-bouton1" value="Se connecter" name="formLogin">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
