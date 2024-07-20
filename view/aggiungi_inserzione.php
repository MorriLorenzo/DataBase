<h1>Inserisci Nuova Inserzione per <?php echo $carta;?></h1>
<form action="./index.php?model=inserzione&action=insert&carta=<?php echo $carta;?>" method="post">

    <label for="informazione">Informazione:</label>
    <textarea id="informazione" name="informazione" required></textarea>
    <br>

    <label for="prezzo">Prezzo a carta(€):</label>
    <input type="text" id="prezzo" name="prezzo" required>
    <br>

    <label for="quantita">Quantità:</label>
    <input type="number" id="quantita" name="quantita" min="1" required>
    <br>

    <button type="submit">Aggiungi Inserzione</button>
</form>