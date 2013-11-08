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
$tbl_client_category_delete = new ctbl_client_category_delete();
$Page =& $tbl_client_category_delete;

// Page init
$tbl_client_category_delete->Page_Init();

// Page main
$tbl_client_category_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_client_category_delete = new ew_Page("tbl_client_category_delete");

// page properties
tbl_client_category_delete.PageID = "delete"; // page ID
tbl_client_category_delete.FormID = "ftbl_client_categorydelete"; // form ID
var EW_PAGE_ID = tbl_client_category_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_client_category_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_client_category_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_client_category_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $tbl_client_category_delete->LoadRecordset())
	$tbl_client_category_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_client_category_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_client_category_delete->Page_Terminate("tbl_client_categorylist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_client_category->TableCaption() ?><br><br>
<a href="<?php echo $tbl_client_category->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_client_category_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_client_category">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_client_category_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_client_category->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_client_category->character->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_client_category->cate_name->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_client_category_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_client_category_delete->lRecCnt++;

	// Set row properties
	$tbl_client_category->CssClass = "";
	$tbl_client_category->CssStyle = "";
	$tbl_client_category->RowAttrs = array();
	$tbl_client_category->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_client_category_delete->LoadRowValues($rs);

	// Render row
	$tbl_client_category_delete->RenderRow();
?>
	<tr<?php echo $tbl_client_category->RowAttributes() ?>>
		<td<?php echo $tbl_client_category->character->CellAttributes() ?>>
<div<?php echo $tbl_client_category->character->ViewAttributes() ?>><?php echo $tbl_client_category->character->ListViewValue() ?></div></td>
		<td<?php echo $tbl_client_category->cate_name->CellAttributes() ?>>
<div<?php echo $tbl_client_category->cate_name->ViewAttributes() ?>><?php echo $tbl_client_category->cate_name->ListViewValue() ?></div></td>
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
$tbl_client_category_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_client_category_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_client_category';

	// Page object name
	var $PageObjName = 'tbl_client_category_delete';

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
	function ctbl_client_category_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_client_category)
		$GLOBALS["tbl_client_category"] = new ctbl_client_category();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_client_category;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["cate_id"] <> "") {
			$tbl_client_category->cate_id->setQueryStringValue($_GET["cate_id"]);
			if (!is_numeric($tbl_client_category->cate_id->QueryStringValue))
				$this->Page_Terminate("tbl_client_categorylist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_client_category->cate_id->QueryStringValue;
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
			$this->Page_Terminate("tbl_client_categorylist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_client_categorylist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`cate_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_client_category class, tbl_client_categoryinfo.php

		$tbl_client_category->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_client_category->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_client_category->CurrentAction = "I"; // Display record
		}
		switch ($tbl_client_category->CurrentAction) {
			case "D": // Delete
				$tbl_client_category->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_client_category->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_client_category;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_client_category->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_client_category class, tbl_client_categoryinfo.php

		$tbl_client_category->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_client_category->SQL();
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
				$DeleteRows = $tbl_client_category->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['cate_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_client_category->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_client_category->CancelMessage <> "") {
				$this->setMessage($tbl_client_category->CancelMessage);
				$tbl_client_category->CancelMessage = "";
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
				$tbl_client_category->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_client_category;

		// Call Recordset Selecting event
		$tbl_client_category->Recordset_Selecting($tbl_client_category->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_client_category->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_client_category->Recordset_Selected($rs);
		return $rs;
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
		// Call Row_Rendering event

		$tbl_client_category->Row_Rendering();

		// Common render codes for all row types
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
