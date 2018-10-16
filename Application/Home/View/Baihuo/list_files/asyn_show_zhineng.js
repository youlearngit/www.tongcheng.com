(function() {

	var sendLog = function(content) {
		var img = new Image();
		img.src = "http://track.58.com/empty.js.gif?" + content + "&rand=" + Math.random();
	}

	var ajaxsend = function(url) {
		var img = new Image();
		img.src = url;
	}

	if (window.znjsFirst == false){
		sendLog('duplicate_ggafs=1');
		return ;
	}

	document.write=function(html_str){
		$(document.body).append(html_str);
	}
	
	var listPage = "listpage";
	var finalPage = "finalpage";
	
	var bottomDiv = "direct_ad_bottom";
	var rightDiv = "direct_ad_right";
	
	var defaultListRightNum = 8;
	var defaultListBottomNum = 4;
	var defaultFinalRightNum = 5;
	var defaultFinalBottomNum = 4;
	
	var smsc='';
	var dispLocalId;
	var dispLocalName = 'bj';
	var subDispLocalName = '';
	var rootDispCateId;
	var dispCateId;
	var subDispCateName = '';
	var pageType;
	var entityId = -1;
	var entityType = 0;
	var dispLocalPath = '';
	var dispCatePath = '';
	var dispLocalTitlePath = '';
	var dispCateTitlePath = '';
	var pageTitle = '';
    var zhineng_locallist = [];
    
	var righttop_wangmeng_slot = "righttop_slot_wangmeng";
	var right_wangmeng_slot = "right_slot_wangmeng";
	var rightbtm_wangmeng_slot = "rightbtm_slot_wangmeng";
	var right_zhineng_slot = "right_slot_zhineng";
	var list_right_ad_slot = "rightframe";
	var final_right_ad_slot = "sideAD";
	var list_inner_bottom_ad_slot = "bottom_google_ad";
	var zhineng_list_inner_bottom_slot = "zhineng_list_inner_bottom";

	var is_zhineng_requested = false;

	var is_auto_slot = false;

	var add_js = function(jsSrc) {	
		var sNode = document.createElement("script");
		sNode.type = "text/javascript";
		sNode.src = jsSrc;
		document.getElementsByTagName("head")[0].appendChild(sNode);
	}
	
	var template_render = function(template, obj_item) {
		var rgx = /{{(.*?)}}/g;
		return template.replace(rgx, function (match, sub_match, index, s) {
			return obj_item[sub_match] || "";
		});
	}

	var safe_html = function(content) {
		if(!content) {
			return '';
		}
		return content.replace(/[\n|,|\r\n|'|"|\t]/g, '');
	}

	var get_title = function() {
		var title = document.title;
		return $.trim(title.replace(/^【图】/, '').replace(/^【.*新消息】【图】/, '').replace(/^【.*新消息】/, '').replace(/\- .*58同城$/, '').replace(/[\n|\r\n|\t]/g, ''));
	}

	var substr_ext = function(content, len) {
		if(content.length * 2 <= len) {
			return content;
		}
		var idx = 0;
		var s_len = content.length;
		for(var i = 0; i < s_len; i++) {
			if(content.charCodeAt(i) > 128) {
				idx += 2;
			} else {
				idx++;
			}
			if (idx == len) {
				return content.substring(0, i + 1);
			} else if (idx == len + 1) {
				return content.substring(0, i);
			}
		}
		return content;
	}
	
	var str_len = function(title) {
		var idx = 0;
		var s_len = title.length;
		for(var i = 0; i < s_len; i++) {
			if(title.charCodeAt(i) > 128){
				idx += 2;	
			} else {
				idx++;
			}
		}
		return idx;
	}

	var cateHasAd = function(rootDispCateId, dispCateId) {
		return !(rootDispCateId == '14743' || rootDispCateId == '25063' || rootDispCateId == '26379' || rootDispCateId == '26507'
			|| rootDispCateId == '28151' || rootDispCateId == '9225' || rootDispCateId == '13952'
			|| dispCateId == '22' || dispCateId == '23' || dispCateId == '27' || dispCateId == '28' || dispCateId == '837'
			|| dispCateId == '14513' || dispCateId == '23440' || dispCateId == '23009'
			|| dispCateId == '23244' || dispCateId == '23245' || dispCateId == '23246' || dispCateId == '23247' || dispCateId == '23248'
			|| dispCateId == '42');
	}

	var rightHasAd = function(rootDispCateId) {
		return !(rootDispCateId == '9225' || rootDispCateId == '13952' || rootDispCateId == '14743' || rootDispCateId == '25063'
				|| rootDispCateId == '26379' || rootDispCateId == '26507' || rootDispCateId == '28151');
	}

	var isJobsCate = function(rootDispCateId) {
		return rootDispCateId == '9224' || rootDispCateId == '9225' || rootDispCateId == '13941' || rootDispCateId == '13952';
	}

	var isCtrNewCate = function(dispCateId) {
		return dispCateId == '13901' || dispCateId == '13916' || dispCateId == '13906' || dispCateId == '13802' || dispCateId == '13915';
	}

	var isHuangYeCate = function(rootDispCateId) {
		return rootDispCateId == '8512' || rootDispCateId == '8703' || rootDispCateId == '8538' || rootDispCateId == '26509'
			|| rootDispCateId == '92' || rootDispCateId == '187' || rootDispCateId == '8640' || rootDispCateId == '8581'
			|| rootDispCateId == '143' || rootDispCateId == '26506' || rootDispCateId == '28921' || rootDispCateId == '26510'
			|| rootDispCateId == '26508';
	}

	var isGoogleCsaCate = function(rootDispCateId) {
		return isHuangYeCate(rootDispCateId) || rootDispCateId == '1' || rootDispCateId == '5' || rootDispCateId == '3'
				|| rootDispCateId == '832' || rootDispCateId == '9225' || rootDispCateId == '9224' || rootDispCateId == '13941'
				|| rootDispCateId == '13952' || rootDispCateId == '4' || rootDispCateId == '833';
	}
	var hasZhiNengAd = function(rootDispCateId) {
		return rootDispCateId == '1' || isJobsCate(rootDispCateId);
	}

	var hasListInnerBottom = function(rootDispCateId) {
		return rootDispCateId == '1' || rootDispCateId == '9224' || rootDispCateId == '13941' || rootDispCateId == '4'
				|| rootDispCateId == '832' || rootDispCateId == '833' || isHuangYeCate(rootDispCateId);
	}

	var hasListInnerBottomErShou = function(rootDispCateId, dispCateId) {
		var the_url = window.location.href;
		return rootDispCateId == '5' && (dispCateId != '35' && dispCateId != '36' && dispCateId != '37' 
				&& dispCateId != '38' && dispCateId != '39' && dispCateId != '508' && dispCateId != '45' 
				&& dispCateId != '41' && dispCateId != '44' && dispCateId != '46' && dispCateId != '43' 
				&& dispCateId != '23089' && dispCateId != '47' && dispCateId != '48' && dispCateId != '246' 
				&& dispCateId != '8502' || the_url.indexOf('/pn') >= 0 && the_url.indexOf('/pn1/') < 0 
				&& the_url.indexOf('/pn0/') < 0);
	}

	var isAutoSlotCate = function(rootDispCateId) {
		if(rootDispCateId == '3' || rootDispCateId == '26510' || pageType == listPage || pageType == finalPage){
		//if(rootDispCateId == '3' || rootDispCateId == '26510'){
			return true;
		}
		return false;
	}

	try {
		if(typeof(____json4fe) != "undefined" && typeof(____json4fe.smsc) != "undefined"){smsc = ____json4fe.smsc;}
		if(typeof(____json4fe) != "undefined"){
		    if(____json4fe.hasOwnProperty("newlocallist")){
		       zhineng_locallist = ____json4fe["newlocallist"];
		    }
		    else if(____json4fe.hasOwnProperty("locallist")){
		       zhineng_locallist = ____json4fe["locallist"];
		    }
		}
		if(typeof(____json4fe) != "undefined" && ____json4fe.hasOwnProperty("modules") 
				&& ____json4fe.hasOwnProperty("catentry")) {
			
			//取一级展现城市ID
			if(zhineng_locallist.length > 0 && zhineng_locallist[0].hasOwnProperty("dispid")) {
				dispLocalId = zhineng_locallist[0].dispid;
			}

			if(zhineng_locallist.length > 0 && zhineng_locallist[0].hasOwnProperty("listname")) {
				dispLocalName = zhineng_locallist[0].listname;
			}

			//取最低级展现城市name
			if(zhineng_locallist.length > 1 && zhineng_locallist[zhineng_locallist.length-1].hasOwnProperty("listname")) {
				subDispLocalName = zhineng_locallist[zhineng_locallist.length-1].listname;
			}
			//取最低级展现类别name
			if(____json4fe.catentry.hasOwnProperty("listname")){
				subDispCateName = ____json4fe.catentry.listname;
			}
			if(____json4fe.catentry.length > 0 && ____json4fe.catentry[____json4fe.catentry.length-1].hasOwnProperty("listname")) {
				subDispCateName = ____json4fe.catentry[____json4fe.catentry.length-1].listname;
			}

			//取城市的idpath和titlepath
			for(var i in zhineng_locallist) {
				var locObj = zhineng_locallist[i];
				if(locObj.hasOwnProperty("name")) {
					if(dispLocalTitlePath != '') {
						dispLocalTitlePath += ",";
					}
					dispLocalTitlePath += encodeURIComponent(safe_html(locObj.name));
				}
				if(locObj.hasOwnProperty("dispid")) {
					if(dispLocalPath != '') {
						dispLocalPath += ",";
					}
					dispLocalPath += locObj.dispid;
				}
			}

			//取二级展现类ID
			if(____json4fe.modules == listPage || ____json4fe.modules == "list") {
				//列表页
				if(____json4fe.catentry.length > 1 && ____json4fe.catentry[0].hasOwnProperty("dispid") 
						&& ____json4fe.catentry[1].hasOwnProperty("dispid")) {
					rootDispCateId = ____json4fe.catentry[0].dispid;
					dispCateId = ____json4fe.catentry[1].dispid;
				}

				for(var i in ____json4fe.catentry) {
					var cateObj = ____json4fe.catentry[i];
					if(cateObj.hasOwnProperty("name")) {
						if(dispCateTitlePath != '') {
							dispCateTitlePath += ",";
						}
						dispCateTitlePath += encodeURIComponent(safe_html(cateObj.name));
					}
					if(cateObj.hasOwnProperty("dispid")) {
						if(dispCatePath != '') {
							dispCatePath += ",";
						}
						dispCatePath += cateObj.dispid;
					}
				}

				pageType = listPage;

				if((dispLocalId == '1' || dispLocalId == '2' || dispLocalId == '3' || dispLocalId == '4' || dispLocalId == '18'
						|| dispLocalId == '158') && (dispCateId == '8' || dispCateId == '9' || dispCateId == '10' 
						|| dispCateId == '12' || dispCateId == '13' || dispCateId == '37031')) {
					defaultListRightNum = 10;
				}

				if(isAutoSlotCate(rootDispCateId)) {
					is_auto_slot = true;
				}

				if(!is_auto_slot) {
					//添加广告位
					if(rightHasAd(rootDispCateId) && document.getElementById(list_right_ad_slot)) {
						if (rootDispCateId == '1') {
							document.getElementById(list_right_ad_slot).innerHTML += '<div id="' + righttop_wangmeng_slot 
									+ '"></div><div id="' + right_zhineng_slot + '" style="padding-bottom: 10px;"></div><div id="' 
									+ right_wangmeng_slot + '"></div>';
						} else if(isJobsCate(rootDispCateId)) {
							document.getElementById(list_right_ad_slot).innerHTML += '<div id="' + right_zhineng_slot 
									+ '" style="padding-bottom: 10px;"></div><div id="' + righttop_wangmeng_slot + '"></div><div id="' 
									+ right_wangmeng_slot + '"></div>';
						} else {
							document.getElementById(list_right_ad_slot).innerHTML += '<div id="' + righttop_wangmeng_slot + '"></div><div id="'
									+ right_wangmeng_slot + '"></div><div id="' + right_zhineng_slot + '" style="padding-bottom: 10px;"></div>';
						}
						document.getElementById(list_right_ad_slot).innerHTML += '<div id="'+ rightbtm_wangmeng_slot +'"></div>';
						document.getElementById(right_zhineng_slot).innerHTML += '<div id="' + rightDiv + '"></div>';
					}
				}

				if(document.getElementById(list_inner_bottom_ad_slot)) {
					document.getElementById(list_inner_bottom_ad_slot).innerHTML += '<div id="' + zhineng_list_inner_bottom_slot 
						+ '"></div><div id="list_bottom_google_ad"></div>';
				}
			} else if (____json4fe.modules == finalPage || ____json4fe.modules == "final") {
				//最终页
				//pageTitle = encodeURIComponent(get_title());

				if(____json4fe.hasOwnProperty("rootcatentry") && ____json4fe.rootcatentry.hasOwnProperty("dispid")) {
					rootDispCateId = ____json4fe.rootcatentry.dispid;
					if(____json4fe.rootcatentry.hasOwnProperty("name")) {
						dispCateTitlePath += encodeURIComponent(safe_html(____json4fe.rootcatentry.name));
					}
					dispCatePath += ____json4fe.rootcatentry.dispid;
				}
				if(____json4fe.catentry.hasOwnProperty("dispid")) {
					dispCateId = ____json4fe.catentry.dispid;
					if(____json4fe.catentry.hasOwnProperty("name")) {
						if(dispCateTitlePath != '') {
							dispCateTitlePath += ",";
						}
						dispCateTitlePath += encodeURIComponent(safe_html(____json4fe.catentry.name));
					}
					if(dispCatePath != '') {
						dispCatePath += ",";
					}
					dispCatePath += ____json4fe.catentry.dispid;
				}
				if(____json4fe.hasOwnProperty("infoid")) {
					entityId = ____json4fe.infoid;
				}
				pageType = finalPage;

				if(isJobsCate(rootDispCateId) || rootDispCateId == '1') {
					defaultFinalRightNum = 8;
				}

				if(isAutoSlotCate(rootDispCateId)) {
					is_auto_slot = true;
				}

				if(!is_auto_slot) {
					//添加最终页右侧广告位
					if(rightHasAd(rootDispCateId) && document.getElementById(final_right_ad_slot)) {
						if(rootDispCateId == '1') {
							document.getElementById(final_right_ad_slot).innerHTML += '<div id="' + righttop_wangmeng_slot + '"></div>'
									+ '<div id="'+ right_zhineng_slot + '"></div>'
									+ '<div id="' + right_wangmeng_slot + '"></div>'
									+ '<div id="zp_right_link"></div>';
							document.getElementById(right_zhineng_slot).innerHTML += '<div id="' + rightDiv + '" class="s_ad"></div>';
						} else if(isJobsCate(rootDispCateId)) {
							document.getElementById(final_right_ad_slot).innerHTML += '<div id="' + right_zhineng_slot 
									+ '"></div><div id="' + righttop_wangmeng_slot + '"></div><div id="'
									+ right_wangmeng_slot + '"></div>';
							document.getElementById(right_zhineng_slot).innerHTML += '<div id="' + rightDiv + '" class="newAd"></div>';
						} else {
							document.getElementById(final_right_ad_slot).innerHTML += '<div id="' + righttop_wangmeng_slot + '"></div>'
									+ '<div id="' + right_wangmeng_slot + '"></div><div id="'
									+ right_zhineng_slot + '"></div><div id="zp_right_link"></div>';
							document.getElementById(right_zhineng_slot).innerHTML += '<div id="' + rightDiv + '" class="s_ad"></div>';
						}
					}
				}

				if(dispCateId == "9") {
					$('#direct_ad_bottom').css({'width':'726px'});
				}
			}
		}

		if(typeof(dispLocalId) != "undefined" && typeof(rootDispCateId) != "undefined" && typeof(dispCateId) != "undefined"
				&& typeof(pageType) != "undefined" && cateHasAd(rootDispCateId, dispCateId)) {
			//获取城市、类别、页面类型成功
			
			var rightNum = 0;
			var bottomNum = 0;

			if(is_auto_slot) {
				//使用配置的广告位数据
				if(pageType == listPage) {
					if(rightHasAd(rootDispCateId) && document.getElementById(list_right_ad_slot)) {
						rightNum = defaultListRightNum;
						if(dispCateId == '11') {
							rightNum = rightNum > 2 ? 2 : rightNum;
						}
						if(isJobsCate(rootDispCateId) || rootDispCateId == '832' || rootDispCateId == '4' || rootDispCateId == '5') {
							rightNum = 10;
						}
					}
				} else if (pageType == finalPage) {
					if(rightHasAd(rootDispCateId) && document.getElementById(final_right_ad_slot)) {
						rightNum = defaultFinalRightNum;
					}
					if(dispCateId == '241'){
						rightNum = 0;
					}
				}
			} else {
				//获取列表页可展现广告条数
				if(!document.getElementById(rightDiv)) {
					rightNum = 0;
				} else {
					if(pageType == listPage) {
						rightNum = defaultListRightNum;
						if(dispCateId == '11') {
							rightNum = rightNum > 2 ? 2 : rightNum;
						}
						if(isJobsCate(rootDispCateId) || rootDispCateId == '832' || rootDispCateId == '4' || rootDispCateId == '5') {
							rightNum = 10;
						}
					} else if(pageType == finalPage) {
						rightNum = defaultFinalRightNum;
						if(dispCateId == '241'){
							rightNum = 0;
						}
					}
				}
			}

			if(!document.getElementById(bottomDiv)) {
				bottomNum = 0;
			} else {
				if(pageType == listPage) {
					bottomNum = defaultListBottomNum;
					if(isHuangYeCate(rootDispCateId)) {
						bottomNum = 5;
					}
					if(rootDispCateId == '1') {
						bottomNum = 6;
					}
					if(rootDispCateId == '9224' || rootDispCateId == '13941') {
						bottomNum = 5;
					}
					if(dispCateId == '13889') {
						bottomNum = 4;
					}
					if(rootDispCateId == '5' || rootDispCateId == '832') {
						bottomNum = 6;
					}
					if(rootDispCateId == '187'){
					    bottomNum = 6;
					}
					if(dispLocalId == '1' && rootDispCateId == '8581') {
						bottomNum = 6;
					}
					if((dispLocalId == '1' || dispLocalId == '2' || dispLocalId == '3') && rootDispCateId == '143') {
						bottomNum = 6;
					}
					if(dispCateId == '241'){
						bottomNum = 4;
					}
					if(dispCateId == '29' || dispCateId == '13978'){
						bottomNum = 6;
					}
				} else if(pageType == finalPage) {
					bottomNum = defaultFinalBottomNum;
					if(dispCateId == '36' || dispCateId == '508') {
						bottomNum = 5;
					}
					if(rootDispCateId == '9224' || rootDispCateId == '5' || rootDispCateId == '13941') {
						bottomNum = 5;
					}
					if(isHuangYeCate(rootDispCateId)) {
						bottomNum = 5;
					}
					if(rootDispCateId == '187'){
					    bottomNum = 6;
					}
					if(dispCateId == '241'){
						bottomNum = 12;
					}
				}
			}

			if(rightNum > 0 || bottomNum > 0) {
				var slotInfo = "";
				var sPrefix = "";
				var reverseSlot = 0;
				if(pageType == listPage) {
					sPrefix = "list";
				} else if(pageType == finalPage) {
					sPrefix = "final";
					if(rootDispCateId == '1' && typeof(____json4fe) != "undefined" 
							&& ((____json4fe.hasOwnProperty("isChengxin") && ____json4fe.isChengxin == 'true')
							|| ____json4fe.hasOwnProperty("isRenzheng") && ____json4fe.isRenzheng)) {
						reverseSlot = 1;
					}
					if(rootDispCateId == '832' && $('.xiaobao2_xb_icon').length > 0) {
						reverseSlot = 1;
					}
					if(rootDispCateId == '5' && $('.bz_zfb').length > 0) {
						reverseSlot = 1;
					}
				}
				if(rightNum > 0) {
					slotInfo += sPrefix + "right_" + rightNum;
				}
				if(bottomNum > 0) {
					if(slotInfo != "") {
						slotInfo += ",";
					}
					slotInfo += sPrefix + "bottom_" + bottomNum;
				}

				var has_zhineng = 1;
				var has_list_inner_bottom = 0;
				if(pageType == listPage && (hasListInnerBottom(rootDispCateId) 
						|| hasListInnerBottomErShou(rootDispCateId, dispCateId)) 
						&& document.getElementById(zhineng_list_inner_bottom_slot)) {
					has_list_inner_bottom = 1;
				}

				var is_auto_slot_flag = is_auto_slot ? 1 : 0;
				var ad_test_flag = 'O';
				if(dispCateId == '29' || dispCateId == '14') {
					ad_test_flag = 'N';
				}
				if(dispCateId == '36'){
					ad_test_flag = (Math.floor(Math.random() * 2) == 1) ? 'O' : 'N';
				}
				if(document.location.href.indexOf('DEBUG_FLAG=O') > 0) {
					ad_test_flag = 'O';
				} else if (document.location.href.indexOf('DEBUG_FLAG=N') > 0) {
					ad_test_flag = 'N';
				}
				
				//二手详情页对AB测标识特殊处理
                if(dispCateId in {'36':1,'39':1,'508':1,'30':1,'240':1} && (____json4fe.modules == finalPage || ____json4fe.modules == "final")){
                    var tempFlag = ____json4fe.page;
                    if(typeof(tempFlag) == 'string' && tempFlag){
                       ad_test_flag = ad_test_flag + tempFlag;
                    }
                }
                
				var realRefer = document.referrer;
				realRefer = !realRefer ? "" : encodeURIComponent(realRefer);

				//ad_test_flag = 'a';
				//请求广告的js
				var zhineng_show_js = 'http://show.zhineng.58.com/show_zhineng_impl.js?zn=' + has_zhineng + '&lo=' 
							+ dispLocalId + '&lol=' + dispLocalName + '&rca=' + rootDispCateId + '&ca=' + dispCateId 
							+ '&pt=' + pageType + '&sl=' + slotInfo + '&revsl=' + reverseSlot + '&entid=' + entityId 
							+ '&enttp=' + entityType + '&zlib=' + has_list_inner_bottom + '&ias=' + is_auto_slot_flag 
							+ '&abt=' + ad_test_flag + '&capth=' + dispCatePath + '&catpth=' + dispCateTitlePath 
							+ '&lopth=' + dispLocalPath + '&lotpth=' + dispLocalTitlePath + '&pttl=' + pageTitle 
							+ '&smsc=' + smsc + '&realRefer=' + realRefer + '&rand=' + Math.random();
				if(pageType == listPage) {
					document.write('<scri' + 'pt src="' + zhineng_show_js + '"></scri' + 'pt>');
					is_zhineng_requested = true;
				} else if (pageType == finalPage) {
					if(isGoogleCsaCate(rootDispCateId)){
						document.write('<scr' + 'ipt src="' + zhineng_show_js + '"></' + 'scr' + 'ipt>');
					}else{
						add_js(zhineng_show_js);
					}
					is_zhineng_requested = true;
				}
			} else {

			}
		}

		if(typeof(dispLocalId) != "undefined" && typeof(rootDispCateId) != "undefined" && typeof(dispCateId) != "undefined"
				&& typeof(pageType) != "undefined") {
			try {
				if("1"==rootDispCateId||isHuangYeCate(rootDispCateId)||isJobsCate(rootDispCateId)){
					ajaxsend("http://rtbserver.58.com/cm/start");
				}
			} catch (e_rtb) {}
		}

	} catch (e) {

	}

	var zhineng_request_done_3 = function(ad_num, list_inner_bottom_ad_count, is_auto_slot, is_slot_created, 
			client_zntag) {
		if(typeof(pageType) != "undefined") {
			if (is_auto_slot) {
				var ggad_src = "http://track.58.com/adsys/pageads/?zhineng_num=" + ad_num + "&pt=" + pageType
							+ "&isc=" + (is_slot_created ? 1 : 0) + "&client_zntag=" + client_zntag 
							+ "&displocalname=" + dispLocalName + "&subdisplocalname=" + subDispLocalName + "&subdispcatename=" + subDispCateName ;
				if (pageType == listPage) {
					ggad_src += "&list_inner_bottom_ad_count=" + list_inner_bottom_ad_count;
				}
				ggad_src += "&r=" + Math.random();
				if(pageType == listPage || isGoogleCsaCate(rootDispCateId)) {
					document.write('<scr' + 'ipt src="' + ggad_src + '"></' + 'scr'+'ipt>');
				} else {
					add_js(ggad_src);
				}
			} else {
				if(pageType == listPage) {
					document.write('<scri' + 'pt src="http://track.58.com/adsys/listpagead?zhineng_num=' + ad_num 
							+ '&list_inner_bottom_ad_count=' + list_inner_bottom_ad_count + "&client_zntag="+ client_zntag 
							+ "&displocalname=" + dispLocalName + "&subdisplocalname=" + subDispLocalName + "&subdispcatename=" + subDispCateName 
							+ '&r=' + Math.random() + '"></scri' + 'pt>');
				} else if (pageType == finalPage) {
					var final_src = "http://track.58.com/adsys/finalpagead?zhineng_num=" + ad_num 
						+ "&client_zntag=" + client_zntag 
						+ "&displocalname=" + dispLocalName + "&subdisplocalname=" + subDispLocalName + "&subdispcatename=" + subDispCateName 
						+ "&r=" + Math.random();
					if(isGoogleCsaCate(rootDispCateId)){
						document.write('<scr' + 'ipt src="' + final_src + '"></' + 'scr'+'ipt>');
					}else{
						add_js(final_src);
					}
				}
			}
		}
	}

	var zhineng_request_done_2 = function(ad_num, list_inner_bottom_ad_count, is_auto_slot, is_slot_created) {
		zhineng_request_done_3(ad_num, list_inner_bottom_ad_count, is_auto_slot, false, 0);
	}

	var zhineng_request_done_new = function(ad_num, list_inner_bottom_ad_count) {
		zhineng_request_done_3(ad_num, list_inner_bottom_ad_count, false, false, 0);
	}

	var zhineng_request_done = function(ad_num) {
		zhineng_request_done_3(ad_num, 0, true, false, 0);
	}

	var city_title = typeof(____json4fe) != "undefined" && zhineng_locallist.length > 0 
			&& zhineng_locallist[0].hasOwnProperty("name") ? zhineng_locallist[0]['name'] : "全国";
	
	var optz_namespace = "optzjs";
	window[optz_namespace] = {};
	window[optz_namespace]["template_render"] = template_render;
	window[optz_namespace]["substr_ext"] = substr_ext;
	window[optz_namespace]["str_len"] = str_len;
	window[optz_namespace]["city_title"] = city_title;
	window[optz_namespace]['add_js'] = add_js;
	window[optz_namespace]['zhineng_request_done'] = zhineng_request_done;
	window[optz_namespace]['zhineng_request_done_new'] = zhineng_request_done_new;
	window[optz_namespace]['zhineng_request_done_2'] = zhineng_request_done_2;
	window[optz_namespace]['zhineng_request_done_3'] = zhineng_request_done_3;
	


	if(!is_zhineng_requested) {
		//没有请求智能推广广告，广告位没有划分
		zhineng_request_done_2(0, 0, is_auto_slot, false);
	}
	window.znjsFirst = false;
})();
