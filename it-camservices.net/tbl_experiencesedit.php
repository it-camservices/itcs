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
$tbl_experiences_edit = new ctbl_experiences_edit();
$Page =& $tbl_experiences_edit;

// Page init
$tbl_experiences_edit->Page_Init();

// Page main
$tbl_experiences_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_experiences_edit = new ew_Page("tbl_experiences_edit");

// page properties
tbl_experiences_edit.PageID = "edit"; // page ID
tbl_experiences_edit.FormID = "ftbl_experiencesedit"; // form ID
var EW_PAGE_ID = tbl_experiences_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_experiences_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_experiences->name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_positions"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_experiences->positions->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_photos"];
		aelm = fobj.elements["a" + infix + "_photos"];
		var chk_photos = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_photos && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_experiences->photos->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_photos"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_sort_text"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_experiences->sort_text->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_full_text"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_experiences->full_text->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_experiences_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_experiences_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_experiences_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_experiences->TableCaption() ?><br><br>
<a href="<?php echo $tbl_experiences->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_experiences_edit->ShowMessage();
?>
<form name="ftbl_experiencesedit" id="ftbl_experiencesedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_experiences">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_experiences->exper_id->Visible) { // exper_id ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->exper_id->FldCaption() ?></td>
		<td<?php echo $tbl_experiences->exper_id->CellAttributes() ?>><span id="el_exper_id">
<div<?php echo $tbl_experiences->exper_id->ViewAttributes() ?>><?php echo $tbl_experiences->exper_id->EditValue ?></div><input type="hidden" name="x_exper_id" id="x_exper_id" value="<?php echo ew_HtmlEncode($tbl_experiences->exper_id->CurrentValue) ?>">
</span><?php echo $tbl_experiences->exper_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->name->Visible) { // name ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_experiences->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" title="<?php echo $tbl_experiences->name->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_experiences->name->EditValue ?>"<?php echo $tbl_experiences->name->EditAttributes() ?>>
</span><?php echo $tbl_experiences->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->positions->Visible) { // positions ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->positions->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_experiences->positions->CellAttributes() ?>><span id="el_positions">
<input type="text" name="x_positions" id="x_positions" title="<?php echo $tbl_experiences->positions->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_experiences->positions->EditValue ?>"<?php echo $tbl_experiences->positions->EditAttributes() ?>>
</span><?php echo $tbl_experiences->positions->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->photos->Visible) { // photos ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->photos->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_experiences->photos->CellAttributes() ?>><span id="el_photos">
<div id="old_x_photos">
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
</div>
<div id="new_x_photos">
<?php if (!empty($tbl_experiences->photos->Upload->DbValue)) { ?>
<label><input type="radio" name="a_photos" id="a_photos" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_photos" id="a_photos" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_photos" id="a_photos" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $tbl_experiences->photos->EditAttrs["onchange"] = "this.form.a_photos[2].checked=true;" . @$tbl_experiences->photos->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_photos" id="a_photos" value="3">
<?php } ?>
<input type="file" name="x_photos" id="x_photos" title="<?php echo $tbl_experiences->photos->FldTitle() ?>" size="30"<?php echo $tbl_experiences->photos->EditAttributes() ?>>
</div>
</span><?php echo $tbl_experiences->photos->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->sort_text->Visible) { // sort_text ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->sort_text->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_experiences->sort_text->CellAttributes() ?>><span id="el_sort_text">
<textarea name="x_sort_text" id="x_sort_text" title="<?php echo $tbl_experiences->sort_text->FldTitle() ?>" cols="50" rows="3"<?php echo $tbl_experiences->sort_text->EditAttributes() ?>><?php echo $tbl_experiences->sort_text->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_sort_text", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_sort_text', 50*_width_multiplier, 3*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $tbl_experiences->sort_text->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_experiences->full_text->Visible) { // full_text ?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_experiences->full_text->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_experiences->full_text->CellAttributes() ?>><span id="el_full_text">
<textarea name="x_full_text" id="x_full_text" title="<?php echo $tbl_experiences->full_text->FldTitle() ?>" cols="50" rows="7"<?php echo $tbl_experiences->full_text->EditAttributes() ?>><?php echo $tbl_experiences->full_text->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_full_text", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_full_text', 50*_width_multiplier, 7*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $tbl_experiences->full_text->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>" onclick="ew_SubmitForm(tbl_experiences_edit, this.form);">
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
$tbl_experiences_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_experiences_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_experiences';

	// Page object name
	var $PageObjName = 'tbl_experiences_edit';

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
	function ctbl_experiences_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_experiences)
		$GLOBALS["tbl_experiences"] = new ctbl_experiences();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $tbl_experiences;

		// Load key from QueryString
		if (@$_GET["exper_id"] <> "")
			$tbl_experiences->exper_id->setQueryStringValue($_GET["exper_id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_experiences->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_experiences->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_experiences->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_experiences->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_experiences->exper_id->CurrentValue == "")
			$this->Page_Terminate("tbl_experienceslist.php"); // Invalid key, return to list
		switch ($tbl_experiences->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_experienceslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_experiences->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_experiences->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_experiences->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_experiences->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_experiences;

		// Get upload data
			if ($tbl_experiences->photos->Upload->UploadFile()) {

				// No action required
			} else {
				echo $tbl_experiences->photos->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_experiences;
		$tbl_experiences->exper_id->setFormValue($objForm->GetValue("x_exper_id"));
		$tbl_experiences->name->setFormValue($objForm->GetValue("x_name"));
		$tbl_experiences->positions->setFormValue($objForm->GetValue("x_positions"));
		$tbl_experiences->sort_text->setFormValue($objForm->GetValue("x_sort_text"));
		$tbl_experiences->full_text->setFormValue($objForm->GetValue("x_full_text"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_experiences;
		$this->LoadRow();
		$tbl_experiences->exper_id->CurrentValue = $tbl_experiences->exper_id->FormValue;
		$tbl_experiences->name->CurrentValue = $tbl_experiences->name->FormValue;
		$tbl_experiences->positions->CurrentValue = $tbl_experiences->positions->FormValue;
		$tbl_experiences->sort_text->CurrentValue = $tbl_experiences->sort_text->FormValue;
		$tbl_experiences->full_text->CurrentValue = $tbl_experiences->full_text->FormValue;
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
		// exper_id

		$tbl_experiences->exper_id->CellCssStyle = ""; $tbl_experiences->exper_id->CellCssClass = "";
		$tbl_experiences->exper_id->CellAttrs = array(); $tbl_experiences->exper_id->ViewAttrs = array(); $tbl_experiences->exper_id->EditAttrs = array();

		// name
		$tbl_experiences->name->CellCssStyle = ""; $tbl_experiences->name->CellCssClass = "";
		$tbl_experiences->name->CellAttrs = array(); $tbl_experiences->name->ViewAttrs = array(); $tbl_experiences->name->EditAttrs = array();

		// positions
		$tbl_experiences->positions->CellCssStyle = ""; $tbl_experiences->positions->CellCssClass = "";
		$tbl_experiences->positions->CellAttrs = array(); $tbl_experiences->positions->ViewAttrs = array(); $tbl_experiences->positions->EditAttrs = array();

		// photos
		$tbl_experiences->photos->CellCssStyle = ""; $tbl_experiences->photos->CellCssClass = "";
		$tbl_experiences->photos->CellAttrs = array(); $tbl_experiences->photos->ViewAttrs = array(); $tbl_experiences->photos->EditAttrs = array();

		// sort_text
		$tbl_experiences->sort_text->CellCssStyle = ""; $tbl_experiences->sort_text->CellCssClass = "";
		$tbl_experiences->sort_text->CellAttrs = array(); $tbl_experiences->sort_text->ViewAttrs = array(); $tbl_experiences->sort_text->EditAttrs = array();

		// full_text
		$tbl_experiences->full_text->CellCssStyle = ""; $tbl_experiences->full_text->CellCssClass = "";
		$tbl_experiences->full_text->CellAttrs = array(); $tbl_experiences->full_text->ViewAttrs = array(); $tbl_experiences->full_text->EditAttrs = array();
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

			// sort_text
			$tbl_experiences->sort_text->ViewValue = $tbl_experiences->sort_text->CurrentValue;
			$tbl_experiences->sort_text->CssStyle = "";
			$tbl_experiences->sort_text->CssClass = "";
			$tbl_experiences->sort_text->ViewCustomAttributes = "";

			// full_text
			$tbl_experiences->full_text->ViewValue = $tbl_experiences->full_text->CurrentValue;
			$tbl_experiences->full_text->CssStyle = "";
			$tbl_experiences->full_text->CssClass = "";
			$tbl_experiences->full_text->ViewCustomAttributes = "";

			// exper_id
			$tbl_experiences->exper_id->HrefValue = "";
			$tbl_experiences->exper_id->TooltipValue = "";

			// name
			$tbl_experiences->name->HrefValue = "";
			$tbl_experiences->name->TooltipValue = "";

			// positions
			$tbl_experiences->positions->HrefValue = "";
			$tbl_experiences->positions->TooltipValue = "";

			// photos
			$tbl_experiences->photos->HrefValue = "";
			$tbl_experiences->photos->TooltipValue = "";

			// sort_text
			$tbl_experiences->sort_text->HrefValue = "";
			$tbl_experiences->sort_text->TooltipValue = "";

			// full_text
			$tbl_experiences->full_text->HrefValue = "";
			$tbl_experiences->full_text->TooltipValue = "";
		} elseif ($tbl_experiences->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// exper_id
			$tbl_experiences->exper_id->EditCustomAttributes = "";
			$tbl_experiences->exper_id->EditValue = $tbl_experiences->exper_id->CurrentValue;
			$tbl_experiences->exper_id->CssStyle = "";
			$tbl_experiences->exper_id->CssClass = "";
			$tbl_experiences->exper_id->ViewCustomAttributes = "";

			// name
			$tbl_experiences->name->EditCustomAttributes = "";
			$tbl_experiences->name->EditValue = ew_HtmlEncode($tbl_experiences->name->CurrentValue);

			// positions
			$tbl_experiences->positions->EditCustomAttributes = "";
			$tbl_experiences->positions->EditValue = ew_HtmlEncode($tbl_experiences->positions->CurrentValue);

			// photos
			$tbl_experiences->photos->EditCustomAttributes = "";
			if (!ew_Empty($tbl_experiences->photos->Upload->DbValue)) {
				$tbl_experiences->photos->EditValue = $tbl_experiences->photos->Upload->DbValue;
				$tbl_experiences->photos->ImageWidth = 220;
				$tbl_experiences->photos->ImageHeight = 160;
				$tbl_experiences->photos->ImageAlt = $tbl_experiences->photos->FldAlt();
			} else {
				$tbl_experiences->photos->EditValue = "";
			}

			// sort_text
			$tbl_experiences->sort_text->EditCustomAttributes = "";
			$tbl_experiences->sort_text->EditValue = ew_HtmlEncode($tbl_experiences->sort_text->CurrentValue);

			// full_text
			$tbl_experiences->full_text->EditCustomAttributes = "";
			$tbl_experiences->full_text->EditValue = ew_HtmlEncode($tbl_experiences->full_text->CurrentValue);

			// Edit refer script
			// exper_id

			$tbl_experiences->exper_id->HrefValue = "";

			// name
			$tbl_experiences->name->HrefValue = "";

			// positions
			$tbl_experiences->positions->HrefValue = "";

			// photos
			$tbl_experiences->photos->HrefValue = "";

			// sort_text
			$tbl_experiences->sort_text->HrefValue = "";

			// full_text
			$tbl_experiences->full_text->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_experiences->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_experiences->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_experiences;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($tbl_experiences->photos->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($tbl_experiences->photos->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $tbl_experiences->photos->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($tbl_experiences->photos->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $tbl_experiences->photos->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_experiences->name->FormValue) && $tbl_experiences->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_experiences->name->FldCaption();
		}
		if (!is_null($tbl_experiences->positions->FormValue) && $tbl_experiences->positions->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_experiences->positions->FldCaption();
		}
		if ($tbl_experiences->photos->Upload->Action == "3" && is_null($tbl_experiences->photos->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_experiences->photos->FldCaption();
		}
		if (!is_null($tbl_experiences->sort_text->FormValue) && $tbl_experiences->sort_text->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_experiences->sort_text->FldCaption();
		}
		if (!is_null($tbl_experiences->full_text->FormValue) && $tbl_experiences->full_text->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_experiences->full_text->FldCaption();
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
		global $conn, $Security, $Language, $tbl_experiences;
		$sFilter = $tbl_experiences->KeyFilter();
		$tbl_experiences->CurrentFilter = $sFilter;
		$sSql = $tbl_experiences->SQL();
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
			$tbl_experiences->name->SetDbValueDef($rsnew, $tbl_experiences->name->CurrentValue, "", FALSE);

			// positions
			$tbl_experiences->positions->SetDbValueDef($rsnew, $tbl_experiences->positions->CurrentValue, "", FALSE);

			// photos
			$tbl_experiences->photos->Upload->SaveToSession(); // Save file value to Session
						if ($tbl_experiences->photos->Upload->Action == "2" || $tbl_experiences->photos->Upload->Action == "3") { // Update/Remove
			$tbl_experiences->photos->Upload->DbValue = $rs->fields('photos'); // Get original value
			if (is_null($tbl_experiences->photos->Upload->Value)) {
				$rsnew['photos'] = NULL;
			} else {
				$rsnew['photos'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $tbl_experiences->photos->UploadPath), $tbl_experiences->photos->Upload->FileName);
			}
			$tbl_experiences->photos->ImageWidth = 220; // Resize width
			$tbl_experiences->photos->ImageHeight = 190; // Resize height
			}

			// sort_text
			$tbl_experiences->sort_text->SetDbValueDef($rsnew, $tbl_experiences->sort_text->CurrentValue, "", FALSE);

			// full_text
			$tbl_experiences->full_text->SetDbValueDef($rsnew, $tbl_experiences->full_text->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_experiences->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($tbl_experiences->photos->Upload->Value)) {
				$tbl_experiences->photos->Upload->RestoreFromSession(); // Restore original value
				$tbl_experiences->photos->Upload->Resize($tbl_experiences->photos->ImageWidth, $tbl_experiences->photos->ImageHeight, 75);
			}
			$tbl_experiences->photos->ImageWidth = 0; // Reset image width
			$tbl_experiences->photos->ImageHeight = 0; // Reset image height
			if (!ew_Empty($tbl_experiences->photos->Upload->Value)) {
				$tbl_experiences->photos->Upload->SaveToFile($tbl_experiences->photos->UploadPath, $rsnew['photos'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_experiences->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_experiences->CancelMessage <> "") {
					$this->setMessage($tbl_experiences->CancelMessage);
					$tbl_experiences->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_experiences->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// photos
		$tbl_experiences->photos->Upload->RemoveFromSession(); // Remove file value from Session
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
