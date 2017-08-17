
function validatePartyName()
{
	var name = document.getElementById("pName").value;
	if(name.length < 2)
	{
		document.getElementById("lblpName").innerHTML = "Party name must be at least 2 characters long";
		document.getElementById("lblpName").style.color = "red";
		return false;
	}
	if(name.length > 12)
	{
		document.getElementById("lblpName").innerHTML = "Party name is too long";
		document.getElementById("lblpName").style.color = "red";
		return false;
	}
	if(!name.match(/^[A-Za-z]*$/))
	{
		document.getElementById("lblpName").innerHTML = "Invalid party name, please insure that party name have no special characters";
		document.getElementById("lblpName").style.color = "red";
		return false;
	}
	else
	{
		document.getElementById("lblpName").innerHTML = "Ok";
		document.getElementById("lblpName").style.color ="green";
		return true;
	}
	
}


function validateName()
{
	var name = document.getElementById("pPresident").value;
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

function validateDesc()
{
	var pDesc = document.getElementById("pDesc").value;
	if(pDesc.length < 2)
	{
		document.getElementById("lblpDesc").innerHTML = "Your description must be at least 2 characters long";
		document.getElementById("lblpDesc").style.color = "red";
		return false;
	}
	if(pDesc.length > 249)
	{
		document.getElementById("lblpDesc").innerHTML = "Your description is too long";
		document.getElementById("lblpDesc").style.color = "red";
		return false;
	}
	
	else
	{
		document.getElementById("lblpDesc").innerHTML = "Ok";
		document.getElementById("lblpDesc").style.color ="green";
		return true;
	}
	
}

function validateForm()
{
	if( validatePartyName()&&  validateName()  && validateDesc())
        {
		return true;
	}
	else
	{
		return false;
	}
}