<div class="register-container">
        <h2>Registrazione</h2>
        <form action="./index.php?model=login&action=insert" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label>Cognome</label>
                <input type="text" name="cognome" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
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
                <button type="submit">Registrati</button>
            </div>
        </form>
    </div>