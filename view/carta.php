<div class="container-img">
    
    <img src="<?php echo $carta->getImmagine(); ?>" alt="<?php echo $carta->getCodice(); ?>" width="100%">
   
    <div class="table">
        <table>
            <tr>                    
                <th><?php echo $carta->getDescrizione(); ?></th>
            <tr>
                <th><a href="./index.php?model=carta&action=settCarta&codice=<?php echo $carta->getCodice()?>">visualizza set associati</a></th>
            </tr>
        </table>
    </div>
    <form action="./index.php?model=inserzione&action=aggiungi&carta=<?php echo $carta->getCodice()?>" method="post">
        <button type="submit">Aggiungi Inserzione</button>
    </form>
</div>
<div class="inserzioni-table">
    <?php if (!empty($inserzioni)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Informazione</th>
                    <th>Prezzo (€)</th>
                    <th>Quantità</th>
                    <th>Email Venditore</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inserzioni as $inserzione) : ?>
                    <tr>
                        <td><?php echo $inserzione->getInformazione(); ?></td>
                        <td><?php echo $inserzione->getPrezzo(); ?> €</td>
                        <td><?php echo $inserzione->getQuantita(); ?></td>
                        <td><?php echo $inserzione->getEmailVenditore(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Nessuna inserzione disponibile.</p>
    <?php endif; ?>
</div>



