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
$tbl_experiences_add = new ctbl_experiences_add();
$Page =& $tbl_experiences_add;

// Page init
$tbl_experiences_add->Page_Init();

// Page main
$tbl_experiences_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_experiences_add = new ew_Page("tbl_experiences_add");

// page properties
tbl_experiences_add.PageID = "add"; // page ID
tbl_experiences_add.FormID = "ftbl_experiencesadd"; // form ID
var EW_PAGE_ID = tbl_experiences_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_experiences_add.ValidateForm = function(fobj) {
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
tbl_experiences_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_experiences_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_experiences_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_experiences->TableCaption() ?><br><br>
<a href="<?php echo $tbl_experiences->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_experiences_add->ShowMessage();
?>
<form name="ftbl_experiencesadd" id="ftbl_experiencesadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return tbl_experiences_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_experiences">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
	var oCKeditor = CKEDITOR.replace('x_sort_text', { width: 50*_width_multiplier, height: 3*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
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
	var oCKeditor = CKEDITOR.replace('x_full_text', { width: 50*_width_multiplier, height: 7*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
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
$tbl_experiences_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_experiences_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tbl_experiences';

	// Page object name
	var $PageObjName = 'tbl_experiences_add';

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
	function ctbl_experiences_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_experiences)
		$GLOBALS["tbl_experiences"] = new ctbl_experiences();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $tbl_experiences;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["exper_id"] != "") {
		  $tbl_experiences->exper_id->setQueryStringValue($_GET["exper_id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $tbl_experiences->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_experiences->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $tbl_experiences->CurrentAction = "C"; // Copy record
		  } else {
		    $tbl_experiences->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($tbl_experiences->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("tbl_experienceslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$tbl_experiences->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tbl_experiences->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$tbl_experiences->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $tbl_experiences;
		$tbl_experiences->photos->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_experiences;
		$tbl_experiences->name->setFormValue($objForm->GetValue("x_name"));
		$tbl_experiences->positions->setFormValue($objForm->GetValue("x_positions"));
		$tbl_experiences->sort_text->setFormValue($objForm->GetValue("x_sort_text"));
		$tbl_experiences->full_text->setFormValue($objForm->GetValue("x_full_text"));
		$tbl_experiences->exper_id->setFormValue($objForm->GetValue("x_exper_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_experiences;
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
		} elseif ($tbl_experiences->RowType == EW_ROWTYPE_ADD) { // Add row

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
		if (is_null($tbl_experiences->photos->Upload->Value)) {
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_experiences;
		$rsnew = array();

		// name
		$tbl_experiences->name->SetDbValueDef($rsnew, $tbl_experiences->name->CurrentValue, "", FALSE);

		// positions
		$tbl_experiences->positions->SetDbValueDef($rsnew, $tbl_experiences->positions->CurrentValue, "", FALSE);

		// photos
		$tbl_experiences->photos->Upload->SaveToSession(); // Save file value to Session
		if (is_null($tbl_experiences->photos->Upload->Value)) {
			$rsnew['photos'] = NULL;
		} else {
			$rsnew['photos'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $tbl_experiences->photos->UploadPath), $tbl_experiences->photos->Upload->FileName);
		}
		$tbl_experiences->photos->ImageWidth = 220; // Resize width
		$tbl_experiences->photos->ImageHeight = 190; // Resize height

		// sort_text
		$tbl_experiences->sort_text->SetDbValueDef($rsnew, $tbl_experiences->sort_text->CurrentValue, "", FALSE);

		// full_text
		$tbl_experiences->full_text->SetDbValueDef($rsnew, $tbl_experiences->full_text->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$bInsertRow = $tbl_experiences->Row_Inserting($rsnew);
		if ($bInsertRow) {
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
			$AddRow = $conn->Execute($tbl_experiences->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_experiences->CancelMessage <> "") {
				$this->setMessage($tbl_experiences->CancelMessage);
				$tbl_experiences->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$tbl_experiences->exper_id->setDbValue($conn->Insert_ID());
			$rsnew['exper_id'] = $tbl_experiences->exper_id->DbValue;

			// Call Row Inserted event
			$tbl_experiences->Row_Inserted($rsnew);
		}

		// photos
		$tbl_experiences->photos->Upload->RemoveFromSession(); // Remove file value from Session
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
