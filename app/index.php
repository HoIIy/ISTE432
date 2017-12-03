<?php
    require("./src/views/TemplateEngine.php");

    $mainPage = new Template("./src/views/index.tpl");

    echo $mainPage->output();
?>

