<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../Application/AutoLoader.php';
$autoLoader = new AutoLoader(realpath(__DIR__.'/../'));
$autoLoader->registerNamespaces();

if (!empty($_GET['cmd'])) {
    if ($_GET['cmd'] == 'reset') {
        session_start();
        session_destroy();
        header('Location: index.php');
    }
}
$bootstrap = new \App\Bootstrap();
$bootstrap->run();


?>

<form method="get">
<input type="text" name="cmd" id="commandPrompt" />
</form>
<script type="text/javascript">
   function formfocus() {
      document.getElementById('commandPrompt').focus();
   }
   window.onload = formfocus;
</script>