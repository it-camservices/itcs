<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_clientinfo.php" ?>
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
$tbl_client_view = new ctbl_client_view();
$Page =& $tbl_client_view;

// Page init
$tbl_client_view->Page_Init();

// Page main
$tbl_client_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_client->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_client_view = new ew_Page("tbl_client_view");

// page properties
tbl_client_view.PageID = "view"; // page ID
tbl_client_view.FormID = "ftbl_clientview"; // form ID
var EW_PAGE_ID = tbl_client_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_client_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_client_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_client_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_client->TableCaption() ?>
<br><br>
<?php if ($tbl_client->Export == "") { ?>
<a href="<?php echo $tbl_client_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_client_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_client->client_id->Visible) { // client_id ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->client_id->FldCaption() ?></td>
		<td<?php echo $tbl_client->client_id->CellAttributes() ?>>
<div<?php echo $tbl_client->client_id->ViewAttributes() ?>><?php echo $tbl_client->client_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->cate_id->Visible) { // cate_id ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->cate_id->FldCaption() ?></td>
		<td<?php echo $tbl_client->cate_id->CellAttributes() ?>>
<div<?php echo $tbl_client->cate_id->ViewAttributes() ?>><?php echo $tbl_client->cate_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->client_name->Visible) { // client_name ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->client_name->FldCaption() ?></td>
		<td<?php echo $tbl_client->client_name->CellAttributes() ?>>
<div<?php echo $tbl_client->client_name->ViewAttributes() ?>><?php echo $tbl_client->client_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->photo->Visible) { // photo ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->photo->FldCaption() ?></td>
		<td<?php echo $tbl_client->photo->CellAttributes() ?>>
<?php if ($tbl_client->photo->HrefValue <> "" || $tbl_client->photo->TooltipValue <> "") { ?>
<?php if (!empty($tbl_client->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_client->photo->UploadPath) . $tbl_client->photo->Upload->DbValue ?>" border=0<?php echo $tbl_client->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_client->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($tbl_client->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_client->photo->UploadPath) . $tbl_client->photo->Upload->DbValue ?>" border=0<?php echo $tbl_client->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_client->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($tbl_client->link->Visible) { // link ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->link->FldCaption() ?></td>
		<td<?php echo $tbl_client->link->CellAttributes() ?>>
<div<?php echo $tbl_client->link->ViewAttributes() ?>><?php echo $tbl_client->link->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->order_by->Visible) { // order_by ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->order_by->FldCaption() ?></td>
		<td<?php echo $tbl_client->order_by->CellAttributes() ?>>
<div<?php echo $tbl_client->order_by->ViewAttributes() ?>><?php echo $tbl_client->order_by->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($tbl_client->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_client_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_client_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_client';

	// Page object name
	var $PageObjName = 'tbl_client_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_client;
		if ($tbl_client->UseTokenInUrl) $PageUrl .= "t=" . $tbl_client->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_client;
		if ($tbl_client->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_client->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_client->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_client_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_client)
		$GLOBALS["tbl_client"] = new ctbl_client();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_client', TRUE);

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
		global $tbl_client;

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
		global $Language, $tbl_client;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["client_id"] <> "") {
				$tbl_client->client_id->setQueryStringValue($_GET["client_id"]);
				$this->arRecKey["client_id"] = $tbl_client->client_id->QueryStringValue;
			} else {
				$sReturnUrl = "tbl_clientlist.php"; // Return to list
			}

			// Get action
			$tbl_client->CurrentAction = "I"; // Display form
			switch ($tbl_client->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_clientlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "tbl_clientlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_client->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_client;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_client->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_client->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_client->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_client->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_client->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_client->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_client;
		$sFilter = $tbl_client->KeyFilter();

		// Call Row Selecting event
		$tbl_client->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_client->CurrentFilter = $sFilter;
		$sSql = $tbl_client->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_client->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_client;
		$tbl_client->client_id->setDbValue($rs->fields('client_id'));
		$tbl_client->cate_id->setDbValue($rs->fields('cate_id'));
		$tbl_client->client_name->setDbValue($rs->fields('client_name'));
		$tbl_client->photo->Upload->DbValue = $rs->fields('photo');
		$tbl_client->link->setDbValue($rs->fields('link'));
		$tbl_client->order_by->setDbValue($rs->fields('order_by'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_client;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "client_id=" . urlencode($tbl_client->client_id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "client_id=" . urlencode($tbl_client->client_id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "client_id=" . urlencode($tbl_client->client_id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "client_id=" . urlencode($tbl_client->client_id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "client_id=" . urlencode($tbl_client->client_id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "client_id=" . urlencode($tbl_client->client_id->CurrentValue);
		$this->AddUrl = $tbl_client->AddUrl();
		$this->EditUrl = $tbl_client->EditUrl();
		$this->CopyUrl = $tbl_client->CopyUrl();
		$this->DeleteUrl = $tbl_client->DeleteUrl();
		$this->ListUrl = $tbl_client->ListUrl();

		// Call Row_Rendering event
		$tbl_client->Row_Rendering();

		// Common render codes for all row types
		// client_id

		$tbl_client->client_id->CellCssStyle = ""; $tbl_client->client_id->CellCssClass = "";
		$tbl_client->client_id->CellAttrs = array(); $tbl_client->client_id->ViewAttrs = array(); $tbl_client->client_id->EditAttrs = array();

		// cate_id
		$tbl_client->cate_id->CellCssStyle = ""; $tbl_client->cate_id->CellCssClass = "";
		$tbl_client->cate_id->CellAttrs = array(); $tbl_client->cate_id->ViewAttrs = array(); $tbl_client->cate_id->EditAttrs = array();

		// client_name
		$tbl_client->client_name->CellCssStyle = ""; $tbl_client->client_name->CellCssClass = "";
		$tbl_client->client_name->CellAttrs = array(); $tbl_client->client_name->ViewAttrs = array(); $tbl_client->client_name->EditAttrs = array();

		// photo
		$tbl_client->photo->CellCssStyle = ""; $tbl_client->photo->CellCssClass = "";
		$tbl_client->photo->CellAttrs = array(); $tbl_client->photo->ViewAttrs = array(); $tbl_client->photo->EditAttrs = array();

		// link
		$tbl_client->link->CellCssStyle = ""; $tbl_client->link->CellCssClass = "";
		$tbl_client->link->CellAttrs = array(); $tbl_client->link->ViewAttrs = array(); $tbl_client->link->EditAttrs = array();

		// order_by
		$tbl_client->order_by->CellCssStyle = ""; $tbl_client->order_by->CellCssClass = "";
		$tbl_client->order_by->CellAttrs = array(); $tbl_client->order_by->ViewAttrs = array(); $tbl_client->order_by->EditAttrs = array();
		if ($tbl_client->RowType == EW_ROWTYPE_VIEW) { // View row

			// client_id
			$tbl_client->client_id->ViewValue = $tbl_client->client_id->CurrentValue;
			$tbl_client->client_id->CssStyle = "";
			$tbl_client->client_id->CssClass = "";
			$tbl_client->client_id->ViewCustomAttributes = "";

			// cate_id
			if (strval($tbl_client->cate_id->CurrentValue) <> "") {
				$sFilterWrk = "`cate_id` = " . ew_AdjustSql($tbl_client->cate_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `cate_name` FROM `tbl_client_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_client->cate_id->ViewValue = $rswrk->fields('cate_name');
					$rswrk->Close();
				} else {
					$tbl_client->cate_id->ViewValue = $tbl_client->cate_id->CurrentValue;
				}
			} else {
				$tbl_client->cate_id->ViewValue = NULL;
			}
			$tbl_client->cate_id->CssStyle = "";
			$tbl_client->cate_id->CssClass = "";
			$tbl_client->cate_id->ViewCustomAttributes = "";

			// client_name
			$tbl_client->client_name->ViewValue = $tbl_client->client_name->CurrentValue;
			$tbl_client->client_name->CssStyle = "";
			$tbl_client->client_name->CssClass = "";
			$tbl_client->client_name->ViewCustomAttributes = "";

			// photo
			if (!ew_Empty($tbl_client->photo->Upload->DbValue)) {
				$tbl_client->photo->ViewValue = $tbl_client->photo->Upload->DbValue;
				$tbl_client->photo->ImageWidth = 300;
				$tbl_client->photo->ImageHeight = 200;
				$tbl_client->photo->ImageAlt = $tbl_client->photo->FldAlt();
			} else {
				$tbl_client->photo->ViewValue = "";
			}
			$tbl_client->photo->CssStyle = "";
			$tbl_client->photo->CssClass = "";
			$tbl_client->photo->ViewCustomAttributes = "";

			// link
			$tbl_client->link->ViewValue = $tbl_client->link->CurrentValue;
			$tbl_client->link->CssStyle = "";
			$tbl_client->link->CssClass = "";
			$tbl_client->link->ViewCustomAttributes = "";

			// order_by
			$tbl_client->order_by->ViewValue = $tbl_client->order_by->CurrentValue;
			$tbl_client->order_by->CssStyle = "";
			$tbl_client->order_by->CssClass = "";
			$tbl_client->order_by->ViewCustomAttributes = "";

			// client_id
			$tbl_client->client_id->HrefValue = "";
			$tbl_client->client_id->TooltipValue = "";

			// cate_id
			$tbl_client->cate_id->HrefValue = "";
			$tbl_client->cate_id->TooltipValue = "";

			// client_name
			$tbl_client->client_name->HrefValue = "";
			$tbl_client->client_name->TooltipValue = "";

			// photo
			$tbl_client->photo->HrefValue = "";
			$tbl_client->photo->TooltipValue = "";

			// link
			$tbl_client->link->HrefValue = "";
			$tbl_client->link->TooltipValue = "";

			// order_by
			$tbl_client->order_by->HrefValue = "";
			$tbl_client->order_by->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_client->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_client->Row_Rendered();
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
