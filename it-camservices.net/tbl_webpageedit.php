<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_webpageinfo.php" ?>
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
$tbl_webpage_edit = new ctbl_webpage_edit();
$Page =& $tbl_webpage_edit;

// Page init
$tbl_webpage_edit->Page_Init();

// Page main
$tbl_webpage_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_webpage_edit = new ew_Page("tbl_webpage_edit");

// page properties
tbl_webpage_edit.PageID = "edit"; // page ID
tbl_webpage_edit.FormID = "ftbl_webpageedit"; // form ID
var EW_PAGE_ID = tbl_webpage_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_webpage_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_site_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_webpage->site_title->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_site_keyword"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_webpage->site_keyword->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_site_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_webpage->site_description->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_page_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_webpage->page_name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_page_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_webpage->page_title->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_descriptions"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_webpage->descriptions->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_webpage_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_webpage_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_webpage_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_webpage->TableCaption() ?><br><br>
<a href="<?php echo $tbl_webpage->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_webpage_edit->ShowMessage();
?>
<form name="ftbl_webpageedit" id="ftbl_webpageedit" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_webpage">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_webpage->web_id->Visible) { // web_id ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->web_id->FldCaption() ?></td>
		<td<?php echo $tbl_webpage->web_id->CellAttributes() ?>><span id="el_web_id">
<div<?php echo $tbl_webpage->web_id->ViewAttributes() ?>><?php echo $tbl_webpage->web_id->EditValue ?></div><input type="hidden" name="x_web_id" id="x_web_id" value="<?php echo ew_HtmlEncode($tbl_webpage->web_id->CurrentValue) ?>">
</span><?php echo $tbl_webpage->web_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->site_title->Visible) { // site_title ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->site_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_webpage->site_title->CellAttributes() ?>><span id="el_site_title">
<input type="text" name="x_site_title" id="x_site_title" title="<?php echo $tbl_webpage->site_title->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_webpage->site_title->EditValue ?>"<?php echo $tbl_webpage->site_title->EditAttributes() ?>>
</span><?php echo $tbl_webpage->site_title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->site_keyword->Visible) { // site_keyword ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->site_keyword->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_webpage->site_keyword->CellAttributes() ?>><span id="el_site_keyword">
<textarea name="x_site_keyword" id="x_site_keyword" title="<?php echo $tbl_webpage->site_keyword->FldTitle() ?>" cols="50" rows="4"<?php echo $tbl_webpage->site_keyword->EditAttributes() ?>><?php echo $tbl_webpage->site_keyword->EditValue ?></textarea>
</span><?php echo $tbl_webpage->site_keyword->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->site_description->Visible) { // site_description ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->site_description->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_webpage->site_description->CellAttributes() ?>><span id="el_site_description">
<textarea name="x_site_description" id="x_site_description" title="<?php echo $tbl_webpage->site_description->FldTitle() ?>" cols="50" rows="4"<?php echo $tbl_webpage->site_description->EditAttributes() ?>><?php echo $tbl_webpage->site_description->EditValue ?></textarea>
</span><?php echo $tbl_webpage->site_description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->page_name->Visible) { // page_name ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->page_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_webpage->page_name->CellAttributes() ?>><span id="el_page_name">
<input type="text" name="x_page_name" id="x_page_name" title="<?php echo $tbl_webpage->page_name->FldTitle() ?>" size="50" maxlength="100" value="<?php echo $tbl_webpage->page_name->EditValue ?>"<?php echo $tbl_webpage->page_name->EditAttributes() ?>>
</span><?php echo $tbl_webpage->page_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->page_title->Visible) { // page_title ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->page_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_webpage->page_title->CellAttributes() ?>><span id="el_page_title">
<input type="text" name="x_page_title" id="x_page_title" title="<?php echo $tbl_webpage->page_title->FldTitle() ?>" size="50" maxlength="250" value="<?php echo $tbl_webpage->page_title->EditValue ?>"<?php echo $tbl_webpage->page_title->EditAttributes() ?>>
</span><?php echo $tbl_webpage->page_title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_webpage->descriptions->Visible) { // descriptions ?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_webpage->descriptions->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_webpage->descriptions->CellAttributes() ?>><span id="el_descriptions">
<textarea name="x_descriptions" id="x_descriptions" title="<?php echo $tbl_webpage->descriptions->FldTitle() ?>" cols="50" rows="10"<?php echo $tbl_webpage->descriptions->EditAttributes() ?>><?php echo $tbl_webpage->descriptions->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_descriptions", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_descriptions', 50*_width_multiplier, 10*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $tbl_webpage->descriptions->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>" onclick="ew_SubmitForm(tbl_webpage_edit, this.form);">
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
$tbl_webpage_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_webpage_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_webpage';

	// Page object name
	var $PageObjName = 'tbl_webpage_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_webpage;
		if ($tbl_webpage->UseTokenInUrl) $PageUrl .= "t=" . $tbl_webpage->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_webpage;
		if ($tbl_webpage->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_webpage->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_webpage->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_webpage_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_webpage)
		$GLOBALS["tbl_webpage"] = new ctbl_webpage();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_webpage', TRUE);

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
		global $tbl_webpage;

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
		global $objForm, $Language, $gsFormError, $tbl_webpage;

		// Load key from QueryString
		if (@$_GET["web_id"] <> "")
			$tbl_webpage->web_id->setQueryStringValue($_GET["web_id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_webpage->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_webpage->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_webpage->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_webpage->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_webpage->web_id->CurrentValue == "")
			$this->Page_Terminate("tbl_webpagelist.php"); // Invalid key, return to list
		switch ($tbl_webpage->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_webpagelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_webpage->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_webpage->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_webpage->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_webpage->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_webpage;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_webpage;
		$tbl_webpage->web_id->setFormValue($objForm->GetValue("x_web_id"));
		$tbl_webpage->site_title->setFormValue($objForm->GetValue("x_site_title"));
		$tbl_webpage->site_keyword->setFormValue($objForm->GetValue("x_site_keyword"));
		$tbl_webpage->site_description->setFormValue($objForm->GetValue("x_site_description"));
		$tbl_webpage->page_name->setFormValue($objForm->GetValue("x_page_name"));
		$tbl_webpage->page_title->setFormValue($objForm->GetValue("x_page_title"));
		$tbl_webpage->descriptions->setFormValue($objForm->GetValue("x_descriptions"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_webpage;
		$this->LoadRow();
		$tbl_webpage->web_id->CurrentValue = $tbl_webpage->web_id->FormValue;
		$tbl_webpage->site_title->CurrentValue = $tbl_webpage->site_title->FormValue;
		$tbl_webpage->site_keyword->CurrentValue = $tbl_webpage->site_keyword->FormValue;
		$tbl_webpage->site_description->CurrentValue = $tbl_webpage->site_description->FormValue;
		$tbl_webpage->page_name->CurrentValue = $tbl_webpage->page_name->FormValue;
		$tbl_webpage->page_title->CurrentValue = $tbl_webpage->page_title->FormValue;
		$tbl_webpage->descriptions->CurrentValue = $tbl_webpage->descriptions->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_webpage;
		$sFilter = $tbl_webpage->KeyFilter();

		// Call Row Selecting event
		$tbl_webpage->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_webpage->CurrentFilter = $sFilter;
		$sSql = $tbl_webpage->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_webpage->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_webpage;
		$tbl_webpage->web_id->setDbValue($rs->fields('web_id'));
		$tbl_webpage->site_title->setDbValue($rs->fields('site_title'));
		$tbl_webpage->site_keyword->setDbValue($rs->fields('site_keyword'));
		$tbl_webpage->site_description->setDbValue($rs->fields('site_description'));
		$tbl_webpage->page_name->setDbValue($rs->fields('page_name'));
		$tbl_webpage->page_title->setDbValue($rs->fields('page_title'));
		$tbl_webpage->descriptions->setDbValue($rs->fields('descriptions'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_webpage;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_webpage->Row_Rendering();

		// Common render codes for all row types
		// web_id

		$tbl_webpage->web_id->CellCssStyle = ""; $tbl_webpage->web_id->CellCssClass = "";
		$tbl_webpage->web_id->CellAttrs = array(); $tbl_webpage->web_id->ViewAttrs = array(); $tbl_webpage->web_id->EditAttrs = array();

		// site_title
		$tbl_webpage->site_title->CellCssStyle = ""; $tbl_webpage->site_title->CellCssClass = "";
		$tbl_webpage->site_title->CellAttrs = array(); $tbl_webpage->site_title->ViewAttrs = array(); $tbl_webpage->site_title->EditAttrs = array();

		// site_keyword
		$tbl_webpage->site_keyword->CellCssStyle = ""; $tbl_webpage->site_keyword->CellCssClass = "";
		$tbl_webpage->site_keyword->CellAttrs = array(); $tbl_webpage->site_keyword->ViewAttrs = array(); $tbl_webpage->site_keyword->EditAttrs = array();

		// site_description
		$tbl_webpage->site_description->CellCssStyle = ""; $tbl_webpage->site_description->CellCssClass = "";
		$tbl_webpage->site_description->CellAttrs = array(); $tbl_webpage->site_description->ViewAttrs = array(); $tbl_webpage->site_description->EditAttrs = array();

		// page_name
		$tbl_webpage->page_name->CellCssStyle = ""; $tbl_webpage->page_name->CellCssClass = "";
		$tbl_webpage->page_name->CellAttrs = array(); $tbl_webpage->page_name->ViewAttrs = array(); $tbl_webpage->page_name->EditAttrs = array();

		// page_title
		$tbl_webpage->page_title->CellCssStyle = ""; $tbl_webpage->page_title->CellCssClass = "";
		$tbl_webpage->page_title->CellAttrs = array(); $tbl_webpage->page_title->ViewAttrs = array(); $tbl_webpage->page_title->EditAttrs = array();

		// descriptions
		$tbl_webpage->descriptions->CellCssStyle = ""; $tbl_webpage->descriptions->CellCssClass = "";
		$tbl_webpage->descriptions->CellAttrs = array(); $tbl_webpage->descriptions->ViewAttrs = array(); $tbl_webpage->descriptions->EditAttrs = array();
		if ($tbl_webpage->RowType == EW_ROWTYPE_VIEW) { // View row

			// web_id
			$tbl_webpage->web_id->ViewValue = $tbl_webpage->web_id->CurrentValue;
			$tbl_webpage->web_id->CssStyle = "";
			$tbl_webpage->web_id->CssClass = "";
			$tbl_webpage->web_id->ViewCustomAttributes = "";

			// site_title
			$tbl_webpage->site_title->ViewValue = $tbl_webpage->site_title->CurrentValue;
			$tbl_webpage->site_title->CssStyle = "";
			$tbl_webpage->site_title->CssClass = "";
			$tbl_webpage->site_title->ViewCustomAttributes = "";

			// site_keyword
			$tbl_webpage->site_keyword->ViewValue = $tbl_webpage->site_keyword->CurrentValue;
			$tbl_webpage->site_keyword->CssStyle = "";
			$tbl_webpage->site_keyword->CssClass = "";
			$tbl_webpage->site_keyword->ViewCustomAttributes = "";

			// site_description
			$tbl_webpage->site_description->ViewValue = $tbl_webpage->site_description->CurrentValue;
			$tbl_webpage->site_description->CssStyle = "";
			$tbl_webpage->site_description->CssClass = "";
			$tbl_webpage->site_description->ViewCustomAttributes = "";

			// page_name
			$tbl_webpage->page_name->ViewValue = $tbl_webpage->page_name->CurrentValue;
			$tbl_webpage->page_name->CssStyle = "";
			$tbl_webpage->page_name->CssClass = "";
			$tbl_webpage->page_name->ViewCustomAttributes = "";

			// page_title
			$tbl_webpage->page_title->ViewValue = $tbl_webpage->page_title->CurrentValue;
			$tbl_webpage->page_title->CssStyle = "";
			$tbl_webpage->page_title->CssClass = "";
			$tbl_webpage->page_title->ViewCustomAttributes = "";

			// descriptions
			$tbl_webpage->descriptions->ViewValue = $tbl_webpage->descriptions->CurrentValue;
			$tbl_webpage->descriptions->CssStyle = "";
			$tbl_webpage->descriptions->CssClass = "";
			$tbl_webpage->descriptions->ViewCustomAttributes = "";

			// web_id
			$tbl_webpage->web_id->HrefValue = "";
			$tbl_webpage->web_id->TooltipValue = "";

			// site_title
			$tbl_webpage->site_title->HrefValue = "";
			$tbl_webpage->site_title->TooltipValue = "";

			// site_keyword
			$tbl_webpage->site_keyword->HrefValue = "";
			$tbl_webpage->site_keyword->TooltipValue = "";

			// site_description
			$tbl_webpage->site_description->HrefValue = "";
			$tbl_webpage->site_description->TooltipValue = "";

			// page_name
			$tbl_webpage->page_name->HrefValue = "";
			$tbl_webpage->page_name->TooltipValue = "";

			// page_title
			$tbl_webpage->page_title->HrefValue = "";
			$tbl_webpage->page_title->TooltipValue = "";

			// descriptions
			$tbl_webpage->descriptions->HrefValue = "";
			$tbl_webpage->descriptions->TooltipValue = "";
		} elseif ($tbl_webpage->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// web_id
			$tbl_webpage->web_id->EditCustomAttributes = "";
			$tbl_webpage->web_id->EditValue = $tbl_webpage->web_id->CurrentValue;
			$tbl_webpage->web_id->CssStyle = "";
			$tbl_webpage->web_id->CssClass = "";
			$tbl_webpage->web_id->ViewCustomAttributes = "";

			// site_title
			$tbl_webpage->site_title->EditCustomAttributes = "";
			$tbl_webpage->site_title->EditValue = ew_HtmlEncode($tbl_webpage->site_title->CurrentValue);

			// site_keyword
			$tbl_webpage->site_keyword->EditCustomAttributes = "";
			$tbl_webpage->site_keyword->EditValue = ew_HtmlEncode($tbl_webpage->site_keyword->CurrentValue);

			// site_description
			$tbl_webpage->site_description->EditCustomAttributes = "";
			$tbl_webpage->site_description->EditValue = ew_HtmlEncode($tbl_webpage->site_description->CurrentValue);

			// page_name
			$tbl_webpage->page_name->EditCustomAttributes = "";
			$tbl_webpage->page_name->EditValue = ew_HtmlEncode($tbl_webpage->page_name->CurrentValue);

			// page_title
			$tbl_webpage->page_title->EditCustomAttributes = "";
			$tbl_webpage->page_title->EditValue = ew_HtmlEncode($tbl_webpage->page_title->CurrentValue);

			// descriptions
			$tbl_webpage->descriptions->EditCustomAttributes = "";
			$tbl_webpage->descriptions->EditValue = ew_HtmlEncode($tbl_webpage->descriptions->CurrentValue);

			// Edit refer script
			// web_id

			$tbl_webpage->web_id->HrefValue = "";

			// site_title
			$tbl_webpage->site_title->HrefValue = "";

			// site_keyword
			$tbl_webpage->site_keyword->HrefValue = "";

			// site_description
			$tbl_webpage->site_description->HrefValue = "";

			// page_name
			$tbl_webpage->page_name->HrefValue = "";

			// page_title
			$tbl_webpage->page_title->HrefValue = "";

			// descriptions
			$tbl_webpage->descriptions->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_webpage->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_webpage->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_webpage;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_webpage->site_title->FormValue) && $tbl_webpage->site_title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_webpage->site_title->FldCaption();
		}
		if (!is_null($tbl_webpage->site_keyword->FormValue) && $tbl_webpage->site_keyword->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_webpage->site_keyword->FldCaption();
		}
		if (!is_null($tbl_webpage->site_description->FormValue) && $tbl_webpage->site_description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_webpage->site_description->FldCaption();
		}
		if (!is_null($tbl_webpage->page_name->FormValue) && $tbl_webpage->page_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_webpage->page_name->FldCaption();
		}
		if (!is_null($tbl_webpage->page_title->FormValue) && $tbl_webpage->page_title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_webpage->page_title->FldCaption();
		}
		if (!is_null($tbl_webpage->descriptions->FormValue) && $tbl_webpage->descriptions->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_webpage->descriptions->FldCaption();
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
		global $conn, $Security, $Language, $tbl_webpage;
		$sFilter = $tbl_webpage->KeyFilter();
		$tbl_webpage->CurrentFilter = $sFilter;
		$sSql = $tbl_webpage->SQL();
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

			// site_title
			$tbl_webpage->site_title->SetDbValueDef($rsnew, $tbl_webpage->site_title->CurrentValue, "", FALSE);

			// site_keyword
			$tbl_webpage->site_keyword->SetDbValueDef($rsnew, $tbl_webpage->site_keyword->CurrentValue, "", FALSE);

			// site_description
			$tbl_webpage->site_description->SetDbValueDef($rsnew, $tbl_webpage->site_description->CurrentValue, "", FALSE);

			// page_name
			$tbl_webpage->page_name->SetDbValueDef($rsnew, $tbl_webpage->page_name->CurrentValue, "", FALSE);

			// page_title
			$tbl_webpage->page_title->SetDbValueDef($rsnew, $tbl_webpage->page_title->CurrentValue, "", FALSE);

			// descriptions
			$tbl_webpage->descriptions->SetDbValueDef($rsnew, $tbl_webpage->descriptions->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_webpage->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_webpage->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_webpage->CancelMessage <> "") {
					$this->setMessage($tbl_webpage->CancelMessage);
					$tbl_webpage->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_webpage->Row_Updated($rsold, $rsnew);
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
