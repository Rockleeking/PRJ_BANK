//validate form by checking contrains
function validateform() {
    var fname = document.getElementsByName("fname")[0].value;
    var title = document.getElementsByName("title")[0].value;
    var type = document.getElementsByName("type")[0].value;
    var lname = document.getElementsByName("lname")[0].value;
    var add1 = document.getElementsByName("add1")[0].value;
    var password = document.getElementsByName("pass")[0].value;
    var phone = document.getElementsByName("phone")[0].value;
    var email = document.getElementsByName("email")[0].value; 
    var cpass = document.getElementsByName("cpass")[0].value;

    if (fname==null || fname=="") {  
      alert("Frist Name can't be blank");  
      return false;
    }else if (title==null || title=="") {  
      alert("Title can't be blank");  
      return false;
    }else if (type==null || type=="") {  
      alert("Acount type can't be blank"); 
      return false;
      }else if (lname==null || lname=="") {  
      alert("Last Name can't be blank");  
      return false;   
    }else if (add1==null || add1==""||add1.length<5) {  
      alert("Address can't be blank or less than 5 charaters longs");  
      return false;
      }else if(email==null||email==""||add1.length<5) {
        alert("email cannot be blank");
        return false;}
      else if(password.length<6||password.length>12) {  
      alert("Password must be at least 6 characters long.");  
      return false; 
      } else if(phone.length!=10) {  
      alert("Phone must be at least 10 characters long.");  
      return false;  
    }else if(password!==cpass) {
        alert("password dosent match");
        return false;

    }
}
//validate login
function valid(){
    var pass=document.getElementsByName("pass")[0].value;
    var phone=document.getElementsByName("phone")[0].value;	
     if(phone.length<5||phone.length>18){  
      alert("Username must be Your ph number.");  
      return false;  
    }else if(pass.length<6||pass.length>12) {  
      alert("Password must be at least 6 characters long.");  
      return false; 
      } 
}
//validate transaction
function validtrans(){
    var tAccName=document.getElementsByName("tAccName")[0].value;
    var tbsb=document.getElementsByName("tbsb")[0].value;
    var tAccNo=document.getElementsByName("tAccNo")[0].value;
    var amount=document.getElementsByName("amount")[0].value;
    var info=document.getElementsByName("info")[0].value;
    var bname=document.getElementsByName("bname")[0].value;
    var type=document.getElementsByName("type")[0].value;
    var pass=document.getElementsByName("pass")[0].value;
     if(tAccNo.length<9||tAccNo.length>12){  
      alert("Invalid Account Number.");  
      return false;  
    }else if(pass.length<6||pass.length>12) {  
      alert("Password must be at least 6 characters long.");  
      return false; 
      }else if(type=="") {  
      alert("Please select Your transaction Type");  
      return false; 
      }else if(amount<=0) {  
      alert("Please enter a proper amount");  
      return false; 
      }else if(tbsb.length!=6){
	alert("BSB should be of 6 digit");  
      return false; 
	}else if(tAccName==""||tAccName==null){
	alert("Account holder's name cannot be empty.");  
      return false; 	
	}else if(bname==""||bname==null){
	alert("Bank name should be entered.");  
      return false;
	}else if(info==""||info==null){
	alert("Insert a reason for your transaction");  
      return false;
	}else if(confirm("Do you really wish to continue,\n payment to: "+tAccName+"\n Account Number"+tAccNo+" \n BSB: "+tbsb+" \n Bank Name: "+bname+"\n Transtion: "+type+"") == true) {
                    return true;
    }else {
                    return false;
    }  
    }
//function for gallary slider 
$(function() {		  
	var width = 720;
	var animationSpeed=2000;
	var pause=3000;
	var currentSlide=1;
	
	var $slider=$('#slider');
	var $slideContainer=$slider.find('.slides');
	var $slide= $slideContainer.find('.slide');
	
	var interval;
	
	
	
	function startSlider() {
		var interval=setInterval(function() {
		$slideContainer.animate({'margin-left':'-='+width}, animationSpeed, function(){
			currentSlide++;
			if(currentSlide == $slide.length){
				currentSlide=1;
				$slideContainer.css('margin-left',0);
			}
		});
	},pause);	
}
function stopSlider() {
	clearInterval(interval);
}

$slider.on('mouseenter',stopSlider).on('mouseleave',startSlider);
		
});
