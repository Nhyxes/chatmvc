<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Réinitialiser le mot de passe</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="../../css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="header-line">RÉINITIALISER LE MOT DE PASSE</h4>
            </div>
        </div>

        <!-- Formulaire de réinitialisation de mot de passe -->
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 offset-md-3">

                <form role="form" method="post" action="/forgotpassword" onsubmit="return valid()">
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input class="form-control" type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nouveau mot de passe</label>
                        <input onblur="return valid()" class="form-control" type="password" name="new_password" id="new_password" placeholder="Nouveau mot de passe" required>
                    </div>

                    <div>
                        <p id="message-1"></p>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmer le mot de passe</label>
                        <input onblur="return valid()" class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer le mot de passe" required>
                    </div>

                    <button type="submit" class="btn btn-info" id="button" >Réinitialiser le mot de passe</button>
                </form>
            </div>

        </div>
        <!-- Fin du formulaire de réinitialisation de mot de passe -->
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    function valid() {
        let new_password = $('#new_password').val();
        let confirm_password = $('#confirm_password').val();
        let submitBtn = $('#button'); // Sélectionner le bouton de soumission

        if (new_password !== confirm_password) {
            // Afficher le message d'erreur seulement si le champ de confirmation n'est pas vide
            if (confirm_password.trim() !== "") {
                $('#message-1').text("Les mots de passe ne correspondent pas !");
                submitBtn.prop('disabled', true); // Désactiver le bouton d'envoi
                return false;
            } else {
                // Effacer le message d'erreur si le champ de confirmation est vide
                $('#message-1').text("");
                submitBtn.prop('disabled', false); // Activer le bouton d'envoi
                return true;
            }
        } else {
            // Effacer le message d'erreur s'il n'y a pas de problème
            $('#message-1').text("");
            submitBtn.prop('disabled', false); // Activer le bouton d'envoi
        }

        return true;
    }
</script>

</html>