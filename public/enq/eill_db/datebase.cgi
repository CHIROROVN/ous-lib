#!/usr/local/bin/perl5

# Copyright (c) CGIROOM.                           http://www.cgiroom.nu
#======================================================================#
# [Ver  1.44] ���@�\������p�f�[�^�x�[�X
#
# ���̃v���O�����ɂ���ċN��������CGIROOM�͐ӔC�𕉂��܂���B
# ���p�_��ɓ��ӂł��Ȃ����̂����p�́A�����������B
#======================================================================#
# �����ݒ�

	#�� jcode.pl�܂ł̃p�X
$require= 'jcode.pl';

	#�� �f�[�^�t�@�C���܂ł̃p�X
	#   �t�@�C�����͕ύX���Ă������������߂��܂��B
	#   �b�r�u�t�@�C���𒼐ڃ_�E�����[�h����鋰�ꂪ����̂ŁB
$SEEK = "data.csv";

	#�� �\������
$print_max = 20;

	#�� �ő�\������
$max_max = 100;

	#�� �����t�H�[���̍ő勖��(20�ȏ�̌����@�\���g�p����ꍇ�͐��𑝂₵�Ă��������B)
$seekform = 20;

#�g���@�\=(�ύX�̕K�v���Ȃ�)===========================================#
#�� �^�u��؂�t�@�C���̏ꍇ 0 �� 1 �ɕύX
$tab = 0;

#�� �񌋍��̊Ԃɓ���镶��
$sep = " ";
#======================================================================#
#�� HTML�̕ҏW�ɂ���
#�@�@�������牺��HTML�̕ҏW�ɂȂ�܂��B
#�@�@�ҏW����ꍇ�́A�Q�̃R�����g�^�O�ň͂����^�O��ҏW���Ă��������B
#�� �ҏW�̎��̒��ӓ_
#�@�S�p�X�y�[�X�̌�ɂ͕K�����s���͔��p�X�y�[�X���L�����ĉ������B
# �u�\���v���̕������L�������ꍇ������������ꍇ������܂��B
#�@���̏ꍇ�́u�\\���v�̂悤��[\]�𕶎��������镶���ɋL�����Ă��������B
#�@[ \ $ % @ ]���̔��p�L�����g���ꍇ���̂悤�ɋL�����ĉ������B[ \\ \$ \% \@ ]
#======================================================================#
sub head{
print"Content-type: text/html\n\n";
#======================================================================#
#�� �w�b�_�\������
#
print<<HEAD;
<HTML>
	<HEAD>
		<TITLE> D A T A B A S E </TITLE>
	</HEAD>
	<BODY bgcolor="#FFFFFF" text="#000000">

	<CENTER>
		<H1>DATABASE</H1>
		<b>$keywords</b><br>
		$max ���̃f�[�^�̂��� $target ���Y�����܂����B
	</CENTER>
HEAD
print $print;
}
sub html{
#======================================================================#
#�� �w���v�\��
# CGI�ɒ��ڃA�N�Z�X�����ꍇ�ɕ\�����镔���ł��B
print<<'HTML';
<hr>
<pre>
	�f�[�^�x�[�X�̎g����
	�E�����L�[���[�h���X�y�[�X�ŋ�؂�ƃL�[���[�h�𕡐��w�肷�邱�Ƃ��\�ł��B
	�E�Y�������f�[�^���ׂĂ�\\������̌����L�[���[�h�͍i���Č�������ƕ֗��ł�
	�E�����Ō��J���Ă���f�[�^�̖��f�]�ڂ͂������������B
<form action="database.cgi" method=GET>
	<input type="text" size="20" name="key"><input type="submit" value="����">
</form>

</pre>


HTML
}
sub seek{$no=$.;
#======================================================================#
#�� �f�[�^�\�� �f�U�C������
# �����Ō����L�[�ɊY�������b�r�u�̍s��\�����܂��B
# �\������Ƃ��ɁA$data[**] ��**�̕����ɗ�ԍ����L�����܂��B
# $data[1] �ƋL������ƁA�P��ڂ̕�����\�����܂��B
# $data[2] �ƋL������ƁA�Q��ڂ̕�����\�����܂��B
#���I�v�V����
# $count   �ƋL������ƊY���ԍ���\�����܂��B
# $no      �ƋL������ƊY�������s�̍s�ԍ���\�����܂��B
#���⏕�@�\
#�@�uprint<<HTML;�v�̑O�ɂ������L�q����ƃf�[�^��ҏW�ł��܂��B
# &comma($data[**]);
#  ���l�Ɏ����ŃR���}�����܂��B�܂� 10000 �� 10,000 �Ɛ���܂��B
# tag($data[**]);
#  �^�O�ȂǂɎg�p�����L���𖳌������܂��B


$print .=<<HTML;
<!-- �Y�� -->
<table border=0 width="100%">
<tr bgcolor="#EEEEEE"><td width="30%" align=right>���i��       </td><td width="70%">  $data[2] </td></tr>
<tr><td align=right bgcolor="#F0F1E7">���i�i���o�[ </td><td width="70%">  $data[1] </td></tr>
<tr><td align=right bgcolor="#F0F1E7">���l�i       </td><td width="70%">$data[3]</td></tr>
<tr><td align=right bgcolor="#F0F1E7">����         </td><td width="70%">  $data[4] </td></tr>
<tr><td align=right >�@</td><td width="70%">�@</td></tr>
</table>
<!-- �Y�� -->
HTML
if($print_max==0){$tell=tell(SEEK);$last=$count;
return 1 if$max;return;}
}
sub next{$URL="database.cgi?${url}data=$target\%$max\%$tell\%$no%$last";
#======================================================================#
#�� ���̃y�[�W�փ{�^��
#
print<<NEXT;
<!-- NEXT -->

<br><a href="$URL">���̃y�[�W</a>

<!-- NEXT -->
NEXT
}
sub no{
#======================================================================#
#�� �������ʂ��\������Ȃ������ꍇ(�Y�������̏ꍇ)
#
print<<HTML;
<!-- �Y������ -->
<center>
	�Y��������̂�����܂���ł���
</center>
<!-- �Y������ -->
HTML
}
#======================================================================#
sub foot{
	#�� �t�b�^�\������
	#���쌠����(�����N)�͏������Ɏc���Ă����Ă��������B
print<<FOOT;
<!-- �t�b�^ -->

	$_[0]
	<hr>
	<tt><i>�����Ō��J���Ă���f�[�^�̖��f���p���ւ��܂��B<br>
	system:<a href="http://cgiroom.nu">CGIROOM</a></i></tt>
	</BODY>

<!-- �t�b�^ -->
</HTML>

FOOT
exit if $_[0];
}
# �����ݒ�
#======================================================================#
require $require if -e $require;
if($ENV{'REQUEST_METHOD'} eq "POST"){
	read(STDIN,$QUERY,$ENV{'CONTENT_LENGTH'})
}else{
	$QUERY = $ENV{'QUERY_STRING'}
}
@QUERY=split(/&/,$QUERY);

foreach (@QUERY){
	($n,$v)=split(/=/);
	$v=~ tr/+/ /;
	next if $n eq "data" && $v !~ /[^\d\%]/ && (@data = split('%',$v));
	$v=~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
	$n=~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
	$v=~ s/\r|\n|\t|�@/ /g;
	$v=~ s/\s+(""|"|,)\s+/ /g;
	$v=~ s/^(""|"|,)$//g;
	next if $n eq "" || $v eq "";
	&jcode'convert(*v,'sjis') if $jcode'version;
	if($n=~ /^IDn/){
		$ID{$n}=$v
	}elsif($n=~ /^IDv(\d+)/){
		$IDv{$1}.=" " if $IDv{$1};
		$IDv{$1}.=$v
	}else{
		$s=$n=~ /^join/ ?"":" ";
		$FORM{$n}.=$s if $FORM{$n};
		$FORM{$n}.=$v
	}
}

if($FORM{'query'}){
	@QUERY = split(/&/,$FORM{'query'});
	foreach (@QUERY){
		($n,$v)=split(/=/);
		next if $n eq "" || $v eq "";
		if($n=~ /^IDn/){
			$ID{$n}=$v
		}elsif($n=~ /^IDv(\d+)/){
			$IDv{$1}.=" " if $IDv{$1};
			$IDv{$1}.=$v
		}else{
			$s=$n=~ /^join/ ?"":" ";
			$FORM{$n}.=$s if $FORM{$n};
			$FORM{$n}.=$v
		}
	}
}

$print_max=$FORM{print} if $FORM{print} && $FORM{print} !~ /\D/;
$print_max=$max_max if $print_max > $max_max;
$n=~ /IDn(\d+)/ &&($FORM{$v}=$IDv{$1})while ($n,$v)=each(%ID);
if($QUERY=~ /join/){
	$n=~ s/^join// && push(@form,"$n\t$v"),delete $FORM{"join$n"} while ($n,$v)=each(%FORM);
	foreach(@form){
		($n,$v)=split(/\t/);
		$FORM{$n}=$v if $n ne "" && $v ne ""
	}
	undef @form;
}
if($QUERY=~ /select/){
	while(($n,$v)=each(%FORM)){
		if($n=~ s/^select// && $FORM{"$v$n"} eq ""){
			push(@form,"$v$n\t$FORM{\"value$n\"}");
			delete $FORM{"select$n"}
		}
	}
	foreach(@form){
		($n,$v)=split(/\t/);
		$FORM{$n}=$v if $n ne "" && $v ne ""
	}
	undef @form
}
%W=('�`','(?:�`|��|A|a)','��','(?:�`|��|A|a)','A','(?:�`|��|A|a)','a','(?:�`|��|A|a)',
'�a','(?:�a|��|B|b)','��','(?:�a|��|B|b)','B','(?:�a|��|B|b)','b','(?:�a|��|B|b)',
'�b','(?:�b|��|C|c)','��','(?:�b|��|C|c)','C','(?:�b|��|C|c)','c','(?:�b|��|C|c)',
'�c','(?:�c|��|D|d)','��','(?:�c|��|D|d)','D','(?:�c|��|D|d)','d','(?:�c|��|D|d)',
'�d','(?:�d|��|E|e)','��','(?:�d|��|E|e)','E','(?:�d|��|E|e)','e','(?:�d|��|E|e)',
'�e','(?:�e|��|F|f)','��','(?:�e|��|F|f)','F','(?:�e|��|F|f)','f','(?:�e|��|F|f)',
'�f','(?:�f|��|G|g)','��','(?:�f|��|G|g)','G','(?:�f|��|G|g)','g','(?:�f|��|G|g)',
'�g','(?:�g|��|H|h)','��','(?:�g|��|H|h)','H','(?:�g|��|H|h)','h','(?:�g|��|H|h)',
'�h','(?:�h|��|I|i)','��','(?:�h|��|I|i)','I','(?:�h|��|I|i)','i','(?:�h|��|I|i)',
'�i','(?:�i|��|J|j)','��','(?:�i|��|J|j)','J','(?:�i|��|J|j)','j','(?:�i|��|J|j)',
'�j','(?:�j|��|K|k)','��','(?:�j|��|K|k)','K','(?:�j|��|K|k)','k','(?:�j|��|K|k)',
'�k','(?:�k|��|L|l)','��','(?:�k|��|L|l)','L','(?:�k|��|L|l)','l','(?:�k|��|L|l)',
'�l','(?:�l|��|M|m)','��','(?:�l|��|M|m)','M','(?:�l|��|M|m)','m','(?:�l|��|M|m)',
'�m','(?:�m|��|N|n)','��','(?:�m|��|N|n)','N','(?:�m|��|N|n)','n','(?:�m|��|N|n)',
'�n','(?:�n|��|O|o)','��','(?:�n|��|O|o)','O','(?:�n|��|O|o)','o','(?:�n|��|O|o)',
'�o','(?:�o|��|P|p)','��','(?:�o|��|P|p)','P','(?:�o|��|P|p)','p','(?:�o|��|P|p)',
'�p','(?:�p|��|Q|q)','��','(?:�p|��|Q|q)','Q','(?:�p|��|Q|q)','q','(?:�p|��|Q|q)',
'�q','(?:�q|��|R|r)','��','(?:�q|��|R|r)','R','(?:�q|��|R|r)','r','(?:�q|��|R|r)',
'�r','(?:�r|��|S|s)','��','(?:�r|��|S|s)','S','(?:�r|��|S|s)','s','(?:�r|��|S|s)',
'�s','(?:�s|��|T|t)','��','(?:�s|��|T|t)','T','(?:�s|��|T|t)','t','(?:�s|��|T|t)',
'�t','(?:�t|��|U|u)','��','(?:�t|��|U|u)','U','(?:�t|��|U|u)','u','(?:�t|��|U|u)',
'�u','(?:�u|��|V|v)','��','(?:�u|��|V|v)','V','(?:�u|��|V|v)','v','(?:�u|��|V|v)',
'�v','(?:�v|��|W|w)','��','(?:�v|��|W|w)','W','(?:�v|��|W|w)','w','(?:�v|��|W|w)',
'�w','(?:�w|��|X|x)','��','(?:�w|��|X|x)','X','(?:�w|��|X|x)','x','(?:�w|��|X|x)',
'�x','(?:�x|��|Y|y)','��','(?:�x|��|Y|y)','Y','(?:�x|��|Y|y)','y','(?:�x|��|Y|y)',
'�y','(?:�y|��|Z|z)','��','(?:�y|��|Z|z)','Z','(?:�y|��|Z|z)','z','(?:�y|��|Z|z)',
'�P','(?:�P|��|��|1)','��','(?:�P|��|��|1)','��','(?:�P|��|��|1)','1','(?:�P|��|��|1)',
'�Q','(?:�Q|��|��|2)','��','(?:�Q|��|��|2)','��','(?:�Q|��|��|2)','2','(?:�Q|��|��|2)',
'�R','(?:�R|�O|�Q|3)','�O','(?:�R|�O|�Q|3)','�Q','(?:�R|�O|�Q|3)','3','(?:�R|�O|�Q|3)',
'�S','(?:�S|�l|4)','�l','(?:�S|�l|4)','4','(?:�S|�l|4)',
'�T','(?:�T|��|5)','��','(?:�T|��|5)','5','(?:�T|��|5)',
'�U','(?:�U|�Z|6)','�Z','(?:�U|�Z|6)','6','(?:�U|�Z|6)',
'�V','(?:�V|��|7)','��','(?:�V|��|7)','7','(?:�V|��|7)',
'�W','(?:�W|��|8)','��','(?:�W|��|8)','8','(?:�W|��|8)',
'�X','(?:�X|��|9)','��','(?:�X|��|9)','9','(?:�X|��|9)',
'�O','(?:�O|��|0)','��','(?:�O|��|0)','0','(?:�O|��|0)',
'�C','(?:�A|�C|,)','�A','(?:�A|�C|,)',',','(?:�A|�C|,)',
'�D','(?:�D|�B|\.)','�B','(?:�D|�B|\.)','.','(?:�D|�B|\.)',
'��','(?:��|\@)','@','(?:��|\@)',	'��','(?:��|\#)','#','(?:��|\#)',
'��','(?:��|\$)','$','(?:��|\$)',	'��','(?:��|\%)','%','(?:��|\%)',
'�f','(?:�f|\')','\'','(?:�f|\')',	'�i','(?:�i|\()','(','(?:�i|\()',
'�j','(?:�j|\))',')','(?:�j|\))',	'�G','(?:�G|\;)',';','(?:�G|\;)',
'�F','(?:�F|\:)',':','(?:�F|\:)',	'��','(?:��|\*)','*','(?:��|\*)',
'��','(?:��|\=)','=','(?:��|\=)',	'�{','(?:�{|\+)','+','(?:�{|\+)',
'�H','(?:�H|\?)','?','(?:�H|\?)',	'�I','(?:�I|\!)','!','(?:�I|\!)',
'�O','(?:�O|\^)','^','(?:�O|\^)',	'�b','(?:�b|\|)','|','(?:�b|\|)',
'�m','(?:�m|\[)','[','(?:�m|\[)',	'�n','(?:�n|\])',']','(?:�n|\])',
'�^','(?:�^|\/)','/','(?:�^|\/)','�_','(?:�_|\\)','\\','(?:�_|\\|��)','��','(?:��|\\)',
'�|','(?:�||\-|\x81\x5B)','-','(?:�||\-|\x81\x5B)',"\x81\x5B",'(?:�||\-|\x81\x5B)',
'��','(?:��|\&lt\;)','��','(?:��|\&gt;)') if $FORM{'word'} == 2;
$komozi = "(?i)" unless $FORM{'word'};
$AND = $FORM{'and'} || $FORM{'AND'} || $FORM{'key'};
$OR = $FORM{'or'} || $FORM{'OR'};
$NOT = $FORM{'not'} || $FORM{'NOT'};
while(($n,$v)=each(%FORM)){
	next if $n =~ /^join/;
	if( $n =~ /^up|^down/){
		$q .=$n =~ /^up/ ? "$v�ȏ� " : "$v�ȉ�";
	}elsif($n =~ /^(?:key|not|equal|and|or)/i){
		$q .= "$v ";
	}
	($nn,$vv)=($n,$v);
	$vv =~ s/(\W)/'%'. unpack("H*",$1)/eg;
	$nn =~ s/(\W)/'%'. unpack("H*",$1)/eg;
	$url .="$nn=$vv&amp;" if $vv ne "";
	if($n =~ /^(keys|or|not|and)/i){
		$v =~ s/^\s+|\s+$//g;
		&word(\$v);
		if($n =~ s/^(?:keys|and)/and/){
			$v=~ s/(\S+)\s*/(?=.*$1)/g;
		}else{
			$v =~ s/\s+/|/g;
		}
	}
	push(@form,"$2\t$1\t$v\t$2$3") if $n =~ /^([a-z]+)(\d+)((?:,\d{1,3})*)/io;
	last if @form >= $seekform;
}
foreach(@form){
	my @tmp = split(/\t/);
	undef $tmp[3] if $tmp[3] !~ /,/;
	$_ = join("\t",@tmp[0..2],split(/,/,$tmp[3]));
}
$q =~ s/\s+$//;
&word(*OR) if $OR;
&word(*NOT) if $NOT;
&word(*AND) if $AND;
foreach(@data){
	undef $_ if /\D/
}
$OR =~ s/\s+/|/g;
$NOT=~ s/\s+/|/g;
$AND =~ s/^\s+|\s+$//g;
$AND=~ s/(\S+)\s*/(?=.*$1)/g;
$keywords = $q;
&tag($keywords);
$count=$data[4]+0;
$checkcount = $target = $data[0]+0;
$max=$data[1]+0;

&head,&html,&foot(''),exit if $q !~ /\S/ || (! @form && $AND eq "" && $OR eq "" && $NOT eq "");
open(SEEK)||&foot('�f�[�^�t�@�C�����J���܂���');
binmode(SEEK);
seek(SEEK,$data[2],0) if $data[2];
$.=$data[3]?$data[3]:0;
FI: while(<SEEK>){
	next FI if $OR  && ! /$komozi$OR/o;
	next FI if $NOT && /$komozi$NOT/o;
	next FI if $AND && ! /^$komozi$AND/o;
	s/[\r\n]+//g;
	undef @data;
	if($tab){
		@data=split(/\t/)
	}elsif(index($_,'"') >= 0){
		@line=split(/,/);
		while(@line){
			$dummy = shift @line;
			while(($dummy=~ tr/"/"/ % 2) == 1){
				last unless @line;
				$dummy .=',' . shift @line;
			}
			if(index($dummy,'"') >= 0){
				chop $dummy;
				substr($dummy,0,1)="";
				$dummy=~ s/""/"/og;
			}
			push(@data,$dummy);
		}
	}else{
		@data=split(/,/)
	}
	unshift(@data,0);
	foreach(@form){
		($keys,$n,$v,@keys)=split(/\t/);
		if(@keys){
			if($n eq "and"){
				next FI if join($sep,@data[@keys]) !~ /^$komozi$v/;
			}elsif($n eq "or"){
				next FI if join($sep,@data[@keys]) !~ /$komozi$v/
			}elsif($n eq "not"){
				next FI if join($sep,@data[@keys]) =~ /$komozi$v/;
			}
			next;
		}
		next FI if $data[$keys] eq "";
		if($n eq "and"){
			next FI if $data[$keys] !~ /^$komozi$v/;
		}elsif($n eq "or"){
			next FI if $data[$keys] !~ /$komozi$v/
		}elsif($n eq "not"){
			next FI if $data[$keys] =~ /$komozi$v/;
		}elsif($n eq "up"){
			next FI if $data[$keys] < $v;
		}elsif($n eq "down"){
			next FI if $data[$keys] > $v;
		}elsif($n eq "equal"){
			next FI if $data[$keys] ne $v;
		}
	}
	$count++;
	&seek == 1 && last if --$print_max >= 0
}
if(!$target){
	$target=$count+0;
	$max=$.+0
}
&head;
&next if $print_max <= 0 && $checkcount != $count;
&no unless $count;
exit if &foot('');
sub comma{
	1 while $_[0]=~ s/(.*\d)(\d\d\d)/$1,$2/
}
sub tag{
	$_[0]=~ s/&/&amp;/g;
	$_[0]=~ s/</&lt;/g;
	$_[0]=~ s/>/&gt;/g;
	$_[0]=~ s/"/&quot;/g
}
sub word{
	*word = shift ;
	$word =~ s/([^\w ])/\\$1/go && return 1 if  $FORM{'word'} < 2;
	$word =~ s/((?:[\x81-\x9F|\xE0-\xEF][\x40-\x7E|\x80-\xFC])|(?:[\x20-\x7E])|(?:[\xA0-\xDF]))/&_word($1)/oeg;
}
sub _word{
	$sw=$_[0];
	return $W{$sw} if $W{$sw};
	$sw =~ s/([^\w ])/\\$1/go;
	return $sw
}
#================================================================================#
#�y ��  �� �z�F���     < wake-t@mtc.biglobe.ne.jp >
#�y���J�ꏊ�z�FCGIROOM  < http://cgiroom.nu >
#�y ��  �� �z�F
#  1999/07/22 Ver  0.00
#  1999/08/06 Ver  1.00
#  1999/10/13 Ver  1.20 �����@�\�� �ȏ�A�ȉ��A�����A�I�� ��ǉ�
#  2000/01/03 Ver  1.30 �^�u��؂�t�@�C���ɑΉ��A�����@�\��NOT,OR��ǉ�
#  2000/01/12 Ver  1.31 1.30�̃o�O���C��
#  2000/01/20 Ver  1.32 1.31�̃o�O���C��
#  2000/02/21 Ver  1.33 1.32�̃o�O���C�� 10�ȏ�̗񌟍����o���Ȃ������o�O
#  2000/05/13 Ver  1.40 ���x�����@�\��ǉ�
#  2000/05/23 Ver  1.41 1.40�Ŕ��������o�O�C��(����J)
#  2000/05/29 Ver  1.42 ����Ƃ������J
#  2000/06/22 Ver  1.43 equal�����Ō�������ƊY�����Ȃ��o�O���C��
#  2000/12/03 Ver  1.43.01 ���傢���ƃo�O�C��
#  2001/09/10 Ver  1.44 query�����@�\�����ǉ�
#================================================================================#