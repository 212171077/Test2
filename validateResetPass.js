
function validateId()
{
	var id = document.getElementById("id").value;
	if(id.length != 13)
	{
		document.getElementById("lblId").innerHTML = "---Valid ID number is required";
		document.getElementById("lblId").style.color = "red";
		return false;
	}
	else
	{
                /*{YYMMDD}{G}{SSS}{C}{A}{Z}
                 *{930424}{6}{082}{0}{8}{2}
                YYMMDD : Date of birth.
                G  : Gender. 0-4 Female; 5-9 Male.
                SSS  : Sequence No. for DOB/G combination.
                C  : Citizenship. 0 SA; 1 Other.
                A  : Usually 8, or 9 [can be other values]
                Z  : Control digit calculated in the following section:*/
                
                
        
                
                var elements=id.split('');
                
                var year=elements[0]+""+elements[1];
                var mon=elements[2]+""+elements[3];
                var day=elements[4]+""+elements[5];
                var citizenship=parseInt(elements[10]);
                
                var intYear=parseInt(year);
                var intMon=parseInt(mon);
                var intDay=parseInt(day);
                
                if(intMon>12 || intMon<1 || intDay>31 ||intDay<1 || intYear<0)
                {
                    document.getElementById("lblId").innerHTML = "---Valid ID number is required, Please rectify...!!";
                    document.getElementById("lblId").style.color = "red";
                    return false;
                }
                else if(citizenship !==0)
                {
                    document.getElementById("lblId").innerHTML = "---Please provide South African ID number...!!";
                    document.getElementById("lblId").style.color = "red";
                    return false;  
                }
                else
                {
                    
                    document.getElementById("lblId").innerHTML = "---Ok";
                    document.getElementById("lblId").style.color ="green";
                    return true; 
                }
            
		
	}
}

function validateEmail()
{
	var email = document.getElementById("username").value;
	
	if(!email.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
	{
		document.getElementById("lblEmail").innerHTML = "Invalid email address, please rectify...";
		document.getElementById("lblEmail").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblEmail").innerHTML = "Ok";
		document.getElementById("lblEmail").style.color ="green";
                return true;
	}
}

function validateForm()
{
	//if(validatePasswordTwo() && validatePassword() && validateUsername() && validateProvince() && validatePhone() && validateSurname() && validateName())
	if(validateId() && validateEmail())
        {
		return true;
	}
	else
	{
		return false;
	}
}