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
$tbl_slide_list = new ctbl_slide_list();
$Page =& $tbl_slide_list;

// Page init
$tbl_slide_list->Page_Init();

// Page main
$tbl_slide_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_slide->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_slide_list = new ew_Page("tbl_slide_list");

// page properties
tbl_slide_list.PageID = "list"; // page ID
tbl_slide_list.FormID = "ftbl_slidelist"; // form ID
var EW_PAGE_ID = tbl_slide_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_slide_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_slide_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_slide_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($tbl_slide->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_slide_list->lTotalRecs = $tbl_slide->SelectRecordCount();
	} else {
		if ($rs = $tbl_slide_list->LoadRecordset())
			$tbl_slide_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_slide_list->lStartRec = 1;
	if ($tbl_slide_list->lDisplayRecs <= 0 || ($tbl_slide->Export <> "" && $tbl_slide->ExportAll)) // Display all records
		$tbl_slide_list->lDisplayRecs = $tbl_slide_list->lTotalRecs;
	if (!($tbl_slide->Export <> "" && $tbl_slide->ExportAll))
		$tbl_slide_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_slide_list->LoadRecordset($tbl_slide_list->lStartRec-1, $tbl_slide_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_slide->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($tbl_slide->Export == "" && $tbl_slide->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_slide_list);" style="text-decoration: none;"><img id="tbl_slide_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_slide_list_SearchPanel">
<form name="ftbl_slidelistsrch" id="ftbl_slidelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_slide">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_slide->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_slide_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_slide->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_slide->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_slide->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_slide_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_slide->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_slide->CurrentAction <> "gridadd" && $tbl_slide->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_slide_list->Pager)) $tbl_slide_list->Pager = new cNumericPager($tbl_slide_list->lStartRec, $tbl_slide_list->lDisplayRecs, $tbl_slide_list->lTotalRecs, $tbl_slide_list->lRecRange) ?>
<?php if ($tbl_slide_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_slide_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_slide_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_slide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_slide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_slide_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_slide_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $tbl_slide_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_slidelist" id="ftbl_slidelist" class="ewForm" action="" method="post">
<div id="gmp_tbl_slide" class="ewGridMiddlePanel">
<?php if ($tbl_slide_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_slide->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_slide_list->RenderListOptions();

// Render list options (header, left)
$tbl_slide_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_slide->title->Visible) { // title ?>
	<?php if ($tbl_slide->SortUrl($tbl_slide->title) == "") { ?>
		<td><?php echo $tbl_slide->title->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_slide->SortUrl($tbl_slide->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_slide->title->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_slide->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_slide->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_slide->images->Visible) { // images ?>
	<?php if ($tbl_slide->SortUrl($tbl_slide->images) == "") { ?>
		<td><?php echo $tbl_slide->images->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_slide->SortUrl($tbl_slide->images) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_slide->images->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_slide->images->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_slide->images->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_slide->order_by->Visible) { // order_by ?>
	<?php if ($tbl_slide->SortUrl($tbl_slide->order_by) == "") { ?>
		<td><?php echo $tbl_slide->order_by->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_slide->SortUrl($tbl_slide->order_by) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_slide->order_by->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_slide->order_by->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_slide->order_by->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_slide_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tbl_slide->ExportAll && $tbl_slide->Export <> "") {
	$tbl_slide_list->lStopRec = $tbl_slide_list->lTotalRecs;
} else {
	$tbl_slide_list->lStopRec = $tbl_slide_list->lStartRec + $tbl_slide_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_slide_list->lRecCount = $tbl_slide_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_slide_list->lStartRec > 1)
		$rs->Move($tbl_slide_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_slide->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_slide_list->RenderRow();
$tbl_slide_list->lRowCnt = 0;
while (($tbl_slide->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_slide_list->lRecCount < $tbl_slide_list->lStopRec) {
	$tbl_slide_list->lRecCount++;
	if (intval($tbl_slide_list->lRecCount) >= intval($tbl_slide_list->lStartRec)) {
		$tbl_slide_list->lRowCnt++;

	// Init row class and style
	$tbl_slide->CssClass = "";
	$tbl_slide->CssStyle = "";
	$tbl_slide->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_slide->CurrentAction == "gridadd") {
		$tbl_slide_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_slide_list->LoadRowValues($rs); // Load row values
	}
	$tbl_slide->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$tbl_slide_list->RenderRow();

	// Render list options
	$tbl_slide_list->RenderListOptions();
?>
	<tr<?php echo $tbl_slide->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_slide_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_slide->title->Visible) { // title ?>
		<td<?php echo $tbl_slide->title->CellAttributes() ?>>
<div<?php echo $tbl_slide->title->ViewAttributes() ?>><?php echo $tbl_slide->title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_slide->images->Visible) { // images ?>
		<td<?php echo $tbl_slide->images->CellAttributes() ?>>
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
</td>
	<?php } ?>
	<?php if ($tbl_slide->order_by->Visible) { // order_by ?>
		<td<?php echo $tbl_slide->order_by->CellAttributes() ?>>
<div<?php echo $tbl_slide->order_by->ViewAttributes() ?>><?php echo $tbl_slide->order_by->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_slide_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tbl_slide->CurrentAction <> "gridadd")
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
<?php if ($tbl_slide_list->lTotalRecs > 0) { ?>
<?php if ($tbl_slide->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_slide->CurrentAction <> "gridadd" && $tbl_slide->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_slide_list->Pager)) $tbl_slide_list->Pager = new cNumericPager($tbl_slide_list->lStartRec, $tbl_slide_list->lDisplayRecs, $tbl_slide_list->lTotalRecs, $tbl_slide_list->lRecRange) ?>
<?php if ($tbl_slide_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_slide_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_slide_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_slide_list->PageUrl() ?>start=<?php echo $tbl_slide_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_slide_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_slide_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_slide_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_slide_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_slide_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($tbl_slide_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_slide_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_slide->Export == "" && $tbl_slide->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_slide->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_slide_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_slide_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_slide';

	// Page object name
	var $PageObjName = 'tbl_slide_list';

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
	function ctbl_slide_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_slide)
		$GLOBALS["tbl_slide"] = new ctbl_slide();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_slide"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_slidedelete.php";
		$this->MultiUpdateUrl = "tbl_slideupdate.php";

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_slide', TRUE);

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
		global $tbl_slide;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_slide->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_slide->Export = $_POST["exporttype"];
		} else {
			$tbl_slide->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_slide->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_slide->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_slide;

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
			$tbl_slide->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tbl_slide->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_slide->getRecordsPerPage(); // Restore from Session
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
		$tbl_slide->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tbl_slide->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_slide->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_slide->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$tbl_slide->setSessionWhere($sFilter);
		$tbl_slide->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tbl_slide;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_slide->title, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_slide->images, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_slide->description, $Keyword);
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
		global $Security, $tbl_slide;
		$sSearchStr = "";
		$sSearchKeyword = $tbl_slide->BasicSearchKeyword;
		$sSearchType = $tbl_slide->BasicSearchType;
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
			$tbl_slide->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_slide->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_slide;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_slide->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_slide;
		$tbl_slide->setSessionBasicSearchKeyword("");
		$tbl_slide->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_slide;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_slide->BasicSearchKeyword = $tbl_slide->getSessionBasicSearchKeyword();
			$tbl_slide->BasicSearchType = $tbl_slide->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_slide;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_slide->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_slide->CurrentOrderType = @$_GET["ordertype"];
			$tbl_slide->UpdateSort($tbl_slide->title); // title
			$tbl_slide->UpdateSort($tbl_slide->images); // images
			$tbl_slide->UpdateSort($tbl_slide->order_by); // order_by
			$tbl_slide->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_slide;
		$sOrderBy = $tbl_slide->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_slide->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_slide->SqlOrderBy();
				$tbl_slide->setSessionOrderBy($sOrderBy);
				$tbl_slide->order_by->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_slide;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_slide->setSessionOrderBy($sOrderBy);
				$tbl_slide->title->setSort("");
				$tbl_slide->images->setSort("");
				$tbl_slide->order_by->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_slide->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_slide;

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
		if ($tbl_slide->Export <> "" ||
			$tbl_slide->CurrentAction == "gridadd" ||
			$tbl_slide->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_slide;
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
		global $Security, $Language, $tbl_slide;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_slide;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_slide->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_slide->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_slide->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_slide->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_slide->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_slide->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_slide;
		$tbl_slide->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_slide->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_slide;

		// Call Recordset Selecting event
		$tbl_slide->Recordset_Selecting($tbl_slide->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_slide->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_slide->Recordset_Selected($rs);
		return $rs;
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
		$this->ViewUrl = $tbl_slide->ViewUrl();
		$this->EditUrl = $tbl_slide->EditUrl();
		$this->InlineEditUrl = $tbl_slide->InlineEditUrl();
		$this->CopyUrl = $tbl_slide->CopyUrl();
		$this->InlineCopyUrl = $tbl_slide->InlineCopyUrl();
		$this->DeleteUrl = $tbl_slide->DeleteUrl();

		// Call Row_Rendering event
		$tbl_slide->Row_Rendering();

		// Common render codes for all row types
		// title

		$tbl_slide->title->CellCssStyle = ""; $tbl_slide->title->CellCssClass = "";
		$tbl_slide->title->CellAttrs = array(); $tbl_slide->title->ViewAttrs = array(); $tbl_slide->title->EditAttrs = array();

		// images
		$tbl_slide->images->CellCssStyle = ""; $tbl_slide->images->CellCssClass = "";
		$tbl_slide->images->CellAttrs = array(); $tbl_slide->images->ViewAttrs = array(); $tbl_slide->images->EditAttrs = array();

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

			// order_by
			$tbl_slide->order_by->ViewValue = $tbl_slide->order_by->CurrentValue;
			$tbl_slide->order_by->CssStyle = "";
			$tbl_slide->order_by->CssClass = "";
			$tbl_slide->order_by->ViewCustomAttributes = "";

			// title
			$tbl_slide->title->HrefValue = "";
			$tbl_slide->title->TooltipValue = "";

			// images
			$tbl_slide->images->HrefValue = "";
			$tbl_slide->images->TooltipValue = "";

			// order_by
			$tbl_slide->order_by->HrefValue = "";
			$tbl_slide->order_by->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_slide->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_slide->Row_Rendered();
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
