<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_client_categoryinfo.php" ?>
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
$tbl_client_category_view = new ctbl_client_category_view();
$Page =& $tbl_client_category_view;

// Page init
$tbl_client_category_view->Page_Init();

// Page main
$tbl_client_category_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_client_category->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_client_category_view = new ew_Page("tbl_client_category_view");

// page properties
tbl_client_category_view.PageID = "view"; // page ID
tbl_client_category_view.FormID = "ftbl_client_categoryview"; // form ID
var EW_PAGE_ID = tbl_client_category_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_client_category_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_client_category_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_client_category_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_client_category->TableCaption() ?>
<br><br>
<?php if ($tbl_client_category->Export == "") { ?>
<a href="<?php echo $tbl_client_category_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_category_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_category_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_category_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_category_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_client_category_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_client_category->cate_id->Visible) { // cate_id ?>
	<tr<?php echo $tbl_client_category->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client_category->cate_id->FldCaption() ?></td>
		<td<?php echo $tbl_client_category->cate_id->CellAttributes() ?>>
<div<?php echo $tbl_client_category->cate_id->ViewAttributes() ?>><?php echo $tbl_client_category->cate_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_client_category->character->Visible) { // character ?>
	<tr<?php echo $tbl_client_category->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client_category->character->FldCaption() ?></td>
		<td<?php echo $tbl_client_category->character->CellAttributes() ?>>
<div<?php echo $tbl_client_category->character->ViewAttributes() ?>><?php echo $tbl_client_category->character->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_client_category->cate_name->Visible) { // cate_name ?>
	<tr<?php echo $tbl_client_category->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client_category->cate_name->FldCaption() ?></td>
		<td<?php echo $tbl_client_category->cate_name->CellAttributes() ?>>
<div<?php echo $tbl_client_category->cate_name->ViewAttributes() ?>><?php echo $tbl_client_category->cate_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($tbl_client_category->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_client_category_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_client_category_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_client_category';

	// Page object name
	var $PageObjName = 'tbl_client_category_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_client_category;
		if ($tbl_client_category->UseTokenInUrl) $PageUrl .= "t=" . $tbl_client_category->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_client_category;
		if ($tbl_client_category->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_client_category->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_client_category->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_client_category_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_client_category)
		$GLOBALS["tbl_client_category"] = new ctbl_client_category();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_client_category', TRUE);

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
		global $tbl_client_category;

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
		global $Language, $tbl_client_category;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["cate_id"] <> "") {
				$tbl_client_category->cate_id->setQueryStringValue($_GET["cate_id"]);
				$this->arRecKey["cate_id"] = $tbl_client_category->cate_id->QueryStringValue;
			} else {
				$sReturnUrl = "tbl_client_categorylist.php"; // Return to list
			}

			// Get action
			$tbl_client_category->CurrentAction = "I"; // Display form
			switch ($tbl_client_category->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_client_categorylist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tbl_client_categorylist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_client_category->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_client_category;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_client_category->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_client_category->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_client_category->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_client_category->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_client_category->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_client_category->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_client_category;
		$sFilter = $tbl_client_category->KeyFilter();

		// Call Row Selecting event
		$tbl_client_category->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_client_category->CurrentFilter = $sFilter;
		$sSql = $tbl_client_category->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_client_category->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_client_category;
		$tbl_client_category->cate_id->setDbValue($rs->fields('cate_id'));
		$tbl_client_category->character->setDbValue($rs->fields('character'));
		$tbl_client_category->cate_name->setDbValue($rs->fields('cate_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_client_category;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "cate_id=" . urlencode($tbl_client_category->cate_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "cate_id=" . urlencode($tbl_client_category->cate_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "cate_id=" . urlencode($tbl_client_category->cate_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "cate_id=" . urlencode($tbl_client_category->cate_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "cate_id=" . urlencode($tbl_client_category->cate_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "cate_id=" . urlencode($tbl_client_category->cate_id->CurrentValue);
		$this->AddUrl = $tbl_client_category->AddUrl();
		$this->EditUrl = $tbl_client_category->EditUrl();
		$this->CopyUrl = $tbl_client_category->CopyUrl();
		$this->DeleteUrl = $tbl_client_category->DeleteUrl();
		$this->ListUrl = $tbl_client_category->ListUrl();

		// Call Row_Rendering event
		$tbl_client_category->Row_Rendering();

		// Common render codes for all row types
		// cate_id

		$tbl_client_category->cate_id->CellCssStyle = ""; $tbl_client_category->cate_id->CellCssClass = "";
		$tbl_client_category->cate_id->CellAttrs = array(); $tbl_client_category->cate_id->ViewAttrs = array(); $tbl_client_category->cate_id->EditAttrs = array();

		// character
		$tbl_client_category->character->CellCssStyle = ""; $tbl_client_category->character->CellCssClass = "";
		$tbl_client_category->character->CellAttrs = array(); $tbl_client_category->character->ViewAttrs = array(); $tbl_client_category->character->EditAttrs = array();

		// cate_name
		$tbl_client_category->cate_name->CellCssStyle = ""; $tbl_client_category->cate_name->CellCssClass = "";
		$tbl_client_category->cate_name->CellAttrs = array(); $tbl_client_category->cate_name->ViewAttrs = array(); $tbl_client_category->cate_name->EditAttrs = array();
		if ($tbl_client_category->RowType == EW_ROWTYPE_VIEW) { // View row

			// cate_id
			$tbl_client_category->cate_id->ViewValue = $tbl_client_category->cate_id->CurrentValue;
			$tbl_client_category->cate_id->CssStyle = "";
			$tbl_client_category->cate_id->CssClass = "";
			$tbl_client_category->cate_id->ViewCustomAttributes = "";

			// character
			$tbl_client_category->character->ViewValue = $tbl_client_category->character->CurrentValue;
			$tbl_client_category->character->CssStyle = "";
			$tbl_client_category->character->CssClass = "";
			$tbl_client_category->character->ViewCustomAttributes = "";

			// cate_name
			$tbl_client_category->cate_name->ViewValue = $tbl_client_category->cate_name->CurrentValue;
			$tbl_client_category->cate_name->CssStyle = "";
			$tbl_client_category->cate_name->CssClass = "";
			$tbl_client_category->cate_name->ViewCustomAttributes = "";

			// cate_id
			$tbl_client_category->cate_id->HrefValue = "";
			$tbl_client_category->cate_id->TooltipValue = "";

			// character
			$tbl_client_category->character->HrefValue = "";
			$tbl_client_category->character->TooltipValue = "";

			// cate_name
			$tbl_client_category->cate_name->HrefValue = "";
			$tbl_client_category->cate_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_client_category->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_client_category->Row_Rendered();
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
