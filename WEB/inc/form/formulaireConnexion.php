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

    // Continue si il n'y a aucune érreur.
    if (count($erreur) == 0)
    {
        // Vérifie si l'utilisateur est un administrateur.
        if (!verifieAdmin($mailConnexion,$password))
        {
            $erreurAdmin["password"] = ".";
            $erreurAdmin["email"] = ".";
            $erreurAdmin["login"] = ".";
            $erreur["login"] = ".";
        }
        // Vérifie si l'utilisateur est un stagiaire.
        if (!verifierUser($mailConnexion,$password))
        {
            $erreurStagiaire["password"] = ".";
            $erreurStagiaire["email"] = ".";
            $erreurStagiaire["login"] = ".";
            $erreur["login"] = ".";
        }
        // Si l'utilisateur est un stagiaire le connecte, lui donne ces informations en session et le redirige a la page stagiaire.
        if (count($erreurStagiaire) == 0)
        {
            $userinfo = getInfosStagiaire($mailConnexion);
            $_SESSION["nom"] = $userinfo["nomStagiaire_STAGIAIRES"];
            $_SESSION["idStagiaire"] = $userinfo["idStagiaire_STAGIAIRES"];
            $_SESSION["grade"] = "Stagiaire";
            $_SESSION['connect'] = True;
            $_SESSION["droits"] = array(
                "stagiaire" => true
            );
            header("Location: profil.php");
            exit;
        }
        // Si l'utilisateur est un admin le connecte, lui donne ces informations en session et le redirige a la page admin.
        if (count($erreurAdmin) == 0)
        {
            $userinfo = getInfosAdmin($mailConnexion);
            $_SESSION["nom"] = $userinfo["nomAdmin_ADMINISTRATEUR"];
            $_SESSION["idStagiaire"] = $userinfo["idAdmin_ADMINISTRATEUR"];
            $_SESSION["grade"] = "Admin";
            $_SESSION['connect'] = True;
            $_SESSION["droits"] = array(
                "admin" => true
            );
            header("Location: administrationStagiaire.php");
            exit;
        }
    }
}
?>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card text-light" style="background-color: #ffbb7e;">
                <?php if (isset($erreur["login"])): ?>
                    <div class="card-header bg-danger"><h5>Email ou mot de passe incorrect</h5></div>
                <?php else: ?>
                    <div class="card-header" style="background-color: #e26a00"><h5>Se connecter</h5></div>
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
