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
$tbl_admin_edit = new ctbl_admin_edit();
$Page =& $tbl_admin_edit;

// Page init
$tbl_admin_edit->Page_Init();

// Page main
$tbl_admin_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_admin_edit = new ew_Page("tbl_admin_edit");

// page properties
tbl_admin_edit.PageID = "edit"; // page ID
tbl_admin_edit.FormID = "ftbl_adminedit"; // form ID
var EW_PAGE_ID = tbl_admin_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_admin_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_admin->username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_admin->password->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_admin_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_admin_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_admin_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_admin->TableCaption() ?><br><br>
<a href="<?php echo $tbl_admin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_admin_edit->ShowMessage();
?>
<form name="ftbl_adminedit" id="ftbl_adminedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_admin_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_admin">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_admin->admin_id->Visible) { // admin_id ?>
	<tr<?php echo $tbl_admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_admin->admin_id->FldCaption() ?></td>
		<td<?php echo $tbl_admin->admin_id->CellAttributes() ?>><span id="el_admin_id">
<div<?php echo $tbl_admin->admin_id->ViewAttributes() ?>><?php echo $tbl_admin->admin_id->EditValue ?></div><input type="hidden" name="x_admin_id" id="x_admin_id" value="<?php echo ew_HtmlEncode($tbl_admin->admin_id->CurrentValue) ?>">
</span><?php echo $tbl_admin->admin_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_admin->username->Visible) { // username ?>
	<tr<?php echo $tbl_admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_admin->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_admin->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" title="<?php echo $tbl_admin->username->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_admin->username->EditValue ?>"<?php echo $tbl_admin->username->EditAttributes() ?>>
</span><?php echo $tbl_admin->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_admin->password->Visible) { // password ?>
	<tr<?php echo $tbl_admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_admin->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_admin->password->CellAttributes() ?>><span id="el_password">
<input type="password" name="x_password" id="x_password" title="<?php echo $tbl_admin->password->FldTitle() ?>" value="<?php echo $tbl_admin->password->EditValue ?>" size="30" maxlength="250"<?php echo $tbl_admin->password->EditAttributes() ?>>
</span><?php echo $tbl_admin->password->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_admin_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_admin_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_admin';

	// Page object name
	var $PageObjName = 'tbl_admin_edit';

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
	function ctbl_admin_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_admin)
		$GLOBALS["tbl_admin"] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $tbl_admin;

		// Load key from QueryString
		if (@$_GET["admin_id"] <> "")
			$tbl_admin->admin_id->setQueryStringValue($_GET["admin_id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_admin->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_admin->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_admin->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_admin->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_admin->admin_id->CurrentValue == "")
			$this->Page_Terminate("tbl_adminlist.php"); // Invalid key, return to list
		switch ($tbl_admin->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_adminlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_admin->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_admin->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_admin->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_admin->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_admin;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_admin;
		$tbl_admin->admin_id->setFormValue($objForm->GetValue("x_admin_id"));
		$tbl_admin->username->setFormValue($objForm->GetValue("x_username"));
		$tbl_admin->password->setFormValue($objForm->GetValue("x_password"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_admin;
		$this->LoadRow();
		$tbl_admin->admin_id->CurrentValue = $tbl_admin->admin_id->FormValue;
		$tbl_admin->username->CurrentValue = $tbl_admin->username->FormValue;
		$tbl_admin->password->CurrentValue = $tbl_admin->password->FormValue;
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
		// admin_id

		$tbl_admin->admin_id->CellCssStyle = ""; $tbl_admin->admin_id->CellCssClass = "";
		$tbl_admin->admin_id->CellAttrs = array(); $tbl_admin->admin_id->ViewAttrs = array(); $tbl_admin->admin_id->EditAttrs = array();

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

			// admin_id
			$tbl_admin->admin_id->HrefValue = "";
			$tbl_admin->admin_id->TooltipValue = "";

			// username
			$tbl_admin->username->HrefValue = "";
			$tbl_admin->username->TooltipValue = "";

			// password
			$tbl_admin->password->HrefValue = "";
			$tbl_admin->password->TooltipValue = "";
		} elseif ($tbl_admin->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// admin_id
			$tbl_admin->admin_id->EditCustomAttributes = "";
			$tbl_admin->admin_id->EditValue = $tbl_admin->admin_id->CurrentValue;
			$tbl_admin->admin_id->CssStyle = "";
			$tbl_admin->admin_id->CssClass = "";
			$tbl_admin->admin_id->ViewCustomAttributes = "";

			// username
			$tbl_admin->username->EditCustomAttributes = "";
			$tbl_admin->username->EditValue = ew_HtmlEncode($tbl_admin->username->CurrentValue);

			// password
			$tbl_admin->password->EditCustomAttributes = "";
			$tbl_admin->password->EditValue = ew_HtmlEncode($tbl_admin->password->CurrentValue);

			// Edit refer script
			// admin_id

			$tbl_admin->admin_id->HrefValue = "";

			// username
			$tbl_admin->username->HrefValue = "";

			// password
			$tbl_admin->password->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_admin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_admin->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_admin;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_admin->username->FormValue) && $tbl_admin->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_admin->username->FldCaption();
		}
		if (!is_null($tbl_admin->password->FormValue) && $tbl_admin->password->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_admin->password->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $tbl_admin;
		$sFilter = $tbl_admin->KeyFilter();
		$tbl_admin->CurrentFilter = $sFilter;
		$sSql = $tbl_admin->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// username
			$tbl_admin->username->SetDbValueDef($rsnew, $tbl_admin->username->CurrentValue, "", FALSE);

			// password
			$tbl_admin->password->SetDbValueDef($rsnew, $tbl_admin->password->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_admin->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_admin->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_admin->CancelMessage <> "") {
					$this->setMessage($tbl_admin->CancelMessage);
					$tbl_admin->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_admin->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
