<h1>Modifica Set <?php echo $sett->getNome() ?></h1>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    <form action="./index.php?model=admin&action=sett&operazione=update&nome=<?php echo $sett->getNome() ?>&codice=<?php echo $sett->getCodice() ?>" method="POST">
        <div class="form-group">
            <label>Nome</label>
            <input type="name" name="nuovoNome" required>
        </div>
        <div class="form-group">
            <label>Codice</label>
            <input type="name" name="nuovoCodice" required>
        </div>
        <label for="nuovoGioco">Seleziona un gioco:</label>
            <select id="nuovoGioco" name="nuovoGioco">
                <?php
                foreach ($giochi as $gioco) {
                    $giocoNome=$gioco->getNome();
                    echo "<option value=\"$giocoNome\">$giocoNome</option>";
                }
                ?>
            </select>
        <div class="form-group">
            <button type="submit">Modifica</button>
        </div>
    </form>
<form action="./index.php?model=admin&action=sett&operazione=elimina&nome=<?php echo $sett->getNome() ?>&codice=<?php echo $sett->getCodice() ?>" method="POST">
    <button type="submit" >Elimina</button>
</form>  