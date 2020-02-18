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
    $nom = ucfirst(filter_input(INPUT_POST,"nom", FILTER_SANITIZE_STRING));
    $prenom = ucfirst(filter_input(INPUT_POST,"prenom", FILTER_SANITIZE_STRING));
    $email = filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL);
    $pseudo = filter_input(INPUT_POST,"pseudo", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,"password1", FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_POST,"password2", FILTER_SANITIZE_STRING);

    $erreur = [];

    // Vérifie si nom stagiaire n'est pas vide.
    if (!$nom)
    {
        $erreur["nom"] = "Nom incomplet";
    }
    if (!verifyName($nom))
    {
        $erreur["nom"] = "Un nom ne peut pas être un chiffre";
    }

    // Vérifie si prénom n'est pas vide.
    if (!$prenom)
    {
        $erreur["prenom"] = "Prénom incomplet";
    }
    if (!verifyName($prenom))
    {
        $erreur["prenom"] = "Un prénom ne peut pas être un chiffre";
    }

    // Vérifie si password n'est pas vide.
    if (!$password)
    {
        $erreur["password"] = "Mot de passe incomplet";
    }

    // Vérifie si pseudo n'est pas vide.
    if (!$password)
    {
        $erreur["password"] = "Mot de passe incomplet";
    }

    // Vérifie si l'email est bien un email et n'est pas vide.
    if (!$email)
    {
        $erreur["email"] = "Email incomplet";
    }

    // Vérifie si l'email est libre
    if (verifyIfEmailExists($email))
    {
        $erreur["email"] = "Un compte avec cet email est déjà existant";
    }

    // Vérifie si le pseudo n'est pas vide.
    if (!$pseudo)
    {
        $erreur["pseudo"] = "pseudo incomplet";
    }

    // Vérifie si le pseudo est libre
    if (verifyIfPseudoExists($pseudo))
    {
        $erreur["pseudo"] = "Un compte avec ce pseudo existe déjà";
    }
    if (!verifyNickname($pseudo))
    {
        $erreur["pseudo"] = "Un pseudo doit commencer par une lettre et faire entre 4 et 16 caractères.";
    }

    // Vérifie si les mots de passes sont les mêmes
    if ($password != $password2)
    {
        $erreur["password"] = "Les mots de passes sont différents";
    }

    // Vérifie si les mots de passes ne sont pas vide
    if (!$password && !$password2)
    {
        $erreur["password"] = "mot de passe incomplet";
    }

    // Vérifie si il n'y a eu aucune valeur mal entrée dans le formulaire et envoie les données dans la bdd.
    if (count($erreur) == 0)
    {
        addUser($nom,$prenom,$email,hashPassword($email,$password),$pseudo);
        echo " oki";
        //header("Location: pingtoflop.php");
    }
}
?>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card text-dark" style="background-color: #EEEEEE">
                <div class="card-header" style="background-color: #c0c0c0"><h5>Crée un compte</h5></div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <?php if (isset($erreur["nom"])): ?>
                                        <label for="nom" class="text-danger mb-0 pb-0"><h5>Votre nom :</h5></label>
                                        <input type="text" class="form-control is-invalid" id="nom" placeholder="nom ..." name="nom" required>
                                        <div class="invalid-feedback"><?= $erreur["nom"] ?></div>
                                    <?php else: ?>
                                        <label for="nom" class="mb-0 pb-0"><h5>Votre nom :</h5></label>
                                        <input type="text" class="form-control" id="nom" placeholder="nom ..." name="nom" required value="<?php if(isset($nom)){echo $nom;}?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col">
                                    <?php if (isset($erreur["prenom"])): ?>
                                        <label for="prenom" class="text-danger mb-0 pb-0"><h5>Votre prénom :</h5></label>
                                        <input type="text" class="form-control is-invalid" id="prenom" placeholder="Prénom" name="prenom" required>
                                        <div class="invalid-feedback"><?= $erreur["prenom"]?></div>
                                    <?php else: ?>
                                        <label for="prenom" class="mb-0 pb-0"><h5>Votre prénom :</h5></label>
                                        <input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" required value="<?php if(isset($prenom)){echo $prenom;}?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php if (isset($erreur["email"])): ?>
                                <label for="email" class="text-danger mb-0 pb-0"><h5>Adresse email :</h5></label>
                                <input type="text" class="form-control is-invalid" id="email" placeholder="exemple@mail.ch" name="email" required>
                                <div class="invalid-feedback"><?= $erreur["email"] ?></div>
                            <?php else: ?>
                                <label for="email" class="mb-0 pb-0"><h5>Adresse email :</h5></label>
                                <input type="text" class="form-control" id="email" placeholder="exemple@mail.ch" name="email" required value="<?php if(isset($email)){echo $email;}?>">
                            <?php endif; ?>
                        </div>
                        <div class="form-group"> 
                            <?php if (isset($erreur["pseudo"])): ?>
                                <label for="pseudo" class="text-danger mb-0 pb-0"><h5>Pseudo :</h5></label>
                                <input type="text" class="form-control is-invalid" id="pseudo" placeholder="Pseudonyme ...." name="pseudo" required >
                                <div class="invalid-feedback"><?= $erreur["pseudo"] ?></div>
                            <?php else: ?>
                                <label for="pseudo" class="mb-0 pb-0"><h5>Pseudo :</h5></label>
                                <input type="text" class="form-control" id="pseudo" placeholder="Pseudonyme ...." name="pseudo" required value="<?php if(isset($pseudo)){echo $pseudo;}?>">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <?php if (isset($erreur["password"])): ?>
                                            <label for="password1" class="text-danger mb-0 pb-0"><h5>Mot de passe :</h5></label>
                                            <input type="text" class="form-control is-invalid" id="password1" placeholder="*****" name="password1" required>
                                            <div class="invalid-feedback"><?= $erreur["password"] ?></div>
                                        <?php else: ?>
                                            <label for="password1" class="mb-0 pb-0"><h5>Mot de passe :</h5></label>
                                            <input type="text" class="form-control" id="password1" placeholder="*****" name="password1" required>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <?php if (isset($erreur["password"])): ?>
                                            <label for="password2" class="text-danger mb-0 pb-0"><h5>Vérification mot de passe :</h5></label>
                                            <input type="text" class="form-control is-invalid" id="password2" placeholder="*****" name="password2" required>

                                            <div class="invalid-feedback"><?= $erreur["password"] ?></div>
                                        <?php else: ?>
                                            <label for="password2" class="mb-0 pb-0"><h5>Vérification mot de passe :</h5></label>
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
</script>
