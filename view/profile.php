<h1>Scheda utente</h1>
<table>
  <tr>
    <th>Cognome</th>
    <td><?php echo $utente->getCognome(); ?></td>
  </tr>
  <tr>
    <th>Nome</th>
    <td><?php echo $utente->getNome(); ?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php echo $utente->getEmail(); ?></td>
  </tr>
</table>
<h2>Indirizzi associati</h2>
<table>
  <tr>
    <th>Stato</th>
    <th>CAP</th>
    <th>Provincia</th>
    <th>Via</th>
    <th>Civico</th>
  </tr>
  <?php foreach ($indirizzi as $indirizzo): ?>
    <tr>
      <td><?php echo $indirizzo->getStato(); ?></td>
      <td><?php echo $indirizzo->getCAP(); ?></td>
      <td><?php echo $indirizzo->getProvincia(); ?></td>
      <td><?php echo $indirizzo->getVia(); ?></td>
      <td><?php echo $indirizzo->getCivico(); ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<form action="./index.php?model=logout" method="post">
    <button type="submit" name="termina">Termina Sessione</button>
</form>