<?php

class FooterHelper
{
	public static function DrawSessionFooter()
	{
		print('<footer>');
	        print('<a href="../Order/Add-Pizza.php">Add Pizza</a>');
	        print('<a href="../Order/Checkout.php">View Cart</a>');
	        print('<a href="../Order/History.php">Order History</a>');
	        print('<a href="../Account/Edit-Profile.php">Edit Profile</a>');
	        print('<a href="../Account/Change-Password.php">Change Password</a>');

	        print('<form class="inline" method="post">');
	        	print('<button class="inline" name="Logout">Log out</button>');
	        print('</form>');

	        print('<div class="adminFooterLinks">');
	        	print('<a  href="../Admin/Manage-Crusts.php">Manage Crusts</a>');
	        	print('<a class="admin" href="../Admin/Manage-Toppings.php">Manage Toppings</a>');
	        	print('<a class="admin" href="../Admin/Manage-Sizes.php">Manage Sizes</a>');
        	print('</div>');
	    print('</footer>');
	}

	public static function DrawAnonymousFooter()
	{
		print('<footer>');
	        print('<a href="../Account/Login.php">Login</a>');
	        print('<a href="../Account/Register.php">Register</a>');
	        print('<a href="../Account/Forgot-Password.php">Forgot Password</a>');
	    print('</footer>');
	}
}