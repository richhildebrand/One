<?php

class footerHelper
{
	public function DrawSessionFooter()
	{
		print('<footer>');
	        print('<a href="../Order/Add-Pizza.php">Add Pizza</a>');
	        print('<a href="../Order/Checkout.php">Checkout</a>');
	        print('<a href="../Order/History.php">Order History</a>');
	        print('<a href="../Account/Edit-Profile.php">Edit Profile</a>');
	        print('<a href="../Account/Change-Password.php">Change Password</a>');
	    print('</footer>');
	}
}