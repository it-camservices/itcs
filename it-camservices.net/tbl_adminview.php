<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_admininfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$tbl_admin_view = new ctbl_admin_view();
$Page =& $tbl_admin_view;

// Page init
$tbl_admin_view->Page_Init();

// Page main
$tbl_admin_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_admin->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_admin_view = new ew_Page("tbl_admin_view");

// page properties
tbl_admin_view.PageID = "view"; // page ID
tbl_admin_view.FormID = "ftbl_adminview"; // form ID
var EW_PAGE_ID = tbl_admin_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_admin_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_admin_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_admin_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_admin->TableCaption() ?>
<br><br>
<?php if ($tbl_admin->Export == "") { ?>
<a href="<?php echo $tbl_admin_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_admin_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_admin_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_admin_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_admin_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_admin_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_admin->admin_id->Visible) { // admin_id ?>
	<tr<?php echo $tbl_admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_admin->admin_id->FldCaption() ?></td>
		<td<?php echo $tbl_admin->admin_id->CellAttributes() ?>>
<div<?php echo $tbl_admin->admin_id->ViewAttributes() ?>><?php echo $tbl_admin->admin_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_admin->username->Visible) { // username ?>
	<tr<?php echo $tbl_admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_admin->username->FldCaption() ?></td>
		<td<?php echo $tbl_admin->username->CellAttributes() ?>>
<div<?php echo $tbl_admin->username->ViewAttributes() ?>><?php echo $tbl_admin->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_admin->password->Visible) { // password ?>
	<tr<?php echo $tbl_admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_admin->password->FldCaption() ?></td>
		<td<?php echo $tbl_admin->password->CellAttributes() ?>>
<div<?php echo $tbl_admin->password->ViewAttributes() ?>><?php echo $tbl_admin->password->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($tbl_admin->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_admin_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_admin_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_admin';

	// Page object name
	var $PageObjName = 'tbl_admin_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_admin;
		if ($tbl_admin->UseTokenInUrl) $PageUrl .= "t=" . $tbl_admin->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $tbl_admin;
		if ($tbl_admin->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_admin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_admin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_admin_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_admin)
		$GLOBALS["tbl_admin"] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_admin', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $tbl_admin;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_admin;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["admin_id"] <> "") {
				$tbl_admin->admin_id->setQueryStringValue($_GET["admin_id"]);
				$this->arRecKey["admin_id"] = $tbl_admin->admin_id->QueryStringValue;
			} else {
				$sReturnUrl = "tbl_adminlist.php"; // Return to list
			}

			// Get action
			$tbl_admin->CurrentAction = "I"; // Display form
			switch ($tbl_admin->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_adminlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tbl_adminlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_admin->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_admin;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_admin->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_admin->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_admin->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_admin->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_admin->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_admin->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_admin;
		$sFilter = $tbl_admin->KeyFilter();

		// Call Row Selecting event
		$tbl_admin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_admin->CurrentFilter = $sFilter;
		$sSql = $tbl_admin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_admin->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_admin;
		$tbl_admin->admin_id->setDbValue($rs->fields('admin_id'));
		$tbl_admin->username->setDbValue($rs->fields('username'));
		$tbl_admin->password->setDbValue($rs->fields('password'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_admin;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "admin_id=" . urlencode($tbl_admin->admin_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "admin_id=" . urlencode($tbl_admin->admin_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "admin_id=" . urlencode($tbl_admin->admin_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "admin_id=" . urlencode($tbl_admin->admin_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "admin_id=" . urlencode($tbl_admin->admin_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "admin_id=" . urlencode($tbl_admin->admin_id->CurrentValue);
		$this->AddUrl = $tbl_admin->AddUrl();
		$this->EditUrl = $tbl_admin->EditUrl();
		$this->CopyUrl = $tbl_admin->CopyUrl();
		$this->DeleteUrl = $tbl_admin->DeleteUrl();
		$this->ListUrl = $tbl_admin->ListUrl();

		// Call Row_Rendering event
		$tbl_admin->Row_Rendering();

		// Common render codes for all row types
		// admin_id

		$tbl_admin->admin_id->CellCssStyle = ""; $tbl_admin->admin_id->CellCssClass = "";
		$tbl_admin->admin_id->CellAttrs = array(); $tbl_admin->admin_id->ViewAttrs = array(); $tbl_admin->admin_id->EditAttrs = array();

		// username
		$tbl_admin->username->CellCssStyle = ""; $tbl_admin->username->CellCssClass = "";
		$tbl_admin->username->CellAttrs = array(); $tbl_admin->username->ViewAttrs = array(); $tbl_admin->username->EditAttrs = array();

		// password
		$tbl_admin->password->CellCssStyle = ""; $tbl_admin->password->CellCssClass = "";
		$tbl_admin->password->CellAttrs = array(); $tbl_admin->password->ViewAttrs = array(); $tbl_admin->password->EditAttrs = array();
		if ($tbl_admin->RowType == EW_ROWTYPE_VIEW) { // View row

			// admin_id
			$tbl_admin->admin_id->ViewValue = $tbl_admin->admin_id->CurrentValue;
			$tbl_admin->admin_id->CssStyle = "";
			$tbl_admin->admin_id->CssClass = "";
			$tbl_admin->admin_id->ViewCustomAttributes = "";

			// username
			$tbl_admin->username->ViewValue = $tbl_admin->username->CurrentValue;
			$tbl_admin->username->CssStyle = "";
			$tbl_admin->username->CssClass = "";
			$tbl_admin->username->ViewCustomAttributes = "";

			// password
			$tbl_admin->password->ViewValue = "********";
			$tbl_admin->password->CssStyle = "";
			$tbl_admin->password->CssClass = "";
			$tbl_admin->password->ViewCustomAttributes = "";

			// admin_id
			$tbl_admin->admin_id->HrefValue = "";
			$tbl_admin->admin_id->TooltipValue = "";

			// username
			$tbl_admin->username->HrefValue = "";
			$tbl_admin->username->TooltipValue = "";

			// password
			$tbl_admin->password->HrefValue = "";
			$tbl_admin->password->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_admin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_admin->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}
}
?>
