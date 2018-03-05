#!/usr/local/bin/perl5

# Copyright (c) CGIROOM.                           http://www.cgiroom.nu
#======================================================================#
# [Ver  1.44] 高機能検索専用データベース
#
# このプログラムによって起きた事にCGIROOMは責任を負いません。
# 利用契約に同意できない方のご利用は、遠慮下さい。
#======================================================================#
# 初期設定

	#◆ jcode.plまでのパス
$require= 'jcode.pl';

	#◆ データファイルまでのパス
	#   ファイル名は変更しておく事をお勧めします。
	#   ＣＳＶファイルを直接ダウンロードされる恐れがあるので。
$SEEK = "data.csv";

	#◆ 表示件数
$print_max = 20;

	#◆ 最大表示件数
$max_max = 100;

	#◇ 検索フォームの最大許可数(20個以上の検索機能を使用する場合は数を増やしてください。)
$seekform = 20;

#拡張機能=(変更の必要性なし)===========================================#
#◆ タブ区切りファイルの場合 0 を 1 に変更
$tab = 0;

#◆ 列結合の間に入れる文字
$sep = " ";
#======================================================================#
#◆ HTMLの編集について
#　　ここから下はHTMLの編集になります。
#　　編集する場合は、２つのコメントタグで囲ったタグを編集してください。
#◆ 編集の時の注意点
#　全角スペースの後には必ず改行又は半角スペースを記入して下さい。
# 「表示」等の文字を記入した場合文字化けする場合があります。
#　その場合は「表\示」のように[\]を文字化けする文字に記入してください。
#　[ \ $ % @ ]等の半角記号を使う場合次のように記入して下さい。[ \\ \$ \% \@ ]
#======================================================================#
sub head{
print"Content-type: text/html\n\n";
#======================================================================#
#◆ ヘッダ表示部分
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
		$max 件のデータのうち $target 件該当しました。
	</CENTER>
HEAD
print $print;
}
sub html{
#======================================================================#
#◆ ヘルプ表示
# CGIに直接アクセスした場合に表示する部分です。
print<<'HTML';
<hr>
<pre>
	データベースの使い方
	・検索キーワードをスペースで区切るとキーワードを複数指定することが可能です。
	・該当したデータすべてを表\示するの検索キーワードは絞って検索すると便利です
	・ここで公開しているデータの無断転載はご遠慮下さい。
<form action="database.cgi" method=GET>
	<input type="text" size="20" name="key"><input type="submit" value="検索">
</form>

</pre>


HTML
}
sub seek{$no=$.;
#======================================================================#
#◆ データ表示 デザイン部分
# ここで検索キーに該当したＣＳＶの行を表示します。
# 表示するときに、$data[**] の**の部分に列番号を記入します。
# $data[1] と記入すると、１列目の文字を表示します。
# $data[2] と記入すると、２列目の文字を表示します。
#◆オプション
# $count   と記入すると該当番号を表示します。
# $no      と記入すると該当した行の行番号を表示します。
#◆補助機能
#　「print<<HTML;」の前にこれらを記述するとデータを編集できます。
# &comma($data[**]);
#  数値に自動でコンマを入れます。つまり 10000 が 10,000 と成ります。
# tag($data[**]);
#  タグなどに使用される記号を無効させます。


$print .=<<HTML;
<!-- 該当 -->
<table border=0 width="100%">
<tr bgcolor="#EEEEEE"><td width="30%" align=right>商品名       </td><td width="70%">  $data[2] </td></tr>
<tr><td align=right bgcolor="#F0F1E7">商品ナンバー </td><td width="70%">  $data[1] </td></tr>
<tr><td align=right bgcolor="#F0F1E7">お値段       </td><td width="70%">$data[3]</td></tr>
<tr><td align=right bgcolor="#F0F1E7">説明         </td><td width="70%">  $data[4] </td></tr>
<tr><td align=right >　</td><td width="70%">　</td></tr>
</table>
<!-- 該当 -->
HTML
if($print_max==0){$tell=tell(SEEK);$last=$count;
return 1 if$max;return;}
}
sub next{$URL="database.cgi?${url}data=$target\%$max\%$tell\%$no%$last";
#======================================================================#
#◆ 次のページへボタン
#
print<<NEXT;
<!-- NEXT -->

<br><a href="$URL">次のページ</a>

<!-- NEXT -->
NEXT
}
sub no{
#======================================================================#
#◆ 検索結果が表示されなかった場合(該当無しの場合)
#
print<<HTML;
<!-- 該当無し -->
<center>
	該当するものがありませんでした
</center>
<!-- 該当無し -->
HTML
}
#======================================================================#
sub foot{
	#◆ フッタ表示部分
	#著作権部分(リンク)は消さずに残しておいてください。
print<<FOOT;
<!-- フッタ -->

	$_[0]
	<hr>
	<tt><i>ここで公開しているデータの無断引用を禁じます。<br>
	system:<a href="http://cgiroom.nu">CGIROOM</a></i></tt>
	</BODY>

<!-- フッタ -->
</HTML>

FOOT
exit if $_[0];
}
# 初期設定
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
	$v=~ s/\r|\n|\t|　/ /g;
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
%W=('Ａ','(?:Ａ|ａ|A|a)','ａ','(?:Ａ|ａ|A|a)','A','(?:Ａ|ａ|A|a)','a','(?:Ａ|ａ|A|a)',
'Ｂ','(?:Ｂ|ｂ|B|b)','ｂ','(?:Ｂ|ｂ|B|b)','B','(?:Ｂ|ｂ|B|b)','b','(?:Ｂ|ｂ|B|b)',
'Ｃ','(?:Ｃ|ｃ|C|c)','ｃ','(?:Ｃ|ｃ|C|c)','C','(?:Ｃ|ｃ|C|c)','c','(?:Ｃ|ｃ|C|c)',
'Ｄ','(?:Ｄ|ｄ|D|d)','ｄ','(?:Ｄ|ｄ|D|d)','D','(?:Ｄ|ｄ|D|d)','d','(?:Ｄ|ｄ|D|d)',
'Ｅ','(?:Ｅ|ｅ|E|e)','ｅ','(?:Ｅ|ｅ|E|e)','E','(?:Ｅ|ｅ|E|e)','e','(?:Ｅ|ｅ|E|e)',
'Ｆ','(?:Ｆ|ｆ|F|f)','ｆ','(?:Ｆ|ｆ|F|f)','F','(?:Ｆ|ｆ|F|f)','f','(?:Ｆ|ｆ|F|f)',
'Ｇ','(?:Ｇ|ｇ|G|g)','ｇ','(?:Ｇ|ｇ|G|g)','G','(?:Ｇ|ｇ|G|g)','g','(?:Ｇ|ｇ|G|g)',
'Ｈ','(?:Ｈ|ｈ|H|h)','ｈ','(?:Ｈ|ｈ|H|h)','H','(?:Ｈ|ｈ|H|h)','h','(?:Ｈ|ｈ|H|h)',
'Ｉ','(?:Ｉ|ｉ|I|i)','ｉ','(?:Ｉ|ｉ|I|i)','I','(?:Ｉ|ｉ|I|i)','i','(?:Ｉ|ｉ|I|i)',
'Ｊ','(?:Ｊ|ｊ|J|j)','ｊ','(?:Ｊ|ｊ|J|j)','J','(?:Ｊ|ｊ|J|j)','j','(?:Ｊ|ｊ|J|j)',
'Ｋ','(?:Ｋ|ｋ|K|k)','ｋ','(?:Ｋ|ｋ|K|k)','K','(?:Ｋ|ｋ|K|k)','k','(?:Ｋ|ｋ|K|k)',
'Ｌ','(?:Ｌ|ｌ|L|l)','ｌ','(?:Ｌ|ｌ|L|l)','L','(?:Ｌ|ｌ|L|l)','l','(?:Ｌ|ｌ|L|l)',
'Ｍ','(?:Ｍ|ｍ|M|m)','ｍ','(?:Ｍ|ｍ|M|m)','M','(?:Ｍ|ｍ|M|m)','m','(?:Ｍ|ｍ|M|m)',
'Ｎ','(?:Ｎ|ｎ|N|n)','ｎ','(?:Ｎ|ｎ|N|n)','N','(?:Ｎ|ｎ|N|n)','n','(?:Ｎ|ｎ|N|n)',
'Ｏ','(?:Ｏ|ｏ|O|o)','ｏ','(?:Ｏ|ｏ|O|o)','O','(?:Ｏ|ｏ|O|o)','o','(?:Ｏ|ｏ|O|o)',
'Ｐ','(?:Ｐ|ｐ|P|p)','ｐ','(?:Ｐ|ｐ|P|p)','P','(?:Ｐ|ｐ|P|p)','p','(?:Ｐ|ｐ|P|p)',
'Ｑ','(?:Ｑ|ｑ|Q|q)','ｑ','(?:Ｑ|ｑ|Q|q)','Q','(?:Ｑ|ｑ|Q|q)','q','(?:Ｑ|ｑ|Q|q)',
'Ｒ','(?:Ｒ|ｒ|R|r)','ｒ','(?:Ｒ|ｒ|R|r)','R','(?:Ｒ|ｒ|R|r)','r','(?:Ｒ|ｒ|R|r)',
'Ｓ','(?:Ｓ|ｓ|S|s)','ｓ','(?:Ｓ|ｓ|S|s)','S','(?:Ｓ|ｓ|S|s)','s','(?:Ｓ|ｓ|S|s)',
'Ｔ','(?:Ｔ|ｔ|T|t)','ｔ','(?:Ｔ|ｔ|T|t)','T','(?:Ｔ|ｔ|T|t)','t','(?:Ｔ|ｔ|T|t)',
'Ｕ','(?:Ｕ|ｕ|U|u)','ｕ','(?:Ｕ|ｕ|U|u)','U','(?:Ｕ|ｕ|U|u)','u','(?:Ｕ|ｕ|U|u)',
'Ｖ','(?:Ｖ|ｖ|V|v)','ｖ','(?:Ｖ|ｖ|V|v)','V','(?:Ｖ|ｖ|V|v)','v','(?:Ｖ|ｖ|V|v)',
'Ｗ','(?:Ｗ|ｗ|W|w)','ｗ','(?:Ｗ|ｗ|W|w)','W','(?:Ｗ|ｗ|W|w)','w','(?:Ｗ|ｗ|W|w)',
'Ｘ','(?:Ｘ|ｘ|X|x)','ｘ','(?:Ｘ|ｘ|X|x)','X','(?:Ｘ|ｘ|X|x)','x','(?:Ｘ|ｘ|X|x)',
'Ｙ','(?:Ｙ|ｙ|Y|y)','ｙ','(?:Ｙ|ｙ|Y|y)','Y','(?:Ｙ|ｙ|Y|y)','y','(?:Ｙ|ｙ|Y|y)',
'Ｚ','(?:Ｚ|ｚ|Z|z)','ｚ','(?:Ｚ|ｚ|Z|z)','Z','(?:Ｚ|ｚ|Z|z)','z','(?:Ｚ|ｚ|Z|z)',
'１','(?:１|一|壱|1)','一','(?:１|一|壱|1)','壱','(?:１|一|壱|1)','1','(?:１|一|壱|1)',
'２','(?:２|二|弐|2)','二','(?:２|二|弐|2)','弐','(?:２|二|弐|2)','2','(?:２|二|弐|2)',
'３','(?:３|三|参|3)','三','(?:３|三|参|3)','参','(?:３|三|参|3)','3','(?:３|三|参|3)',
'４','(?:４|四|4)','四','(?:４|四|4)','4','(?:４|四|4)',
'５','(?:５|五|5)','五','(?:５|五|5)','5','(?:５|五|5)',
'６','(?:６|六|6)','六','(?:６|六|6)','6','(?:６|六|6)',
'７','(?:７|七|7)','七','(?:７|七|7)','7','(?:７|七|7)',
'８','(?:８|八|8)','八','(?:８|八|8)','8','(?:８|八|8)',
'９','(?:９|九|9)','九','(?:９|九|9)','9','(?:９|九|9)',
'０','(?:０|零|0)','零','(?:０|零|0)','0','(?:０|零|0)',
'，','(?:、|，|,)','、','(?:、|，|,)',',','(?:、|，|,)',
'．','(?:．|。|\.)','。','(?:．|。|\.)','.','(?:．|。|\.)',
'＠','(?:＠|\@)','@','(?:＠|\@)',	'＃','(?:＃|\#)','#','(?:＃|\#)',
'＄','(?:＄|\$)','$','(?:＄|\$)',	'％','(?:％|\%)','%','(?:％|\%)',
'’','(?:’|\')','\'','(?:’|\')',	'（','(?:（|\()','(','(?:（|\()',
'）','(?:）|\))',')','(?:）|\))',	'；','(?:；|\;)',';','(?:；|\;)',
'：','(?:：|\:)',':','(?:：|\:)',	'＊','(?:＊|\*)','*','(?:＊|\*)',
'＝','(?:＝|\=)','=','(?:＝|\=)',	'＋','(?:＋|\+)','+','(?:＋|\+)',
'？','(?:？|\?)','?','(?:？|\?)',	'！','(?:！|\!)','!','(?:！|\!)',
'＾','(?:＾|\^)','^','(?:＾|\^)',	'｜','(?:｜|\|)','|','(?:｜|\|)',
'［','(?:［|\[)','[','(?:［|\[)',	'］','(?:］|\])',']','(?:］|\])',
'／','(?:／|\/)','/','(?:／|\/)','＼','(?:＼|\\)','\\','(?:＼|\\|￥)','￥','(?:￥|\\)',
'－','(?:－|\-|\x81\x5B)','-','(?:－|\-|\x81\x5B)',"\x81\x5B",'(?:－|\-|\x81\x5B)',
'＜','(?:＜|\&lt\;)','＞','(?:＞|\&gt;)') if $FORM{'word'} == 2;
$komozi = "(?i)" unless $FORM{'word'};
$AND = $FORM{'and'} || $FORM{'AND'} || $FORM{'key'};
$OR = $FORM{'or'} || $FORM{'OR'};
$NOT = $FORM{'not'} || $FORM{'NOT'};
while(($n,$v)=each(%FORM)){
	next if $n =~ /^join/;
	if( $n =~ /^up|^down/){
		$q .=$n =~ /^up/ ? "$v以上 " : "$v以下";
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
open(SEEK)||&foot('データファイルを開けません');
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
#【 作  成 】：わん     < wake-t@mtc.biglobe.ne.jp >
#【公開場所】：CGIROOM  < http://cgiroom.nu >
#【 履  歴 】：
#  1999/07/22 Ver  0.00
#  1999/08/06 Ver  1.00
#  1999/10/13 Ver  1.20 検索機能に 以上、以下、結合、選択 を追加
#  2000/01/03 Ver  1.30 タブ区切りファイルに対応、検索機能にNOT,ORを追加
#  2000/01/12 Ver  1.31 1.30のバグを修正
#  2000/01/20 Ver  1.32 1.31のバグを修正
#  2000/02/21 Ver  1.33 1.32のバグを修正 10以上の列検索が出来なかったバグ
#  2000/05/13 Ver  1.40 高度検索機能を追加
#  2000/05/23 Ver  1.41 1.40で発生したバグ修正(非公開)
#  2000/05/29 Ver  1.42 やっとこさ公開
#  2000/06/22 Ver  1.43 equalだけで検索すると該当しないバグを修正
#  2000/12/03 Ver  1.43.01 ちょいっとバグ修正
#  2001/09/10 Ver  1.44 query検索機能だけ追加
#================================================================================#