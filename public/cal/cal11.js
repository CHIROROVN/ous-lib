<!--
	//カレンダーのID／複数設置する場合に要設定
	var cal_Id = 'cal_0';
	
	var calObject = new Object();
	calObject[cal_Id] = new Object();
	
	//Xヵ月後のカレンダーを表示する場合 :: 1は当月
	var cal_display_month = 1;
	calObject[cal_Id].after = new Array();
	
	//定休日などはここで設定します。
	//calObject[cal_Id].day[ここに日にちを半角で] = クラス名;
	calObject[cal_Id].day = new Object();
	calObject[cal_Id].text = new Object();
	
//ここにエクセルで作ったデータをコピペする。

calObject[cal_Id].day["2017/2/1"] = "ptn6";
calObject[cal_Id].day["2017/2/2"] = "ptn6";
calObject[cal_Id].day["2017/2/3"] = "ptn6";
calObject[cal_Id].day["2017/2/4"] = "ptn6";
calObject[cal_Id].day["2017/2/5"] = "ptn6";
calObject[cal_Id].day["2017/2/6"] = "ptn3";
calObject[cal_Id].day["2017/2/7"] = "ptn3";
calObject[cal_Id].day["2017/2/8"] = "ptn3";
calObject[cal_Id].day["2017/2/9"] = "ptn3";
calObject[cal_Id].day["2017/2/10"] = "ptn3";
calObject[cal_Id].day["2017/2/11"] = "ptn6";
calObject[cal_Id].day["2017/2/12"] = "ptn6";
calObject[cal_Id].day["2017/2/13"] = "ptn3";
calObject[cal_Id].day["2017/2/14"] = "ptn3";
calObject[cal_Id].day["2017/2/15"] = "ptn3";
calObject[cal_Id].day["2017/2/16"] = "ptn3";
calObject[cal_Id].day["2017/2/17"] = "ptn3";
calObject[cal_Id].day["2017/2/18"] = "ptn6";
calObject[cal_Id].day["2017/2/19"] = "ptn6";
calObject[cal_Id].day["2017/2/20"] = "ptn3";
calObject[cal_Id].day["2017/2/21"] = "ptn3";
calObject[cal_Id].day["2017/2/22"] = "ptn3";
calObject[cal_Id].day["2017/2/23"] = "ptn3";
calObject[cal_Id].day["2017/2/24"] = "ptn3";
calObject[cal_Id].day["2017/2/25"] = "ptn6";
calObject[cal_Id].day["2017/2/26"] = "ptn6";
calObject[cal_Id].day["2017/2/27"] = "ptn3";
calObject[cal_Id].day["2017/2/28"] = "ptn3";
calObject[cal_Id].day["2017/3/1"] = "ptn3";
calObject[cal_Id].day["2017/3/2"] = "ptn3";
calObject[cal_Id].day["2017/3/3"] = "ptn3";
calObject[cal_Id].day["2017/3/4"] = "ptn6";
calObject[cal_Id].day["2017/3/5"] = "ptn6";
calObject[cal_Id].day["2017/3/6"] = "ptn3";
calObject[cal_Id].day["2017/3/7"] = "ptn3";
calObject[cal_Id].day["2017/3/8"] = "ptn3";
calObject[cal_Id].day["2017/3/9"] = "ptn3";
calObject[cal_Id].day["2017/3/10"] = "ptn3";
calObject[cal_Id].day["2017/3/11"] = "ptn6";
calObject[cal_Id].day["2017/3/12"] = "ptn6";
calObject[cal_Id].day["2017/3/13"] = "ptn3";
calObject[cal_Id].day["2017/3/14"] = "ptn3";
calObject[cal_Id].day["2017/3/15"] = "ptn3";
calObject[cal_Id].day["2017/3/16"] = "ptn3";
calObject[cal_Id].day["2017/3/17"] = "ptn3";
calObject[cal_Id].day["2017/3/18"] = "ptn6";
calObject[cal_Id].day["2017/3/19"] = "ptn6";
calObject[cal_Id].day["2017/3/20"] = "ptn6";
calObject[cal_Id].day["2017/3/21"] = "ptn3";
calObject[cal_Id].day["2017/3/22"] = "ptn6";
calObject[cal_Id].day["2017/3/23"] = "ptn3";
calObject[cal_Id].day["2017/3/24"] = "ptn3";
calObject[cal_Id].day["2017/3/25"] = "ptn6";
calObject[cal_Id].day["2017/3/26"] = "ptn6";
calObject[cal_Id].day["2017/3/27"] = "ptn3";
calObject[cal_Id].day["2017/3/28"] = "ptn3";
calObject[cal_Id].day["2017/3/29"] = "ptn3";
calObject[cal_Id].day["2017/3/30"] = "ptn3";
calObject[cal_Id].day["2017/3/31"] = "ptn3";
calObject[cal_Id].day["2017/4/1"] = "ptn6";
calObject[cal_Id].day["2017/4/2"] = "ptn6";
calObject[cal_Id].day["2017/4/3"] = "ptn6";
calObject[cal_Id].day["2017/4/4"] = "ptn3";
calObject[cal_Id].day["2017/4/5"] = "ptn3";
calObject[cal_Id].day["2017/4/6"] = "ptn3";
calObject[cal_Id].day["2017/4/7"] = "ptn3";
calObject[cal_Id].day["2017/4/8"] = "ptn3";
calObject[cal_Id].day["2017/4/9"] = "ptn6";
calObject[cal_Id].day["2017/4/10"] = "ptn1";
calObject[cal_Id].day["2017/4/11"] = "ptn1";
calObject[cal_Id].day["2017/4/12"] = "ptn1";
calObject[cal_Id].day["2017/4/13"] = "ptn1";
calObject[cal_Id].day["2017/4/14"] = "ptn1";
calObject[cal_Id].day["2017/4/15"] = "ptn4";
calObject[cal_Id].day["2017/4/16"] = "ptn6";
calObject[cal_Id].day["2017/4/17"] = "ptn1";
calObject[cal_Id].day["2017/4/18"] = "ptn1";
calObject[cal_Id].day["2017/4/19"] = "ptn1";
calObject[cal_Id].day["2017/4/20"] = "ptn1";
calObject[cal_Id].day["2017/4/21"] = "ptn1";
calObject[cal_Id].day["2017/4/22"] = "ptn6";
calObject[cal_Id].day["2017/4/23"] = "ptn6";
calObject[cal_Id].day["2017/4/24"] = "ptn1";
calObject[cal_Id].day["2017/4/25"] = "ptn1";
calObject[cal_Id].day["2017/4/26"] = "ptn1";
calObject[cal_Id].day["2017/4/27"] = "ptn1";
calObject[cal_Id].day["2017/4/28"] = "ptn1";
calObject[cal_Id].day["2017/4/29"] = "ptn6";
calObject[cal_Id].day["2017/4/30"] = "ptn6";
calObject[cal_Id].day["2017/5/1"] = "ptn6";
calObject[cal_Id].day["2017/5/2"] = "ptn6";
calObject[cal_Id].day["2017/5/3"] = "ptn6";
calObject[cal_Id].day["2017/5/4"] = "ptn6";
calObject[cal_Id].day["2017/5/5"] = "ptn6";
calObject[cal_Id].day["2017/5/6"] = "ptn6";
calObject[cal_Id].day["2017/5/7"] = "ptn6";
calObject[cal_Id].day["2017/5/8"] = "ptn1";
calObject[cal_Id].day["2017/5/9"] = "ptn1";
calObject[cal_Id].day["2017/5/10"] = "ptn1";
calObject[cal_Id].day["2017/5/11"] = "ptn1";
calObject[cal_Id].day["2017/5/12"] = "ptn1";
calObject[cal_Id].day["2017/5/13"] = "ptn4";
calObject[cal_Id].day["2017/5/14"] = "ptn4";
calObject[cal_Id].day["2017/5/15"] = "ptn1";
calObject[cal_Id].day["2017/5/16"] = "ptn1";
calObject[cal_Id].day["2017/5/17"] = "ptn1";
calObject[cal_Id].day["2017/5/18"] = "ptn1";
calObject[cal_Id].day["2017/5/19"] = "ptn1";
calObject[cal_Id].day["2017/5/20"] = "ptn4";
calObject[cal_Id].day["2017/5/21"] = "ptn4";
calObject[cal_Id].day["2017/5/22"] = "ptn1";
calObject[cal_Id].day["2017/5/23"] = "ptn1";
calObject[cal_Id].day["2017/5/24"] = "ptn1";
calObject[cal_Id].day["2017/5/25"] = "ptn1";
calObject[cal_Id].day["2017/5/26"] = "ptn1";
calObject[cal_Id].day["2017/5/27"] = "ptn4";
calObject[cal_Id].day["2017/5/28"] = "ptn4";
calObject[cal_Id].day["2017/5/29"] = "ptn1";
calObject[cal_Id].day["2017/5/30"] = "ptn1";
calObject[cal_Id].day["2017/5/31"] = "ptn1";
calObject[cal_Id].day["2017/6/1"] = "ptn1";
calObject[cal_Id].day["2017/6/2"] = "ptn1";
calObject[cal_Id].day["2017/6/3"] = "ptn4";
calObject[cal_Id].day["2017/6/4"] = "ptn4";
calObject[cal_Id].day["2017/6/5"] = "ptn1";
calObject[cal_Id].day["2017/6/6"] = "ptn1";
calObject[cal_Id].day["2017/6/7"] = "ptn1";
calObject[cal_Id].day["2017/6/8"] = "ptn1";
calObject[cal_Id].day["2017/6/9"] = "ptn1";
calObject[cal_Id].day["2017/6/10"] = "ptn4";
calObject[cal_Id].day["2017/6/11"] = "ptn4";
calObject[cal_Id].day["2017/6/12"] = "ptn1";
calObject[cal_Id].day["2017/6/13"] = "ptn1";
calObject[cal_Id].day["2017/6/14"] = "ptn1";
calObject[cal_Id].day["2017/6/15"] = "ptn1";
calObject[cal_Id].day["2017/6/16"] = "ptn1";
calObject[cal_Id].day["2017/6/17"] = "ptn4";
calObject[cal_Id].day["2017/6/18"] = "ptn4";
calObject[cal_Id].day["2017/6/19"] = "ptn1";
calObject[cal_Id].day["2017/6/20"] = "ptn1";
calObject[cal_Id].day["2017/6/21"] = "ptn1";
calObject[cal_Id].day["2017/6/22"] = "ptn1";
calObject[cal_Id].day["2017/6/23"] = "ptn1";
calObject[cal_Id].day["2017/6/24"] = "ptn4";
calObject[cal_Id].day["2017/6/25"] = "ptn4";
calObject[cal_Id].day["2017/6/26"] = "ptn1";
calObject[cal_Id].day["2017/6/27"] = "ptn1";
calObject[cal_Id].day["2017/6/28"] = "ptn1";
calObject[cal_Id].day["2017/6/29"] = "ptn1";
calObject[cal_Id].day["2017/6/30"] = "ptn1";
calObject[cal_Id].day["2017/7/1"] = "ptn4";
calObject[cal_Id].day["2017/7/2"] = "ptn4";
calObject[cal_Id].day["2017/7/3"] = "ptn1";
calObject[cal_Id].day["2017/7/4"] = "ptn1";
calObject[cal_Id].day["2017/7/5"] = "ptn1";
calObject[cal_Id].day["2017/7/6"] = "ptn1";
calObject[cal_Id].day["2017/7/7"] = "ptn3";
calObject[cal_Id].day["2017/7/8"] = "ptn4";
calObject[cal_Id].day["2017/7/9"] = "ptn4";
calObject[cal_Id].day["2017/7/10"] = "ptn1";
calObject[cal_Id].day["2017/7/11"] = "ptn1";
calObject[cal_Id].day["2017/7/12"] = "ptn1";
calObject[cal_Id].day["2017/7/13"] = "ptn1";
calObject[cal_Id].day["2017/7/14"] = "ptn1";
calObject[cal_Id].day["2017/7/15"] = "ptn4";
calObject[cal_Id].day["2017/7/16"] = "ptn4";
calObject[cal_Id].day["2017/7/17"] = "ptn1";
calObject[cal_Id].day["2017/7/18"] = "ptn1";
calObject[cal_Id].day["2017/7/19"] = "ptn1";
calObject[cal_Id].day["2017/7/20"] = "ptn1";
calObject[cal_Id].day["2017/7/21"] = "ptn1";
calObject[cal_Id].day["2017/7/22"] = "ptn4";
calObject[cal_Id].day["2017/7/23"] = "ptn4";
calObject[cal_Id].day["2017/7/24"] = "ptn1";
calObject[cal_Id].day["2017/7/25"] = "ptn1";
calObject[cal_Id].day["2017/7/26"] = "ptn1";
calObject[cal_Id].day["2017/7/27"] = "ptn1";
calObject[cal_Id].day["2017/7/28"] = "ptn1";
calObject[cal_Id].day["2017/7/29"] = "ptn4";
calObject[cal_Id].day["2017/7/30"] = "ptn4";
calObject[cal_Id].day["2017/7/31"] = "ptn1";
calObject[cal_Id].day["2017/8/1"] = "ptn1";
calObject[cal_Id].day["2017/8/2"] = "ptn1";
calObject[cal_Id].day["2017/8/3"] = "ptn1";
calObject[cal_Id].day["2017/8/4"] = "ptn1";
calObject[cal_Id].day["2017/8/5"] = "ptn4";
calObject[cal_Id].day["2017/8/6"] = "ptn4";
calObject[cal_Id].day["2017/8/7"] = "ptn1";
calObject[cal_Id].day["2017/8/8"] = "ptn1";
calObject[cal_Id].day["2017/8/9"] = "ptn3";
calObject[cal_Id].day["2017/8/10"] = "ptn6";
calObject[cal_Id].day["2017/8/11"] = "ptn6";
calObject[cal_Id].day["2017/8/12"] = "ptn6";
calObject[cal_Id].day["2017/8/13"] = "ptn6";
calObject[cal_Id].day["2017/8/14"] = "ptn6";
calObject[cal_Id].day["2017/8/15"] = "ptn6";
calObject[cal_Id].day["2017/8/16"] = "ptn6";
calObject[cal_Id].day["2017/8/17"] = "ptn6";
calObject[cal_Id].day["2017/8/18"] = "ptn6";
calObject[cal_Id].day["2017/8/19"] = "ptn6";
calObject[cal_Id].day["2017/8/20"] = "ptn6";
calObject[cal_Id].day["2017/8/21"] = "ptn3";
calObject[cal_Id].day["2017/8/22"] = "ptn3";
calObject[cal_Id].day["2017/8/23"] = "ptn3";
calObject[cal_Id].day["2017/8/24"] = "ptn3";
calObject[cal_Id].day["2017/8/25"] = "ptn3";
calObject[cal_Id].day["2017/8/26"] = "ptn6";
calObject[cal_Id].day["2017/8/27"] = "ptn6";
calObject[cal_Id].day["2017/8/28"] = "ptn6";
calObject[cal_Id].day["2017/8/29"] = "ptn3";
calObject[cal_Id].day["2017/8/30"] = "ptn3";
calObject[cal_Id].day["2017/8/31"] = "ptn3";
calObject[cal_Id].day["2017/9/1"] = "ptn3";
calObject[cal_Id].day["2017/9/2"] = "ptn6";
calObject[cal_Id].day["2017/9/3"] = "ptn6";
calObject[cal_Id].day["2017/9/4"] = "ptn3";
calObject[cal_Id].day["2017/9/5"] = "ptn3";
calObject[cal_Id].day["2017/9/6"] = "ptn3";
calObject[cal_Id].day["2017/9/7"] = "ptn3";
calObject[cal_Id].day["2017/9/8"] = "ptn3";
calObject[cal_Id].day["2017/9/9"] = "ptn6";
calObject[cal_Id].day["2017/9/10"] = "ptn6";
calObject[cal_Id].day["2017/9/11"] = "ptn3";
calObject[cal_Id].day["2017/9/12"] = "ptn3";
calObject[cal_Id].day["2017/9/13"] = "ptn3";
calObject[cal_Id].day["2017/9/14"] = "ptn3";
calObject[cal_Id].day["2017/9/15"] = "ptn1";
calObject[cal_Id].day["2017/9/16"] = "ptn4";
calObject[cal_Id].day["2017/9/17"] = "ptn4";
calObject[cal_Id].day["2017/9/18"] = "ptn1";
calObject[cal_Id].day["2017/9/19"] = "ptn1";
calObject[cal_Id].day["2017/9/20"] = "ptn1";
calObject[cal_Id].day["2017/9/21"] = "ptn1";
calObject[cal_Id].day["2017/9/22"] = "ptn1";
calObject[cal_Id].day["2017/9/23"] = "ptn6";
calObject[cal_Id].day["2017/9/24"] = "ptn4";
calObject[cal_Id].day["2017/9/25"] = "ptn1";
calObject[cal_Id].day["2017/9/26"] = "ptn1";
calObject[cal_Id].day["2017/9/27"] = "ptn1";
calObject[cal_Id].day["2017/9/28"] = "ptn1";
calObject[cal_Id].day["2017/9/29"] = "ptn1";
calObject[cal_Id].day["2017/9/30"] = "ptn4";
calObject[cal_Id].day["2017/10/1"] = "ptn6";
calObject[cal_Id].day["2017/10/2"] = "ptn1";
calObject[cal_Id].day["2017/10/3"] = "ptn1";
calObject[cal_Id].day["2017/10/4"] = "ptn1";
calObject[cal_Id].day["2017/10/5"] = "ptn1";
calObject[cal_Id].day["2017/10/6"] = "ptn1";
calObject[cal_Id].day["2017/10/7"] = "ptn4";
calObject[cal_Id].day["2017/10/8"] = "ptn4";
calObject[cal_Id].day["2017/10/9"] = "ptn1";
calObject[cal_Id].day["2017/10/10"] = "ptn1";
calObject[cal_Id].day["2017/10/11"] = "ptn1";
calObject[cal_Id].day["2017/10/12"] = "ptn1";
calObject[cal_Id].day["2017/10/13"] = "ptn1";
calObject[cal_Id].day["2017/10/14"] = "ptn4";
calObject[cal_Id].day["2017/10/15"] = "ptn4";
calObject[cal_Id].day["2017/10/16"] = "ptn1";
calObject[cal_Id].day["2017/10/17"] = "ptn1";
calObject[cal_Id].day["2017/10/18"] = "ptn1";
calObject[cal_Id].day["2017/10/19"] = "ptn1";
calObject[cal_Id].day["2017/10/20"] = "ptn1";
calObject[cal_Id].day["2017/10/21"] = "ptn4";
calObject[cal_Id].day["2017/10/22"] = "ptn4";
calObject[cal_Id].day["2017/10/23"] = "ptn1";
calObject[cal_Id].day["2017/10/24"] = "ptn1";
calObject[cal_Id].day["2017/10/25"] = "ptn1";
calObject[cal_Id].day["2017/10/26"] = "ptn1";
calObject[cal_Id].day["2017/10/27"] = "ptn1";
calObject[cal_Id].day["2017/10/28"] = "ptn4";
calObject[cal_Id].day["2017/10/29"] = "ptn4";
calObject[cal_Id].day["2017/10/30"] = "ptn1";
calObject[cal_Id].day["2017/10/31"] = "ptn1";
calObject[cal_Id].day["2017/11/1"] = "ptn1";
calObject[cal_Id].day["2017/11/2"] = "ptn1";
calObject[cal_Id].day["2017/11/3"] = "ptn6";
calObject[cal_Id].day["2017/11/4"] = "ptn4";
calObject[cal_Id].day["2017/11/5"] = "ptn4";
calObject[cal_Id].day["2017/11/6"] = "ptn1";
calObject[cal_Id].day["2017/11/7"] = "ptn1";
calObject[cal_Id].day["2017/11/8"] = "ptn1";
calObject[cal_Id].day["2017/11/9"] = "ptn1";
calObject[cal_Id].day["2017/11/10"] = "ptn1";
calObject[cal_Id].day["2017/11/11"] = "ptn4";
calObject[cal_Id].day["2017/11/12"] = "ptn4";
calObject[cal_Id].day["2017/11/13"] = "ptn3";
calObject[cal_Id].day["2017/11/14"] = "ptn3";
calObject[cal_Id].day["2017/11/15"] = "ptn3";
calObject[cal_Id].day["2017/11/16"] = "ptn1";
calObject[cal_Id].day["2017/11/17"] = "ptn1";
calObject[cal_Id].day["2017/11/18"] = "ptn6";
calObject[cal_Id].day["2017/11/19"] = "ptn6";
calObject[cal_Id].day["2017/11/20"] = "ptn1";
calObject[cal_Id].day["2017/11/21"] = "ptn1";
calObject[cal_Id].day["2017/11/22"] = "ptn1";
calObject[cal_Id].day["2017/11/23"] = "ptn6";
calObject[cal_Id].day["2017/11/24"] = "ptn3";
calObject[cal_Id].day["2017/11/25"] = "ptn4";
calObject[cal_Id].day["2017/11/26"] = "ptn4";
calObject[cal_Id].day["2017/11/27"] = "ptn6";
calObject[cal_Id].day["2017/11/28"] = "ptn1";
calObject[cal_Id].day["2017/11/29"] = "ptn1";
calObject[cal_Id].day["2017/11/30"] = "ptn1";
calObject[cal_Id].day["2017/12/1"] = "ptn1";
calObject[cal_Id].day["2017/12/2"] = "ptn4";
calObject[cal_Id].day["2017/12/3"] = "ptn4";
calObject[cal_Id].day["2017/12/4"] = "ptn1";
calObject[cal_Id].day["2017/12/5"] = "ptn1";
calObject[cal_Id].day["2017/12/6"] = "ptn1";
calObject[cal_Id].day["2017/12/7"] = "ptn1";
calObject[cal_Id].day["2017/12/8"] = "ptn1";
calObject[cal_Id].day["2017/12/9"] = "ptn6";
calObject[cal_Id].day["2017/12/10"] = "ptn6";
calObject[cal_Id].day["2017/12/11"] = "ptn1";
calObject[cal_Id].day["2017/12/12"] = "ptn1";
calObject[cal_Id].day["2017/12/13"] = "ptn1";
calObject[cal_Id].day["2017/12/14"] = "ptn1";
calObject[cal_Id].day["2017/12/15"] = "ptn1";
calObject[cal_Id].day["2017/12/16"] = "ptn6";
calObject[cal_Id].day["2017/12/17"] = "ptn6";
calObject[cal_Id].day["2017/12/18"] = "ptn1";
calObject[cal_Id].day["2017/12/19"] = "ptn1";
calObject[cal_Id].day["2017/12/20"] = "ptn1";
calObject[cal_Id].day["2017/12/21"] = "ptn1";
calObject[cal_Id].day["2017/12/22"] = "ptn1";
calObject[cal_Id].day["2017/12/23"] = "ptn6";
calObject[cal_Id].day["2017/12/24"] = "ptn4";
calObject[cal_Id].day["2017/12/25"] = "ptn3";
calObject[cal_Id].day["2017/12/26"] = "ptn6";
calObject[cal_Id].day["2017/12/27"] = "ptn6";
calObject[cal_Id].day["2017/12/28"] = "ptn6";
calObject[cal_Id].day["2017/12/29"] = "ptn6";
calObject[cal_Id].day["2017/12/30"] = "ptn6";
calObject[cal_Id].day["2017/12/31"] = "ptn6";
calObject[cal_Id].day["2018/1/1"] = "ptn6";
calObject[cal_Id].day["2018/1/2"] = "ptn6";
calObject[cal_Id].day["2018/1/3"] = "ptn6";
calObject[cal_Id].day["2018/1/4"] = "ptn6";
calObject[cal_Id].day["2018/1/5"] = "ptn1";
calObject[cal_Id].day["2018/1/6"] = "ptn4";
calObject[cal_Id].day["2018/1/7"] = "ptn4";
calObject[cal_Id].day["2018/1/8"] = "ptn6";
calObject[cal_Id].day["2018/1/9"] = "ptn3";
calObject[cal_Id].day["2018/1/10"] = "ptn1";
calObject[cal_Id].day["2018/1/11"] = "ptn1";
calObject[cal_Id].day["2018/1/12"] = "ptn3";
calObject[cal_Id].day["2018/1/13"] = "ptn6";
calObject[cal_Id].day["2018/1/14"] = "ptn6";
calObject[cal_Id].day["2018/1/15"] = "ptn1";
calObject[cal_Id].day["2018/1/16"] = "ptn1";
calObject[cal_Id].day["2018/1/17"] = "ptn1";
calObject[cal_Id].day["2018/1/18"] = "ptn1";
calObject[cal_Id].day["2018/1/19"] = "ptn1";
calObject[cal_Id].day["2018/1/20"] = "ptn4";
calObject[cal_Id].day["2018/1/21"] = "ptn4";
calObject[cal_Id].day["2018/1/22"] = "ptn1";
calObject[cal_Id].day["2018/1/23"] = "ptn1";
calObject[cal_Id].day["2018/1/24"] = "ptn1";
calObject[cal_Id].day["2018/1/25"] = "ptn1";
calObject[cal_Id].day["2018/1/26"] = "ptn1";
calObject[cal_Id].day["2018/1/27"] = "ptn4";
calObject[cal_Id].day["2018/1/28"] = "ptn4";
calObject[cal_Id].day["2018/1/29"] = "ptn1";
calObject[cal_Id].day["2018/1/30"] = "ptn1";
calObject[cal_Id].day["2018/1/31"] = "ptn3";
calObject[cal_Id].day["2018/2/1"] = "ptn6";
calObject[cal_Id].day["2018/2/2"] = "ptn6";
calObject[cal_Id].day["2018/2/3"] = "ptn6";
calObject[cal_Id].day["2018/2/4"] = "ptn6";
calObject[cal_Id].day["2018/2/5"] = "ptn1";
calObject[cal_Id].day["2018/2/6"] = "ptn3";
calObject[cal_Id].day["2018/2/7"] = "ptn3";
calObject[cal_Id].day["2018/2/8"] = "ptn3";
calObject[cal_Id].day["2018/2/9"] = "ptn3";
calObject[cal_Id].day["2018/2/10"] = "ptn6";
calObject[cal_Id].day["2018/2/11"] = "ptn6";
calObject[cal_Id].day["2018/2/12"] = "ptn6";
calObject[cal_Id].day["2018/2/13"] = "ptn3";
calObject[cal_Id].day["2018/2/14"] = "ptn3";
calObject[cal_Id].day["2018/2/15"] = "ptn3";
calObject[cal_Id].day["2018/2/16"] = "ptn3";
calObject[cal_Id].day["2018/2/17"] = "ptn6";
calObject[cal_Id].day["2018/2/18"] = "ptn6";
calObject[cal_Id].day["2018/2/19"] = "ptn6";
calObject[cal_Id].day["2018/2/20"] = "ptn3";
calObject[cal_Id].day["2018/2/21"] = "ptn3";
calObject[cal_Id].day["2018/2/22"] = "ptn3";
calObject[cal_Id].day["2018/2/23"] = "ptn3";
calObject[cal_Id].day["2018/2/24"] = "ptn6";
calObject[cal_Id].day["2018/2/25"] = "ptn6";
calObject[cal_Id].day["2018/2/26"] = "ptn3";
calObject[cal_Id].day["2018/2/27"] = "ptn3";
calObject[cal_Id].day["2018/2/28"] = "ptn3";
calObject[cal_Id].day["2018/3/1"] = "ptn3";
calObject[cal_Id].day["2018/3/2"] = "ptn3";
calObject[cal_Id].day["2018/3/3"] = "ptn6";
calObject[cal_Id].day["2018/3/4"] = "ptn6";
calObject[cal_Id].day["2018/3/5"] = "ptn3";
calObject[cal_Id].day["2018/3/6"] = "ptn3";
calObject[cal_Id].day["2018/3/7"] = "ptn3";
calObject[cal_Id].day["2018/3/8"] = "ptn3";
calObject[cal_Id].day["2018/3/9"] = "ptn3";
calObject[cal_Id].day["2018/3/10"] = "ptn6";
calObject[cal_Id].day["2018/3/11"] = "ptn6";
calObject[cal_Id].day["2018/3/12"] = "ptn3";
calObject[cal_Id].day["2018/3/13"] = "ptn3";
calObject[cal_Id].day["2018/3/14"] = "ptn3";
calObject[cal_Id].day["2018/3/15"] = "ptn3";
calObject[cal_Id].day["2018/3/16"] = "ptn3";
calObject[cal_Id].day["2018/3/17"] = "ptn6";
calObject[cal_Id].day["2018/3/18"] = "ptn6";
calObject[cal_Id].day["2018/3/19"] = "ptn3";
calObject[cal_Id].day["2018/3/20"] = "ptn6";
calObject[cal_Id].day["2018/3/21"] = "ptn6";
calObject[cal_Id].day["2018/3/22"] = "ptn6";
calObject[cal_Id].day["2018/3/23"] = "ptn3";
calObject[cal_Id].day["2018/3/24"] = "ptn6";
calObject[cal_Id].day["2018/3/25"] = "ptn6";
calObject[cal_Id].day["2018/3/26"] = "ptn3";
calObject[cal_Id].day["2018/3/27"] = "ptn3";
calObject[cal_Id].day["2018/3/28"] = "ptn3";
calObject[cal_Id].day["2018/3/29"] = "ptn3";
calObject[cal_Id].day["2018/3/30"] = "ptn3";
calObject[cal_Id].day["2018/3/31"] = "ptn6";


	
	//○日後
	calObject[cal_Id].after = new Array();
	//calObject[cal_Id].after[4] = "deli";
	
	//毎週○曜日の場合
	calObject[cal_Id].week = new Object();
	calObject[cal_Id].week["flag"] = 1;
	calObject[cal_Id].week["Sun"] = "Sun";
	calObject[cal_Id].week["Mon"];
	calObject[cal_Id].week["Tue"];
	calObject[cal_Id].week["Wed"];
	calObject[cal_Id].week["Thu"];
	calObject[cal_Id].week["Fri"];
	calObject[cal_Id].week["Sat"] = "Sat";
	
	//○日後
	calObject[cal_Id].after = new Array();
//	calObject[cal_Id].after[3] = "deli";
	
	//毎週○曜日の場合
	calObject[cal_Id].week = new Object();
	calObject[cal_Id].week["flag"] = 1;
	calObject[cal_Id].week["Sun"] = "Sun";
	calObject[cal_Id].week["Mon"];
	calObject[cal_Id].week["Tue"];
	calObject[cal_Id].week["Wed"];
	calObject[cal_Id].week["Thu"];
	calObject[cal_Id].week["Fri"];
	calObject[cal_Id].week["Sat"] = "Sat";
	
	//毎月○日の場合
	calObject[cal_Id].month = new Object();
//	calObject[cal_Id].month[1] = "openingsale";
	
	//カレンダーをクリックできるようにする場合
	calObject[cal_Id].click = new Object();
	////パラメータを送るURL
	calObject[cal_Id].click["url"];
	////クリック可能にするクラス名(クラス指定なしの場合は指定せず)
	calObject[cal_Id].click["day"];
	
	calObject[cal_Id].today = new Date();
	calObject[cal_Id].cal_year = calObject[cal_Id].today.getYear();
	calObject[cal_Id].cal_month = calObject[cal_Id].today.getMonth() + cal_display_month;
	calObject[cal_Id].cal_day = calObject[cal_Id].today.getDate();
	if(calObject[cal_Id].cal_year < 1900) calObject[cal_Id].cal_year += 1900;
	if(calObject[cal_Id].cal_month < 1){
		calObject[cal_Id].cal_month += 12;
		calObject[cal_Id].cal_year -= 1;
	}
	else if(calObject[cal_Id].cal_month > 12){
		calObject[cal_Id].cal_month -= 12;
		calObject[cal_Id].cal_year = calObject[cal_Id].cal_year + 1;
	}
	
	if(cal_display_month == 1){
		calObject[cal_Id].text[calObject[cal_Id].cal_year+"/"+calObject[cal_Id].cal_month+"/"+calObject[cal_Id].cal_day] = "Today";
		for(i=0;i<calObject[cal_Id].after.length;i++){
			if(calObject[cal_Id].after[i] != undefined){
				nmsec = i * 1000 * 60 * 60 * 24;
				msec  = (new Date()).getTime();
				dt    = new Date(nmsec+msec);
				month = dt.getMonth() + 1;
				date  = dt.getDate();
				year = dt.getYear();
				if(year < 1900) year += 1900;
				calObject[cal_Id].day[year+"/"+month+"/"+date] = calObject[cal_Id].after[i];
			}
		}
	}
	
	document.write("<div class='cal_wrapper'>");
	document.write("<ul class='cal_ui'>");
	document.write("<li class=\"cal_prev\" onclick=\"prevCal('"+cal_Id+"')\"></li>");
	document.write("<li class='cal_to' onclick=\"currentCal('"+cal_Id+"')\"></li>");
	document.write("<li class='cal_next' onclick=\"nextCal('"+cal_Id+"')\"></li>");
	document.write("</ul>");
	document.write("<div id='"+cal_Id+"' class='cal_base'></div>");
	document.write("</div>");
	
	calObject[cal_Id].to_year = calObject[cal_Id].cal_year;
	calObject[cal_Id].to_month = calObject[cal_Id].cal_month;
	calObject[cal_Id].to_day = calObject[cal_Id].cal_day;
	
	
	function currentCal(calObj){
		calObject[calObj].cal_year = calObject[calObj].to_year;
		calObject[calObj].cal_month = calObject[calObj].to_month;
		calObject[calObj].cal_day = calObject[calObj].to_day;
		writeCal(calObject[calObj].cal_year,calObject[calObj].cal_month,calObject[calObj].cal_day,calObj);
	}
	function prevCal(calObj){
		calObject[calObj].cal_month -= 1;
		if(calObject[calObj].cal_month < 1){
			calObject[calObj].cal_month = 12;
			calObject[calObj].cal_year -= 1;
		}
		writeCal(calObject[calObj].cal_year,calObject[calObj].cal_month,0,calObj);
	}
	function nextCal(calObj){
		calObject[calObj].cal_month += 1;
		if(calObject[calObj].cal_month > 12){
			calObject[calObj].cal_month = 1;
			calObject[calObj].cal_year += 1;
		}
		writeCal(calObject[calObj].cal_year,calObject[calObj].cal_month,0,calObj);
	}
	function getWeek(year,month,day){
		if (month == 1 || month == 2) {
			year--;
			month += 12;
		}
		var week = Math.floor(year + Math.floor(year/4) - Math.floor(year/100) + Math.floor(year/400) + Math.floor((13 * month + 8) / 5) + day) % 7;
		return week;
	}
	function writeCal(year,month,day,calObj){
		var calendars = new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
		var weeks = new Array("日","月","火","水","木","金","土");
		var monthName = new Array('','1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
		
		var cal_flag = 0;
		if(year % 100 == 0 || year % 4 != 0){
			if(year % 400 != 0){
				cal_flag = 0;
			}
			else{
				cal_flag = 1;
			}
		}
		else if(year % 4 == 0){
			cal_flag = 1;
		}
		else{
			cal_flag = 0;
		}
		calendars[2] += cal_flag;
		
		var cal_start_day = getWeek(year,month,1);
		var cal_tags = "<p>" + year + "年" + monthName[month] + "</p>";
		cal_tags += "<ul class='cal_main'>";
		for(var i=0;i<weeks.length;i++){
			cal_tags += "<li class='cal_headline'><span>" + weeks[i] + "</span></li>";
		}
		for(var i=0;i < cal_start_day;i++){
			cal_tags += "<li><span>&nbsp;</span></li>";
		}
		
		//main
		var first_thu_flag = 1;
		var day_after = null;
		for(var cal_day_cnt = 1;cal_day_cnt <= calendars[month];cal_day_cnt++){
			var cal_day_match = year + "/" + month + "/" + cal_day_cnt;
			var dayClass = "";
			
			if(calObject[calObj].day[cal_day_match]){
				dayClass = ' class="'+calObject[calObj].day[cal_day_match]+'"';
			}
			else if(calObject[calObj].month[cal_day_cnt] != undefined){
				dayClass = ' class="'+calObject[calObj].month[cal_day_cnt]+'"';
			}
			else if(calObject[calObj].week["flag"] != undefined){
				if(cal_start_day == 0 && calObject[calObj].week["Sun"] != undefined){
					dayClass = ' class="'+calObject[calObj].week["Sun"]+'"';
				}
				else if(cal_start_day == 1 && calObject[calObj].week["Mon"] != undefined){
					dayClass = ' class="'+calObject[calObj].week["Mon"]+'"';
				}
				else if(cal_start_day == 2 && calObject[calObj].week["Tue"] != undefined){
					dayClass = ' class="'+calObject[calObj].week["Tue"]+'"';
				}
				else if(cal_start_day == 3 && calObject[calObj].week["Wed"] != undefined){
					dayClass = ' class="'+calObject[calObj].week["Wed"]+'"';
				}
				else if(cal_start_day == 4 && calObject[calObj].week["Thu"] != undefined){
					dayClass = ' class="'+calObject[calObj].week["Thu"]+'"';
				}
				else if(cal_start_day == 5 && calObject[calObj].week["Fri"] != undefined){
					dayClass = ' class="'+calObject[calObj].week["Fri"]+'"';
				}
				else if(cal_start_day == 6 && calObject[calObj].week["Sat"] != undefined){
					dayClass = ' class="'+calObject[calObj].week["Sat"]+'"';
				}
				else {
					dayClass = ' class="undefined"';
				}
			}
			else {
				dayClass = ' class="undefined"';
			}
			
			if(calObject[calObj].text[cal_day_match]){
				text_f = "<span class=\""+calObject[calObj].text[cal_day_match]+"\">";
				text_b = "</span>";
			}
			else {
				text_f = "<span>";
				text_b = "</span>";
			}
			
			//Click to Action
			var clickActions = "";
			if(calObject[calObj].click["day"] == calObject[calObj].day[cal_day_match] && calObject[calObj].click["url"] != undefined)
				clickActions = " onclick=\"location.href='"+calObject[calObj].click["url"]+cal_day_match+"'\"";
			
			cal_tags += "<li"+dayClass+clickActions+">" + text_f + cal_day_cnt + text_b + "</li>";
			if(cal_start_day == 6){
				cal_start_day = 0;
			}
			else{
				cal_start_day++;
			}
		}
		while(cal_start_day <= 6 && cal_start_day != 0){
			cal_tags += "<li><span>&nbsp;</span></li>";
			cal_start_day++;
		}
		cal_tags += "</ul>";
		document.getElementById(calObj).innerHTML = cal_tags;
	}
	writeCal(calObject[cal_Id].cal_year,calObject[cal_Id].cal_month,calObject[cal_Id].cal_day,cal_Id);
//-->