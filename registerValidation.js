
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
                C  : CitizenshA  : Usually 8, or 9 [can be ip. 0 SA; 1 Other.
                other values]
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



function validateName()
{
	var name = document.getElementById("name").value;
	if(name.length < 2)
	{
		document.getElementById("lblName").innerHTML = "Your name must be at least 2 characters long";
		document.getElementById("lblName").style.color = "red";
		return false;
	}
	if(name.length > 12)
	{
		document.getElementById("lblName").innerHTML = "Your name is too long";
		document.getElementById("lblName").style.color = "red";
		return false;
	}
	if(!name.match(/^[A-Za-z]*$/))
	{
		document.getElementById("lblName").innerHTML = "Invalid name, please insure that your name have no special characters";
		document.getElementById("lblName").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblName").innerHTML = "Ok";
		document.getElementById("lblName").style.color ="green";
		return true;
	}
	
}

function validateSurname()
{
	var surname = document.getElementById("surname").value;
	if(surname.length < 2)
	{
		document.getElementById("lblSurname").innerHTML = "Your surname must be at least 2 characters long";
		document.getElementById("lblSurname").style.color = "red";
		return false;
	}
	if(surname.length > 12)
	{
		document.getElementById("lblSurname").innerHTML = "Your name is too long";
		document.getElementById("lblSurname").style.color = "red";
		return false;
	}
	if(!surname.match(/^[A-Za-z]*$/))
	{
		document.getElementById("lblSurname").innerHTML = "Invalid surname, please insure that your surname have no special characters";
		document.getElementById("lblSurname").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblSurname").innerHTML = "Ok";
		document.getElementById("lblSurname").style.color ="green";
		return true;
	}
}


function validateProvince()
{
    var data = document.getElementById("province").value;
   
    if(data==="Select")
    {
        document.getElementById("lblProvince").innerHTML = "---Please select province";
        document.getElementById("lblProvince").style.color = "red";
        return false;
        
    }
    else
    {
        document.getElementById("lblProvince").innerHTML = "---OK";
        document.getElementById("lblProvince").style.color = "Green";
        return true;
    }
}

function validatePhone()
{
	var phone = document.getElementById("phone").value;
	if(phone.length != 10)
	{
		document.getElementById("lblPhone").innerHTML = "Invalid phone number,please insure that your phone consists of 10 digits";
		document.getElementById("lblPhone").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblPhone").innerHTML = "Ok";
		document.getElementById("lblPhone").style.color ="green";
		return true;
	}
}

function validateEmail()
{
	var email = document.getElementById("email").value;
	
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



function validatePassword()
{
	var password = document.getElementById("password").value;
	if(password.length < 7)
	{
		document.getElementById("lblPassword").innerHTML = "Your password must be at least 6 characters long";
		document.getElementById("lblPassword").style.color = "red";
		return false;
	}
	if(password.length > 30)
	{
		document.getElementById("lblPassword").innerHTML = "Your password is too long";
		document.getElementById("lblPassword").style.color = "red";
		return false;
	}
	if(!password.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/))
	{
		document.getElementById("lblPassword").innerHTML = "Please insure that your password has at least one number, one lowercase and one uppercase letter, at least six characters";
		document.getElementById("lblPassword").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblPassword").innerHTML = "Ok";
		document.getElementById("lblPassword").style.color ="green";
		return true;
	}
}

function validatePasswordTwo()
{
	var passwordTwo = document.getElementById("confirmPass").value;
	var passwordOne = document.getElementById("password").value;
	if(passwordOne == passwordTwo)
	{
		document.getElementById("lblPasswordTwo").innerHTML = "Ok";
		document.getElementById("lblPasswordTwo").style.color ="green";
		return true;
	}
	else
	{
		document.getElementById("lblPasswordTwo").innerHTML = "Passwords must match";
		document.getElementById("lblPasswordTwo").style.color = "red";
		return false;
	}
}



function validateForm()
{
	//if(validatePasswordTwo() && validatePassword() && validateUsername() && validateProvince() && validatePhone() && validateSurname() && validateName())
	if(validateId()&& validateSurname()&&  validateName() && validateProvince() && validatePhone() && validateEmail()&&validatePassword()&&validatePasswordTwo())
        {
		return true;
	}
	else
	{
		return false;
	}
}
