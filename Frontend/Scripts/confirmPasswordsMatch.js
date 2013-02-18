function confirmPasswordsMatch()
{   
    var password1=document.getElementById('password');
    var password2=document.getElementById('confirm-password');
    if ( password1.value != password2.value )
    {  
        document.getElementById('password-warning-one').style.display = "inline";
        document.getElementById('password-warning-two').style.display = "inline";
    }
    else
    {
        document.getElementById('password-warning-one').style.display = "none";
        document.getElementById('password-warning-two').style.display = "none";
    }
}