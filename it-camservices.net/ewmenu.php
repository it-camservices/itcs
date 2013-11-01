<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "", TRUE);
?>
<?php

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "tbl_webpagelist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "tbl_servicelist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "tbl_slidelist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "tbl_client_categorylist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "tbl_clientlist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "tbl_experienceslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "tbl_adminlist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
