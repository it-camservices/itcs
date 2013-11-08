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
$tbl_client_delete = new ctbl_client_delete();
$Page =& $tbl_client_delete;

// Page init
$tbl_client_delete->Page_Init();

// Page main
$tbl_client_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_client_delete = new ew_Page("tbl_client_delete");

// page properties
tbl_client_delete.PageID = "delete"; // page ID
tbl_client_delete.FormID = "ftbl_clientdelete"; // form ID
var EW_PAGE_ID = tbl_client_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_client_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_client_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_client_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $tbl_client_delete->LoadRecordset())
	$tbl_client_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_client_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_client_delete->Page_Terminate("tbl_clientlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_client->TableCaption() ?><br><br>
<a href="<?php echo $tbl_client->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_client_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_client">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_client_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_client->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_client->client_id->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_client->cate_id->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_client->client_name->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_client->photo->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_client->link->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_client->order_by->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_client_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_client_delete->lRecCnt++;

	// Set row properties
	$tbl_client->CssClass = "";
	$tbl_client->CssStyle = "";
	$tbl_client->RowAttrs = array();
	$tbl_client->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_client_delete->LoadRowValues($rs);

	// Render row
	$tbl_client_delete->RenderRow();
?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td<?php echo $tbl_client->client_id->CellAttributes() ?>>
<div<?php echo $tbl_client->client_id->ViewAttributes() ?>><?php echo $tbl_client->client_id->ListViewValue() ?></div></td>
		<td<?php echo $tbl_client->cate_id->CellAttributes() ?>>
<div<?php echo $tbl_client->cate_id->ViewAttributes() ?>><?php echo $tbl_client->cate_id->ListViewValue() ?></div></td>
		<td<?php echo $tbl_client->client_name->CellAttributes() ?>>
<div<?php echo $tbl_client->client_name->ViewAttributes() ?>><?php echo $tbl_client->client_name->ListViewValue() ?></div></td>
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
		<td<?php echo $tbl_client->link->CellAttributes() ?>>
<div<?php echo $tbl_client->link->ViewAttributes() ?>><?php echo $tbl_client->link->ListViewValue() ?></div></td>
		<td<?php echo $tbl_client->order_by->CellAttributes() ?>>
<div<?php echo $tbl_client->order_by->ViewAttributes() ?>><?php echo $tbl_client->order_by->ListViewValue() ?></div></td>
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
$tbl_client_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_client_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_client';

	// Page object name
	var $PageObjName = 'tbl_client_delete';

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
	function ctbl_client_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_client)
		$GLOBALS["tbl_client"] = new ctbl_client();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_client;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["client_id"] <> "") {
			$tbl_client->client_id->setQueryStringValue($_GET["client_id"]);
			if (!is_numeric($tbl_client->client_id->QueryStringValue))
				$this->Page_Terminate("tbl_clientlist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_client->client_id->QueryStringValue;
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
			$this->Page_Terminate("tbl_clientlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_clientlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`client_id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_client class, tbl_clientinfo.php

		$tbl_client->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_client->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_client->CurrentAction = "I"; // Display record
		}
		switch ($tbl_client->CurrentAction) {
			case "D": // Delete
				$tbl_client->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_client->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_client;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_client->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_client class, tbl_clientinfo.php

		$tbl_client->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_client->SQL();
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
				$DeleteRows = $tbl_client->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['client_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_client->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_client->CancelMessage <> "") {
				$this->setMessage($tbl_client->CancelMessage);
				$tbl_client->CancelMessage = "";
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
				$tbl_client->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_client;

		// Call Recordset Selecting event
		$tbl_client->Recordset_Selecting($tbl_client->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_client->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_client->Recordset_Selected($rs);
		return $rs;
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
