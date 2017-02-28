function formValidation()  
{  		var user_name=	document.getElementById("username").value;
	 	var uname = 	document.getElementById("name").value;
		var pass = 		document.getElementById("password").value;
		var uadd = 		document.getElementById("address").value;
		var uemail = 	document.getElementById("email").value;
		var dob = 		document.getElementById("date").value;
		
		var umsex = 	document.getElementById("msex").checked; 
		var ufsex = 	document.getElementById("fsex").checked;
		
		
		if (checkusername(user_name))
		{
		
		if(allLetter(uname))  
		{ 
		
		
		if(password_valid(pass)) 
		{
			if (address_valid(uadd))
			{
				
				
					if(ValidateEmail(uemail))
					{
						if(validateDOB(dob))
						{
								
            				if(validsex(umsex,ufsex))
            				{
            					return true;
            				}
        
						}
					
					}
				
			}
			
			
		}
	
	}
	}	
return false;
 
	
}

	function checkusername(user_name)
	{
	
		
		
		var username_len = user_name.length;
		
		if (username_len == 0)
		
		{
			
			document.getElementById("uerror").innerHTML="Type new valid username"; 
			return false;  
		    }  
		    document.getElementById("uerror").innerHTML="";
		    return true;  
    }   
			
		
		
	

	function allLetter(uname)  
	{   
		
			var letters = /^[a-z ,.'-]+$/i ; 
			var uname_len = uname.lenght;
			
			if(uname_len==0 ||!uname.match(letters))  
			{  
				document.getElementById("errorun").innerHTML="this is an invalid name ";
				return false; 
			 
			}	
			document.getElementById("errorun").innerHTML=""; 	  
			return true; 
	}
	
	
	function password_valid(pass)  
    {  
		    
		    var password_len = pass.length;
		   
		    var pass_format= /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])./;  
		    	if (password_len == 0 || !pass.match(pass_format))  
		    { 
		    document.getElementById("error2").innerHTML="Password should not be empty and should have at least 1 number,1 lowercase and 1 uppercase letter.";  
		    return false;  
		    } 
		    document.getElementById("error2").innerHTML="";  
		    return true;  
    }   
    
    function address_valid(uadd)
		    {
		    document.getElementById("error3").innerHTML="";
		    var address_len = uadd.length;
		    if (address_len == 0)  
		    {  
		    	document.getElementById("error3").innerHTML="Must have address field";;  
		    	return false;  
		    } 
		    return true;
		    } 
    


    function ValidateEmail(uemail)  
    	{  
		    	document.getElementById("error4").innerHTML="";
		    	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		    if(uemail.match(mailformat))  
		    	{  
		    	return true;  
		    	}  
		    else  
		    	{	  
		    	document.getElementById("error4").innerHTML="You have entered an invalid email address!"; 
		    	return false;  
		   	 	}  
		  }  
    

	function validateDOB(dob)
			{
	    	document.getElementById("error5").innerHTML="";
	    	var pattern = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
	    	if (dob == null || dob == "" || !pattern.test(dob)) 
	    	{
		    	document.getElementById("error5").innerHTML="Invalid date of birth/ example'12-3-2001'";
				return false;
	    	}
	    	else {
	        return true;
	    	}
		}
	    function validsex(umsex,ufsex)  
    	{ 
		    if(umsex || ufsex)   
		    {  
		     return true;
		    } 
		   else   
		    {  
		    alert('Select Male/Female');  
		    
		    return false;  
		    }    
    	}  