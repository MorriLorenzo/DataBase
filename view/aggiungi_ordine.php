<h1>Inserisci Nuovo Ordine per Inserzione <?php echo $idInserzione; ?></h1>
<form action="./index.php?model=ordine&action=insert&inserzione=<?php echo $idInserzione; ?>" method="post">

    <label for="quantitaAcquistata">Quantità Acquistata:</label>
    <input type="number" id="quantitaAcquistata" name="quantitaAcquistata" min="1" max="<?php echo $max; ?>"required>
    <br>

    <label for="indirizzoId">Seleziona un indirizzo:</label>
            <select id="indirizzoId" name="indirizzoId">
                <?php
                foreach ($indirizzi as $indirizzo) {
                    $indirizzoId=$indirizzo->getId();
                    echo "<option value=\"$indirizzoId\">$indirizzoId - $indirizzo </option>";
                }
                ?>
            </select>
    <br>
    <button type="submit">Aggiungi Ordine</button>
</form>
