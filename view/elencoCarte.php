<?php if (empty($carte)): ?>
    <p style="text-align: center;">Nessuna carta disponibile per il set <?php echo $_GET['nome']?></p>
<?php else: ?>
    <h1>Carte associate al set <?php echo $_GET['nome']?></h1>
    <div class="container-img">
        
        <div class="table2">
            <table>
                <tr><th>Descrizione carte</th><th></th></tr>
                <?php foreach($carte as $carta){ ?>
                    <tr>
                        <td>                    
                            <?php echo $carta->getDescrizione(); ?>
                        </td>
                        <td>
                            <a href="./index.php?model=carta&action=visual&codice=<?php echo $carta->getCodice()?>">visualizza inserzioni carta</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php endif; ?>

