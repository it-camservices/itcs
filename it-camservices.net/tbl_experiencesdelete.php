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
$tbl_experiences_delete = new ctbl_experiences_delete();
$Page =& $tbl_experiences_delete;

// Page init
$tbl_experiences_delete->Page_Init();

// Page main
$tbl_experiences_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_experiences_delete = new ew_Page("tbl_experiences_delete");

// page properties
tbl_experiences_delete.PageID = "delete"; // page ID
tbl_experiences_delete.FormID = "ftbl_experiencesdelete"; // form ID
var EW_PAGE_ID = tbl_experiences_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_experiences_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_experiences_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_experiences_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $tbl_experiences_delete->LoadRecordset())
	$tbl_experiences_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_experiences_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_experiences_delete->Page_Terminate("tbl_experienceslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_experiences->TableCaption() ?><br><br>
<a href="<?php echo $tbl_experiences->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_experiences_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_experiences">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_experiences_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_experiences->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_experiences->name->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_experiences->positions->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_experiences->photos->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_experiences_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_experiences_delete->lRecCnt++;

	// Set row properties
	$tbl_experiences->CssClass = "";
	$tbl_experiences->CssStyle = "";
	$tbl_experiences->RowAttrs = array();
	$tbl_experiences->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_experiences_delete->LoadRowValues($rs);

	// Render row
	$tbl_experiences_delete->RenderRow();
?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td<?php echo $tbl_experiences->name->CellAttributes() ?>>
<div<?php echo $tbl_experiences->name->ViewAttributes() ?>><?php echo $tbl_experiences->name->ListViewValue() ?></div></td>
		<td<?php echo $tbl_experiences->positions->CellAttributes() ?>>
<div<?php echo $tbl_experiences->positions->ViewAttributes() ?>><?php echo $tbl_experiences->positions->ListViewValue() ?></div></td>
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
$tbl_experiences_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_experiences_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_experiences';

	// Page object name
	var $PageObjName = 'tbl_experiences_delete';

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
	function ctbl_experiences_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_experiences)
		$GLOBALS["tbl_experiences"] = new ctbl_experiences();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_experiences;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["exper_id"] <> "") {
			$tbl_experiences->exper_id->setQueryStringValue($_GET["exper_id"]);
			if (!is_numeric($tbl_experiences->exper_id->QueryStringValue))
				$this->Page_Terminate("tbl_experienceslist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_experiences->exper_id->QueryStringValue;
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
			$this->Page_Terminate("tbl_experienceslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_experienceslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`exper_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_experiences class, tbl_experiencesinfo.php

		$tbl_experiences->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_experiences->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_experiences->CurrentAction = "I"; // Display record
		}
		switch ($tbl_experiences->CurrentAction) {
			case "D": // Delete
				$tbl_experiences->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_experiences->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_experiences;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_experiences->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_experiences class, tbl_experiencesinfo.php

		$tbl_experiences->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_experiences->SQL();
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
				$DeleteRows = $tbl_experiences->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['exper_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_experiences->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_experiences->CancelMessage <> "") {
				$this->setMessage($tbl_experiences->CancelMessage);
				$tbl_experiences->CancelMessage = "";
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
				$tbl_experiences->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_experiences;

		// Call Recordset Selecting event
		$tbl_experiences->Recordset_Selecting($tbl_experiences->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_experiences->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_experiences->Recordset_Selected($rs);
		return $rs;
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
		// Call Row_Rendering event

		$tbl_experiences->Row_Rendering();

		// Common render codes for all row types
		// name

		$tbl_experiences->name->CellCssStyle = ""; $tbl_experiences->name->CellCssClass = "";
		$tbl_experiences->name->CellAttrs = array(); $tbl_experiences->name->ViewAttrs = array(); $tbl_experiences->name->EditAttrs = array();

		// positions
		$tbl_experiences->positions->CellCssStyle = ""; $tbl_experiences->positions->CellCssClass = "";
		$tbl_experiences->positions->CellAttrs = array(); $tbl_experiences->positions->ViewAttrs = array(); $tbl_experiences->positions->EditAttrs = array();

		// photos
		$tbl_experiences->photos->CellCssStyle = ""; $tbl_experiences->photos->CellCssClass = "";
		$tbl_experiences->photos->CellAttrs = array(); $tbl_experiences->photos->ViewAttrs = array(); $tbl_experiences->photos->EditAttrs = array();
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

			// name
			$tbl_experiences->name->HrefValue = "";
			$tbl_experiences->name->TooltipValue = "";

			// positions
			$tbl_experiences->positions->HrefValue = "";
			$tbl_experiences->positions->TooltipValue = "";

			// photos
			$tbl_experiences->photos->HrefValue = "";
			$tbl_experiences->photos->TooltipValue = "";
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
