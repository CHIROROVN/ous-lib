<?php
if($_POST['keyword']){
	$keyword = $_POST['keyword'];
	$enc_keyword = urlencode($keyword);
	header("Location:http://op00.lib.ous.ac.jp/mylimedio/search/dirsearch.do?target=local&category-book=1&jfgroup=JF%3Df&location=LO%3D192&keyword=" . $enc_keyword);
}else{
	header("Location:http://www.lib.ous.ac.jp/ebook2/ebook_note.html");
}
?>
