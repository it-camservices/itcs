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
$tbl_webpage_list = new ctbl_webpage_list();
$Page =& $tbl_webpage_list;

// Page init
$tbl_webpage_list->Page_Init();

// Page main
$tbl_webpage_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_webpage->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_webpage_list = new ew_Page("tbl_webpage_list");

// page properties
tbl_webpage_list.PageID = "list"; // page ID
tbl_webpage_list.FormID = "ftbl_webpagelist"; // form ID
var EW_PAGE_ID = tbl_webpage_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_webpage_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_webpage_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_webpage_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($tbl_webpage->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_webpage_list->lTotalRecs = $tbl_webpage->SelectRecordCount();
	} else {
		if ($rs = $tbl_webpage_list->LoadRecordset())
			$tbl_webpage_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_webpage_list->lStartRec = 1;
	if ($tbl_webpage_list->lDisplayRecs <= 0 || ($tbl_webpage->Export <> "" && $tbl_webpage->ExportAll)) // Display all records
		$tbl_webpage_list->lDisplayRecs = $tbl_webpage_list->lTotalRecs;
	if (!($tbl_webpage->Export <> "" && $tbl_webpage->ExportAll))
		$tbl_webpage_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_webpage_list->LoadRecordset($tbl_webpage_list->lStartRec-1, $tbl_webpage_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_webpage->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($tbl_webpage->Export == "" && $tbl_webpage->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_webpage_list);" style="text-decoration: none;"><img id="tbl_webpage_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_webpage_list_SearchPanel">
<form name="ftbl_webpagelistsrch" id="ftbl_webpagelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_webpage">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_webpage->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_webpage_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_webpage->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_webpage->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_webpage->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_webpage_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_webpage->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_webpage->CurrentAction <> "gridadd" && $tbl_webpage->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_webpage_list->Pager)) $tbl_webpage_list->Pager = new cNumericPager($tbl_webpage_list->lStartRec, $tbl_webpage_list->lDisplayRecs, $tbl_webpage_list->lTotalRecs, $tbl_webpage_list->lRecRange) ?>
<?php if ($tbl_webpage_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_webpage_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_webpage_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_webpage_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_webpage_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_webpage_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_webpage_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $tbl_webpage_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_webpagelist" id="ftbl_webpagelist" class="ewForm" action="" method="post">
<div id="gmp_tbl_webpage" class="ewGridMiddlePanel">
<?php if ($tbl_webpage_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_webpage->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_webpage_list->RenderListOptions();

// Render list options (header, left)
$tbl_webpage_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_webpage->site_title->Visible) { // site_title ?>
	<?php if ($tbl_webpage->SortUrl($tbl_webpage->site_title) == "") { ?>
		<td><?php echo $tbl_webpage->site_title->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_webpage->SortUrl($tbl_webpage->site_title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_webpage->site_title->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_webpage->site_title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_webpage->site_title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_webpage->page_name->Visible) { // page_name ?>
	<?php if ($tbl_webpage->SortUrl($tbl_webpage->page_name) == "") { ?>
		<td><?php echo $tbl_webpage->page_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_webpage->SortUrl($tbl_webpage->page_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_webpage->page_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_webpage->page_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_webpage->page_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_webpage->page_title->Visible) { // page_title ?>
	<?php if ($tbl_webpage->SortUrl($tbl_webpage->page_title) == "") { ?>
		<td><?php echo $tbl_webpage->page_title->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_webpage->SortUrl($tbl_webpage->page_title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_webpage->page_title->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_webpage->page_title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_webpage->page_title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_webpage_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tbl_webpage->ExportAll && $tbl_webpage->Export <> "") {
	$tbl_webpage_list->lStopRec = $tbl_webpage_list->lTotalRecs;
} else {
	$tbl_webpage_list->lStopRec = $tbl_webpage_list->lStartRec + $tbl_webpage_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_webpage_list->lRecCount = $tbl_webpage_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_webpage_list->lStartRec > 1)
		$rs->Move($tbl_webpage_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_webpage->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_webpage_list->RenderRow();
$tbl_webpage_list->lRowCnt = 0;
while (($tbl_webpage->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_webpage_list->lRecCount < $tbl_webpage_list->lStopRec) {
	$tbl_webpage_list->lRecCount++;
	if (intval($tbl_webpage_list->lRecCount) >= intval($tbl_webpage_list->lStartRec)) {
		$tbl_webpage_list->lRowCnt++;

	// Init row class and style
	$tbl_webpage->CssClass = "";
	$tbl_webpage->CssStyle = "";
	$tbl_webpage->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_webpage->CurrentAction == "gridadd") {
		$tbl_webpage_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_webpage_list->LoadRowValues($rs); // Load row values
	}
	$tbl_webpage->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$tbl_webpage_list->RenderRow();

	// Render list options
	$tbl_webpage_list->RenderListOptions();
?>
	<tr<?php echo $tbl_webpage->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_webpage_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_webpage->site_title->Visible) { // site_title ?>
		<td<?php echo $tbl_webpage->site_title->CellAttributes() ?>>
<div<?php echo $tbl_webpage->site_title->ViewAttributes() ?>><?php echo $tbl_webpage->site_title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_webpage->page_name->Visible) { // page_name ?>
		<td<?php echo $tbl_webpage->page_name->CellAttributes() ?>>
<div<?php echo $tbl_webpage->page_name->ViewAttributes() ?>><?php echo $tbl_webpage->page_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_webpage->page_title->Visible) { // page_title ?>
		<td<?php echo $tbl_webpage->page_title->CellAttributes() ?>>
<div<?php echo $tbl_webpage->page_title->ViewAttributes() ?>><?php echo $tbl_webpage->page_title->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_webpage_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tbl_webpage->CurrentAction <> "gridadd")
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
<?php if ($tbl_webpage_list->lTotalRecs > 0) { ?>
<?php if ($tbl_webpage->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_webpage->CurrentAction <> "gridadd" && $tbl_webpage->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_webpage_list->Pager)) $tbl_webpage_list->Pager = new cNumericPager($tbl_webpage_list->lStartRec, $tbl_webpage_list->lDisplayRecs, $tbl_webpage_list->lTotalRecs, $tbl_webpage_list->lRecRange) ?>
<?php if ($tbl_webpage_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_webpage_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_webpage_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_webpage_list->PageUrl() ?>start=<?php echo $tbl_webpage_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_webpage_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_webpage_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_webpage_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_webpage_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_webpage_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($tbl_webpage_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_webpage_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_webpage->Export == "" && $tbl_webpage->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_webpage->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_webpage_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_webpage_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_webpage';

	// Page object name
	var $PageObjName = 'tbl_webpage_list';

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
	function ctbl_webpage_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_webpage)
		$GLOBALS["tbl_webpage"] = new ctbl_webpage();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_webpage"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_webpagedelete.php";
		$this->MultiUpdateUrl = "tbl_webpageupdate.php";

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_webpage', TRUE);

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
		global $tbl_webpage;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_webpage->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_webpage->Export = $_POST["exporttype"];
		} else {
			$tbl_webpage->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_webpage->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_webpage->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_webpage;

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
			$tbl_webpage->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tbl_webpage->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_webpage->getRecordsPerPage(); // Restore from Session
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
		$tbl_webpage->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tbl_webpage->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_webpage->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_webpage->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$tbl_webpage->setSessionWhere($sFilter);
		$tbl_webpage->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tbl_webpage;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_webpage->site_title, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_webpage->site_keyword, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_webpage->site_description, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_webpage->page_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_webpage->page_title, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_webpage->descriptions, $Keyword);
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
		global $Security, $tbl_webpage;
		$sSearchStr = "";
		$sSearchKeyword = $tbl_webpage->BasicSearchKeyword;
		$sSearchType = $tbl_webpage->BasicSearchType;
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
			$tbl_webpage->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_webpage->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_webpage;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_webpage->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_webpage;
		$tbl_webpage->setSessionBasicSearchKeyword("");
		$tbl_webpage->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_webpage;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_webpage->BasicSearchKeyword = $tbl_webpage->getSessionBasicSearchKeyword();
			$tbl_webpage->BasicSearchType = $tbl_webpage->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_webpage;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_webpage->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_webpage->CurrentOrderType = @$_GET["ordertype"];
			$tbl_webpage->UpdateSort($tbl_webpage->site_title); // site_title
			$tbl_webpage->UpdateSort($tbl_webpage->page_name); // page_name
			$tbl_webpage->UpdateSort($tbl_webpage->page_title); // page_title
			$tbl_webpage->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_webpage;
		$sOrderBy = $tbl_webpage->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_webpage->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_webpage->SqlOrderBy();
				$tbl_webpage->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_webpage;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_webpage->setSessionOrderBy($sOrderBy);
				$tbl_webpage->site_title->setSort("");
				$tbl_webpage->page_name->setSort("");
				$tbl_webpage->page_title->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_webpage->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_webpage;

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
		if ($tbl_webpage->Export <> "" ||
			$tbl_webpage->CurrentAction == "gridadd" ||
			$tbl_webpage->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_webpage;
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
		global $Security, $Language, $tbl_webpage;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_webpage;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_webpage->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_webpage->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_webpage->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_webpage->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_webpage->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_webpage->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_webpage;
		$tbl_webpage->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_webpage->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_webpage;

		// Call Recordset Selecting event
		$tbl_webpage->Recordset_Selecting($tbl_webpage->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_webpage->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_webpage->Recordset_Selected($rs);
		return $rs;
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
		$this->ViewUrl = $tbl_webpage->ViewUrl();
		$this->EditUrl = $tbl_webpage->EditUrl();
		$this->InlineEditUrl = $tbl_webpage->InlineEditUrl();
		$this->CopyUrl = $tbl_webpage->CopyUrl();
		$this->InlineCopyUrl = $tbl_webpage->InlineCopyUrl();
		$this->DeleteUrl = $tbl_webpage->DeleteUrl();

		// Call Row_Rendering event
		$tbl_webpage->Row_Rendering();

		// Common render codes for all row types
		// site_title

		$tbl_webpage->site_title->CellCssStyle = ""; $tbl_webpage->site_title->CellCssClass = "";
		$tbl_webpage->site_title->CellAttrs = array(); $tbl_webpage->site_title->ViewAttrs = array(); $tbl_webpage->site_title->EditAttrs = array();

		// page_name
		$tbl_webpage->page_name->CellCssStyle = ""; $tbl_webpage->page_name->CellCssClass = "";
		$tbl_webpage->page_name->CellAttrs = array(); $tbl_webpage->page_name->ViewAttrs = array(); $tbl_webpage->page_name->EditAttrs = array();

		// page_title
		$tbl_webpage->page_title->CellCssStyle = ""; $tbl_webpage->page_title->CellCssClass = "";
		$tbl_webpage->page_title->CellAttrs = array(); $tbl_webpage->page_title->ViewAttrs = array(); $tbl_webpage->page_title->EditAttrs = array();
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

			// site_title
			$tbl_webpage->site_title->HrefValue = "";
			$tbl_webpage->site_title->TooltipValue = "";

			// page_name
			$tbl_webpage->page_name->HrefValue = "";
			$tbl_webpage->page_name->TooltipValue = "";

			// page_title
			$tbl_webpage->page_title->HrefValue = "";
			$tbl_webpage->page_title->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_webpage->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_webpage->Row_Rendered();
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
