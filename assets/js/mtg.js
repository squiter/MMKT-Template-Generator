function mask(o,f){
    v_obj=o;
    v_fun=f;
    setTimeout("runMask()",1);
}

function runMask(){
    v_obj.value=v_fun(v_obj.value);
}

function numberMask(v){
	v=v.replace(/\D/g,"");
	return v;
}

function dateMask(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{2})(\d)/g,"$1/$2");
	v=v.replace(/(\d{2})(\d{2})/g,"$1/$2");
    return v;
}

function hourMask(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{2})(\d)/g,"$1:$2");
    return v;
}

function deleteTemplate(obj){
	jQuery(obj).parent().parent().attr("style","background-color:#FACFCF");
	if(confirm(obj.title)){
		window.top.location.href = obj.rel;
	}
	jQuery(obj).parent().parent().removeAttr("style");
	return false;
}