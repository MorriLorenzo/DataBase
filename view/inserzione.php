<h1>Inserzioni personali</h1>

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
            <?php foreach ($inserzioni as $inserzione): ?>
                <tr>
                    <td><?php echo $inserzione->getId(); ?></td>
                    <td><?php echo $inserzione->getInformazione(); ?></td>
                    <td><?php echo $inserzione->getPrezzo(); ?> €</td>
                    <td><?php echo $inserzione->getQuantita(); ?></td>
                    <td><?php echo $inserzione->getCodiceCarta(); ?></td>
                    <td>
                        <form action="./index.php?model=inserzione&action=elimina&id=<?php echo $inserzione->getId()?>" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $inserzione->getId(); ?>">
                            <button type="submit">Elimina</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
