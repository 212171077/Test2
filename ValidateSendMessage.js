function validateEmail1()
{
	var email = document.getElementById("email").value;
	
	if(!email.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
	{
		document.getElementById("lblEmail").innerHTML = "---Please provide a valid email address";
		document.getElementById("lblEmail").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblEmail").innerHTML = "---Ok";
		document.getElementById("lblEmail").style.color ="green";
		return true;
	}
}

function validateName1()
{
	var name = document.getElementById("name").value;
	if(name.length < 2)
	{
		document.getElementById("lblName").innerHTML = "---Your name must be at least 2 characters long";
		document.getElementById("lblName").style.color = "red";
		return false;
	}
	if(name.length > 15)
	{
		document.getElementById("lblName").innerHTML = "---Your name is too long";
		document.getElementById("lblName").style.color = "red";
		return false;
	}
	if(!name.match(/^[A-Za-z]*$/))
	{
		document.getElementById("lblName").innerHTML = "---Invalid name, please insure that your name have no special characters";
		document.getElementById("lblName").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblName").innerHTML = "---Ok";
		document.getElementById("lblName").style.color ="green";
		return true;
	}
	
}

function validateSurname1()
{
	var surname = document.getElementById("surname").value;
	if(surname.length < 2)
	{
		document.getElementById("lblSurname").innerHTML = "---Your surname must be at least 2 characters long";
		document.getElementById("lblSurname").style.color = "red";
		return false;
	}
	if(surname.length > 15)
	{
		document.getElementById("lblSurname").innerHTML = "---Your name is too long";
		document.getElementById("lblSurname").style.color = "red";
		return false;
	}
	if(!surname.match(/^[A-Za-z]*$/))
	{
		document.getElementById("lblSurname").innerHTML = "---Invalid surname, please insure that your surname have no special characters";
		document.getElementById("lblSurname").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblSurname").innerHTML = "---Ok";
		document.getElementById("lblSurname").style.color ="green";
		return true;
	}
        
}

function validateMssg()
{
	var name = document.getElementById("mssg").value;
	if(name.length < 2)
	{
		document.getElementById("lblMssg").innerHTML = "---Your message must be at least 2 characters long";
		document.getElementById("lblMssg").style.color = "red";
		return false;
	}
	if(name.length > 150)
	{
		document.getElementById("lblMssg").innerHTML = "---Your message is too long";
		document.getElementById("lblMssg").style.color = "red";
		return false;
	}
        else
        {
            document.getElementById("lblMssg").innerHTML = "---OK";
            document.getElementById("lblMssg").style.color = "green";
            return true;
        }
	
	
}

function validateForm1()
{
    if(validateEmail1 && validateSurname1() && validateName1() && validateMssg())
    {
        return true;
    }
    else
    {
        return false;
    }
  
}

