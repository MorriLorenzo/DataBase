<h1>Schede utenti bloccabili</h1>
<?php if (empty($utenti)): ?>
    <p style="text-align: center;">tutti gli utenti sono stati bravi</p>
<?php else: ?>
    <table>
    <?php foreach($utenti as $utente){ ?>
    <tr>
        <th>Email</th>
        <td><?php echo $utente->getEmail(); ?></td>
        <th>Media</th>
        <td><?php echo (float)$utente->getValutazioneTotale()/(float)($utente->getNumeroRecensioni()); ?></td>
        <th>Azione</th>
        <?php if (!$utente->isBloccato()) : ?>
            <td><a href="./index.php?model=admin&action=blocca&utente=<?php echo $utente->getEmail();?>">Blocca</a></td>
        <?php else :?>
            <td><a href="./index.php?model=admin&action=sblocca&utente=<?php echo $utente->getEmail();?>">Sblocca</a></td>
        <?php endif;?>
    </tr>
    <?php }?>
    </table>
<?php endif;?>