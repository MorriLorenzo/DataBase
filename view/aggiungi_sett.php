<h1>Aggiungi Sett</h1>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    <form action="./index.php?model=admin&action=sett&operazione=insert" method="POST">
    <div class="form-group">
            <label>Nome</label>
            <input type="name" name="nome" required>
        </div>
        <div class="form-group">
            <label>Codice</label>
            <input type="name" name="codice" required>
        </div>
        <label for="nomeGioco">Seleziona un gioco:</label>
            <select id="nomeGioco" name="nomeGioco">
                <?php
                foreach ($giochi as $gioco) {
                    $giocoNome=$gioco->getNome();
                    echo "<option value=\"$giocoNome\">$giocoNome</option>";
                }
                ?>
            </select>
        <div class="form-group">
            <button type="submit">Inserisci</button>
        </div>
    </form>