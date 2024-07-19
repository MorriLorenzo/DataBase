<div class="register-container">
    <h2>Nuovo Indirizzo</h2>
    <form action="./index.php?model=utente&action=indirizzoi" method="POST">
        <div class="form-group">
            <label>Stato</label>
            <input type="text" name="stato" required>
        </div>
        <div class="form-group">
            <label>CAP</label>
            <input type="text" name="cap" required>
        </div>
        <div class="form-group">
            <label>Provincia</label>
            <input type="text" name="provincia" required>
        </div>
        <div class="form-group">
            <label>Via</label>
            <input type="text" name="via" required>
        </div>
        <div class="form-group">
            <label>Civico</label>
            <input type="text" name="civico" required>
        </div>
        <div class="form-group">
            <button type="submit">Aggiungi</button>
        </div>
    </form>
</div>