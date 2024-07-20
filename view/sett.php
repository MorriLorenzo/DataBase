<?php if (empty($setts)): ?>
    <p style="text-align: center;">Nessun set disponibile per il gioco <?php echo $_GET['nome']?></p>
<?php else: ?>

    <h1>Tabella set del gioco <?php echo $_GET['nome']?></h1>
    <table>
    
    <tr>
        <th>Codice</th>
        <th>Nome</th>
    </tr>
    <?php foreach ($setts as $sett): ?>
        <tr>
            <td><?php echo $sett->getCodice(); ?></td>
            <td><?php echo $sett->getNome(); ?></td>
            <td><a href="./index.php?model=carta&action=visualSett&nome=<?php echo $sett->getNome()?>&codice=<?php echo $sett->getCodice()?>">visualizza carte associate</a></td>
        </tr>
    <?php endforeach; ?>
    </table>

    <form action="./index.php?model=gioco" method="post">
        <button type="submit" name="giochi">Giochi</button>
    </form>
<?php endif; ?>