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
$tbl_client_category_add = new ctbl_client_category_add();
$Page =& $tbl_client_category_add;

// Page init
$tbl_client_category_add->Page_Init();

// Page main
$tbl_client_category_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_client_category_add = new ew_Page("tbl_client_category_add");

// page properties
tbl_client_category_add.PageID = "add"; // page ID
tbl_client_category_add.FormID = "ftbl_client_categoryadd"; // form ID
var EW_PAGE_ID = tbl_client_category_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_client_category_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_character"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_client_category->character->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cate_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_client_category->cate_name->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_client_category_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_client_category_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_client_category_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_client_category->TableCaption() ?><br><br>
<a href="<?php echo $tbl_client_category->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_client_category_add->ShowMessage();
?>
<form name="ftbl_client_categoryadd" id="ftbl_client_categoryadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_client_category_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_client_category">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_client_category->character->Visible) { // character ?>
	<tr<?php echo $tbl_client_category->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client_category->character->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_client_category->character->CellAttributes() ?>><span id="el_character">
<input type="text" name="x_character" id="x_character" title="<?php echo $tbl_client_category->character->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $tbl_client_category->character->EditValue ?>"<?php echo $tbl_client_category->character->EditAttributes() ?>>
</span><?php echo $tbl_client_category->character->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_client_category->cate_name->Visible) { // cate_name ?>
	<tr<?php echo $tbl_client_category->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client_category->cate_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_client_category->cate_name->CellAttributes() ?>><span id="el_cate_name">
<input type="text" name="x_cate_name" id="x_cate_name" title="<?php echo $tbl_client_category->cate_name->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_client_category->cate_name->EditValue ?>"<?php echo $tbl_client_category->cate_name->EditAttributes() ?>>
</span><?php echo $tbl_client_category->cate_name->CustomMsg ?></td>
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
$tbl_client_category_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_client_category_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tbl_client_category';

	// Page object name
	var $PageObjName = 'tbl_client_category_add';

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
	function ctbl_client_category_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_client_category)
		$GLOBALS["tbl_client_category"] = new ctbl_client_category();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $Language, $gsFormError, $tbl_client_category;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["cate_id"] != "") {
		  $tbl_client_category->cate_id->setQueryStringValue($_GET["cate_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $tbl_client_category->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_client_category->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $tbl_client_category->CurrentAction = "C"; // Copy record
		  } else {
		    $tbl_client_category->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($tbl_client_category->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("tbl_client_categorylist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$tbl_client_category->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tbl_client_category->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$tbl_client_category->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_client_category;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_client_category;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_client_category;
		$tbl_client_category->character->setFormValue($objForm->GetValue("x_character"));
		$tbl_client_category->cate_name->setFormValue($objForm->GetValue("x_cate_name"));
		$tbl_client_category->cate_id->setFormValue($objForm->GetValue("x_cate_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_client_category;
		$tbl_client_category->cate_id->CurrentValue = $tbl_client_category->cate_id->FormValue;
		$tbl_client_category->character->CurrentValue = $tbl_client_category->character->FormValue;
		$tbl_client_category->cate_name->CurrentValue = $tbl_client_category->cate_name->FormValue;
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
		} elseif ($tbl_client_category->RowType == EW_ROWTYPE_ADD) { // Add row

			// character
			$tbl_client_category->character->EditCustomAttributes = "";
			$tbl_client_category->character->EditValue = ew_HtmlEncode($tbl_client_category->character->CurrentValue);

			// cate_name
			$tbl_client_category->cate_name->EditCustomAttributes = "";
			$tbl_client_category->cate_name->EditValue = ew_HtmlEncode($tbl_client_category->cate_name->CurrentValue);
		}

		// Call Row Rendered event
		if ($tbl_client_category->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_client_category->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_client_category;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_client_category->character->FormValue) && $tbl_client_category->character->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_client_category->character->FldCaption();
		}
		if (!is_null($tbl_client_category->cate_name->FormValue) && $tbl_client_category->cate_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_client_category->cate_name->FldCaption();
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
		global $conn, $Language, $Security, $tbl_client_category;
		$rsnew = array();

		// character
		$tbl_client_category->character->SetDbValueDef($rsnew, $tbl_client_category->character->CurrentValue, "", FALSE);

		// cate_name
		$tbl_client_category->cate_name->SetDbValueDef($rsnew, $tbl_client_category->cate_name->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$bInsertRow = $tbl_client_category->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_client_category->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_client_category->CancelMessage <> "") {
				$this->setMessage($tbl_client_category->CancelMessage);
				$tbl_client_category->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$tbl_client_category->cate_id->setDbValue($conn->Insert_ID());
			$rsnew['cate_id'] = $tbl_client_category->cate_id->DbValue;

			// Call Row Inserted event
			$tbl_client_category->Row_Inserted($rsnew);
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
