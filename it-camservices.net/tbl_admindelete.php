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
$tbl_admin_delete = new ctbl_admin_delete();
$Page =& $tbl_admin_delete;

// Page init
$tbl_admin_delete->Page_Init();

// Page main
$tbl_admin_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_admin_delete = new ew_Page("tbl_admin_delete");

// page properties
tbl_admin_delete.PageID = "delete"; // page ID
tbl_admin_delete.FormID = "ftbl_admindelete"; // form ID
var EW_PAGE_ID = tbl_admin_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_admin_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_admin_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_admin_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $tbl_admin_delete->LoadRecordset())
	$tbl_admin_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_admin_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_admin_delete->Page_Terminate("tbl_adminlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_admin->TableCaption() ?><br><br>
<a href="<?php echo $tbl_admin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_admin_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_admin">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_admin_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_admin->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_admin->username->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_admin->password->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_admin_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_admin_delete->lRecCnt++;

	// Set row properties
	$tbl_admin->CssClass = "";
	$tbl_admin->CssStyle = "";
	$tbl_admin->RowAttrs = array();
	$tbl_admin->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_admin_delete->LoadRowValues($rs);

	// Render row
	$tbl_admin_delete->RenderRow();
?>
	<tr<?php echo $tbl_admin->RowAttributes() ?>>
		<td<?php echo $tbl_admin->username->CellAttributes() ?>>
<div<?php echo $tbl_admin->username->ViewAttributes() ?>><?php echo $tbl_admin->username->ListViewValue() ?></div></td>
		<td<?php echo $tbl_admin->password->CellAttributes() ?>>
<div<?php echo $tbl_admin->password->ViewAttributes() ?>><?php echo $tbl_admin->password->ListViewValue() ?></div></td>
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
$tbl_admin_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_admin_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_admin';

	// Page object name
	var $PageObjName = 'tbl_admin_delete';

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
	function ctbl_admin_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_admin)
		$GLOBALS["tbl_admin"] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_admin;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["admin_id"] <> "") {
			$tbl_admin->admin_id->setQueryStringValue($_GET["admin_id"]);
			if (!is_numeric($tbl_admin->admin_id->QueryStringValue))
				$this->Page_Terminate("tbl_adminlist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_admin->admin_id->QueryStringValue;
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
			$this->Page_Terminate("tbl_adminlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_adminlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`admin_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_admin class, tbl_admininfo.php

		$tbl_admin->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_admin->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_admin->CurrentAction = "I"; // Display record
		}
		switch ($tbl_admin->CurrentAction) {
			case "D": // Delete
				$tbl_admin->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_admin->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_admin;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_admin->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_admin class, tbl_admininfo.php

		$tbl_admin->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_admin->SQL();
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
				$DeleteRows = $tbl_admin->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['admin_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_admin->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_admin->CancelMessage <> "") {
				$this->setMessage($tbl_admin->CancelMessage);
				$tbl_admin->CancelMessage = "";
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
				$tbl_admin->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_admin;

		// Call Recordset Selecting event
		$tbl_admin->Recordset_Selecting($tbl_admin->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_admin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_admin->Recordset_Selected($rs);
		return $rs;
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
		// Call Row_Rendering event

		$tbl_admin->Row_Rendering();

		// Common render codes for all row types
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
