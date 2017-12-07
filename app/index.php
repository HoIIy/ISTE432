<?php
    require("./src/views/TemplateEngine.php");

    $mainPage = new Template("./src/views/index.tpl");
	
	$errorMsg = "";
	if (isset($_GET["error"])){
		$errorMsg = "<div class='w3-panel w3-red'>";
		$errorMsg .= "<p>Error: ".urldecode($_GET["error"])."</p>";
		$errorMsg .= "</div> ";
	}
	$mainPage->set("errorMsg", $errorMsg);
	
    echo $mainPage->output();
?>

