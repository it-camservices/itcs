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
$tbl_webpage_delete = new ctbl_webpage_delete();
$Page =& $tbl_webpage_delete;

// Page init
$tbl_webpage_delete->Page_Init();

// Page main
$tbl_webpage_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_webpage_delete = new ew_Page("tbl_webpage_delete");

// page properties
tbl_webpage_delete.PageID = "delete"; // page ID
tbl_webpage_delete.FormID = "ftbl_webpagedelete"; // form ID
var EW_PAGE_ID = tbl_webpage_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_webpage_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_webpage_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_webpage_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $tbl_webpage_delete->LoadRecordset())
	$tbl_webpage_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_webpage_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_webpage_delete->Page_Terminate("tbl_webpagelist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_webpage->TableCaption() ?><br><br>
<a href="<?php echo $tbl_webpage->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_webpage_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_webpage">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_webpage_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_webpage->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_webpage->site_title->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_webpage->page_name->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_webpage->page_title->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_webpage_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_webpage_delete->lRecCnt++;

	// Set row properties
	$tbl_webpage->CssClass = "";
	$tbl_webpage->CssStyle = "";
	$tbl_webpage->RowAttrs = array();
	$tbl_webpage->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_webpage_delete->LoadRowValues($rs);

	// Render row
	$tbl_webpage_delete->RenderRow();
?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td<?php echo $tbl_webpage->site_title->CellAttributes() ?>>
<div<?php echo $tbl_webpage->site_title->ViewAttributes() ?>><?php echo $tbl_webpage->site_title->ListViewValue() ?></div></td>
		<td<?php echo $tbl_webpage->page_name->CellAttributes() ?>>
<div<?php echo $tbl_webpage->page_name->ViewAttributes() ?>><?php echo $tbl_webpage->page_name->ListViewValue() ?></div></td>
		<td<?php echo $tbl_webpage->page_title->CellAttributes() ?>>
<div<?php echo $tbl_webpage->page_title->ViewAttributes() ?>><?php echo $tbl_webpage->page_title->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_webpage_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_webpage_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_webpage';

	// Page object name
	var $PageObjName = 'tbl_webpage_delete';

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
	function ctbl_webpage_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_webpage)
		$GLOBALS["tbl_webpage"] = new ctbl_webpage();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_webpage;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["web_id"] <> "") {
			$tbl_webpage->web_id->setQueryStringValue($_GET["web_id"]);
			if (!is_numeric($tbl_webpage->web_id->QueryStringValue))
				$this->Page_Terminate("tbl_webpagelist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_webpage->web_id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("tbl_webpagelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_webpagelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`web_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_webpage class, tbl_webpageinfo.php

		$tbl_webpage->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_webpage->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_webpage->CurrentAction = "I"; // Display record
		}
		switch ($tbl_webpage->CurrentAction) {
			case "D": // Delete
				$tbl_webpage->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_webpage->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_webpage;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_webpage->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_webpage class, tbl_webpageinfo.php

		$tbl_webpage->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_webpage->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $tbl_webpage->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['web_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_webpage->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_webpage->CancelMessage <> "") {
				$this->setMessage($tbl_webpage->CancelMessage);
				$tbl_webpage->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$tbl_webpage->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_webpage;

		// Call Recordset Selecting event
		$tbl_webpage->Recordset_Selecting($tbl_webpage->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_webpage->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_webpage->Recordset_Selected($rs);
		return $rs;
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
		// Call Row_Rendering event

		$tbl_webpage->Row_Rendering();

		// Common render codes for all row types
		// site_title

		$tbl_webpage->site_title->CellCssStyle = ""; $tbl_webpage->site_title->CellCssClass = "";
		$tbl_webpage->site_title->CellAttrs = array(); $tbl_webpage->site_title->ViewAttrs = array(); $tbl_webpage->site_title->EditAttrs = array();

		// page_name
		$tbl_webpage->page_name->CellCssStyle = ""; $tbl_webpage->page_name->CellCssClass = "";
		$tbl_webpage->page_name->CellAttrs = array(); $tbl_webpage->page_name->ViewAttrs = array(); $tbl_webpage->page_name->EditAttrs = array();

		// page_title
		$tbl_webpage->page_title->CellCssStyle = ""; $tbl_webpage->page_title->CellCssClass = "";
		$tbl_webpage->page_title->CellAttrs = array(); $tbl_webpage->page_title->ViewAttrs = array(); $tbl_webpage->page_title->EditAttrs = array();
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

			// site_title
			$tbl_webpage->site_title->HrefValue = "";
			$tbl_webpage->site_title->TooltipValue = "";

			// page_name
			$tbl_webpage->page_name->HrefValue = "";
			$tbl_webpage->page_name->TooltipValue = "";

			// page_title
			$tbl_webpage->page_title->HrefValue = "";
			$tbl_webpage->page_title->TooltipValue = "";
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
