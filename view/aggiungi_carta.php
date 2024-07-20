<h1>Aggiungi Carta</h1>
<?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
<form action="./index.php?model=admin&action=carta&operazione=insert" method="POST">
    <label for="codice">Codice:</label>
    <input type="text" id="codice" name="codice" required>
    <br><br>

    <label for="lingua">Lingua:</label>
    <input type="text" id="lingua" name="lingua" required>
    <br><br>

    <label for="immagine">Immagine:</label>
    <input type="text" id="immagine" name="immagine" required>
    <br><br>

    <label for="descrizione">Descrizione:</label>
    <input type="text" id="descrizione" name="descrizione" required>
    <br><br>

    <div class="form-group">
        <button type="submit">Inserisci</button>
    </div>
    <!--TODO effetto visivo e sett-->
</form>