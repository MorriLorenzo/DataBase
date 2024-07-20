<div class="register-container">
    <h1>Lista carta</h1>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    
    <?php if (empty($carte)): ?>
        <p style="text-align: center;">Nessuna carta presente. <a href="./index.php?model=admin&action=carta&operazione=aggiungi">Aggiungi</a></p>
    <?php else: ?>
    <table>
    
    <?php foreach ($carte as $carta): ?>
    <tr>
        <td><?php echo $carta->getCodice(); ?></td>
        <td><a href="./index.php?model=admin&action=carta&operazione=modifica&codice=<?php echo $carta->getCodice()?>">Modifica</a></td>
        <td><a href="./index.php?model=admin&action=carta&operazione=elimina&codice=<?php echo $carta->getCodice() ?>">Elimina</a></td>    
    </tr>
    <?php endforeach; ?>
    
    </table>
    <p style="text-align: right;"><a href="./index.php?model=admin&action=carta&operazione=aggiungi">Aggiungi</a></p>
    <?php endif; ?>
</div>