<?php
namespace App;
class Response extends \Game\Response
{
    protected $messages = array(
        10000 => '<form method="get">    <input type="text" name="cmd" id="commandPrompt" />    </form>    <script type="text/javascript">       function formfocus() {          document.getElementById(\'commandPrompt\').focus();       }       window.onload = formfocus;    </script>'
    );
}