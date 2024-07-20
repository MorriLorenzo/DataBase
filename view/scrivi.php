<h1>Inserisci una Recensione</h1>
        <form action="./index.php?model=recensione&action=insert&inserzione=<?php echo $inserzione;?>" method="post">
            <label for="valutazione">Valutazione (1-5):</label>
            <input type="number" id="valutazione" name="valutazione" min="1" max="5" required>

            <label for="commento">Commento:</label>
            <textarea id="commento" name="commento" rows="4" required></textarea>

            <button type="submit">Invia Recensione</button>
        </form>