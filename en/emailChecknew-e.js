// JavaScript Document
//Advanced Email Check credit-
//By JavaScript Kit (http://www.javascriptkit.com)
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

var str=email;
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
if (!filter.test(str))
{ 
 	$(function(){
    $("#dialog-sifreunut span").text('Please input a valid e-mail address...');
	$("#dialog-sifreunut" ).dialog({
		modal:true,
		buttons:{OK: function () {
    $(this).dialog("close");
    }}
	});	
    });	
	
	return (false); 
}
	$(function(){
     $("#dialog-sifreunut span").text('Please wait...');
	 $("#dialog-sifreunut" ).dialog();	
      });	
  return true;
}



