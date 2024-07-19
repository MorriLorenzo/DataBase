<h1>Modifica Gioco <?php echo $gioco->getNome() ?></h1>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    <form action="./index.php?model=admin&action=gioco&operazione=update&nome=<?php echo $gioco->getNome() ?>" method="POST">
        <div class="form-group">
            <label>Nome</label>
            <input type="name" name="nuovoNome" required>
        </div>
        <div class="form-group">
            <button type="submit">Modifica</button>
        </div>
    </form>
<form action="./index.php?model=admin&action=gioco&operazione=elimina&nome=<?php echo $gioco->getNome() ?>" method="POST">
    <button type="submit" >Elimina</button>
</form>  