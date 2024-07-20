<h1>Elenco Recensioni</h1>
        <?php if (empty($recensioni)) : ?>
            <p class="no-reviews">Nessuna recensione disponibile.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Mittente</th>
                        <th>ID Destinatario</th>
                        <th>Valutazione</th>
                        <th>Commento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recensioni as $recensione) : ?>
                        <tr>
                            <td><?php echo $recensione->getIdMittente(); ?></td>
                            <td><?php echo $recensione->getIdDestinatario(); ?></td>
                            <td><?php echo $recensione->getValutazione(); ?></td>
                            <td><?php echo $recensione->getCommento(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>