<h1>Carrello di <?php echo $utente->getNome(); ?></h1>

<?php if (empty($inserzioni)): ?>
    <p style="text-align: center;">Nessuna inserzione salvata</p>
<?php else: ?>
<table>
    <tr>
        <th>ID</th>
        <th>Informazione</th>
        <th>Azione</th>
    </tr>
    <?php foreach ($inserzioni as $inserzione): ?>
    
    <tr>
        <td><?php echo $inserzione->getId(); ?></td>
        <td><?php echo $inserzione->getInformazione(); ?></td>
        <td><a href="?model=inserzione&action=visualizza&inserzione=<?php echo $inserzione->getId()?>">Visualizza inserzione</a></td>
        <td><a href="?model=carrello&action=elimina&inserzione=<?php echo $inserzione->getId()?>">Rimuovi</a></td>
    </tr>

    <?php endforeach; ?>
</table>
<?php endif;?>