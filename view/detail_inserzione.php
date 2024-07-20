<h1>Inserzione <?php echo $inserzioni->getId()?></h1>

<?php if (empty($inserzioni)): ?>
    <p style="text-align: center;">Nessuna inserzione per questo account</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Informazione</th>
                <th>Prezzo</th>
                <th>Quantità</th>
                <th>Codice Carta</th>
                <th>Azioni</th> <!-- Nuova intestazione per la colonna delle azioni -->
            </tr>
        </thead>
        <tbody>
            <?php $inserzione=$inserzioni;?>
                <tr>
                    <td><?php echo $inserzione->getId(); ?></td>
                    <td><?php echo $inserzione->getInformazione(); ?></td>
                    <td><?php echo $inserzione->getPrezzo(); ?> €</td>
                    <td><?php echo $inserzione->getQuantita(); ?></td>
                    <td><?php echo $inserzione->getCodiceCarta(); ?></td>
                    <td>
                        <form action="./index.php?model=ordine&action=aggiungi&inserzione=<?php echo $inserzione->getId() ?>" method="post" style="display: inline;">
                            <button type="submit">Acquista</button>
                        </form>
                    </td>
                </tr>
        </tbody>
    </table>
<?php endif; ?>