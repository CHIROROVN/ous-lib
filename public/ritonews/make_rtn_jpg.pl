#

# Windows�p Perl �v���O����
#==============================================================
# �@�u��Ƃɂ�[���v�p�z�[���y�[�W�\���t�@�C���쐬�v���O����
#==============================================================
# 2003.3.20 : gif-->jpg �ɕύX�����v���O�������쐬
#==============================================================
# ���͂��K�v�ȍ쐬����
# 	�E��Ƃɂ�[���̍���(XX)
# 	�E���̍��̃y�[�W��  (YY)
#----------------------------------------
# �쐬�f�B���N�g��
# 	�EnoXX
#----------------------------------------
# �쐬�t�@�C��
# 	�EnoXX\rtnXX.html	: �t���[����`�t�@�C��
# 	�EnoXX\rtnXXpage.html	: ���t���[��=�ڎ������N�t�@�C��
# 	�EnoXX\rtnXXp1.thml	: �E�t���[���P�y�[�W�ڂ̉摜�\���t�@�C��
# 	             ��                     ��
# 	       rtnXXpYY.thml	: �E�t���[��YY(�ŏI�y�[�W)�y�[�W�ڂ̉摜�\���t�@�C��
#----------------------------------------
# Web�T�[�o�[��̃f�B���N�g���\��
# 	htdocs/ -+- ritonews.html
# 		 |- ritonews/	-+- noXX/	-+- rtnXX.html		�t���[����`
#		 | 		 | 		 |- rtnXXpage.html	���t���[���i�ڎ��j
#				 | 		 |- rtnXXp1.html	�E�t���[���i�e�y�[�W�j
#						 |- rtnXXp2.html
#						 |-      ��
#						 |- rtnXXpYY.html
#						 |
#						 |- noXXp1.jpg		�e�y�[�W�̉摜�t�@�C��
#						 |- noXXp2.jpg
#						 |-     ��
#						 |- noXXpYY.jpg

$cls="CLS";	# for DOS

$sp=10;		# ���j���[�\���̍��C���f���g

while(1){
	system("$cls");
	print(" " x $sp, "===========================================================\n");
	print(" " x $sp, "	�u��Ƃɂ�[���v�p�z�[���y�[�W�\���t�@�C���쐬	     \n");
	print(" " x $sp, "===========================================================\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "�@�z�[���y�[�W�p�ɕK�v�ȃt�@�C���E�f�B���N�g�����쐬���܂��B\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	�@���s���܂����H�i y : ���s / e :�I�� �j=");

		$answer=<STDIN>;
		chop($answer);
		if(not($answer =~/[yeYE]/)){
			print("\a\a\n");
			print(" " x $sp, "	>>>>		���̓~�X�B[Enter]�L�[�������ĉ������B");
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
	print(" " x $sp, "	�u��Ƃɂ�[���v�p�z�[���y�[�W�\���t�@�C���쐬	     \n");
	print(" " x $sp, "===========================================================\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	�ȉ��̏�������͂��ĉ������B\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	�i�P�j��Ƃɂ�[���̍��� = $issue_no");

	if($issue_no eq ""){
		$issue_no=<STDIN>;
		chop($issue_no);
		if(not($issue_no =~/\d/)){
			print("\a\a\n");
			print(" " x $sp, "�����ȊO�̃f�[�^�����͂���܂����B[Enter]�L�[�������ĉ������B");
			<STDIN>;
			$issue_no=undef;
			redo;
			} #>--- end of if(not($issue_no =~/\d/))
		} #>--- if($issue_no eq "")
	    else{print("\n");}

	print(" " x $sp, "\n");
	print(" " x $sp, "	�i�Q�j�y�[�W��		 = $last_page");

	if($last_page eq ""){
		$last_page=<STDIN>;
		chop($last_page);
		if(not($last_page =~/\d/)){
			print("\a\a\n");
			print(" " x $sp, "�����ȊO�̃f�[�^�����͂���܂����B[Enter]�L�[�������ĉ������B");
			<STDIN>;
			$last_page=undef;
			redo;
			} #>--- end of if(not($last_page =~/\d/))
		} #>--- if($last_page eq "")
	    else{print("\n");}


	print(" " x $sp, "\n");
	print(" " x $sp, "	>> ��Ƃɂ�[�� No.$issue_no�i1 �` $last_page �y�[�W�j�p�t�@�C�����쐬���܂��B\n");
	print(" " x $sp, "\n");
	print(" " x $sp, "	>> 	y : �쐬�J�n / n : �����C�� / e : �I�� = ");

	if($answer eq ""){
		$answer=<STDIN>;
		chop($answer);
		if(not($answer =~/[yneYNE]/)){
			print("\a\a\n");
			print(" " x $sp, "	>>>>		���̓~�X�B[Enter]�L�[�������ĉ������B");
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

#print("�t�@�C���쐬���[�`��");
#<STDIN>;

if(-e "no$issue_no"){
	print(" " x $sp, "�f�B���N�g�� no$issue_no �́A���ɑ��݂��܂��B\n");
	print(" " x $sp, "no$issue_no ���폜�܂��͈ړ�������A�ēx���s���ĉ������B\n");
	print(" " x $sp, "���j���[�ɖ߂�܂��B[Enter]�L�[�������ĉ������B");
	<STDIN>;
	return;
	}

print(" " x $sp, "\n");
print(" " x $sp, ">> �t�@�C���쐬���E�E�E\n");
print(" " x $sp, "\n");

$dir_name="no$issue_no";
$common_file_name="rtn$issue_no";
mkdir("$dir_name", 0777);

&make_frame_def_file;
&make_left_frame;
&make_right_frame;

print(" " x $sp, "\n");
print(" " x $sp, ">> �쐬�I���B[Enter]�L�[�������ĉ������B");
<STDIN>;
print(" " x $sp, "\n");

return;
}
#========================= END of make_files ======================================

#========================= Begin of make_frame_def_file ===========================
sub make_frame_def_file{

$issue_no2=$issue_no;
$issue_no2=~tr/0-9/�O-�X/;

open(OUTFILE, ">$dir_name\\$common_file_name.html");	# ritonews/rtnXX.html
$left_file = $common_file_name."page.html";		# rtnXXpage.html �ւ̃����N
$right_file= $common_file_name."p1.html";		# rtnXXp1.html   �ւ̃����N

print OUTFILE <<EOD;
<HTML>
<HEAD>
<TITLE>��Ƃɂ�[��$issue_no2��</TITLE>
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
$issue_no2=~tr/0-9/�O-�X/;

open(OUTFILE, ">$dir_name\\$common_file_name"."page.html");	# ritonews/rtnXXpage.html
print OUTFILE <<EOD;
<HTML>
<HEAD>
<TITLE>��Ƃɂ�[��$issue_no2���i�ڎ��j</TITLE>
</HEAD>
<BODY>
<PRE>
��Ƃɂ�[��$issue_no2���i�ڎ��j
<HR>
EOD

#								# rtnXXpYY.html �ւ̃����N
for($a=1;$a<=$last_page;++$a){
	$page=$a;
	$page=~tr/0-9/�O-�X/;
	print(OUTFILE "\<A HREF = \"$common_file_name"."p$a.html\"  TARGET=\"FRAME2\"\>�o$page�@�@�����ɖڎ�����͂��ĉ������@�@�@�@ \<\/A\>\n");
}

print OUTFILE <<EOD;
</PRE>
<HR>
<!A HREF = "http://www.lib.ous.ac.jp/ritonews.html">
<A HREF = "../../ritonews.html" TARGET="_top">
�u��Ƃɂ�[���v���C���y�[�W��</A><br>
<A HREF = "http://www.lib.ous.ac.jp" TARGET="_top">
�}���ق̃z�[���y�[�W��</A>

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
$issue_no2=~tr/0-9/�O-�X/;

for($a=1;$a<=$last_page;++$a){
	$page=$a;
	$page=~tr/0-9/�O-�X/;
	$jpg_file="no$issue_no"."p$a".".jpg";	# noXXpYY.jpg

open(OUTFILE, ">$dir_name\\$common_file_name"."p$a".".html");	# ritonews/rtnXXpYY.html
print OUTFILE <<EOD;
<HTML>
<HEAD>
<TITLE>��Ƃɂ�[��$issue_no2���i�o$page�j</TITLE>
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
