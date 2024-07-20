<div class="container-img">
    
    <img src="<?php echo $carta->getImmagine(); ?>" alt="<?php echo $carta->getCodice(); ?>" width="100%">
   
    <div class="table">
        <table>
            <tr>                    
                <th><?php echo $carta->getDescrizione(); ?></th>
            <tr>
                <th><a href="./index.php?model=sett&action=settCarta&codice=<?php echo $carta->getCodice()?>">visualizza set associati</a></th>
            </tr>
        </table>
    </div>
</div>


