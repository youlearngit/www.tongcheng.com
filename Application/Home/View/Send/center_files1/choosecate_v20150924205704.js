// 选择类别页面 点击一级类 页面停留时间 pc_post_clickfirstlevel_time_old
var pc_post_choosecate_pageload_time = (new Date()).getTime();
$(".ym-tab > a").click(function() {
		var pc_post_clickfirstlevel_time_tongji = parseInt(((new Date()).getTime() - pc_post_choosecate_pageload_time)/1000);
		if(pc_post_clickfirstlevel_time_tongji > 300 || pc_post_clickfirstlevel_time_tongji < 0){
			pc_post_clickfirstlevel_time_tongji = -1;
		}
		if (typeof clickLog === "function") {        				
			clickLog("from=pc_post_clickfirstlevel_time_old" + pc_post_clickfirstlevel_time_tongji);
		}
});

// 每一次hover都记录一次当前的时间戳
var pc_post_secondlevelmenu_time_start;
$('.ym-tab > a').hover(function(){
	pc_post_secondlevelmenu_time_start = (new Date()).getTime();
});
$("ul.ym-submnu li a").click(function() {
		var pc_post_clicksecondlevel_time_tongji = parseInt(((new Date()).getTime() - pc_post_choosecate_pageload_time)/1000);
		var pc_post_secondlevelmenu_time_tongji = parseInt(((new Date()).getTime() - pc_post_secondlevelmenu_time_start)/1000);
		if(pc_post_clicksecondlevel_time_tongji > 300 || pc_post_clicksecondlevel_time_tongji < 0){
			pc_post_clicksecondlevel_time_tongji = -1;
		}
		if(pc_post_secondlevelmenu_time_tongji > 300 || pc_post_secondlevelmenu_time_tongji < 0){
			pc_post_secondlevelmenu_time_tongji = -1;
		}
		if (typeof clickLog === "function") {    
			//选择类别页面 点击二级类 页面停留时间 pc_post_clicksecondlevel_time_old  				
			clickLog("from=pc_post_clicksecondlevel_time_old" + pc_post_clicksecondlevel_time_tongji);
			// 选择类别页面 各个二级菜单展示时间 hover大类展示其二级类时开始计时至点击该二级类中某一类止 
			// 中间hover到别的类别，就要重新计时； pc_post_secondlevelmenu_time_old
			clickLog("from=pc_post_secondlevelmenu_time_old" + pc_post_secondlevelmenu_time_tongji + '_' + ____json4fe.catentry[1].dispid);
		}
});