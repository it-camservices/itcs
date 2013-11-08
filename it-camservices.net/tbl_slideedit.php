<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_slideinfo.php" ?>
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
$tbl_slide_edit = new ctbl_slide_edit();
$Page =& $tbl_slide_edit;

// Page init
$tbl_slide_edit->Page_Init();

// Page main
$tbl_slide_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_slide_edit = new ew_Page("tbl_slide_edit");

// page properties
tbl_slide_edit.PageID = "edit"; // page ID
tbl_slide_edit.FormID = "ftbl_slideedit"; // form ID
var EW_PAGE_ID = tbl_slide_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_slide_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_slide->title->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_images"];
		aelm = fobj.elements["a" + infix + "_images"];
		var chk_images = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_images && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_slide->images->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_images"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_slide->description->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_order_by"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_slide->order_by->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_slide_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_slide_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_slide_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 20;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {			
		var inst;			
		for (inst in CKEDITOR.instances)
			CKEDITOR.instances[inst].updateElement();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];		
		if (inst)
			inst.setData(inst.element.value);
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];	
		if (inst)
			inst.focus();
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_slide->TableCaption() ?><br><br>
<a href="<?php echo $tbl_slide->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_slide_edit->ShowMessage();
?>
<form name="ftbl_slideedit" id="ftbl_slideedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return tbl_slide_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_slide">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_slide->banner_id->Visible) { // banner_id ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->banner_id->FldCaption() ?></td>
		<td<?php echo $tbl_slide->banner_id->CellAttributes() ?>><span id="el_banner_id">
<div<?php echo $tbl_slide->banner_id->ViewAttributes() ?>><?php echo $tbl_slide->banner_id->EditValue ?></div><input type="hidden" name="x_banner_id" id="x_banner_id" value="<?php echo ew_HtmlEncode($tbl_slide->banner_id->CurrentValue) ?>">
</span><?php echo $tbl_slide->banner_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->title->Visible) { // title ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_slide->title->CellAttributes() ?>><span id="el_title">
<input type="text" name="x_title" id="x_title" title="<?php echo $tbl_slide->title->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_slide->title->EditValue ?>"<?php echo $tbl_slide->title->EditAttributes() ?>>
</span><?php echo $tbl_slide->title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->images->Visible) { // images ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->images->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_slide->images->CellAttributes() ?>><span id="el_images">
<div id="old_x_images">
<?php if ($tbl_slide->images->HrefValue <> "" || $tbl_slide->images->TooltipValue <> "") { ?>
<?php if (!empty($tbl_slide->images->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_slide->images->UploadPath) . $tbl_slide->images->Upload->DbValue ?>" border=0<?php echo $tbl_slide->images->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($tbl_slide->images->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $tbl_slide->images->UploadPath) . $tbl_slide->images->Upload->DbValue ?>" border=0<?php echo $tbl_slide->images->ViewAttributes() ?>>
<?php } elseif (!in_array($tbl_slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_images">
<?php if (!empty($tbl_slide->images->Upload->DbValue)) { ?>
<label><input type="radio" name="a_images" id="a_images" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_images" id="a_images" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_images" id="a_images" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $tbl_slide->images->EditAttrs["onchange"] = "this.form.a_images[2].checked=true;" . @$tbl_slide->images->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_images" id="a_images" value="3">
<?php } ?>
<input type="file" name="x_images" id="x_images" title="<?php echo $tbl_slide->images->FldTitle() ?>" size="30"<?php echo $tbl_slide->images->EditAttributes() ?>>
</div>
</span><?php echo $tbl_slide->images->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->description->Visible) { // description ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->description->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_slide->description->CellAttributes() ?>><span id="el_description">
<textarea name="x_description" id="x_description" title="<?php echo $tbl_slide->description->FldTitle() ?>" cols="35" rows="4"<?php echo $tbl_slide->description->EditAttributes() ?>><?php echo $tbl_slide->description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_description", function() {
	var oCKeditor = CKEDITOR.replace('x_description', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $tbl_slide->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_slide->order_by->Visible) { // order_by ?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_slide->order_by->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_slide->order_by->CellAttributes() ?>><span id="el_order_by">
<input type="text" name="x_order_by" id="x_order_by" title="<?php echo $tbl_slide->order_by->FldTitle() ?>" size="30" value="<?php echo $tbl_slide->order_by->EditValue ?>"<?php echo $tbl_slide->order_by->EditAttributes() ?>>
</span><?php echo $tbl_slide->order_by->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
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
$tbl_slide_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_slide_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_slide';

	// Page object name
	var $PageObjName = 'tbl_slide_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_slide;
		if ($tbl_slide->UseTokenInUrl) $PageUrl .= "t=" . $tbl_slide->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_slide;
		if ($tbl_slide->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_slide->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_slide->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_slide_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_slide)
		$GLOBALS["tbl_slide"] = new ctbl_slide();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_slide', TRUE);

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
		global $tbl_slide;

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
		global $objForm, $Language, $gsFormError, $tbl_slide;

		// Load key from QueryString
		if (@$_GET["banner_id"] <> "")
			$tbl_slide->banner_id->setQueryStringValue($_GET["banner_id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_slide->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_slide->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_slide->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_slide->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_slide->banner_id->CurrentValue == "")
			$this->Page_Terminate("tbl_slidelist.php"); // Invalid key, return to list
		switch ($tbl_slide->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_slidelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_slide->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_slide->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_slide->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_slide->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_slide;

		// Get upload data
			if ($tbl_slide->images->Upload->UploadFile()) {

				// No action required
			} else {
				echo $tbl_slide->images->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_slide;
		$tbl_slide->banner_id->setFormValue($objForm->GetValue("x_banner_id"));
		$tbl_slide->title->setFormValue($objForm->GetValue("x_title"));
		$tbl_slide->description->setFormValue($objForm->GetValue("x_description"));
		$tbl_slide->order_by->setFormValue($objForm->GetValue("x_order_by"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_slide;
		$this->LoadRow();
		$tbl_slide->banner_id->CurrentValue = $tbl_slide->banner_id->FormValue;
		$tbl_slide->title->CurrentValue = $tbl_slide->title->FormValue;
		$tbl_slide->description->CurrentValue = $tbl_slide->description->FormValue;
		$tbl_slide->order_by->CurrentValue = $tbl_slide->order_by->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_slide;
		$sFilter = $tbl_slide->KeyFilter();

		// Call Row Selecting event
		$tbl_slide->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_slide->CurrentFilter = $sFilter;
		$sSql = $tbl_slide->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_slide->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_slide;
		$tbl_slide->banner_id->setDbValue($rs->fields('banner_id'));
		$tbl_slide->title->setDbValue($rs->fields('title'));
		$tbl_slide->images->Upload->DbValue = $rs->fields('images');
		$tbl_slide->description->setDbValue($rs->fields('description'));
		$tbl_slide->order_by->setDbValue($rs->fields('order_by'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_slide;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_slide->Row_Rendering();

		// Common render codes for all row types
		// banner_id

		$tbl_slide->banner_id->CellCssStyle = ""; $tbl_slide->banner_id->CellCssClass = "";
		$tbl_slide->banner_id->CellAttrs = array(); $tbl_slide->banner_id->ViewAttrs = array(); $tbl_slide->banner_id->EditAttrs = array();

		// title
		$tbl_slide->title->CellCssStyle = ""; $tbl_slide->title->CellCssClass = "";
		$tbl_slide->title->CellAttrs = array(); $tbl_slide->title->ViewAttrs = array(); $tbl_slide->title->EditAttrs = array();

		// images
		$tbl_slide->images->CellCssStyle = ""; $tbl_slide->images->CellCssClass = "";
		$tbl_slide->images->CellAttrs = array(); $tbl_slide->images->ViewAttrs = array(); $tbl_slide->images->EditAttrs = array();

		// description
		$tbl_slide->description->CellCssStyle = ""; $tbl_slide->description->CellCssClass = "";
		$tbl_slide->description->CellAttrs = array(); $tbl_slide->description->ViewAttrs = array(); $tbl_slide->description->EditAttrs = array();

		// order_by
		$tbl_slide->order_by->CellCssStyle = ""; $tbl_slide->order_by->CellCssClass = "";
		$tbl_slide->order_by->CellAttrs = array(); $tbl_slide->order_by->ViewAttrs = array(); $tbl_slide->order_by->EditAttrs = array();
		if ($tbl_slide->RowType == EW_ROWTYPE_VIEW) { // View row

			// banner_id
			$tbl_slide->banner_id->ViewValue = $tbl_slide->banner_id->CurrentValue;
			$tbl_slide->banner_id->CssStyle = "";
			$tbl_slide->banner_id->CssClass = "";
			$tbl_slide->banner_id->ViewCustomAttributes = "";

			// title
			$tbl_slide->title->ViewValue = $tbl_slide->title->CurrentValue;
			$tbl_slide->title->CssStyle = "";
			$tbl_slide->title->CssClass = "";
			$tbl_slide->title->ViewCustomAttributes = "";

			// images
			if (!ew_Empty($tbl_slide->images->Upload->DbValue)) {
				$tbl_slide->images->ViewValue = $tbl_slide->images->Upload->DbValue;
				$tbl_slide->images->ImageWidth = 300;
				$tbl_slide->images->ImageHeight = 180;
				$tbl_slide->images->ImageAlt = $tbl_slide->images->FldAlt();
			} else {
				$tbl_slide->images->ViewValue = "";
			}
			$tbl_slide->images->CssStyle = "";
			$tbl_slide->images->CssClass = "";
			$tbl_slide->images->ViewCustomAttributes = "";

			// description
			$tbl_slide->description->ViewValue = $tbl_slide->description->CurrentValue;
			$tbl_slide->description->CssStyle = "";
			$tbl_slide->description->CssClass = "";
			$tbl_slide->description->ViewCustomAttributes = "";

			// order_by
			$tbl_slide->order_by->ViewValue = $tbl_slide->order_by->CurrentValue;
			$tbl_slide->order_by->CssStyle = "";
			$tbl_slide->order_by->CssClass = "";
			$tbl_slide->order_by->ViewCustomAttributes = "";

			// banner_id
			$tbl_slide->banner_id->HrefValue = "";
			$tbl_slide->banner_id->TooltipValue = "";

			// title
			$tbl_slide->title->HrefValue = "";
			$tbl_slide->title->TooltipValue = "";

			// images
			$tbl_slide->images->HrefValue = "";
			$tbl_slide->images->TooltipValue = "";

			// description
			$tbl_slide->description->HrefValue = "";
			$tbl_slide->description->TooltipValue = "";

			// order_by
			$tbl_slide->order_by->HrefValue = "";
			$tbl_slide->order_by->TooltipValue = "";
		} elseif ($tbl_slide->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// banner_id
			$tbl_slide->banner_id->EditCustomAttributes = "";
			$tbl_slide->banner_id->EditValue = $tbl_slide->banner_id->CurrentValue;
			$tbl_slide->banner_id->CssStyle = "";
			$tbl_slide->banner_id->CssClass = "";
			$tbl_slide->banner_id->ViewCustomAttributes = "";

			// title
			$tbl_slide->title->EditCustomAttributes = "";
			$tbl_slide->title->EditValue = ew_HtmlEncode($tbl_slide->title->CurrentValue);

			// images
			$tbl_slide->images->EditCustomAttributes = "";
			if (!ew_Empty($tbl_slide->images->Upload->DbValue)) {
				$tbl_slide->images->EditValue = $tbl_slide->images->Upload->DbValue;
				$tbl_slide->images->ImageWidth = 300;
				$tbl_slide->images->ImageHeight = 180;
				$tbl_slide->images->ImageAlt = $tbl_slide->images->FldAlt();
			} else {
				$tbl_slide->images->EditValue = "";
			}

			// description
			$tbl_slide->description->EditCustomAttributes = "";
			$tbl_slide->description->EditValue = ew_HtmlEncode($tbl_slide->description->CurrentValue);

			// order_by
			$tbl_slide->order_by->EditCustomAttributes = "";
			$tbl_slide->order_by->EditValue = ew_HtmlEncode($tbl_slide->order_by->CurrentValue);

			// Edit refer script
			// banner_id

			$tbl_slide->banner_id->HrefValue = "";

			// title
			$tbl_slide->title->HrefValue = "";

			// images
			$tbl_slide->images->HrefValue = "";

			// description
			$tbl_slide->description->HrefValue = "";

			// order_by
			$tbl_slide->order_by->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_slide->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_slide->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_slide;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($tbl_slide->images->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($tbl_slide->images->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $tbl_slide->images->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($tbl_slide->images->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $tbl_slide->images->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_slide->title->FormValue) && $tbl_slide->title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_slide->title->FldCaption();
		}
		if ($tbl_slide->images->Upload->Action == "3" && is_null($tbl_slide->images->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_slide->images->FldCaption();
		}
		if (!is_null($tbl_slide->description->FormValue) && $tbl_slide->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_slide->description->FldCaption();
		}
		if (!ew_CheckInteger($tbl_slide->order_by->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_slide->order_by->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_slide;
		$sFilter = $tbl_slide->KeyFilter();
		$tbl_slide->CurrentFilter = $sFilter;
		$sSql = $tbl_slide->SQL();
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

			// title
			$tbl_slide->title->SetDbValueDef($rsnew, $tbl_slide->title->CurrentValue, "", FALSE);

			// images
			$tbl_slide->images->Upload->SaveToSession(); // Save file value to Session
						if ($tbl_slide->images->Upload->Action == "2" || $tbl_slide->images->Upload->Action == "3") { // Update/Remove
			$tbl_slide->images->Upload->DbValue = $rs->fields('images'); // Get original value
			if (is_null($tbl_slide->images->Upload->Value)) {
				$rsnew['images'] = NULL;
			} else {
				$rsnew['images'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $tbl_slide->images->UploadPath), $tbl_slide->images->Upload->FileName);
			}
			}

			// description
			$tbl_slide->description->SetDbValueDef($rsnew, $tbl_slide->description->CurrentValue, "", FALSE);

			// order_by
			$tbl_slide->order_by->SetDbValueDef($rsnew, $tbl_slide->order_by->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_slide->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($tbl_slide->images->Upload->Value)) {
				$tbl_slide->images->Upload->SaveToFile($tbl_slide->images->UploadPath, $rsnew['images'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_slide->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_slide->CancelMessage <> "") {
					$this->setMessage($tbl_slide->CancelMessage);
					$tbl_slide->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_slide->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// images
		$tbl_slide->images->Upload->RemoveFromSession(); // Remove file value from Session
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
