<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_webpageinfo.php" ?>
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
$tbl_webpage_view = new ctbl_webpage_view();
$Page =& $tbl_webpage_view;

// Page init
$tbl_webpage_view->Page_Init();

// Page main
$tbl_webpage_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_webpage->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_webpage_view = new ew_Page("tbl_webpage_view");

// page properties
tbl_webpage_view.PageID = "view"; // page ID
tbl_webpage_view.FormID = "ftbl_webpageview"; // form ID
var EW_PAGE_ID = tbl_webpage_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_webpage_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_webpage_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_webpage_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_webpage->TableCaption() ?>
<br><br>
<?php if ($tbl_webpage->Export == "") { ?>
<a href="<?php echo $tbl_webpage_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_webpage_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_webpage_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_webpage_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_webpage_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_webpage_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_webpage->web_id->Visible) { // web_id ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->web_id->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->web_id->CellAttributes() ?>>
<div<?php echo $tbl_webpage->web_id->ViewAttributes() ?>><?php echo $tbl_webpage->web_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->site_title->Visible) { // site_title ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->site_title->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->site_title->CellAttributes() ?>>
<div<?php echo $tbl_webpage->site_title->ViewAttributes() ?>><?php echo $tbl_webpage->site_title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->site_keyword->Visible) { // site_keyword ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->site_keyword->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->site_keyword->CellAttributes() ?>>
<div<?php echo $tbl_webpage->site_keyword->ViewAttributes() ?>><?php echo $tbl_webpage->site_keyword->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->site_description->Visible) { // site_description ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->site_description->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->site_description->CellAttributes() ?>>
<div<?php echo $tbl_webpage->site_description->ViewAttributes() ?>><?php echo $tbl_webpage->site_description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->page_name->Visible) { // page_name ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->page_name->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->page_name->CellAttributes() ?>>
<div<?php echo $tbl_webpage->page_name->ViewAttributes() ?>><?php echo $tbl_webpage->page_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->page_title->Visible) { // page_title ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->page_title->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->page_title->CellAttributes() ?>>
<div<?php echo $tbl_webpage->page_title->ViewAttributes() ?>><?php echo $tbl_webpage->page_title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->descriptions->Visible) { // descriptions ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->descriptions->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->descriptions->CellAttributes() ?>>
<div<?php echo $tbl_webpage->descriptions->ViewAttributes() ?>><?php echo $tbl_webpage->descriptions->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($tbl_webpage->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_webpage_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_webpage_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_webpage';

	// Page object name
	var $PageObjName = 'tbl_webpage_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_webpage;
		if ($tbl_webpage->UseTokenInUrl) $PageUrl .= "t=" . $tbl_webpage->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_webpage;
		if ($tbl_webpage->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_webpage->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_webpage->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_webpage_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_webpage)
		$GLOBALS["tbl_webpage"] = new ctbl_webpage();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_webpage', TRUE);

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
		global $tbl_webpage;

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
		global $Language, $tbl_webpage;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["web_id"] <> "") {
				$tbl_webpage->web_id->setQueryStringValue($_GET["web_id"]);
				$this->arRecKey["web_id"] = $tbl_webpage->web_id->QueryStringValue;
			} else {
				$sReturnUrl = "tbl_webpagelist.php"; // Return to list
			}

			// Get action
			$tbl_webpage->CurrentAction = "I"; // Display form
			switch ($tbl_webpage->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_webpagelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tbl_webpagelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_webpage->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_webpage;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_webpage->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_webpage->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_webpage->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_webpage->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_webpage->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_webpage->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_webpage;
		$sFilter = $tbl_webpage->KeyFilter();

		// Call Row Selecting event
		$tbl_webpage->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_webpage->CurrentFilter = $sFilter;
		$sSql = $tbl_webpage->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_webpage->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_webpage;
		$tbl_webpage->web_id->setDbValue($rs->fields('web_id'));
		$tbl_webpage->site_title->setDbValue($rs->fields('site_title'));
		$tbl_webpage->site_keyword->setDbValue($rs->fields('site_keyword'));
		$tbl_webpage->site_description->setDbValue($rs->fields('site_description'));
		$tbl_webpage->page_name->setDbValue($rs->fields('page_name'));
		$tbl_webpage->page_title->setDbValue($rs->fields('page_title'));
		$tbl_webpage->descriptions->setDbValue($rs->fields('descriptions'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_webpage;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "web_id=" . urlencode($tbl_webpage->web_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "web_id=" . urlencode($tbl_webpage->web_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "web_id=" . urlencode($tbl_webpage->web_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "web_id=" . urlencode($tbl_webpage->web_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "web_id=" . urlencode($tbl_webpage->web_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "web_id=" . urlencode($tbl_webpage->web_id->CurrentValue);
		$this->AddUrl = $tbl_webpage->AddUrl();
		$this->EditUrl = $tbl_webpage->EditUrl();
		$this->CopyUrl = $tbl_webpage->CopyUrl();
		$this->DeleteUrl = $tbl_webpage->DeleteUrl();
		$this->ListUrl = $tbl_webpage->ListUrl();

		// Call Row_Rendering event
		$tbl_webpage->Row_Rendering();

		// Common render codes for all row types
		// web_id

		$tbl_webpage->web_id->CellCssStyle = ""; $tbl_webpage->web_id->CellCssClass = "";
		$tbl_webpage->web_id->CellAttrs = array(); $tbl_webpage->web_id->ViewAttrs = array(); $tbl_webpage->web_id->EditAttrs = array();

		// site_title
		$tbl_webpage->site_title->CellCssStyle = ""; $tbl_webpage->site_title->CellCssClass = "";
		$tbl_webpage->site_title->CellAttrs = array(); $tbl_webpage->site_title->ViewAttrs = array(); $tbl_webpage->site_title->EditAttrs = array();

		// site_keyword
		$tbl_webpage->site_keyword->CellCssStyle = ""; $tbl_webpage->site_keyword->CellCssClass = "";
		$tbl_webpage->site_keyword->CellAttrs = array(); $tbl_webpage->site_keyword->ViewAttrs = array(); $tbl_webpage->site_keyword->EditAttrs = array();

		// site_description
		$tbl_webpage->site_description->CellCssStyle = ""; $tbl_webpage->site_description->CellCssClass = "";
		$tbl_webpage->site_description->CellAttrs = array(); $tbl_webpage->site_description->ViewAttrs = array(); $tbl_webpage->site_description->EditAttrs = array();

		// page_name
		$tbl_webpage->page_name->CellCssStyle = ""; $tbl_webpage->page_name->CellCssClass = "";
		$tbl_webpage->page_name->CellAttrs = array(); $tbl_webpage->page_name->ViewAttrs = array(); $tbl_webpage->page_name->EditAttrs = array();

		// page_title
		$tbl_webpage->page_title->CellCssStyle = ""; $tbl_webpage->page_title->CellCssClass = "";
		$tbl_webpage->page_title->CellAttrs = array(); $tbl_webpage->page_title->ViewAttrs = array(); $tbl_webpage->page_title->EditAttrs = array();

		// descriptions
		$tbl_webpage->descriptions->CellCssStyle = ""; $tbl_webpage->descriptions->CellCssClass = "";
		$tbl_webpage->descriptions->CellAttrs = array(); $tbl_webpage->descriptions->ViewAttrs = array(); $tbl_webpage->descriptions->EditAttrs = array();
		if ($tbl_webpage->RowType == EW_ROWTYPE_VIEW) { // View row

			// web_id
			$tbl_webpage->web_id->ViewValue = $tbl_webpage->web_id->CurrentValue;
			$tbl_webpage->web_id->CssStyle = "";
			$tbl_webpage->web_id->CssClass = "";
			$tbl_webpage->web_id->ViewCustomAttributes = "";

			// site_title
			$tbl_webpage->site_title->ViewValue = $tbl_webpage->site_title->CurrentValue;
			$tbl_webpage->site_title->CssStyle = "";
			$tbl_webpage->site_title->CssClass = "";
			$tbl_webpage->site_title->ViewCustomAttributes = "";

			// site_keyword
			$tbl_webpage->site_keyword->ViewValue = $tbl_webpage->site_keyword->CurrentValue;
			$tbl_webpage->site_keyword->CssStyle = "";
			$tbl_webpage->site_keyword->CssClass = "";
			$tbl_webpage->site_keyword->ViewCustomAttributes = "";

			// site_description
			$tbl_webpage->site_description->ViewValue = $tbl_webpage->site_description->CurrentValue;
			$tbl_webpage->site_description->CssStyle = "";
			$tbl_webpage->site_description->CssClass = "";
			$tbl_webpage->site_description->ViewCustomAttributes = "";

			// page_name
			$tbl_webpage->page_name->ViewValue = $tbl_webpage->page_name->CurrentValue;
			$tbl_webpage->page_name->CssStyle = "";
			$tbl_webpage->page_name->CssClass = "";
			$tbl_webpage->page_name->ViewCustomAttributes = "";

			// page_title
			$tbl_webpage->page_title->ViewValue = $tbl_webpage->page_title->CurrentValue;
			$tbl_webpage->page_title->CssStyle = "";
			$tbl_webpage->page_title->CssClass = "";
			$tbl_webpage->page_title->ViewCustomAttributes = "";

			// descriptions
			$tbl_webpage->descriptions->ViewValue = $tbl_webpage->descriptions->CurrentValue;
			$tbl_webpage->descriptions->CssStyle = "";
			$tbl_webpage->descriptions->CssClass = "";
			$tbl_webpage->descriptions->ViewCustomAttributes = "";

			// web_id
			$tbl_webpage->web_id->HrefValue = "";
			$tbl_webpage->web_id->TooltipValue = "";

			// site_title
			$tbl_webpage->site_title->HrefValue = "";
			$tbl_webpage->site_title->TooltipValue = "";

			// site_keyword
			$tbl_webpage->site_keyword->HrefValue = "";
			$tbl_webpage->site_keyword->TooltipValue = "";

			// site_description
			$tbl_webpage->site_description->HrefValue = "";
			$tbl_webpage->site_description->TooltipValue = "";

			// page_name
			$tbl_webpage->page_name->HrefValue = "";
			$tbl_webpage->page_name->TooltipValue = "";

			// page_title
			$tbl_webpage->page_title->HrefValue = "";
			$tbl_webpage->page_title->TooltipValue = "";

			// descriptions
			$tbl_webpage->descriptions->HrefValue = "";
			$tbl_webpage->descriptions->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_webpage->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_webpage->Row_Rendered();
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
