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
$tbl_admin_add = new ctbl_admin_add();
$Page =& $tbl_admin_add;

// Page init
$tbl_admin_add->Page_Init();

// Page main
$tbl_admin_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_admin_add = new ew_Page("tbl_admin_add");

// page properties
tbl_admin_add.PageID = "add"; // page ID
tbl_admin_add.FormID = "ftbl_adminadd"; // form ID
var EW_PAGE_ID = tbl_admin_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_admin_add.ValidateForm = function(fobj) {
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
tbl_admin_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_admin_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_admin_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_admin->TableCaption() ?><br><br>
<a href="<?php echo $tbl_admin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_admin_add->ShowMessage();
?>
<form name="ftbl_adminadd" id="ftbl_adminadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_admin_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_admin">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="password" name="x_password" id="x_password" title="<?php echo $tbl_admin->password->FldTitle() ?>" size="30" maxlength="250"<?php echo $tbl_admin->password->EditAttributes() ?>>
</span><?php echo $tbl_admin->password->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_admin_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_admin_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tbl_admin';

	// Page object name
	var $PageObjName = 'tbl_admin_add';

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
	function ctbl_admin_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_admin)
		$GLOBALS["tbl_admin"] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $tbl_admin;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["admin_id"] != "") {
		  $tbl_admin->admin_id->setQueryStringValue($_GET["admin_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $tbl_admin->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_admin->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $tbl_admin->CurrentAction = "C"; // Copy record
		  } else {
		    $tbl_admin->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($tbl_admin->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("tbl_adminlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$tbl_admin->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tbl_admin->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$tbl_admin->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_admin;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_admin;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_admin;
		$tbl_admin->username->setFormValue($objForm->GetValue("x_username"));
		$tbl_admin->password->setFormValue($objForm->GetValue("x_password"));
		$tbl_admin->admin_id->setFormValue($objForm->GetValue("x_admin_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_admin;
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
		} elseif ($tbl_admin->RowType == EW_ROWTYPE_ADD) { // Add row

			// username
			$tbl_admin->username->EditCustomAttributes = "";
			$tbl_admin->username->EditValue = ew_HtmlEncode($tbl_admin->username->CurrentValue);

			// password
			$tbl_admin->password->EditCustomAttributes = "";
			$tbl_admin->password->EditValue = ew_HtmlEncode($tbl_admin->password->CurrentValue);
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_admin;
		$rsnew = array();

		// username
		$tbl_admin->username->SetDbValueDef($rsnew, $tbl_admin->username->CurrentValue, "", FALSE);

		// password
		$tbl_admin->password->SetDbValueDef($rsnew, $tbl_admin->password->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$bInsertRow = $tbl_admin->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_admin->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_admin->CancelMessage <> "") {
				$this->setMessage($tbl_admin->CancelMessage);
				$tbl_admin->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$tbl_admin->admin_id->setDbValue($conn->Insert_ID());
			$rsnew['admin_id'] = $tbl_admin->admin_id->DbValue;

			// Call Row Inserted event
			$tbl_admin->Row_Inserted($rsnew);
		}
		return $AddRow;
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
