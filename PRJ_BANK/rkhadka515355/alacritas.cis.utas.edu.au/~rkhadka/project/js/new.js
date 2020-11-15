function validateform(){
var fname=document.getElementsByName("fname")[0].value;
var title=document.getElementsByName("title")[0].value;
var type=document.getElementsByName("type")[0].value;
var lname=document.getElementsByName("lname")[0].value;
var add1=document.getElementsByName("add1")[0].value;
var password=document.getElementsByName("pass")[0].value;
var phone=document.getElementsByName("phone")[0].value;
var email=document.getElementsByName("email")[0].value; 
var cpass=document.getElementsByName("cpass")[0].value;

if (fname==null || fname==""){  
  alert("Frist Name can't be blank");  
  return false;}
  if (title==null || title==""){  
  alert("Title can't be blank");  
  return false;}
  if (type==null || type==""){  
  alert("Acount type can't be blank");  
  return false;}
else if (lname==null || lname==""){  
  alert("Last Name can't be blank");  
  return false;   
}else if (uname==null || uname==""){  
  alert("Address can't be blank or less than 5 charaters longs");  
  return false;
  }else if(email==null||email==""){
	alert("email cannot be blank");
	return false;}
  else if(password.length<6||password.length>12){  
  alert("Password must be at least 6 characters long.");  
  return false; 
  } else if(phone.length==10){  
  alert("Phone must be at least 10 characters long.");  
  return false;  
}else if(password!==cpass){
	alert("password dosent match");
	return false;

}}
function valid(){
var pass=document.getElementsByName("pass")[0].value;
var ph=document.getElementsByName("phone")[0].value;	

if(pass.length<6||pass.length>12){  
  alert("Password must be at least 6 characters long.");  
  return false; 
  } else if(ph.length!=10){  
  alert("Username must be Your ph number.");  
  return false;  
}
}
$(function(){
			  $("#nplaceholder").load("nav.php");$("#footerplaceholder").load("footer.php");
	var width = 720;
	var animationSpeed=1000;
	var pause=3000;
	var currentSlide=1;
	
	var $slider=$('#slider');
	var $slideContainer=$slider.find('.slides');
	var $slide= $slideContainer.find('slide');
	
	var interval;
	
	
	
	function startSlider(){
		var interval=setInterval(function(){
		$slideContainer.animate({'margin-left':'-='+width}, animationSpeed, function(){
			currentSlide++;
			if(currentSlide == $slide.length){
				currentSlide=1;
				$slideContainer.css('margin-left',0);
			}
		});
	},pause);	
}
function stopSlider(){
	clearInterval(interval);
}

$slider.on('mouseenter',stopSlider).on('mouseleave',startSlider);
		
});
