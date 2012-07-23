#UnsignedThread – Anonymous PHP helpdesk software
## Description
The tool is licensed under the Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0) licence. This work is provided as-is, no warranties or guaranties in any way shape or form.

Over the past few days, instead of revising for the exams that I am entrenched in, I decided to program UnsignedThread.

Unsigned thread is essentially a helpdesk with ADHD, it’s an anonymous helpdesk allowing guests to securely communicate with site administrators (yes, multi-user support). It was designed in the format of Twitter Direct Messages (but without the character limits). It can be used for anything from sources communicating with journalists, to traditional website support.

**How is this different from existing tools?**

Anonymous communication, no login, email, etc. required.

Very lightweight, no excessive dependancies, no mail servers required. Streamlined.

It’s free and open source. 

**What security mesures can/have been taken?**

In an Apache2 install it can easily be bound to a Tor hidden service, or a TLS based HTTPS site for security. However as it is plain PHP/HTML/CSS it can be bound to any web server. Note that UnsignedThread does not magically secure all your communications, it is only as secure as both the host running the service and the guest using the service wants it to be. Auth keys are hashed in SHA256 format and salted, also SQL data has been sanitised as standard with most web tools.

I highly recommend you either install this on a TLS secured site (HTTPS) or even better a Tor hidden service.

### Specification

Designed with Twitter Bootstrap.

Easy to post and reply to posts rapidly.

Programmed in PHP using MySQL database.

No personal details required.

High security hashing of auth keys and passwords.

No mail server or excessive dependancies required.

Admin management console with multiple user support.

Can be configured with HTTPS and/or a Tor Hidden Service easily.

No absolute referencing, put it in a directory if you want.

Sorting in Managment Console.

Pagination in Management Console.

Reply to posts.

Updating status.

**Potential issues:**

Same hashing of passwords as auth keys. This issue is not really an issue as hashed auth keys are not visible to the end-user.

## Set-up

###A) PHP Files; Upload the files to you web server to a directory of your choosing:
Download and upload the files from the link above. Alternatively WGET and upload the files.

###B) MySQL/Config:
You will need to edit the first few lines of “connect.php” file in the includes folder include your MySQL details and preferences:

	/* Database config */
	
	$db_host        = 'localhost'; // In most cases you should leave this alone.
	$db_user        = 'root'; // MySQL username.
	$db_pass        = ''; // MySQL password.
	$db_database    = 'unsignedthread'; // MySQL database name.
	
	/* User config */
	
	$installed = FALSE; // IMPORTANT: Change this to $installed == TRUE; after your first login to the management console.
	
	$sitename = 'Site Name'; // Signed name goes here!
	$auth_salt = 'Vux&9+k*@MpgI-{[S;ZHbB}TM]`j+fC]F_8G&xdw4_.:kFvxdf'; // IMPORTANT - change this to a random string, random length, punctuation, 		letters and numbers. If this is changed after installed, old posts may not readable…
	
	$initialadminusername = 'admin'; // CHANGE THESE VARIABLES TO YOUR INITIAL USERNAME
	$initialadminpassword = 'admin'; // AND PASSWORD (after set-up I advise you comment these lines out!)
	
	$deleteold = TRUE; //CHANGE TO FALSE TO DISABLE AUTO CLEAN-UPS
	Next go to the the URL where you have installed this service.
	
	Check everything works, then go back into the includes/connect.php file to change the installed value to true:


	$installed = TRUE; // IMPORTANT: Change this to $installed = TRUE; after your first login to the managment console.
###C) Done.
Yes, no more steps, you’re done!

