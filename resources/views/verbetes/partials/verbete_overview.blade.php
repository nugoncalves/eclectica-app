<!-- VERBETE: FICHA TÉCNICA RESUMIDA -->


<p>
  <strong>[ <?= $verbete["id"]; ?> ]</strong>
  <br>
  <strong><?= ($verbete["author"]) ?? ""; ?></strong>
  <br>
  <em><?= $verbete["title"]; ?></em>
  <?= ($verbete["mentions"]) ?? ""; ?>. <?= ($verbete["place"]) ? $verbete["place"] . ': ' : ""; ?><?= ($verbete["printer"]) ? $verbete["printer"] . ', ' : ""; ?><?= ($verbete["date"]) ? $verbete["date"] . '.' : ""; ?>
  <br>
  <?= $verbete["colaccao"]; ?>
</p>