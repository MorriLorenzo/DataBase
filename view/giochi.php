<h1>Tabella giochi</h1>
<table>
  <tr>
  <?php foreach ($giochi as $gioco): ?>
    <tr>
      <td><?php echo $gioco->getNome(); ?></td>
      <td><a href="./index.php?model=sett&action=menu&nome=<?php echo $gioco->getNome()?>">visualizza set associati</a></td>
    </tr>
  <?php endforeach; ?>
  </tr>
</table>

<form action="./index.php?model=utente&action=profile" method="post">
    <button type="submit" name="profilo utente">Profilo utente</button>
</form>