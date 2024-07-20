<?php if (empty($utenti)): ?>
    <p style="text-align: center;">nessun utente trovato</p>
<?php else: ?>
    <table>
    <?php foreach($utenti as $utente){ ?>
    <tr>
        <th>Email</th>
        <td><?php echo $utente->getEmail(); ?></td>
        <th>Media</th>
        <td><?php echo (float)$utente->getValutazioneTotale()/(float)($utente->getNumeroRecensioni()); ?></td>
    </tr>
    <?php }?>
    </table>
<?php endif;?>