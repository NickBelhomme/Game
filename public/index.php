<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once '../Application/AutoLoader.php';
$autoLoader = new AutoLoader(realpath(__DIR__.'/../'));
$autoLoader->registerNamespaces();

if (! \Game\Registry::load()) {
    \Game\Registry::set('personalInventory',  new \Game\Inventory());
    $grid = new \Game\Grid(2, 2);
    \Game\Registry::set('grid', $grid);

    $grid->addTile(new \App\Tile\PrisonCell(), 0, 0)
         ->addTile(new App\Tile\PrisonOffice(), 1, 0);

}

if (!empty($_GET['cmd'])) {
    if ($_GET['cmd'] == 'reset') {
        session_destroy();
        header('Location: index.php');
    }
    $commandParser = new \App\CommandParser($_GET['cmd'], \Game\Registry::get('grid'), \Game\Registry::get('personalInventory'));
}

\Game\Registry::save();
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