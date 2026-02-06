<?php
if (!empty($message_erreur) || !empty($message)) {
  ?>
  <!-- **************************************** -->
  <!-- Messages de l'application                -->
  <section class="section-formulaire">
    <h2>Logs</h2>
    <?php
    if (!empty($message_erreur)) {
      echo "<section class=\"erreur\">\n" . $message_erreur . "</section>\n";
    }
    if (!empty($message)) {
      echo "<section>\n" . $message . "</section>\n";
    }
    ?>
  </section>          
  <?php
}
?>      
