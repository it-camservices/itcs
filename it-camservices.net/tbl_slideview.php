<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_slideinfo.php" ?>
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
$tbl_slide_view = new ctbl_slide_view();
$Page =& $tbl_slide_view;

// Page init
$tbl_slide_view->Page_Init();

// Page main
$tbl_slide_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_slide->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_slide_view = new ew_Page("tbl_slide_view");

// page properties
tbl_slide_view.PageID = "view"; // page ID
tbl_slide_view.FormID = "ftbl_slideview"; // form ID
var EW_PAGE_ID = tbl_slide_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_slide_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_slide_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_slide_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_slide->TableCaption() ?>
<br><br>
<?php if ($tbl_slide->Export == "") { ?>
<a href="<?php echo $tbl_slide_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_slide_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_slide_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_slide_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_slide_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_slide_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_slide->banner_id->Visible) { // banner_id ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->banner_id->FldCaption() ?></td>
		<td<?php echo $tbl_slide->banner_id->CellAttributes() ?>>
<div<?php echo $tbl_slide->banner_id->ViewAttributes() ?>><?php echo $tbl_slide->banner_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->title->Visible) { // title ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->title->FldCaption() ?></td>
		<td<?php echo $tbl_slide->title->CellAttributes() ?>>
<div<?php echo $tbl_slide->title->ViewAttributes() ?>><?php echo $tbl_slide->title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->images->Visible) { // images ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->images->FldCaption() ?></td>
		<td<?php echo $tbl_slide->images->CellAttributes() ?>>
<?php if ($tbl_slide->images->HrefValue <> "" || $tbl_slide->images->TooltipValue <> "") { ?>
<?php if (!empty($tbl_slide->images->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_slide->images->UploadPath) . $tbl_slide->images->Upload->DbValue ?>" border=0<?php echo $tbl_slide->images->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($tbl_slide->images->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_slide->images->UploadPath) . $tbl_slide->images->Upload->DbValue ?>" border=0<?php echo $tbl_slide->images->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->description->Visible) { // description ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->description->FldCaption() ?></td>
		<td<?php echo $tbl_slide->description->CellAttributes() ?>>
<div<?php echo $tbl_slide->description->ViewAttributes() ?>><?php echo $tbl_slide->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->order_by->Visible) { // order_by ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->order_by->FldCaption() ?></td>
		<td<?php echo $tbl_slide->order_by->CellAttributes() ?>>
<div<?php echo $tbl_slide->order_by->ViewAttributes() ?>><?php echo $tbl_slide->order_by->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($tbl_slide->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_slide_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_slide_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_slide';

	// Page object name
	var $PageObjName = 'tbl_slide_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_slide;
		if ($tbl_slide->UseTokenInUrl) $PageUrl .= "t=" . $tbl_slide->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_slide;
		if ($tbl_slide->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_slide->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_slide->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_slide_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_slide)
		$GLOBALS["tbl_slide"] = new ctbl_slide();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_slide', TRUE);

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
		global $tbl_slide;

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
		global $Language, $tbl_slide;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["banner_id"] <> "") {
				$tbl_slide->banner_id->setQueryStringValue($_GET["banner_id"]);
				$this->arRecKey["banner_id"] = $tbl_slide->banner_id->QueryStringValue;
			} else {
				$sReturnUrl = "tbl_slidelist.php"; // Return to list
			}

			// Get action
			$tbl_slide->CurrentAction = "I"; // Display form
			switch ($tbl_slide->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_slidelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tbl_slidelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_slide->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_slide;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_slide->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_slide->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_slide->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_slide->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_slide->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_slide->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_slide;
		$sFilter = $tbl_slide->KeyFilter();

		// Call Row Selecting event
		$tbl_slide->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_slide->CurrentFilter = $sFilter;
		$sSql = $tbl_slide->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_slide->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_slide;
		$tbl_slide->banner_id->setDbValue($rs->fields('banner_id'));
		$tbl_slide->title->setDbValue($rs->fields('title'));
		$tbl_slide->images->Upload->DbValue = $rs->fields('images');
		$tbl_slide->description->setDbValue($rs->fields('description'));
		$tbl_slide->order_by->setDbValue($rs->fields('order_by'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_slide;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "banner_id=" . urlencode($tbl_slide->banner_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "banner_id=" . urlencode($tbl_slide->banner_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "banner_id=" . urlencode($tbl_slide->banner_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "banner_id=" . urlencode($tbl_slide->banner_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "banner_id=" . urlencode($tbl_slide->banner_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "banner_id=" . urlencode($tbl_slide->banner_id->CurrentValue);
		$this->AddUrl = $tbl_slide->AddUrl();
		$this->EditUrl = $tbl_slide->EditUrl();
		$this->CopyUrl = $tbl_slide->CopyUrl();
		$this->DeleteUrl = $tbl_slide->DeleteUrl();
		$this->ListUrl = $tbl_slide->ListUrl();

		// Call Row_Rendering event
		$tbl_slide->Row_Rendering();

		// Common render codes for all row types
		// banner_id

		$tbl_slide->banner_id->CellCssStyle = ""; $tbl_slide->banner_id->CellCssClass = "";
		$tbl_slide->banner_id->CellAttrs = array(); $tbl_slide->banner_id->ViewAttrs = array(); $tbl_slide->banner_id->EditAttrs = array();

		// title
		$tbl_slide->title->CellCssStyle = ""; $tbl_slide->title->CellCssClass = "";
		$tbl_slide->title->CellAttrs = array(); $tbl_slide->title->ViewAttrs = array(); $tbl_slide->title->EditAttrs = array();

		// images
		$tbl_slide->images->CellCssStyle = ""; $tbl_slide->images->CellCssClass = "";
		$tbl_slide->images->CellAttrs = array(); $tbl_slide->images->ViewAttrs = array(); $tbl_slide->images->EditAttrs = array();

		// description
		$tbl_slide->description->CellCssStyle = ""; $tbl_slide->description->CellCssClass = "";
		$tbl_slide->description->CellAttrs = array(); $tbl_slide->description->ViewAttrs = array(); $tbl_slide->description->EditAttrs = array();

		// order_by
		$tbl_slide->order_by->CellCssStyle = ""; $tbl_slide->order_by->CellCssClass = "";
		$tbl_slide->order_by->CellAttrs = array(); $tbl_slide->order_by->ViewAttrs = array(); $tbl_slide->order_by->EditAttrs = array();
		if ($tbl_slide->RowType == EW_ROWTYPE_VIEW) { // View row

			// banner_id
			$tbl_slide->banner_id->ViewValue = $tbl_slide->banner_id->CurrentValue;
			$tbl_slide->banner_id->CssStyle = "";
			$tbl_slide->banner_id->CssClass = "";
			$tbl_slide->banner_id->ViewCustomAttributes = "";

			// title
			$tbl_slide->title->ViewValue = $tbl_slide->title->CurrentValue;
			$tbl_slide->title->CssStyle = "";
			$tbl_slide->title->CssClass = "";
			$tbl_slide->title->ViewCustomAttributes = "";

			// images
			if (!ew_Empty($tbl_slide->images->Upload->DbValue)) {
				$tbl_slide->images->ViewValue = $tbl_slide->images->Upload->DbValue;
				$tbl_slide->images->ImageWidth = 300;
				$tbl_slide->images->ImageHeight = 180;
				$tbl_slide->images->ImageAlt = $tbl_slide->images->FldAlt();
			} else {
				$tbl_slide->images->ViewValue = "";
			}
			$tbl_slide->images->CssStyle = "";
			$tbl_slide->images->CssClass = "";
			$tbl_slide->images->ViewCustomAttributes = "";

			// description
			$tbl_slide->description->ViewValue = $tbl_slide->description->CurrentValue;
			$tbl_slide->description->CssStyle = "";
			$tbl_slide->description->CssClass = "";
			$tbl_slide->description->ViewCustomAttributes = "";

			// order_by
			$tbl_slide->order_by->ViewValue = $tbl_slide->order_by->CurrentValue;
			$tbl_slide->order_by->CssStyle = "";
			$tbl_slide->order_by->CssClass = "";
			$tbl_slide->order_by->ViewCustomAttributes = "";

			// banner_id
			$tbl_slide->banner_id->HrefValue = "";
			$tbl_slide->banner_id->TooltipValue = "";

			// title
			$tbl_slide->title->HrefValue = "";
			$tbl_slide->title->TooltipValue = "";

			// images
			$tbl_slide->images->HrefValue = "";
			$tbl_slide->images->TooltipValue = "";

			// description
			$tbl_slide->description->HrefValue = "";
			$tbl_slide->description->TooltipValue = "";

			// order_by
			$tbl_slide->order_by->HrefValue = "";
			$tbl_slide->order_by->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_slide->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_slide->Row_Rendered();
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
