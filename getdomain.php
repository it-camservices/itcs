<?php
if($_POST['submitbtn']){
    $nama_domain = "$_POST[domain]"."$_POST[suffix]";
    $arrHost = @gethostbynamel("$nama_domain");
  
    if(empty($arrHost)){
        echo "Domain $nama_domain is available, <a href='#'>Pesan Sekarang</a>.";
    }else{
        echo "Domain $nama_domain is not available.";
    }
}
?>