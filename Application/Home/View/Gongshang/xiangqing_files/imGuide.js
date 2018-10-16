define(function(){	
	//在common/imLoad中调用（关于用户的状态判断在imLoad中判断，这是因为在异步的情况下IM_QueryUserState_New这个函数只被调用一次）
	var arrTip = window.ImGuideTip||['点击可在线沟通','在线沟通更安全'];
	var index = 0;
	if(Math.random() >= 0.5){
		index = 1;
	}
	$(".webim_pop").html('<em></em><span>' + arrTip[index] + '</span>');
});