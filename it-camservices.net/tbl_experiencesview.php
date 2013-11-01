<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_experiencesinfo.php" ?>
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
$tbl_experiences_view = new ctbl_experiences_view();
$Page =& $tbl_experiences_view;

// Page init
$tbl_experiences_view->Page_Init();

// Page main
$tbl_experiences_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_experiences->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_experiences_view = new ew_Page("tbl_experiences_view");

// page properties
tbl_experiences_view.PageID = "view"; // page ID
tbl_experiences_view.FormID = "ftbl_experiencesview"; // form ID
var EW_PAGE_ID = tbl_experiences_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_experiences_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_experiences_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_experiences_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_experiences->TableCaption() ?>
<br><br>
<?php if ($tbl_experiences->Export == "") { ?>
<a href="<?php echo $tbl_experiences_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_experiences_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_experiences_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_experiences_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_experiences_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_experiences_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_experiences->exper_id->Visible) { // exper_id ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->exper_id->FldCaption() ?></td>
		<td<?php echo $tbl_experiences->exper_id->CellAttributes() ?>>
<div<?php echo $tbl_experiences->exper_id->ViewAttributes() ?>><?php echo $tbl_experiences->exper_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->name->Visible) { // name ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->name->FldCaption() ?></td>
		<td<?php echo $tbl_experiences->name->CellAttributes() ?>>
<div<?php echo $tbl_experiences->name->ViewAttributes() ?>><?php echo $tbl_experiences->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->positions->Visible) { // positions ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->positions->FldCaption() ?></td>
		<td<?php echo $tbl_experiences->positions->CellAttributes() ?>>
<div<?php echo $tbl_experiences->positions->ViewAttributes() ?>><?php echo $tbl_experiences->positions->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->photos->Visible) { // photos ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->photos->FldCaption() ?></td>
		<td<?php echo $tbl_experiences->photos->CellAttributes() ?>>
<?php if ($tbl_experiences->photos->HrefValue <> "" || $tbl_experiences->photos->TooltipValue <> "") { ?>
<?php if (!empty($tbl_experiences->photos->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_experiences->photos->UploadPath) . $tbl_experiences->photos->Upload->DbValue ?>" border=0<?php echo $tbl_experiences->photos->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_experiences->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($tbl_experiences->photos->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_experiences->photos->UploadPath) . $tbl_experiences->photos->Upload->DbValue ?>" border=0<?php echo $tbl_experiences->photos->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_experiences->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->sort_text->Visible) { // sort_text ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->sort_text->FldCaption() ?></td>
		<td<?php echo $tbl_experiences->sort_text->CellAttributes() ?>>
<div<?php echo $tbl_experiences->sort_text->ViewAttributes() ?>><?php echo $tbl_experiences->sort_text->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->full_text->Visible) { // full_text ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->full_text->FldCaption() ?></td>
		<td<?php echo $tbl_experiences->full_text->CellAttributes() ?>>
<div<?php echo $tbl_experiences->full_text->ViewAttributes() ?>><?php echo $tbl_experiences->full_text->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($tbl_experiences->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_experiences_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_experiences_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_experiences';

	// Page object name
	var $PageObjName = 'tbl_experiences_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_experiences;
		if ($tbl_experiences->UseTokenInUrl) $PageUrl .= "t=" . $tbl_experiences->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_experiences;
		if ($tbl_experiences->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_experiences->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_experiences->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_experiences_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_experiences)
		$GLOBALS["tbl_experiences"] = new ctbl_experiences();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_experiences', TRUE);

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
		global $tbl_experiences;

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
		global $Language, $tbl_experiences;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["exper_id"] <> "") {
				$tbl_experiences->exper_id->setQueryStringValue($_GET["exper_id"]);
				$this->arRecKey["exper_id"] = $tbl_experiences->exper_id->QueryStringValue;
			} else {
				$sReturnUrl = "tbl_experienceslist.php"; // Return to list
			}

			// Get action
			$tbl_experiences->CurrentAction = "I"; // Display form
			switch ($tbl_experiences->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_experienceslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tbl_experienceslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_experiences->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_experiences;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_experiences->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_experiences->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_experiences->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_experiences->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_experiences->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_experiences->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_experiences;
		$sFilter = $tbl_experiences->KeyFilter();

		// Call Row Selecting event
		$tbl_experiences->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_experiences->CurrentFilter = $sFilter;
		$sSql = $tbl_experiences->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_experiences->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_experiences;
		$tbl_experiences->exper_id->setDbValue($rs->fields('exper_id'));
		$tbl_experiences->name->setDbValue($rs->fields('name'));
		$tbl_experiences->positions->setDbValue($rs->fields('positions'));
		$tbl_experiences->photos->Upload->DbValue = $rs->fields('photos');
		$tbl_experiences->sort_text->setDbValue($rs->fields('sort_text'));
		$tbl_experiences->full_text->setDbValue($rs->fields('full_text'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_experiences;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "exper_id=" . urlencode($tbl_experiences->exper_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "exper_id=" . urlencode($tbl_experiences->exper_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "exper_id=" . urlencode($tbl_experiences->exper_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "exper_id=" . urlencode($tbl_experiences->exper_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "exper_id=" . urlencode($tbl_experiences->exper_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "exper_id=" . urlencode($tbl_experiences->exper_id->CurrentValue);
		$this->AddUrl = $tbl_experiences->AddUrl();
		$this->EditUrl = $tbl_experiences->EditUrl();
		$this->CopyUrl = $tbl_experiences->CopyUrl();
		$this->DeleteUrl = $tbl_experiences->DeleteUrl();
		$this->ListUrl = $tbl_experiences->ListUrl();

		// Call Row_Rendering event
		$tbl_experiences->Row_Rendering();

		// Common render codes for all row types
		// exper_id

		$tbl_experiences->exper_id->CellCssStyle = ""; $tbl_experiences->exper_id->CellCssClass = "";
		$tbl_experiences->exper_id->CellAttrs = array(); $tbl_experiences->exper_id->ViewAttrs = array(); $tbl_experiences->exper_id->EditAttrs = array();

		// name
		$tbl_experiences->name->CellCssStyle = ""; $tbl_experiences->name->CellCssClass = "";
		$tbl_experiences->name->CellAttrs = array(); $tbl_experiences->name->ViewAttrs = array(); $tbl_experiences->name->EditAttrs = array();

		// positions
		$tbl_experiences->positions->CellCssStyle = ""; $tbl_experiences->positions->CellCssClass = "";
		$tbl_experiences->positions->CellAttrs = array(); $tbl_experiences->positions->ViewAttrs = array(); $tbl_experiences->positions->EditAttrs = array();

		// photos
		$tbl_experiences->photos->CellCssStyle = ""; $tbl_experiences->photos->CellCssClass = "";
		$tbl_experiences->photos->CellAttrs = array(); $tbl_experiences->photos->ViewAttrs = array(); $tbl_experiences->photos->EditAttrs = array();

		// sort_text
		$tbl_experiences->sort_text->CellCssStyle = ""; $tbl_experiences->sort_text->CellCssClass = "";
		$tbl_experiences->sort_text->CellAttrs = array(); $tbl_experiences->sort_text->ViewAttrs = array(); $tbl_experiences->sort_text->EditAttrs = array();

		// full_text
		$tbl_experiences->full_text->CellCssStyle = ""; $tbl_experiences->full_text->CellCssClass = "";
		$tbl_experiences->full_text->CellAttrs = array(); $tbl_experiences->full_text->ViewAttrs = array(); $tbl_experiences->full_text->EditAttrs = array();
		if ($tbl_experiences->RowType == EW_ROWTYPE_VIEW) { // View row

			// exper_id
			$tbl_experiences->exper_id->ViewValue = $tbl_experiences->exper_id->CurrentValue;
			$tbl_experiences->exper_id->CssStyle = "";
			$tbl_experiences->exper_id->CssClass = "";
			$tbl_experiences->exper_id->ViewCustomAttributes = "";

			// name
			$tbl_experiences->name->ViewValue = $tbl_experiences->name->CurrentValue;
			$tbl_experiences->name->CssStyle = "";
			$tbl_experiences->name->CssClass = "";
			$tbl_experiences->name->ViewCustomAttributes = "";

			// positions
			$tbl_experiences->positions->ViewValue = $tbl_experiences->positions->CurrentValue;
			$tbl_experiences->positions->CssStyle = "";
			$tbl_experiences->positions->CssClass = "";
			$tbl_experiences->positions->ViewCustomAttributes = "";

			// photos
			if (!ew_Empty($tbl_experiences->photos->Upload->DbValue)) {
				$tbl_experiences->photos->ViewValue = $tbl_experiences->photos->Upload->DbValue;
				$tbl_experiences->photos->ImageWidth = 220;
				$tbl_experiences->photos->ImageHeight = 160;
				$tbl_experiences->photos->ImageAlt = $tbl_experiences->photos->FldAlt();
			} else {
				$tbl_experiences->photos->ViewValue = "";
			}
			$tbl_experiences->photos->CssStyle = "";
			$tbl_experiences->photos->CssClass = "";
			$tbl_experiences->photos->ViewCustomAttributes = "";

			// sort_text
			$tbl_experiences->sort_text->ViewValue = $tbl_experiences->sort_text->CurrentValue;
			$tbl_experiences->sort_text->CssStyle = "";
			$tbl_experiences->sort_text->CssClass = "";
			$tbl_experiences->sort_text->ViewCustomAttributes = "";

			// full_text
			$tbl_experiences->full_text->ViewValue = $tbl_experiences->full_text->CurrentValue;
			$tbl_experiences->full_text->CssStyle = "";
			$tbl_experiences->full_text->CssClass = "";
			$tbl_experiences->full_text->ViewCustomAttributes = "";

			// exper_id
			$tbl_experiences->exper_id->HrefValue = "";
			$tbl_experiences->exper_id->TooltipValue = "";

			// name
			$tbl_experiences->name->HrefValue = "";
			$tbl_experiences->name->TooltipValue = "";

			// positions
			$tbl_experiences->positions->HrefValue = "";
			$tbl_experiences->positions->TooltipValue = "";

			// photos
			$tbl_experiences->photos->HrefValue = "";
			$tbl_experiences->photos->TooltipValue = "";

			// sort_text
			$tbl_experiences->sort_text->HrefValue = "";
			$tbl_experiences->sort_text->TooltipValue = "";

			// full_text
			$tbl_experiences->full_text->HrefValue = "";
			$tbl_experiences->full_text->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_experiences->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_experiences->Row_Rendered();
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
