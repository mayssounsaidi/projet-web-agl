<?php
session_start();

include "config/functions.php";
$user=true;

if (!empty($_POST)) {
  $user = ConnectVisiteur($conn, $_POST);
  if ($user !== false) {
      session_start();
      $_SESSION['id']= $user['id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['nom'] = $user['nom'];
      $_SESSION['prenom'] = $user['prenom'];
      $_SESSION['mp'] = $user['mp'];
      $_SESSION['telephone'] = $user['telephone'];
      header('location:index.php');
  }}

include "config/header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1>Connexion</h1>
            <form action="login.php" method="post">
                <div class="form-group
                <?php echo isset($user) && $user === false ? 'has-error' : ''; ?>">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group
                <?php echo isset($user) && $user === false ? 'has-error' : ''; ?>">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="mp" id="mp" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Connexion</button>
            </form>
            <a href="signup.php" class="btn">Sign UP</a>
        </div>
    </div>
</div>

<?php
include "config/footer.php";
?>