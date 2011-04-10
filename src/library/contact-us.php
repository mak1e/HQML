<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome to the Integrated Health Measures Library</title>

<link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/screen.css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.jigowatt.js"></script><!-- AJAX Form Submit -->
</head>

<body>

<!-- start header -->
<div id="header"><a href="#"><img src="images/patients-first-logo.jpg" alt="Health Care" height="111" border="0" class="logo"/></a>

<div id="secondary-nav">
<ul id="sub-navigation">
        <li><a href="site-index.php">Home</a></li>
        <li><a href="contact-us.php">Contact Us</a></li>
    </ul>
  </div>

<div id="primary-nav">
<ul id="navigation">
        <li><a href=<?php echo '/index.php?r=measure'; ?>>Library</a></li>
        <li><a href="announcements.php">Announcements</a></li>
        <li><a href="sites-of-interest.php">Sites of Interest</a></li>
		<li><a href="message-board.html">Message Board</a></li>
    </ul>
  </div>
</div>
<!-- end header -->

<div id="breadcrumb-holder">
<p>You are here: Home > Contact Us</p>
</div>

<!-- start content -->
<div id="container">
<div id="main-container">
<h2>Office Contact</h2>
<p><strong>+64 (0) 4 473 9166</strong></p>
<p><strong>Level 3 - 88 The Terrace, Wellington</strong></p>
<p><strong>PO Box 8082 - The Terrace, Wellington 6143</strong></p>
<p>&nbsp;</p>
<p>Your feedback on this library is welcomed. Please feel free to contact us with your thoughts and suggestions for improvements by entering your message in the text box below and clicking submit.</p>
<div id="contact">
<div id="message"></div>
                                
            <form method="post" action="contact.php" name="contactform" id="contactform">
            
            <fieldset>
                    
            <legend>Please fill in the following form to contact us</legend>
        
            <label for=name accesskey=U><span class="required">*</span> Your Name</label>
            <input name="name" type="text" id="name" size="30" value="" /> 
        
            <br />
            <label for=email accesskey=E><span class="required">*</span> Email</label>
            <input name="email" type="text" id="email" size="30" value="" />
        
            <br />
            <label for=phone accesskey=P><span class="required">*</span> Phone</label>
            <input name="phone" type="text" id="phone" size="30" value="" />
        
            <br />
            <label for=comments accesskey=C><span class="required">*</span> Your comments</label>
            <textarea name="comments" cols="40" rows="3"  id="comments" style="width: 350px;"></textarea>
                            
            <p><span class="required">*</span> Verification</p>
                    
            <label for=verify accesskey=V>&nbsp;&nbsp;&nbsp;<img src="image.php" border="0"></label>
            <input name="verify" type="text" id="verify" size="6" value="" style="width: 50px;" /><br /><br />
            <input type="submit" class="submit" id="submit" value="Submit" />
            </fieldset>
            </form>
</div>
</div>
<div class="vertical-line"></div>
<div id="right-sidebar">
<div class="sidebar-box"><img src="images/search-bar.jpg" alt="DeOsc Media"/></div>
<div class="sidebar-box">
<!-- start: announcements -->
		<h3>Announcements</h3>
		<ul class="newslist">
			<li><span>12 Dec 2009 | <a href="#">0 comments</a></span>
				<h5><a href="#">Duis nec porttitor lorem</a></h5> Mauris et nisi urna nonfaucibus lacus magna. Integer lacus ante then ante ullamcorper ut vulputate.. </li>
			<li><span>18 Dec 2009 | <a href="#">5 comments</a></span>
				<h5><a href="#">Aenean interdum</a></h5> Vestibulum ante ipsum primis into faucibus orci luctus ultrices antene posuere.</li>
			<li><span>4 Jan 20010 | <a href="#">2 comments</a></span>
				<h5><a href="#">Integer vitae nisl</a></h5> Duis volutpat ligula laoreet orci lectus placerat Curabitur lectus malesuada pulvinar.</li>
		</ul>
		<!-- end: announcments -->

<div class="sidebar-box">
<!-- start: messages -->
		<h3>Message Board</h3>
		<ul class="newslist">
			<li><span>12 Dec 2009 | <a href="#">0 comments</a></span>
				<h5><a href="#">Duis nec porttitor lorem</a></h5> Mauris et nisi urna nonfaucibus lacus magna. Integer lacus ante then ante ullamcorper ut vulputate.. </li>
			<li><span>18 Dec 2009 | <a href="#">5 comments</a></span>
				<h5><a href="#">Aenean interdum</a></h5> Vestibulum ante ipsum primis into faucibus orci luctus ultrices antene posuere.</li>
			<li><span>4 Jan 20010 | <a href="#">2 comments</a></span>
				<h5><a href="#">Integer vitae nisl</a></h5> Duis volutpat ligula laoreet orci lectus placerat Curabitur lectus malesuada pulvinar.</li>
		</ul>
		<!-- end: useful messages -->

<div class="sidebar-box">
<!-- start: useful resources -->
		<h3>Sites of Interest</h3>
		<ul class="newslist">
			<li><span>12 Dec 2009 | <a href="#">0 comments</a></span>
				<h5><a href="#">Duis nec porttitor lorem</a></h5> Mauris et nisi urna nonfaucibus lacus magna. Integer lacus ante then ante ullamcorper ut vulputate.. </li>
			<li><span>18 Dec 2009 | <a href="#">5 comments</a></span>
				<h5><a href="#">Aenean interdum</a></h5> Vestibulum ante ipsum primis into faucibus orci luctus ultrices antene posuere.</li>
			<li><span>4 Jan 20010 | <a href="#">2 comments</a></span>
				<h5><a href="#">Integer vitae nisl</a></h5> Duis volutpat ligula laoreet orci lectus placerat Curabitur lectus malesuada pulvinar.</li>
		</ul>
		<!-- end: useful resources -->
</div>
</div>
</div>
</div>
</div>
<!-- end content -->

<div class="clear-divider"></div>

<div id="footer">
<div id="footer-container">
<div id="footer-tag">
</div>
<div id="footer-sidebar">
<h4>Contact Us</h4>
<h1>Telephone Support</h1>
<p>Tel:04 473 9166</p>
<h1>Email Support</h1>
<p>HQMNZ@patientsfirst.co.nz</p>
</div>
</div>
</div>

</body>
</html>
