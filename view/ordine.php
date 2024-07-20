<h1>Ordini Personali</h1>
<?php if (empty($ordini)): ?>
    <p style="text-align: center;">Nessun ordine trovato.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Codice</th>
                <th>Quantità Acquistata</th>
                <th>Id Inserzione</th>
                <th>Indirizzo Spedizione</th>
                <th>Lascia recensione</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordini as $ordine): ?>
                <tr>
                    <td><?php echo $ordine->getCodice(); ?></td>
                    <td><?php echo $ordine->getQuantitaAcquistata(); ?></td>
                    <td><?php echo $ordine->getIdInserzione(); ?></td>
                    <td><?php echo $ordine->getIndirizzoSpedizione(); ?></td>
                    <td>
                        <form method="post" action="./index.php?model=recensione&action=scrivi&inserzione=<?php echo $ordine->getIdInserzione(); ?>">
                            <button type="submit">Recensisci</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>