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
$tbl_client_edit = new ctbl_client_edit();
$Page =& $tbl_client_edit;

// Page init
$tbl_client_edit->Page_Init();

// Page main
$tbl_client_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_client_edit = new ew_Page("tbl_client_edit");

// page properties
tbl_client_edit.PageID = "edit"; // page ID
tbl_client_edit.FormID = "ftbl_clientedit"; // form ID
var EW_PAGE_ID = tbl_client_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_client_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_cate_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_client->cate_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_client_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_client->client_name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_photo"];
		aelm = fobj.elements["a" + infix + "_photo"];
		var chk_photo = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_photo && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_client->photo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_photo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_link"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_client->link->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_order_by"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_client->order_by->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_order_by"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_client->order_by->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_client_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_client_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_client_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_client->TableCaption() ?><br><br>
<a href="<?php echo $tbl_client->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_client_edit->ShowMessage();
?>
<form name="ftbl_clientedit" id="ftbl_clientedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return tbl_client_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_client">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_client->client_id->Visible) { // client_id ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->client_id->FldCaption() ?></td>
		<td<?php echo $tbl_client->client_id->CellAttributes() ?>><span id="el_client_id">
<div<?php echo $tbl_client->client_id->ViewAttributes() ?>><?php echo $tbl_client->client_id->EditValue ?></div><input type="hidden" name="x_client_id" id="x_client_id" value="<?php echo ew_HtmlEncode($tbl_client->client_id->CurrentValue) ?>">
</span><?php echo $tbl_client->client_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->cate_id->Visible) { // cate_id ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->cate_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_client->cate_id->CellAttributes() ?>><span id="el_cate_id">
<select id="x_cate_id" name="x_cate_id" title="<?php echo $tbl_client->cate_id->FldTitle() ?>"<?php echo $tbl_client->cate_id->EditAttributes() ?>>
<?php
if (is_array($tbl_client->cate_id->EditValue)) {
	$arwrk = $tbl_client->cate_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_client->cate_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `cate_id`, `cate_name`, '' AS Disp2Fld FROM `tbl_client_category`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_cate_id" id="s_x_cate_id" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_cate_id" id="lft_x_cate_id" value="">
</span><?php echo $tbl_client->cate_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->client_name->Visible) { // client_name ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->client_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_client->client_name->CellAttributes() ?>><span id="el_client_name">
<input type="text" name="x_client_name" id="x_client_name" title="<?php echo $tbl_client->client_name->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_client->client_name->EditValue ?>"<?php echo $tbl_client->client_name->EditAttributes() ?>>
</span><?php echo $tbl_client->client_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->photo->Visible) { // photo ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->photo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_client->photo->CellAttributes() ?>><span id="el_photo">
<div id="old_x_photo">
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
</div>
<div id="new_x_photo">
<?php if (!empty($tbl_client->photo->Upload->DbValue)) { ?>
<label><input type="radio" name="a_photo" id="a_photo" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_photo" id="a_photo" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_photo" id="a_photo" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $tbl_client->photo->EditAttrs["onchange"] = "this.form.a_photo[2].checked=true;" . @$tbl_client->photo->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_photo" id="a_photo" value="3">
<?php } ?>
<input type="file" name="x_photo" id="x_photo" title="<?php echo $tbl_client->photo->FldTitle() ?>" size="30"<?php echo $tbl_client->photo->EditAttributes() ?>>
</div>
</span><?php echo $tbl_client->photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->link->Visible) { // link ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->link->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_client->link->CellAttributes() ?>><span id="el_link">
<input type="text" name="x_link" id="x_link" title="<?php echo $tbl_client->link->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $tbl_client->link->EditValue ?>"<?php echo $tbl_client->link->EditAttributes() ?>>
</span><?php echo $tbl_client->link->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_client->order_by->Visible) { // order_by ?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tbl_client->order_by->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_client->order_by->CellAttributes() ?>><span id="el_order_by">
<input type="text" name="x_order_by" id="x_order_by" title="<?php echo $tbl_client->order_by->FldTitle() ?>" size="30" value="<?php echo $tbl_client->order_by->EditValue ?>"<?php echo $tbl_client->order_by->EditAttributes() ?>>
</span><?php echo $tbl_client->order_by->CustomMsg ?></td>
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
ew_UpdateOpts([['x_cate_id','x_cate_id',false]]);

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
$tbl_client_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_client_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_client';

	// Page object name
	var $PageObjName = 'tbl_client_edit';

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
	function ctbl_client_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_client)
		$GLOBALS["tbl_client"] = new ctbl_client();

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $tbl_client;

		// Load key from QueryString
		if (@$_GET["client_id"] <> "")
			$tbl_client->client_id->setQueryStringValue($_GET["client_id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_client->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_client->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_client->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_client->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_client->client_id->CurrentValue == "")
			$this->Page_Terminate("tbl_clientlist.php"); // Invalid key, return to list
		switch ($tbl_client->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_clientlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_client->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_client->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_client->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_client->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_client;

		// Get upload data
			if ($tbl_client->photo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $tbl_client->photo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_client;
		$tbl_client->client_id->setFormValue($objForm->GetValue("x_client_id"));
		$tbl_client->cate_id->setFormValue($objForm->GetValue("x_cate_id"));
		$tbl_client->client_name->setFormValue($objForm->GetValue("x_client_name"));
		$tbl_client->link->setFormValue($objForm->GetValue("x_link"));
		$tbl_client->order_by->setFormValue($objForm->GetValue("x_order_by"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_client;
		$this->LoadRow();
		$tbl_client->client_id->CurrentValue = $tbl_client->client_id->FormValue;
		$tbl_client->cate_id->CurrentValue = $tbl_client->cate_id->FormValue;
		$tbl_client->client_name->CurrentValue = $tbl_client->client_name->FormValue;
		$tbl_client->link->CurrentValue = $tbl_client->link->FormValue;
		$tbl_client->order_by->CurrentValue = $tbl_client->order_by->FormValue;
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
		} elseif ($tbl_client->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// client_id
			$tbl_client->client_id->EditCustomAttributes = "";
			$tbl_client->client_id->EditValue = $tbl_client->client_id->CurrentValue;
			$tbl_client->client_id->CssStyle = "";
			$tbl_client->client_id->CssClass = "";
			$tbl_client->client_id->ViewCustomAttributes = "";

			// cate_id
			$tbl_client->cate_id->EditCustomAttributes = "";
			if (trim(strval($tbl_client->cate_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`cate_id` = " . ew_AdjustSql($tbl_client->cate_id->CurrentValue) . "";
			}
			$sSqlWrk = "SELECT `cate_id`, `cate_name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `tbl_client_category`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$tbl_client->cate_id->EditValue = $arwrk;

			// client_name
			$tbl_client->client_name->EditCustomAttributes = "";
			$tbl_client->client_name->EditValue = ew_HtmlEncode($tbl_client->client_name->CurrentValue);

			// photo
			$tbl_client->photo->EditCustomAttributes = "";
			if (!ew_Empty($tbl_client->photo->Upload->DbValue)) {
				$tbl_client->photo->EditValue = $tbl_client->photo->Upload->DbValue;
				$tbl_client->photo->ImageWidth = 300;
				$tbl_client->photo->ImageHeight = 200;
				$tbl_client->photo->ImageAlt = $tbl_client->photo->FldAlt();
			} else {
				$tbl_client->photo->EditValue = "";
			}

			// link
			$tbl_client->link->EditCustomAttributes = "";
			$tbl_client->link->EditValue = ew_HtmlEncode($tbl_client->link->CurrentValue);

			// order_by
			$tbl_client->order_by->EditCustomAttributes = "";
			$tbl_client->order_by->EditValue = ew_HtmlEncode($tbl_client->order_by->CurrentValue);

			// Edit refer script
			// client_id

			$tbl_client->client_id->HrefValue = "";

			// cate_id
			$tbl_client->cate_id->HrefValue = "";

			// client_name
			$tbl_client->client_name->HrefValue = "";

			// photo
			$tbl_client->photo->HrefValue = "";

			// link
			$tbl_client->link->HrefValue = "";

			// order_by
			$tbl_client->order_by->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_client->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_client->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_client;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($tbl_client->photo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($tbl_client->photo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $tbl_client->photo->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($tbl_client->photo->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $tbl_client->photo->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_client->cate_id->FormValue) && $tbl_client->cate_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_client->cate_id->FldCaption();
		}
		if (!is_null($tbl_client->client_name->FormValue) && $tbl_client->client_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_client->client_name->FldCaption();
		}
		if ($tbl_client->photo->Upload->Action == "3" && is_null($tbl_client->photo->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_client->photo->FldCaption();
		}
		if (!is_null($tbl_client->link->FormValue) && $tbl_client->link->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_client->link->FldCaption();
		}
		if (!is_null($tbl_client->order_by->FormValue) && $tbl_client->order_by->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_client->order_by->FldCaption();
		}
		if (!ew_CheckInteger($tbl_client->order_by->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_client->order_by->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_client;
		$sFilter = $tbl_client->KeyFilter();
		$tbl_client->CurrentFilter = $sFilter;
		$sSql = $tbl_client->SQL();
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

			// cate_id
			$tbl_client->cate_id->SetDbValueDef($rsnew, $tbl_client->cate_id->CurrentValue, 0, FALSE);

			// client_name
			$tbl_client->client_name->SetDbValueDef($rsnew, $tbl_client->client_name->CurrentValue, "", FALSE);

			// photo
			$tbl_client->photo->Upload->SaveToSession(); // Save file value to Session
						if ($tbl_client->photo->Upload->Action == "2" || $tbl_client->photo->Upload->Action == "3") { // Update/Remove
			$tbl_client->photo->Upload->DbValue = $rs->fields('photo'); // Get original value
			if (is_null($tbl_client->photo->Upload->Value)) {
				$rsnew['photo'] = NULL;
			} else {
				$rsnew['photo'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $tbl_client->photo->UploadPath), $tbl_client->photo->Upload->FileName);
			}
			$tbl_client->photo->ImageWidth = 300; // Resize width
			$tbl_client->photo->ImageHeight = 200; // Resize height
			}

			// link
			$tbl_client->link->SetDbValueDef($rsnew, $tbl_client->link->CurrentValue, "", FALSE);

			// order_by
			$tbl_client->order_by->SetDbValueDef($rsnew, $tbl_client->order_by->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_client->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($tbl_client->photo->Upload->Value)) {
				$tbl_client->photo->Upload->RestoreFromSession(); // Restore original value
				$tbl_client->photo->Upload->Resize($tbl_client->photo->ImageWidth, $tbl_client->photo->ImageHeight, 75);
			}
			$tbl_client->photo->ImageWidth = 0; // Reset image width
			$tbl_client->photo->ImageHeight = 0; // Reset image height
			if (!ew_Empty($tbl_client->photo->Upload->Value)) {
				$tbl_client->photo->Upload->SaveToFile($tbl_client->photo->UploadPath, $rsnew['photo'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_client->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_client->CancelMessage <> "") {
					$this->setMessage($tbl_client->CancelMessage);
					$tbl_client->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_client->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// photo
		$tbl_client->photo->Upload->RemoveFromSession(); // Remove file value from Session
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
