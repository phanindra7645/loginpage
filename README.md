# loginpage
Using PHP to create a login page consisting of Sign in Google or Facebook and with security.

Created in localhost store the details in database for the new registration and will check if the username or email already exists.
In case of forget Password an new page will open to get the email address then email will be sent containing the link for resetting the password and ater entering new password will be updated in the database.
If we fail to login correctly for 3 times there will be Captcha to enter additionally and if fails for 5 times then the IP server will be blocked.
