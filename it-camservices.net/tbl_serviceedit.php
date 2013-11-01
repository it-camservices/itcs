<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_serviceinfo.php" ?>
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
$tbl_service_edit = new ctbl_service_edit();
$Page =& $tbl_service_edit;

// Page init
$tbl_service_edit->Page_Init();

// Page main
$tbl_service_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_service_edit = new ew_Page("tbl_service_edit");

// page properties
tbl_service_edit.PageID = "edit"; // page ID
tbl_service_edit.FormID = "ftbl_serviceedit"; // form ID
var EW_PAGE_ID = tbl_service_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_service_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_service->name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_character"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_service->character->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_service->description->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_order_by"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_service->order_by->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_order_by"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_service->order_by->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_service_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_service_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_service_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_service->TableCaption() ?><br><br>
<a href="<?php echo $tbl_service->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_service_edit->ShowMessage();
?>
<form name="ftbl_serviceedit" id="ftbl_serviceedit" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_service">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_service->service_id->Visible) { // service_id ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->service_id->FldCaption() ?></td>
		<td<?php echo $tbl_service->service_id->CellAttributes() ?>><span id="el_service_id">
<div<?php echo $tbl_service->service_id->ViewAttributes() ?>><?php echo $tbl_service->service_id->EditValue ?></div><input type="hidden" name="x_service_id" id="x_service_id" value="<?php echo ew_HtmlEncode($tbl_service->service_id->CurrentValue) ?>">
</span><?php echo $tbl_service->service_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->name->Visible) { // name ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_service->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" title="<?php echo $tbl_service->name->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_service->name->EditValue ?>"<?php echo $tbl_service->name->EditAttributes() ?>>
</span><?php echo $tbl_service->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->character->Visible) { // character ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->character->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_service->character->CellAttributes() ?>><span id="el_character">
<input type="text" name="x_character" id="x_character" title="<?php echo $tbl_service->character->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $tbl_service->character->EditValue ?>"<?php echo $tbl_service->character->EditAttributes() ?>>
</span><?php echo $tbl_service->character->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->description->Visible) { // description ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->description->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_service->description->CellAttributes() ?>><span id="el_description">
<textarea name="x_description" id="x_description" title="<?php echo $tbl_service->description->FldTitle() ?>" cols="50" rows="7"<?php echo $tbl_service->description->EditAttributes() ?>><?php echo $tbl_service->description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_description", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_description', 50*_width_multiplier, 7*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $tbl_service->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_service->order_by->Visible) { // order_by ?>
	<tr<?php echo $tbl_service->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_service->order_by->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_service->order_by->CellAttributes() ?>><span id="el_order_by">
<input type="text" name="x_order_by" id="x_order_by" title="<?php echo $tbl_service->order_by->FldTitle() ?>" size="30" value="<?php echo $tbl_service->order_by->EditValue ?>"<?php echo $tbl_service->order_by->EditAttributes() ?>>
</span><?php echo $tbl_service->order_by->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>" onclick="ew_SubmitForm(tbl_service_edit, this.form);">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_service_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_service_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_service';

	// Page object name
	var $PageObjName = 'tbl_service_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_service;
		if ($tbl_service->UseTokenInUrl) $PageUrl .= "t=" . $tbl_service->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_service;
		if ($tbl_service->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_service_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_service)
		$GLOBALS["tbl_service"] = new ctbl_service();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_service', TRUE);

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
		global $tbl_service;

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
		global $objForm, $Language, $gsFormError, $tbl_service;

		// Load key from QueryString
		if (@$_GET["service_id"] <> "")
			$tbl_service->service_id->setQueryStringValue($_GET["service_id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_service->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_service->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_service->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_service->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_service->service_id->CurrentValue == "")
			$this->Page_Terminate("tbl_servicelist.php"); // Invalid key, return to list
		switch ($tbl_service->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_servicelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_service->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_service->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_service->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_service->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_service;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_service;
		$tbl_service->service_id->setFormValue($objForm->GetValue("x_service_id"));
		$tbl_service->name->setFormValue($objForm->GetValue("x_name"));
		$tbl_service->character->setFormValue($objForm->GetValue("x_character"));
		$tbl_service->description->setFormValue($objForm->GetValue("x_description"));
		$tbl_service->order_by->setFormValue($objForm->GetValue("x_order_by"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_service;
		$this->LoadRow();
		$tbl_service->service_id->CurrentValue = $tbl_service->service_id->FormValue;
		$tbl_service->name->CurrentValue = $tbl_service->name->FormValue;
		$tbl_service->character->CurrentValue = $tbl_service->character->FormValue;
		$tbl_service->description->CurrentValue = $tbl_service->description->FormValue;
		$tbl_service->order_by->CurrentValue = $tbl_service->order_by->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_service;
		$sFilter = $tbl_service->KeyFilter();

		// Call Row Selecting event
		$tbl_service->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_service->CurrentFilter = $sFilter;
		$sSql = $tbl_service->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_service->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_service;
		$tbl_service->service_id->setDbValue($rs->fields('service_id'));
		$tbl_service->name->setDbValue($rs->fields('name'));
		$tbl_service->character->setDbValue($rs->fields('character'));
		$tbl_service->description->setDbValue($rs->fields('description'));
		$tbl_service->order_by->setDbValue($rs->fields('order_by'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_service;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_service->Row_Rendering();

		// Common render codes for all row types
		// service_id

		$tbl_service->service_id->CellCssStyle = ""; $tbl_service->service_id->CellCssClass = "";
		$tbl_service->service_id->CellAttrs = array(); $tbl_service->service_id->ViewAttrs = array(); $tbl_service->service_id->EditAttrs = array();

		// name
		$tbl_service->name->CellCssStyle = ""; $tbl_service->name->CellCssClass = "";
		$tbl_service->name->CellAttrs = array(); $tbl_service->name->ViewAttrs = array(); $tbl_service->name->EditAttrs = array();

		// character
		$tbl_service->character->CellCssStyle = ""; $tbl_service->character->CellCssClass = "";
		$tbl_service->character->CellAttrs = array(); $tbl_service->character->ViewAttrs = array(); $tbl_service->character->EditAttrs = array();

		// description
		$tbl_service->description->CellCssStyle = ""; $tbl_service->description->CellCssClass = "";
		$tbl_service->description->CellAttrs = array(); $tbl_service->description->ViewAttrs = array(); $tbl_service->description->EditAttrs = array();

		// order_by
		$tbl_service->order_by->CellCssStyle = ""; $tbl_service->order_by->CellCssClass = "";
		$tbl_service->order_by->CellAttrs = array(); $tbl_service->order_by->ViewAttrs = array(); $tbl_service->order_by->EditAttrs = array();
		if ($tbl_service->RowType == EW_ROWTYPE_VIEW) { // View row

			// service_id
			$tbl_service->service_id->ViewValue = $tbl_service->service_id->CurrentValue;
			$tbl_service->service_id->CssStyle = "";
			$tbl_service->service_id->CssClass = "";
			$tbl_service->service_id->ViewCustomAttributes = "";

			// name
			$tbl_service->name->ViewValue = $tbl_service->name->CurrentValue;
			$tbl_service->name->CssStyle = "";
			$tbl_service->name->CssClass = "";
			$tbl_service->name->ViewCustomAttributes = "";

			// character
			$tbl_service->character->ViewValue = $tbl_service->character->CurrentValue;
			$tbl_service->character->CssStyle = "";
			$tbl_service->character->CssClass = "";
			$tbl_service->character->ViewCustomAttributes = "";

			// description
			$tbl_service->description->ViewValue = $tbl_service->description->CurrentValue;
			$tbl_service->description->CssStyle = "";
			$tbl_service->description->CssClass = "";
			$tbl_service->description->ViewCustomAttributes = "";

			// order_by
			$tbl_service->order_by->ViewValue = $tbl_service->order_by->CurrentValue;
			$tbl_service->order_by->CssStyle = "";
			$tbl_service->order_by->CssClass = "";
			$tbl_service->order_by->ViewCustomAttributes = "";

			// service_id
			$tbl_service->service_id->HrefValue = "";
			$tbl_service->service_id->TooltipValue = "";

			// name
			$tbl_service->name->HrefValue = "";
			$tbl_service->name->TooltipValue = "";

			// character
			$tbl_service->character->HrefValue = "";
			$tbl_service->character->TooltipValue = "";

			// description
			$tbl_service->description->HrefValue = "";
			$tbl_service->description->TooltipValue = "";

			// order_by
			$tbl_service->order_by->HrefValue = "";
			$tbl_service->order_by->TooltipValue = "";
		} elseif ($tbl_service->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// service_id
			$tbl_service->service_id->EditCustomAttributes = "";
			$tbl_service->service_id->EditValue = $tbl_service->service_id->CurrentValue;
			$tbl_service->service_id->CssStyle = "";
			$tbl_service->service_id->CssClass = "";
			$tbl_service->service_id->ViewCustomAttributes = "";

			// name
			$tbl_service->name->EditCustomAttributes = "";
			$tbl_service->name->EditValue = ew_HtmlEncode($tbl_service->name->CurrentValue);

			// character
			$tbl_service->character->EditCustomAttributes = "";
			$tbl_service->character->EditValue = ew_HtmlEncode($tbl_service->character->CurrentValue);

			// description
			$tbl_service->description->EditCustomAttributes = "";
			$tbl_service->description->EditValue = ew_HtmlEncode($tbl_service->description->CurrentValue);

			// order_by
			$tbl_service->order_by->EditCustomAttributes = "";
			$tbl_service->order_by->EditValue = ew_HtmlEncode($tbl_service->order_by->CurrentValue);

			// Edit refer script
			// service_id

			$tbl_service->service_id->HrefValue = "";

			// name
			$tbl_service->name->HrefValue = "";

			// character
			$tbl_service->character->HrefValue = "";

			// description
			$tbl_service->description->HrefValue = "";

			// order_by
			$tbl_service->order_by->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_service->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_service->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_service;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_service->name->FormValue) && $tbl_service->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_service->name->FldCaption();
		}
		if (!is_null($tbl_service->character->FormValue) && $tbl_service->character->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_service->character->FldCaption();
		}
		if (!is_null($tbl_service->description->FormValue) && $tbl_service->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_service->description->FldCaption();
		}
		if (!is_null($tbl_service->order_by->FormValue) && $tbl_service->order_by->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_service->order_by->FldCaption();
		}
		if (!ew_CheckInteger($tbl_service->order_by->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_service->order_by->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_service;
		$sFilter = $tbl_service->KeyFilter();
		$tbl_service->CurrentFilter = $sFilter;
		$sSql = $tbl_service->SQL();
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

			// name
			$tbl_service->name->SetDbValueDef($rsnew, $tbl_service->name->CurrentValue, "", FALSE);

			// character
			$tbl_service->character->SetDbValueDef($rsnew, $tbl_service->character->CurrentValue, "", FALSE);

			// description
			$tbl_service->description->SetDbValueDef($rsnew, $tbl_service->description->CurrentValue, "", FALSE);

			// order_by
			$tbl_service->order_by->SetDbValueDef($rsnew, $tbl_service->order_by->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_service->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_service->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_service->CancelMessage <> "") {
					$this->setMessage($tbl_service->CancelMessage);
					$tbl_service->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_service->Row_Updated($rsold, $rsnew);
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
