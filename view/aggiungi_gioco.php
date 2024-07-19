<h2>Aggiungi Gioco</h2>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    <form action="./index.php?model=admin&action=gioco&operazione=insert" method="POST">
        <div class="form-group">
            <label>Nome</label>
            <input type="name" name="nome" required>
        </div>
        <div class="form-group">
            <button type="submit">Aggiungi</button>
        </div>
    </form>