<div class="register-container">
    <h1>Lista Sett</h1>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    
    <?php if (empty($setts)): ?>
        <p style="text-align: center;">Nessun Set presente. <a href="./index.php?model=admin&action=sett&operazione=aggiungi">Aggiungi</a></p>
    <?php else: ?>
    <table>
    
    <?php foreach ($setts as $sett): ?>
    <tr>
        <td><?php echo $sett->getNome(); ?></td>
        <td><a href="./index.php?model=admin&action=sett&operazione=modifica&nome=<?php echo $sett->getNome()?>&codice=<?php echo $sett->getCodice() ?>">Modifica</a></td>
        <td><a href="./index.php?model=admin&action=sett&operazione=elimina&nome=<?php echo $sett->getNome() ?>&codice=<?php echo $sett->getCodice() ?>">Elimina</a></td>    
    </tr>
    <?php endforeach; ?>
    
    </table>
    <p style="text-align: right;"><a href="./index.php?model=admin&action=sett&operazione=aggiungi">Aggiungi</a></p>
    <?php endif; ?>
</div>