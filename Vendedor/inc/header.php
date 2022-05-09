<div class="row" >
    <nav class="navbar" style="background-color: #ff7e2f; height: 10vh;">
    <a class="navbar-brand" href="index.php">
        <img src="src/image/vairaNav.png"  width="50" height="50" style="margin-left: 8px;margin-top: -5px" class="d-inline-block align-top" alt="">
    </a>
    <label for="usuariologueado" style="position:absolute;position: absolute;left:1230px;">Usuario: <?php echo $_SESSION['user'] ?></label>
    <form class="d-flex"  action="../services/cerrar.php">
        <button class="btn btn-primary cerrarSesionBtn" type="submit"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
    </form>
    </nav>
</div>