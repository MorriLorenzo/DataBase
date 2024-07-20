<h1>Modifica Carta <?php echo $carta->getDescrizione() ?></h1>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    <form action="./index.php?model=admin&action=carta&operazione=update&codice=<?php echo $carta->getCodice() ?>" method="POST">
        <label for="nuovoCodice">Nuovo Codice:</label>
            <input type="text" id="nuovoCodice" name="nuovoCodice" required>
        <br><br>

        <label for="nuovaLingua">Nuova Lingua:</label>
            <input type="text" id="nuovaLingua" name="nuovaLingua" required>
        <br><br>

        <label for="nuovaImmagine">Nuova Immagine:</label>
            <input type="text" id="nuovaImmagine" name="nuovaImmagine" required>
        <br><br>

        <label for="nuovaDescrizione">Nuova Descrizione:</label>
            <input type="text" id="nuovaDescrizione" name="nuovaDescrizione" required>
        <br><br>
        <div class="form-group">
            <button type="submit">Modifica</button>
        </div>
    </form>
<form action="./index.php?model=admin&action=sett&operazione=elimina&nome=<?php echo $sett->getNome() ?>&codice=<?php echo $sett->getCodice() ?>" method="POST">
    <button type="submit" >Elimina</button>
</form>  