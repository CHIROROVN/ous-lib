<?php
if($_POST['keyword']){
	$keyword = $_POST['keyword'];
	$enc_keyword = urlencode($keyword);
#	echo 'キーワード = ' . $keyword . '<br>';
#	echo 'エンコード = ' . $enc_keyword . '<br>';

	header("Location:http://op00.lib.ous.ac.jp/mylimedio/search/dirsearch.do?target=local&category-book=1&jfgroup=JF%3Dj&location=LO%3D192&keyword=" . $enc_keyword);

}else{
	header("Location:http://www.lib.ous.ac.jp/ebook2/ebook_note.html");
}
?>
