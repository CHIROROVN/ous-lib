#

# Windows用 Perl プログラム
#==============================================================
# 　「りとにゅーす」用ホームページ構成ファイル作成プログラム
#==============================================================
# 2003.3.20 : gif-->jpg に変更したプログラムを作成
#==============================================================
# 入力が必要な作成条件
# 	・りとにゅーすの号数(XX)
# 	・その号のページ数  (YY)
#----------------------------------------
# 作成ディレクトリ
# 	・noXX
#----------------------------------------
# 作成ファイル
# 	・noXX\rtnXX.html	: フレーム定義ファイル
# 	・noXX\rtnXXpage.html	: 左フレーム=目次リンクファイル
# 	・noXX\rtnXXp1.thml	: 右フレーム１ページ目の画像表示ファイル
# 	             ↓                     ↓
# 	       rtnXXpYY.thml	: 右フレームYY(最終ページ)ページ目の画像表示ファイル
#----------------------------------------
# Webサーバー上のディレクトリ構成
# 	htdocs/ -+- ritonews.html
# 		 |- ritonews/	-+- noXX/	-+- rtnXX.html		フレーム定義
#		 | 		 | 		 |- rtnXXpage.html	左フレーム（目次）
#				 | 		 |- rtnXXp1.html	右フレーム（各ページ）
#						 |- rtnXXp2.html
#						 |-      ↓
#						 |- rtnXXpYY.html
#						 |
#						 |- noXXp1.jpg		各ページの画像ファイル
#						 |- noXXp2.jpg
#						 |-     ↓
#						 |- noXXpYY.jpg

$cls="CLS";	# for DOS

$sp=10;		# メニュー表示の左インデント

while(1){
	system("$cls");
	print(" " x $sp, "===========================================================\n");
	print(" " x $sp, "	「りとにゅーす」用ホームページ構成ファイル作成	     \n");
	print(" " x $sp, "===========================================================\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "　ホームページ用に必要なファイル・ディレクトリを作成します。\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	　実行しますか？（ y : 実行 / e :終了 ）=");

		$answer=<STDIN>;
		chop($answer);
		if(not($answer =~/[yeYE]/)){
			print("\a\a\n");
			print(" " x $sp, "	>>>>		入力ミス。[Enter]キーを押して下さい。");
			<STDIN>;
			$answer=undef;
			redo;
			} #>--- end of if(not($answer =~/)

	if($answer =~ /[yY]/){&menu;} 
	if($answer =~ /[eE]/){last;} 

	} #>--- while(1)

#============================= END of MAIN ==============================================
	

#==================== Begin of menu =====================================================
sub menu{

my($answer);

$issue_no=undef;
$last_page=undef;
$answer=undef;

while(1){
	system("$cls");

	print(" " x $sp, "===========================================================\n");
	print(" " x $sp, "	「りとにゅーす」用ホームページ構成ファイル作成	     \n");
	print(" " x $sp, "===========================================================\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	以下の条件を入力して下さい。\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	（１）りとにゅーすの号数 = $issue_no");

	if($issue_no eq ""){
		$issue_no=<STDIN>;
		chop($issue_no);
		if(not($issue_no =~/\d/)){
			print("\a\a\n");
			print(" " x $sp, "数字以外のデータが入力されました。[Enter]キーを押して下さい。");
			<STDIN>;
			$issue_no=undef;
			redo;
			} #>--- end of if(not($issue_no =~/\d/))
		} #>--- if($issue_no eq "")
	    else{print("\n");}

	print(" " x $sp, "\n");
	print(" " x $sp, "	（２）ページ数		 = $last_page");

	if($last_page eq ""){
		$last_page=<STDIN>;
		chop($last_page);
		if(not($last_page =~/\d/)){
			print("\a\a\n");
			print(" " x $sp, "数字以外のデータが入力されました。[Enter]キーを押して下さい。");
			<STDIN>;
			$last_page=undef;
			redo;
			} #>--- end of if(not($last_page =~/\d/))
		} #>--- if($last_page eq "")
	    else{print("\n");}


	print(" " x $sp, "\n");
	print(" " x $sp, "	>> りとにゅーす No.$issue_no（1 ～ $last_page ページ）用ファイルを作成します。\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	>> 	y : 作成開始 / n : 条件修正 / e : 終了 = ");

	if($answer eq ""){
		$answer=<STDIN>;
		chop($answer);
		if(not($answer =~/[yneYNE]/)){
			print("\a\a\n");
			print(" " x $sp, "	>>>>		入力ミス。[Enter]キーを押して下さい。");
			<STDIN>;
			$answer=undef;
			redo;
			} #>--- end of if(not($answer =~/\d/))
		} #>--- if($answer eq "")
	    else{print("\n");}

	if($answer =~ /[yY]/){&make_files;} 
	if($answer =~ /[nN]/){$answer=undef;
			      $issue_no=undef;
			      $last_page=undef;
			      redo;} 
	if($answer =~ /[eE]/){last;} 

	last;
	} #>--- while(1)
return;
}
### ====================== END of sub menu ========================================

#========================= Begin of make_files ====================================
sub make_files{

system("$cls");

#print("ファイル作成ルーチン");
#<STDIN>;

if(-e "no$issue_no"){
	print(" " x $sp, "ディレクトリ no$issue_no は、既に存在します。\n");
	print(" " x $sp, "no$issue_no を削除または移動した後、再度実行して下さい。\n");
	print(" " x $sp, "メニューに戻ります。[Enter]キーを押して下さい。");
	<STDIN>;
	return;
	}

print(" " x $sp, "\n");
print(" " x $sp, ">> ファイル作成中・・・\n");
print(" " x $sp, "\n");

$dir_name="no$issue_no";
$common_file_name="rtn$issue_no";
mkdir("$dir_name", 0777);

&make_frame_def_file;
&make_left_frame;
&make_right_frame;

print(" " x $sp, "\n");
print(" " x $sp, ">> 作成終了。[Enter]キーを押して下さい。");
<STDIN>;
print(" " x $sp, "\n");

return;
}
#========================= END of make_files ======================================

#========================= Begin of make_frame_def_file ===========================
sub make_frame_def_file{

$issue_no2=$issue_no;
$issue_no2=~tr/0-9/０-９/;

open(OUTFILE, ">$dir_name\\$common_file_name.html");	# ritonews/rtnXX.html
$left_file = $common_file_name."page.html";		# rtnXXpage.html へのリンク
$right_file= $common_file_name."p1.html";		# rtnXXp1.html   へのリンク

print OUTFILE <<EOD;
<HTML>
<HEAD>
<TITLE>りとにゅーす$issue_no2号</TITLE>
</HEAD>

<FRAMESET COLS="35%,65%">
	<FRAME SRC="$left_file" NAME="FRAME1">
	<FRAME SRC="$right_file" NAME="FRAME2">
</FRAMESET>

</HTML>
EOD

close(OUTFILE);
return;
}
#========================= END of make_frame_def_file =============================


#========================= Begin of make_left_frame ===============================
sub make_left_frame{

my($page);

$issue_no2=$issue_no;
$issue_no2=~tr/0-9/０-９/;

open(OUTFILE, ">$dir_name\\$common_file_name"."page.html");	# ritonews/rtnXXpage.html
print OUTFILE <<EOD;
<HTML>
<HEAD>
<TITLE>りとにゅーす$issue_no2号（目次）</TITLE>
</HEAD>
<BODY>
<PRE>
りとにゅーす$issue_no2号（目次）
<HR>
EOD

#								# rtnXXpYY.html へのリンク
for($a=1;$a<=$last_page;++$a){
	$page=$a;
	$page=~tr/0-9/０-９/;
	print(OUTFILE "\<A HREF = \"$common_file_name"."p$a.html\"  TARGET=\"FRAME2\"\>Ｐ$page　　ここに目次を入力して下さい　　　　 \<\/A\>\n");
}

print OUTFILE <<EOD;
</PRE>
<HR>
<!A HREF = "http://www.lib.ous.ac.jp/ritonews.html">
<A HREF = "../../ritonews.html" TARGET="_top">
「りとにゅーす」メインページへ</A><br>
<A HREF = "http://www.lib.ous.ac.jp" TARGET="_top">
図書館のホームページへ</A>

</BODY>
</HTML>
EOD

close(OUTFILE);
return;
}
#========================= END of make_left_frame =================================

#========================= Begin of make_right_frame ==============================
sub make_right_frame{

my($page);

$issue_no2=$issue_no;
$issue_no2=~tr/0-9/０-９/;

for($a=1;$a<=$last_page;++$a){
	$page=$a;
	$page=~tr/0-9/０-９/;
	$jpg_file="no$issue_no"."p$a".".jpg";	# noXXpYY.jpg

open(OUTFILE, ">$dir_name\\$common_file_name"."p$a".".html");	# ritonews/rtnXXpYY.html
print OUTFILE <<EOD;
<HTML>
<HEAD>
<TITLE>りとにゅーす$issue_no2号（Ｐ$page）</TITLE>
</HEAD>
<BODY>

<IMG SRC="$jpg_file">
</BODY>
</HTML>
EOD

close(OUTFILE);
}#>--- end of for
return;
}
#========================= END of make_right_frame ================================
