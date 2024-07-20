<div class="register-container">
    <h1>Lista giochi</h1>
        <?php if (isset($_SESSION['error_msg'])): ?>
        <p class="error-message"><?php echo $_SESSION['error_msg']; ?></p>
        <?php unset($_SESSION['error_msg']); ?>
    <?php endif; ?>
    
    <?php if (empty($giochi)): ?>
        <p style="text-align: center;">Nessun gioco presente. <a href="./index.php?model=admin&action=gioco&operazione=aggiungi">Aggiungi</a></p>
    <?php else: ?>
    <table>
    
    <?php foreach ($giochi as $gioco): ?>
    <tr>
        <td><?php echo $gioco->getNome(); ?></td>
        <td><a href="./index.php?model=admin&action=gioco&operazione=modifica&nome=<?php echo $gioco->getNome()?>">Modifica</a></td>
        <td><a href="./index.php?model=admin&action=gioco&operazione=elimina&nome=<?php echo $gioco->getNome() ?>">Elimina</a></td>    
    </tr>
    <?php endforeach; ?>
    
    </table>
    <p style="text-align: right;"><a href="./index.php?model=admin&action=gioco&operazione=aggiungi">Aggiungi</a></p>
    <?php endif; ?>
</div>