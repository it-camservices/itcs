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
$tbl_experiences_list = new ctbl_experiences_list();
$Page =& $tbl_experiences_list;

// Page init
$tbl_experiences_list->Page_Init();

// Page main
$tbl_experiences_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_experiences->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_experiences_list = new ew_Page("tbl_experiences_list");

// page properties
tbl_experiences_list.PageID = "list"; // page ID
tbl_experiences_list.FormID = "ftbl_experienceslist"; // form ID
var EW_PAGE_ID = tbl_experiences_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_experiences_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_experiences_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_experiences_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($tbl_experiences->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_experiences_list->lTotalRecs = $tbl_experiences->SelectRecordCount();
	} else {
		if ($rs = $tbl_experiences_list->LoadRecordset())
			$tbl_experiences_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_experiences_list->lStartRec = 1;
	if ($tbl_experiences_list->lDisplayRecs <= 0 || ($tbl_experiences->Export <> "" && $tbl_experiences->ExportAll)) // Display all records
		$tbl_experiences_list->lDisplayRecs = $tbl_experiences_list->lTotalRecs;
	if (!($tbl_experiences->Export <> "" && $tbl_experiences->ExportAll))
		$tbl_experiences_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_experiences_list->LoadRecordset($tbl_experiences_list->lStartRec-1, $tbl_experiences_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_experiences->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($tbl_experiences->Export == "" && $tbl_experiences->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_experiences_list);" style="text-decoration: none;"><img id="tbl_experiences_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_experiences_list_SearchPanel">
<form name="ftbl_experienceslistsrch" id="ftbl_experienceslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_experiences">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_experiences->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_experiences_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_experiences->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_experiences->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_experiences->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_experiences_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_experiences->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_experiences->CurrentAction <> "gridadd" && $tbl_experiences->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_experiences_list->Pager)) $tbl_experiences_list->Pager = new cNumericPager($tbl_experiences_list->lStartRec, $tbl_experiences_list->lDisplayRecs, $tbl_experiences_list->lTotalRecs, $tbl_experiences_list->lRecRange) ?>
<?php if ($tbl_experiences_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_experiences_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_experiences_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_experiences_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_experiences_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_experiences_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_experiences_list->sSrchWhere == "0=101") { ?>
	<?php echo $Language->Phrase("EnterSearchCriteria") ?>
	<?php } else { ?>
	<?php echo $Language->Phrase("NoRecord") ?>
	<?php } ?>
<?php } ?>
</span>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_experiences_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_experienceslist" id="ftbl_experienceslist" class="ewForm" action="" method="post">
<div id="gmp_tbl_experiences" class="ewGridMiddlePanel">
<?php if ($tbl_experiences_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_experiences->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_experiences_list->RenderListOptions();

// Render list options (header, left)
$tbl_experiences_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_experiences->name->Visible) { // name ?>
	<?php if ($tbl_experiences->SortUrl($tbl_experiences->name) == "") { ?>
		<td><?php echo $tbl_experiences->name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_experiences->SortUrl($tbl_experiences->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_experiences->name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_experiences->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_experiences->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_experiences->positions->Visible) { // positions ?>
	<?php if ($tbl_experiences->SortUrl($tbl_experiences->positions) == "") { ?>
		<td><?php echo $tbl_experiences->positions->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_experiences->SortUrl($tbl_experiences->positions) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_experiences->positions->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_experiences->positions->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_experiences->positions->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_experiences->photos->Visible) { // photos ?>
	<?php if ($tbl_experiences->SortUrl($tbl_experiences->photos) == "") { ?>
		<td><?php echo $tbl_experiences->photos->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_experiences->SortUrl($tbl_experiences->photos) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_experiences->photos->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_experiences->photos->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_experiences->photos->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_experiences_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tbl_experiences->ExportAll && $tbl_experiences->Export <> "") {
	$tbl_experiences_list->lStopRec = $tbl_experiences_list->lTotalRecs;
} else {
	$tbl_experiences_list->lStopRec = $tbl_experiences_list->lStartRec + $tbl_experiences_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_experiences_list->lRecCount = $tbl_experiences_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_experiences_list->lStartRec > 1)
		$rs->Move($tbl_experiences_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_experiences->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_experiences_list->RenderRow();
$tbl_experiences_list->lRowCnt = 0;
while (($tbl_experiences->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_experiences_list->lRecCount < $tbl_experiences_list->lStopRec) {
	$tbl_experiences_list->lRecCount++;
	if (intval($tbl_experiences_list->lRecCount) >= intval($tbl_experiences_list->lStartRec)) {
		$tbl_experiences_list->lRowCnt++;

	// Init row class and style
	$tbl_experiences->CssClass = "";
	$tbl_experiences->CssStyle = "";
	$tbl_experiences->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_experiences->CurrentAction == "gridadd") {
		$tbl_experiences_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_experiences_list->LoadRowValues($rs); // Load row values
	}
	$tbl_experiences->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$tbl_experiences_list->RenderRow();

	// Render list options
	$tbl_experiences_list->RenderListOptions();
?>
	<tr<?php echo $tbl_experiences->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_experiences_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_experiences->name->Visible) { // name ?>
		<td<?php echo $tbl_experiences->name->CellAttributes() ?>>
<div<?php echo $tbl_experiences->name->ViewAttributes() ?>><?php echo $tbl_experiences->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_experiences->positions->Visible) { // positions ?>
		<td<?php echo $tbl_experiences->positions->CellAttributes() ?>>
<div<?php echo $tbl_experiences->positions->ViewAttributes() ?>><?php echo $tbl_experiences->positions->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_experiences->photos->Visible) { // photos ?>
		<td<?php echo $tbl_experiences->photos->CellAttributes() ?>>
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
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_experiences_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tbl_experiences->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_experiences_list->lTotalRecs > 0) { ?>
<?php if ($tbl_experiences->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_experiences->CurrentAction <> "gridadd" && $tbl_experiences->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_experiences_list->Pager)) $tbl_experiences_list->Pager = new cNumericPager($tbl_experiences_list->lStartRec, $tbl_experiences_list->lDisplayRecs, $tbl_experiences_list->lTotalRecs, $tbl_experiences_list->lRecRange) ?>
<?php if ($tbl_experiences_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_experiences_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_experiences_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_experiences_list->PageUrl() ?>start=<?php echo $tbl_experiences_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_experiences_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_experiences_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_experiences_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_experiences_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_experiences_list->sSrchWhere == "0=101") { ?>
	<?php echo $Language->Phrase("EnterSearchCriteria") ?>
	<?php } else { ?>
	<?php echo $Language->Phrase("NoRecord") ?>
	<?php } ?>
<?php } ?>
</span>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_experiences_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_experiences_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_experiences->Export == "" && $tbl_experiences->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_experiences->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_experiences_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_experiences_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_experiences';

	// Page object name
	var $PageObjName = 'tbl_experiences_list';

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
	function ctbl_experiences_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_experiences)
		$GLOBALS["tbl_experiences"] = new ctbl_experiences();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_experiences"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_experiencesdelete.php";
		$this->MultiUpdateUrl = "tbl_experiencesupdate.php";

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_experiences', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_experiences->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_experiences->Export = $_POST["exporttype"];
		} else {
			$tbl_experiences->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_experiences->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_experiences->TableVar; // Get export file, used in header

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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $tbl_experiences;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$tbl_experiences->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tbl_experiences->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_experiences->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$tbl_experiences->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tbl_experiences->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_experiences->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_experiences->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$tbl_experiences->setSessionWhere($sFilter);
		$tbl_experiences->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tbl_experiences;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_experiences->name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_experiences->positions, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_experiences->photos, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_experiences->sort_text, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_experiences->full_text, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $tbl_experiences;
		$sSearchStr = "";
		$sSearchKeyword = $tbl_experiences->BasicSearchKeyword;
		$sSearchType = $tbl_experiences->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$tbl_experiences->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_experiences->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_experiences;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_experiences->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_experiences;
		$tbl_experiences->setSessionBasicSearchKeyword("");
		$tbl_experiences->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_experiences;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_experiences->BasicSearchKeyword = $tbl_experiences->getSessionBasicSearchKeyword();
			$tbl_experiences->BasicSearchType = $tbl_experiences->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_experiences;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_experiences->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_experiences->CurrentOrderType = @$_GET["ordertype"];
			$tbl_experiences->UpdateSort($tbl_experiences->name); // name
			$tbl_experiences->UpdateSort($tbl_experiences->positions); // positions
			$tbl_experiences->UpdateSort($tbl_experiences->photos); // photos
			$tbl_experiences->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_experiences;
		$sOrderBy = $tbl_experiences->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_experiences->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_experiences->SqlOrderBy();
				$tbl_experiences->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_experiences;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_experiences->setSessionOrderBy($sOrderBy);
				$tbl_experiences->name->setSort("");
				$tbl_experiences->positions->setSort("");
				$tbl_experiences->photos->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_experiences->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_experiences;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_experiences->Export <> "" ||
			$tbl_experiences->CurrentAction == "gridadd" ||
			$tbl_experiences->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_experiences;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_experiences;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_experiences;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_experiences->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_experiences->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_experiences->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_experiences->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_experiences->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_experiences->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_experiences;
		$tbl_experiences->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_experiences->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_experiences;

		// Call Recordset Selecting event
		$tbl_experiences->Recordset_Selecting($tbl_experiences->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_experiences->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_experiences->Recordset_Selected($rs);
		return $rs;
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
		$this->ViewUrl = $tbl_experiences->ViewUrl();
		$this->EditUrl = $tbl_experiences->EditUrl();
		$this->InlineEditUrl = $tbl_experiences->InlineEditUrl();
		$this->CopyUrl = $tbl_experiences->CopyUrl();
		$this->InlineCopyUrl = $tbl_experiences->InlineCopyUrl();
		$this->DeleteUrl = $tbl_experiences->DeleteUrl();

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

			// name
			$tbl_experiences->name->HrefValue = "";
			$tbl_experiences->name->TooltipValue = "";

			// positions
			$tbl_experiences->positions->HrefValue = "";
			$tbl_experiences->positions->TooltipValue = "";

			// photos
			$tbl_experiences->photos->HrefValue = "";
			$tbl_experiences->photos->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_experiences->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_experiences->Row_Rendered();
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
