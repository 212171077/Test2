
function validatePassword()
{
	var password = document.getElementById("password").value;
	if(password.length < 6)
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
	if(validatePassword()&& validatePasswordTwo())
        {
		return true;
	}
	else
	{
		return false;
	}
}
