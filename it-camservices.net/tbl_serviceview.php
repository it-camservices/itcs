<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_serviceinfo.php" ?>
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
$tbl_service_view = new ctbl_service_view();
$Page =& $tbl_service_view;

// Page init
$tbl_service_view->Page_Init();

// Page main
$tbl_service_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_service->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_service_view = new ew_Page("tbl_service_view");

// page properties
tbl_service_view.PageID = "view"; // page ID
tbl_service_view.FormID = "ftbl_serviceview"; // form ID
var EW_PAGE_ID = tbl_service_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_service_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_service_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_service_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_service->TableCaption() ?>
<br><br>
<?php if ($tbl_service->Export == "") { ?>
<a href="<?php echo $tbl_service_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_service_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_service_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_service_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_service_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_service_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_service->service_id->Visible) { // service_id ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->service_id->FldCaption() ?></td>
		<td<?php echo $tbl_service->service_id->CellAttributes() ?>>
<div<?php echo $tbl_service->service_id->ViewAttributes() ?>><?php echo $tbl_service->service_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->name->Visible) { // name ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->name->FldCaption() ?></td>
		<td<?php echo $tbl_service->name->CellAttributes() ?>>
<div<?php echo $tbl_service->name->ViewAttributes() ?>><?php echo $tbl_service->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->character->Visible) { // character ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->character->FldCaption() ?></td>
		<td<?php echo $tbl_service->character->CellAttributes() ?>>
<div<?php echo $tbl_service->character->ViewAttributes() ?>><?php echo $tbl_service->character->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->description->Visible) { // description ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->description->FldCaption() ?></td>
		<td<?php echo $tbl_service->description->CellAttributes() ?>>
<div<?php echo $tbl_service->description->ViewAttributes() ?>><?php echo $tbl_service->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->order_by->Visible) { // order_by ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->order_by->FldCaption() ?></td>
		<td<?php echo $tbl_service->order_by->CellAttributes() ?>>
<div<?php echo $tbl_service->order_by->ViewAttributes() ?>><?php echo $tbl_service->order_by->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($tbl_service->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_service_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_service_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_service';

	// Page object name
	var $PageObjName = 'tbl_service_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_service;
		if ($tbl_service->UseTokenInUrl) $PageUrl .= "t=" . $tbl_service->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_service;
		if ($tbl_service->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_service_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_service)
		$GLOBALS["tbl_service"] = new ctbl_service();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_service', TRUE);

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
		global $tbl_service;

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
		global $Language, $tbl_service;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["service_id"] <> "") {
				$tbl_service->service_id->setQueryStringValue($_GET["service_id"]);
				$this->arRecKey["service_id"] = $tbl_service->service_id->QueryStringValue;
			} else {
				$sReturnUrl = "tbl_servicelist.php"; // Return to list
			}

			// Get action
			$tbl_service->CurrentAction = "I"; // Display form
			switch ($tbl_service->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_servicelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tbl_servicelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_service->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_service;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_service->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_service->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_service->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_service->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_service->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_service->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_service;
		$sFilter = $tbl_service->KeyFilter();

		// Call Row Selecting event
		$tbl_service->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_service->CurrentFilter = $sFilter;
		$sSql = $tbl_service->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_service->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_service;
		$tbl_service->service_id->setDbValue($rs->fields('service_id'));
		$tbl_service->name->setDbValue($rs->fields('name'));
		$tbl_service->character->setDbValue($rs->fields('character'));
		$tbl_service->description->setDbValue($rs->fields('description'));
		$tbl_service->order_by->setDbValue($rs->fields('order_by'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_service;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "service_id=" . urlencode($tbl_service->service_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "service_id=" . urlencode($tbl_service->service_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "service_id=" . urlencode($tbl_service->service_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "service_id=" . urlencode($tbl_service->service_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "service_id=" . urlencode($tbl_service->service_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "service_id=" . urlencode($tbl_service->service_id->CurrentValue);
		$this->AddUrl = $tbl_service->AddUrl();
		$this->EditUrl = $tbl_service->EditUrl();
		$this->CopyUrl = $tbl_service->CopyUrl();
		$this->DeleteUrl = $tbl_service->DeleteUrl();
		$this->ListUrl = $tbl_service->ListUrl();

		// Call Row_Rendering event
		$tbl_service->Row_Rendering();

		// Common render codes for all row types
		// service_id

		$tbl_service->service_id->CellCssStyle = ""; $tbl_service->service_id->CellCssClass = "";
		$tbl_service->service_id->CellAttrs = array(); $tbl_service->service_id->ViewAttrs = array(); $tbl_service->service_id->EditAttrs = array();

		// name
		$tbl_service->name->CellCssStyle = ""; $tbl_service->name->CellCssClass = "";
		$tbl_service->name->CellAttrs = array(); $tbl_service->name->ViewAttrs = array(); $tbl_service->name->EditAttrs = array();

		// character
		$tbl_service->character->CellCssStyle = ""; $tbl_service->character->CellCssClass = "";
		$tbl_service->character->CellAttrs = array(); $tbl_service->character->ViewAttrs = array(); $tbl_service->character->EditAttrs = array();

		// description
		$tbl_service->description->CellCssStyle = ""; $tbl_service->description->CellCssClass = "";
		$tbl_service->description->CellAttrs = array(); $tbl_service->description->ViewAttrs = array(); $tbl_service->description->EditAttrs = array();

		// order_by
		$tbl_service->order_by->CellCssStyle = ""; $tbl_service->order_by->CellCssClass = "";
		$tbl_service->order_by->CellAttrs = array(); $tbl_service->order_by->ViewAttrs = array(); $tbl_service->order_by->EditAttrs = array();
		if ($tbl_service->RowType == EW_ROWTYPE_VIEW) { // View row

			// service_id
			$tbl_service->service_id->ViewValue = $tbl_service->service_id->CurrentValue;
			$tbl_service->service_id->CssStyle = "";
			$tbl_service->service_id->CssClass = "";
			$tbl_service->service_id->ViewCustomAttributes = "";

			// name
			$tbl_service->name->ViewValue = $tbl_service->name->CurrentValue;
			$tbl_service->name->CssStyle = "";
			$tbl_service->name->CssClass = "";
			$tbl_service->name->ViewCustomAttributes = "";

			// character
			$tbl_service->character->ViewValue = $tbl_service->character->CurrentValue;
			$tbl_service->character->CssStyle = "";
			$tbl_service->character->CssClass = "";
			$tbl_service->character->ViewCustomAttributes = "";

			// description
			$tbl_service->description->ViewValue = $tbl_service->description->CurrentValue;
			$tbl_service->description->CssStyle = "";
			$tbl_service->description->CssClass = "";
			$tbl_service->description->ViewCustomAttributes = "";

			// order_by
			$tbl_service->order_by->ViewValue = $tbl_service->order_by->CurrentValue;
			$tbl_service->order_by->CssStyle = "";
			$tbl_service->order_by->CssClass = "";
			$tbl_service->order_by->ViewCustomAttributes = "";

			// service_id
			$tbl_service->service_id->HrefValue = "";
			$tbl_service->service_id->TooltipValue = "";

			// name
			$tbl_service->name->HrefValue = "";
			$tbl_service->name->TooltipValue = "";

			// character
			$tbl_service->character->HrefValue = "";
			$tbl_service->character->TooltipValue = "";

			// description
			$tbl_service->description->HrefValue = "";
			$tbl_service->description->TooltipValue = "";

			// order_by
			$tbl_service->order_by->HrefValue = "";
			$tbl_service->order_by->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_service->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_service->Row_Rendered();
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
