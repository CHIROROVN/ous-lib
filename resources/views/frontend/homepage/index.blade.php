@extends('frontend.layouts.app')
@section('content')
<div class="slider-pro" id="topslider">
  <div class="sp-slides">
    <div class="sp-slide"> <img class="sp-image" src="{{ asset('') }}public/common/image/topslide-01.png" /></div>
    <div class="sp-slide"> <img class="sp-image" src="{{ asset('') }}public/common/image/topslide-02.png"/></div>
    <div class="sp-slide"> <img class="sp-image" src="{{ asset('') }}public/common/image/topslide-03.png"/></div>
  </div>
</div>
<div id="contWrap" class="clear">
  <div id="cont">
    <section>
      <h2>簡易蔵書検索</h2>
      <div class="indexSearch">
        <form name="f_limedio" method="post" action="http://op00.lib.ous.ac.jp/mylimedio/search/search.do?mode=simp" accept-charset="UTF-8" target="_blank" onsubmit="org=document.charset; document.charset='utf-8'; document.f_limedio.submit(); document.charset=org;return false;" >
          <input type="text" name="keyword" value="" size="38">
          <input type="submit" value="検索">
          <input type="hidden" value="level1" name="kwscope" >
          <input type="hidden" value="1" name="category-book">
          <input type="hidden" value="1" name="category-mgz">
          <input type="hidden" value="and" name="query-andor">
          <input type="hidden" value="sjis" name="sessionCode">
          <input type="hidden" value="jpn" name="sessionLang">
        </form>
      </div>
      <div class="clear searchlink">
        <div class="sl01"> <a href="http://op00.lib.ous.ac.jp/mylimedio/search/search-input.do?lang=ja&mode=comp" target="_blank">
          <div class="searchDetail">
            <p><img src="{{ asset('') }}public/common/image/search_detail.png" width="84" height="84"></p>
            <dl>
              <dt>詳細検索</dt>
              <dd>検索条件を詳細に設定できます。</dd>
            </dl>
          </div>
          </a> </div>
        <div class="sl02"> <a href="https://op00.lib.ous.ac.jp/mylimedio/loginPage.do" target="_blank">
          <div class="searchDetail2">
            <p><img src="{{ asset('') }}public/common/image/mylib.png" width="84" height="84"></p>
            <dl>
              <dt>マイライブラリ</dt>
              <dd>自分の借りている本や返却期限などが分かります。</dd>
            </dl>
          </div>
          </a> </div>
      </div>
    </section>
    <seciton>
    <h2>お知らせ<a href="{{route('frontend.news.index')}}"><img src="{{ asset('') }}public/common/image/all.png" width="100" height="30" alt="一覧を見る"></a></h2>
    <ul class="infoList">
      @if(!empty($infos))
      <?php $jumb = 0; ?>
      @foreach($infos as $key => $info)
      <li>@if($info->info_type == 1)
          <a href="{{ $info->info1_url}}"  target="_blank" >
          @elseif($info->info_type == 2)
          <a href="{{ asset('public') }}{{ $info->info2_file}}"  target="_blank" >
          @else
          <a href="{{route('frontend.news.detail', $info->info_id)}}">
          @endif<span>{{format_date($info->info_date,'/')}}</span>{{$info->info_title}}</a></li>
      @endforeach 
      
      @endif
    </ul>
    
    </section>
    <ul class="indexNavi clear">
      <li><a href="http://www.lib.ous.ac.jp/ebook_index.html"><img src="{{ asset('') }}public/common/image/ebook.png" alt="e-BOOK" width="350" height="150"></a></li>
      <li><a href="guide.html"><img src="{{ asset('') }}public/common/image/guide.png" alt="利用案内" width="350" height="150"></a></li>
    </ul>
    <section>
      <h2>電子図書館</h2>
      <ul class="denshi clear">
        <li><a href="https://www.chem-reference.com/" target="_blank"><img src="{{ asset('') }}public/common/image/denshi-01.png" alt="化学書資料館" width="168" height="140"></a></li>
        <li><a href="http://www.rikanenpyo.jp/member/?module=Member&action=Login" target="_blank"><img src="{{ asset('') }}public/common/image/denshi-02.png" alt="理科年表web版" width="168" height="140"></a></li>
        <li><a href="http://bizboard.nikkeibp.co.jp/academic/" target="_blank"><img src="{{ asset('') }}public/common/image/denshi-03.png" alt="日経の雑誌を読む" width="168" height="140"></a></li>
        <li><a href="http://dl.ndl.go.jp/" target="_blank"><img src="{{ asset('') }}public/common/image/denshi-04.png" alt="国立国会図書館デジタルコレクション" width="168" height="140"></a></li>
      </ul>
    </section>
    <section>
      <h2>岡山理科大学学術リポジトリ<a href="https://ous.repo.nii.ac.jp/" target="_blank"><img src="{{ asset('') }}public/common/image/arous.gif" width="126" height="30" alt="AROUSを見る"></a></h2>
      <ul class="repository clear">
        <li><a href="#">リポジトリへの登録について</a></li>
        <li><a href="#">運用指針</a></li>
        <li><a href="#">登録申請書（Excel）</a></li>
        <li><a href="#">著作権ポリシー</a></li>
      </ul>
    </section>
    <section>
      <h2>情報検索</h2>
      <ul class="jyouhou clear">
        <li><a href="http://oudan.libnet.pref.okayama.jp/gf/cgi/start-jp" target="_blank"><img src="{{ asset('') }}public/common/image/link-01.png" width="182" height="52"></a></li>
        <li><a href="https://ci.nii.ac.jp/books/?l=ja" target="_blank"><img src="{{ asset('') }}public/common/image/link-02.png" width="182" height="52"></a></li>
        <li><a href="u_libs.html" target="_blank"><img src="{{ asset('') }}public/common/image/link-03.png" width="182" height="52"></a></li>
        <li><a href="internet.html"><img src="{{ asset('') }}public/common/image/link-04.png" width="182" height="52"></a></li>
        <li><a href="https://scholar.google.com/scholar?hl=ja&lr=" target="_blank"><img src="{{ asset('') }}public/common/image/link-05.png" width="182" height="52"></a></li>
        <li><a href="publish.html"><img src="{{ asset('') }}public/common/image/link-06.png" width="182" height="52"></a></li>
        <li><a href="search_en.html"><img src="{{ asset('') }}public/common/image/link-07.png" width="182" height="52"></a></li>
        <li><a href="http://www.lib.ous.ac.jp/w_supp_tool/w_supp_tool.html" target="_blank"><img src="{{ asset('') }}public/common/image/link-08.png" width="182" height="52"></a></li>
        <li><a href="http://www.nii.ac.jp/service/" target="_blank"><img src="{{ asset('') }}public/common/image/link-09.png" width="182" height="52"></a></li>
        <li><a href="http://webcatplus.nii.ac.jp/" target="_blank"><img src="{{ asset('') }}public/common/image/link-10.png" width="124" height="37"></a></li>
        <li><a href="https://ndlonline.ndl.go.jp/#!/" target="_blank"><img src="{{ asset('') }}public/common/image/link-11.png" width="182" height="52"></a></li>
        <li><a href="https://dic.yahoo.co.jp/" target="_blank"><img src="{{ asset('') }}public/common/image/link-12.png" width="182" height="52"></a></li>
        <li><a href="https://mathscinet.ams.org/mathscinet/" target="_blank"><img src="{{ asset('') }}public/common/image/link-13.png" width="185" height="38"></a></li>
        <li><a href="https://scifinder.cas.org/scifinder/login?TYPE=33554433&REALMOID=06-b7b15cf0-642b-1005-963a-830c809fff21&GUID=&SMAUTHREASON=0&METHOD=GET&SMAGENTNAME=-SM-ugKMi%2bWhwgJDPxHjJYviqwh%2bcuJOHlvK8hWIWKYJyfIaAR4vESV8nLn3DMvI6ByT&TARGET=-SM-http%3a%2f%2fscifinder%2ecas%2eorg%3a443%2fscifinder%2f" target="_blank"><img src="{{ asset('') }}public/common/image/link-14.png" width="135" height="32"></a></li>
        <li><a href="http://login.webofknowledge.com/error/Error?Error=IPError&PathInfo=%2FWOS&RouterURL=http%3A%2F%2Fwww.webofknowledge.com%2F&Domain=.webofknowledge.com&Src=IP&Alias=WOK5" target="_blank"><img src="{{ asset('') }}public/common/image/link-15.png" width="133" height="34"></a></li>
        <li><a href="http://jdream3.com/" target="_blank"><img src="{{ asset('') }}public/common/image/link-16.png" width="182" height="52"></a></li>
      </ul>
    </section>
  </div>
  <div id="side">
    <div class="box">
      <p class="midashi"><img src="{{ asset('') }}public/common/image/side_calendar.gif" alt="図書館カレンダー" width="180" height="33"></p>
      <table width="140" border="0" cellspacing="0" cellpadding="0" class="calendar">
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><IFRAME src="openclose/cal11.html" name="_cal" frameborder="0" scrolling="NO" width="140" height="155"></IFRAME></td>
        </tr>
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
        <tr>
          <td width="10"></td>
          <td width="15" bgcolor="#8FDBFF"><img src="{{ asset('') }}public/img/s.gif" width="1" height="1"></td>
          <td width="5"></td>
          <td width="110" align="left"><span class="b10">9：00～20：45</span></td>
        </tr>
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
        <tr>
          <td></td>
          <td bgcolor="#99E4B4"><img src="{{ asset('') }}public/img/s.gif" alt="" width="1" height="1"></td>
          <td></td>
          <td align="left"><span class="b10">9：30～20：45</span></td>
        </tr>
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
        <tr>
          <td></td>
          <td bgcolor="#FFC397"><img src="{{ asset('') }}public/img/s.gif" alt="" width="1" height="1"></td>
          <td></td>
          <td align="left"><span class="b10">9：30～16：45</span></td>
        </tr>
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
        <tr>
          <td></td>
          <td bgcolor="#C9B8FF"><img src="{{ asset('') }}public/img/s.gif" alt="" width="1" height="1"></td>
          <td></td>
          <td align="left"><span class="b10">9：00～17：00</span></td>
        </tr>
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
        <tr>
          <td></td>
          <td bgcolor="#F8EE66"><img src="{{ asset('') }}public/img/s.gif" alt="" width="1" height="1"></td>
          <td></td>
          <td align="left"><span class="b10">10：00～16：45</span></td>
        </tr>
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
        <tr>
          <td align="center"></td>
          <td align="center" bgcolor="#FFD1FF"><img src="{{ asset('') }}public/img/s.gif" alt="" width="1" height="1"></td>
          <!--td align="center" bgcolor="#FFD1FF"><img src="img/batsu.gif" alt="" align="center"><img src="img/s.gif" alt="" width="1" height="1"></td-->
          <td></td>
          <td align="left"><span class="b10">休館</span></td>
        </tr>
        <tr>
          <td height="5" colspan="4" align="center"></td>
        </tr>
        <tr>
          <td align="center"></td>
          <td align="center"><img src="{{ asset('') }}public/img/icon_pdf.gif" alt="" width="13" height="14"></td>
          <td></td>
          <td align="left"><span class="b10"><a href="openclose/yearly.pdf">１年分のカレンダー</a></span></td>
        </tr>
      </table>
    </div>
    <div class="box">
      <p class="midashi"><img src="{{ asset('') }}public/common/image/side_guide.gif" alt="図書館案内" width="180" height="33"></p>
      <ul>
        <li><a href="guide-02.html">貸出期間や冊数</a></li>
        <li><a href="guidebooks.html">図書館ガイドブック</a></li>
        <li><a href="haichizu/haichizu.html">館内配置図</a></li>
        <li><a href="walk_in_user/gakugai_riyou.html">学外の方へ</a></li>
      </ul>
    </div>
    <div class="box">
      <p class="midashi"><img src="{{ asset('') }}public/common/image/side_order.gif" alt="各種申込（学内限定）" width="180" height="33"></p>
      <ul>
        <li><a href="ill.html">学外文献複写・現物貸借</a></li>
        <li><a href="sensyo.html">図書の推薦</a></li>
      </ul>
    </div>
    <div class="box">
      <p class="midashi"><img src="{{ asset('') }}public/common/image/side_kiyou.gif" alt="紀要委員会" width="180" height="33"></p>
      <ul>
        <li><a href="kiyou/ky_main.html">紀要の投稿作成について</a></li>
        <li><a href="kiyou/ky_kitei.html">紀要投稿要項</a></li>
        <li><a href="kiyou/ky_mk.pdf">原稿作成要領</a></li>
      </ul>
    </div>
    <div class="box">
      <p class="midashi"><img src="{{ asset('') }}public/common/image/side_hou.gif" alt="図書館報" width="180" height="33"></p>
      <p class="links"><a href="ritonews.html"><img src="{{ asset('') }}public/common/image/icon_ritonews.gif" alt="りとにゅーす" width="154" height="43"></a></p>
      <p class="links"><a href="rsd_index.html"><img src="{{ asset('') }}public/common/image/icon_stardust.gif" alt="りとにゅーす Stardust" width="154" height="44"></a></p>
    </div>
    <div class="box">
      <p class="midashi"><img src="{{ asset('') }}public/common/image/side_keitai.gif" alt="携帯版HP" width="180" height="33"></p>
      <p class="links"><img src="{{ asset('') }}public/common/image/QRcodex2.png" width="74" height="74"></p>
      <p>QRコードで簡単に携帯サイトへアクセスできます。<br>
        ※携帯電話の機種によっては表示が乱れることがあります。</p>
    </div>
    <div class="counter"> <img src="/cgi-bin/dream_counter/dream.cgi?id=new_index&fig=6&gif=2"><br>
      <span style="font-size:7pt">(Since 2003/12/1)</span> </div>
    <p class="staff"><a href="staffpg/staff_index.html"><img src="{{ asset('') }}public/common/image/forstaff.png" width="140" height="30"></a></p>
  </div>
</div>     
@endsection