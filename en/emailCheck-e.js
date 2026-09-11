// JavaScript Document
function checkEmail(email)
{
email=email.trim();
$("#dialog-sifreunut").dialog({
    position: {	my: "center",at: "center",of: sayfa},
});
 if(email=="")
  {
	$(function(){
    $("#dialog-sifreunut span").text('Enter your e-mail address...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return (false);
}
var emailstr = email;
var i =  emailstr.indexOf("@");
if (i<0) 
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('@ missing in e-mail address...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	
	return (false); 
}
	else if (i==0)
	{
	 $(function(){
    $("#dialog-sifreunut span").text('E-mail address cannot start with @...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false;
	}
   var mailbox = emailstr.substring(0,i);
   var domain = emailstr.substring(i+1);
   if (domain.indexOf("@")>=0) 
   	{
	$(function(){
    $("#dialog-sifreunut span").text('Multiple @ s in e-mail address...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false;
	}

   alphaSpecial = /[^A-Za-z0-9_\-.]+/;
   alphafront = /^[^A-Za-z0-9]/;
   alphalast = /[^A-Za-z0-9]+$/;
  
	if(alphafront.exec(mailbox)!=null)
	{
	$(function(){
    $("#dialog-sifreunut span").text('E-mail address can only begin with alphanumeric values...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false
	}
	if(alphaSpecial.exec(mailbox)!=null)
	{
	 	$(function(){
    $("#dialog-sifreunut span").text('User name portion of e-mail address can only contain letters, numerals, -, _ and .');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false;
	}
	if(alphalast.exec(mailbox)!=null)
	{
	 	$(function(){
    $("#dialog-sifreunut span").text('E-mail address can only end with alphanumerics...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false
	}

	if(alphafront.exec(domain)!=null)
	{
	 	$(function(){
    $("#dialog-sifreunut span").text('E-mail address domain name can only begin with alphanumerics...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false
	}
	if(alphaSpecial.exec(domain)!=null)
	{
	 	$(function(){
    $("#dialog-sifreunut span").text('Domain name portion of e-mail address can only contain letters, numerals, -, _ and ....');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false;
	}
	if(alphalast.exec(domain)!=null)
	{
	 	$(function(){
    $("#dialog-sifreunut span").text('E-mail address can only end with alphanumerics...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false
	}
   i = domain.lastIndexOf(".");
   if (i<0) 
   	{
	 	$(function(){
    $("#dialog-sifreunut span").text('E-mail address domain name invalid...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false;
	}
	if(!lookup(domain.substring(i+1)))
	{
	 	$(function(){
    $("#dialog-sifreunut span").text('E-mail address domain name is invalid...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	return false;
	}

   alpha = /[_\-.]+/;
   z=mailbox.match(alpha);
   if(z!=null)
   if((String(z).length)>1) 
	return false;
	
   $(function(){
     $("#dialog-sifreunut span").text('Please wait...');
	 $("#dialog-sifreunut" ).dialog();	
      });	
  return true;
}
function lookup(country) 
{   
/*	A = [ "ad", "ae", "af", "ag", "ai", "al", "am", "an", "ao", "aq", "ar", "as", "at", "au", "aw", "az", "ba", "bb", "bd", "be", "bf", "bg", "bh", "bi", "bj", "bm", "bn", "bo", "br", "bs", "bt", "bv", "bw", "by", "bz", "ca", "cc", "cf", "cg", "ch", "ci", "ck", "cl", "cm", "cn", "co", "cr", "cs", "cu", "cv", "cx", "cy", "cz", "de", "dj", "dk", "dm", "do", "dz", "ec", "ee", "eg", "eh", "er", "es", "et", "fi", "fj", "fk", "fm", "fo", "fr", "fx", "ga", "gb", "gd", "ge", "gf", "gh", "gi", "gl", "gm", "gn", "gp", "gq", "gr", "gs", "gt", "gu", "gw", "gy", "hk", "hm", "hn", "hr", "ht", "hu", "id", "ie", "il", "in", "io", "iq", "ir", "is", "it", "jm", "jo", "jp", "ke", "kg", "kh", "ki", "km", "kn", "kp", "kr", "kw", "ky", "kz", "la", "lb", "lc", "li", "lk", "lr", "ls", "lt", "lu", "lv", "ly", "ma", "mc", "md", "mg", "mh", "mk", "ml", "mm", "mn", "mo", "mp", "mq", "mr", "ms", "mt", "mu", "mv", "mw", "mx", "my", "mz", "na", "nc", "ne", "nf", "ng", "ni", "nl", "no", "np", "nr", "nt", "nu", "nz", "om", "pa", "pe", "pf", '"pg", "ph", "pk", "pl", "pm", "pn", "pr", "pt", "pw", "py", "qa", "re", "ro", "ru", "rw", "sa", "sb", "sc", "sd", "se", "sg", "sh", "si", "sj", "sk", "sl", "sm", "sn", "so", "sr", "st", "su", "sv", "sy", "sz", "tc", "td", "tf", "tg", "th", "tj", "tk", "tm", "tn", "to", "tp", "tr", "tt", "tv", "tw", "tz", "ua", "ug", "uk", "um", "us", "uy", "uz", "va", "vc", "ve", "vg", "vi", "vn", "vu", "wf", "ws", "ye", "yt", "yu", "za", "zm", "zr", "zw", "com", "edu", "gov", "int", "mil", "net", "org", "arpa", "nato" ];
    for (i=0; i<A.length; i++)        
	    if (country == A[i])  return true;
   return false; */
return true;
}


