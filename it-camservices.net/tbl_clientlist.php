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
$tbl_client_list = new ctbl_client_list();
$Page =& $tbl_client_list;

// Page init
$tbl_client_list->Page_Init();

// Page main
$tbl_client_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_client->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_client_list = new ew_Page("tbl_client_list");

// page properties
tbl_client_list.PageID = "list"; // page ID
tbl_client_list.FormID = "ftbl_clientlist"; // form ID
var EW_PAGE_ID = tbl_client_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_client_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_client_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_client_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($tbl_client->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_client_list->lTotalRecs = $tbl_client->SelectRecordCount();
	} else {
		if ($rs = $tbl_client_list->LoadRecordset())
			$tbl_client_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_client_list->lStartRec = 1;
	if ($tbl_client_list->lDisplayRecs <= 0 || ($tbl_client->Export <> "" && $tbl_client->ExportAll)) // Display all records
		$tbl_client_list->lDisplayRecs = $tbl_client_list->lTotalRecs;
	if (!($tbl_client->Export <> "" && $tbl_client->ExportAll))
		$tbl_client_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_client_list->LoadRecordset($tbl_client_list->lStartRec-1, $tbl_client_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_client->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($tbl_client->Export == "" && $tbl_client->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_client_list);" style="text-decoration: none;"><img id="tbl_client_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_client_list_SearchPanel">
<form name="ftbl_clientlistsrch" id="ftbl_clientlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_client">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_client->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_client_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_client->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_client->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_client->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_client_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_client->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_client->CurrentAction <> "gridadd" && $tbl_client->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_client_list->Pager)) $tbl_client_list->Pager = new cNumericPager($tbl_client_list->lStartRec, $tbl_client_list->lDisplayRecs, $tbl_client_list->lTotalRecs, $tbl_client_list->lRecRange) ?>
<?php if ($tbl_client_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_client_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_client_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_client_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_client_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_client_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_client_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $tbl_client_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_clientlist" id="ftbl_clientlist" class="ewForm" action="" method="post">
<div id="gmp_tbl_client" class="ewGridMiddlePanel">
<?php if ($tbl_client_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_client->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_client_list->RenderListOptions();

// Render list options (header, left)
$tbl_client_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_client->client_id->Visible) { // client_id ?>
	<?php if ($tbl_client->SortUrl($tbl_client->client_id) == "") { ?>
		<td><?php echo $tbl_client->client_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_client->SortUrl($tbl_client->client_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_client->client_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_client->client_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_client->client_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_client->cate_id->Visible) { // cate_id ?>
	<?php if ($tbl_client->SortUrl($tbl_client->cate_id) == "") { ?>
		<td><?php echo $tbl_client->cate_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_client->SortUrl($tbl_client->cate_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_client->cate_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_client->cate_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_client->cate_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_client->client_name->Visible) { // client_name ?>
	<?php if ($tbl_client->SortUrl($tbl_client->client_name) == "") { ?>
		<td><?php echo $tbl_client->client_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_client->SortUrl($tbl_client->client_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_client->client_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_client->client_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_client->client_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_client->photo->Visible) { // photo ?>
	<?php if ($tbl_client->SortUrl($tbl_client->photo) == "") { ?>
		<td><?php echo $tbl_client->photo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_client->SortUrl($tbl_client->photo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_client->photo->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_client->photo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_client->photo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_client->link->Visible) { // link ?>
	<?php if ($tbl_client->SortUrl($tbl_client->link) == "") { ?>
		<td><?php echo $tbl_client->link->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_client->SortUrl($tbl_client->link) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_client->link->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_client->link->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_client->link->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_client->order_by->Visible) { // order_by ?>
	<?php if ($tbl_client->SortUrl($tbl_client->order_by) == "") { ?>
		<td><?php echo $tbl_client->order_by->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_client->SortUrl($tbl_client->order_by) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_client->order_by->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_client->order_by->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_client->order_by->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_client_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tbl_client->ExportAll && $tbl_client->Export <> "") {
	$tbl_client_list->lStopRec = $tbl_client_list->lTotalRecs;
} else {
	$tbl_client_list->lStopRec = $tbl_client_list->lStartRec + $tbl_client_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_client_list->lRecCount = $tbl_client_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_client_list->lStartRec > 1)
		$rs->Move($tbl_client_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_client->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_client_list->RenderRow();
$tbl_client_list->lRowCnt = 0;
while (($tbl_client->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_client_list->lRecCount < $tbl_client_list->lStopRec) {
	$tbl_client_list->lRecCount++;
	if (intval($tbl_client_list->lRecCount) >= intval($tbl_client_list->lStartRec)) {
		$tbl_client_list->lRowCnt++;

	// Init row class and style
	$tbl_client->CssClass = "";
	$tbl_client->CssStyle = "";
	$tbl_client->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_client->CurrentAction == "gridadd") {
		$tbl_client_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_client_list->LoadRowValues($rs); // Load row values
	}
	$tbl_client->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$tbl_client_list->RenderRow();

	// Render list options
	$tbl_client_list->RenderListOptions();
?>
	<tr<?php echo $tbl_client->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_client_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_client->client_id->Visible) { // client_id ?>
		<td<?php echo $tbl_client->client_id->CellAttributes() ?>>
<div<?php echo $tbl_client->client_id->ViewAttributes() ?>><?php echo $tbl_client->client_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_client->cate_id->Visible) { // cate_id ?>
		<td<?php echo $tbl_client->cate_id->CellAttributes() ?>>
<div<?php echo $tbl_client->cate_id->ViewAttributes() ?>><?php echo $tbl_client->cate_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_client->client_name->Visible) { // client_name ?>
		<td<?php echo $tbl_client->client_name->CellAttributes() ?>>
<div<?php echo $tbl_client->client_name->ViewAttributes() ?>><?php echo $tbl_client->client_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_client->photo->Visible) { // photo ?>
		<td<?php echo $tbl_client->photo->CellAttributes() ?>>
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
</td>
	<?php } ?>
	<?php if ($tbl_client->link->Visible) { // link ?>
		<td<?php echo $tbl_client->link->CellAttributes() ?>>
<div<?php echo $tbl_client->link->ViewAttributes() ?>><?php echo $tbl_client->link->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_client->order_by->Visible) { // order_by ?>
		<td<?php echo $tbl_client->order_by->CellAttributes() ?>>
<div<?php echo $tbl_client->order_by->ViewAttributes() ?>><?php echo $tbl_client->order_by->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_client_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tbl_client->CurrentAction <> "gridadd")
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
<?php if ($tbl_client_list->lTotalRecs > 0) { ?>
<?php if ($tbl_client->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_client->CurrentAction <> "gridadd" && $tbl_client->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($tbl_client_list->Pager)) $tbl_client_list->Pager = new cNumericPager($tbl_client_list->lStartRec, $tbl_client_list->lDisplayRecs, $tbl_client_list->lTotalRecs, $tbl_client_list->lRecRange) ?>
<?php if ($tbl_client_list->Pager->RecordCount > 0) { ?>
	<?php if ($tbl_client_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->FirstButton->Start ?>"><b><?php echo $Language->Phrase("PagerFirst") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->PrevButton->Start ?>"><b><?php echo $Language->Phrase("PagerPrevious") ?></b></a>&nbsp;
	<?php } ?>
	<?php foreach ($tbl_client_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->NextButton->Start ?>"><b><?php echo $Language->Phrase("PagerNext") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $tbl_client_list->PageUrl() ?>start=<?php echo $tbl_client_list->Pager->LastButton->Start ?>"><b><?php echo $Language->Phrase("PagerLast") ?></b></a>&nbsp;
	<?php } ?>
	<?php if ($tbl_client_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_client_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_client_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_client_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($tbl_client_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($tbl_client_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $tbl_client_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_client->Export == "" && $tbl_client->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_client->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_client_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_client_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_client';

	// Page object name
	var $PageObjName = 'tbl_client_list';

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
	function ctbl_client_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_client)
		$GLOBALS["tbl_client"] = new ctbl_client();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_client"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_clientdelete.php";
		$this->MultiUpdateUrl = "tbl_clientupdate.php";

		// Table object (tbl_admin)
		$GLOBALS['tbl_admin'] = new ctbl_admin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_client', TRUE);

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
		global $tbl_client;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_client->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_client->Export = $_POST["exporttype"];
		} else {
			$tbl_client->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_client->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_client->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_client;

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
			$tbl_client->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tbl_client->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_client->getRecordsPerPage(); // Restore from Session
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
		$tbl_client->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tbl_client->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_client->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_client->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$tbl_client->setSessionWhere($sFilter);
		$tbl_client->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tbl_client;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_client->client_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_client->photo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_client->link, $Keyword);
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
		global $Security, $tbl_client;
		$sSearchStr = "";
		$sSearchKeyword = $tbl_client->BasicSearchKeyword;
		$sSearchType = $tbl_client->BasicSearchType;
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
			$tbl_client->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_client->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_client;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_client->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_client;
		$tbl_client->setSessionBasicSearchKeyword("");
		$tbl_client->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_client;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_client->BasicSearchKeyword = $tbl_client->getSessionBasicSearchKeyword();
			$tbl_client->BasicSearchType = $tbl_client->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_client;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_client->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_client->CurrentOrderType = @$_GET["ordertype"];
			$tbl_client->UpdateSort($tbl_client->client_id); // client_id
			$tbl_client->UpdateSort($tbl_client->cate_id); // cate_id
			$tbl_client->UpdateSort($tbl_client->client_name); // client_name
			$tbl_client->UpdateSort($tbl_client->photo); // photo
			$tbl_client->UpdateSort($tbl_client->link); // link
			$tbl_client->UpdateSort($tbl_client->order_by); // order_by
			$tbl_client->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_client;
		$sOrderBy = $tbl_client->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_client->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_client->SqlOrderBy();
				$tbl_client->setSessionOrderBy($sOrderBy);
				$tbl_client->order_by->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_client;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_client->setSessionOrderBy($sOrderBy);
				$tbl_client->client_id->setSort("");
				$tbl_client->cate_id->setSort("");
				$tbl_client->client_name->setSort("");
				$tbl_client->photo->setSort("");
				$tbl_client->link->setSort("");
				$tbl_client->order_by->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_client->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_client;

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
		if ($tbl_client->Export <> "" ||
			$tbl_client->CurrentAction == "gridadd" ||
			$tbl_client->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_client;
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
		global $Security, $Language, $tbl_client;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_client;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_client->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_client->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_client->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_client->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_client->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_client->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_client;
		$tbl_client->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_client->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_client;

		// Call Recordset Selecting event
		$tbl_client->Recordset_Selecting($tbl_client->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_client->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_client->Recordset_Selected($rs);
		return $rs;
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
		$this->ViewUrl = $tbl_client->ViewUrl();
		$this->EditUrl = $tbl_client->EditUrl();
		$this->InlineEditUrl = $tbl_client->InlineEditUrl();
		$this->CopyUrl = $tbl_client->CopyUrl();
		$this->InlineCopyUrl = $tbl_client->InlineCopyUrl();
		$this->DeleteUrl = $tbl_client->DeleteUrl();

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
		}

		// Call Row Rendered event
		if ($tbl_client->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_client->Row_Rendered();
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
