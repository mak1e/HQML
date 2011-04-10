<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Welcome to the Integrated Health Measures Library</title>

<link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/screen.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/960.css" />

</head>

<body>

<!-- start header -->
<div id="header"><a href="#"><img src="images/patients-first-logo.jpg" alt="Health Care" height="111" border="0" class="logo"/></a>

<div id="secondary-nav">
<ul id="sub-navigation">
<!--        <li><a href=<?php echo '' ?>>Home</a></li>
        <li><a href="contact-us.php">Contact Us</a></li>-->
    <?php $this->widget('zii.widgets.CMenu', array(
        'items'=>array(
            array('label'=>'Home', 'url'=>array('/site/index')),
            array('label'=>'Contact Us', 'url'=>array('/site/contact')),
            array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
            array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
        )
    )) ?>
    </ul>
  </div>

<div id="primary-nav">
<ul id="navigation">
         <?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Library', 'url'=>array('/measure/index')),
                                array('label'=>'Announcements', 'url'=>array('/site/announcement')),
                                array('label'=>'Sites of Interest', 'url'=>array('/site/sitesOfInterest')),
                                array('label'=>'Message Board', 'url'=>array('site/index')),

				//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
	)); ?>
    </ul>
  </div>
</div>
<!-- end header -->

<div id="breadcrumb-holder">
<p><?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?></p>
</div>

<!-- start content -->
<div class="container_16">
<!--<div class="grid_16" id="main-container">-->
<?php echo $content; ?>
<!--</div>-->
</div>
<!--<div class="vertical-line"></div>
<div id="right-sidebar">
<div class="sidebar-box"><img src="images/search-bar.jpg" alt="DeOsc Media"/></div>
<div class="sidebar-box">
 start: announcements 
		<h3>Announcements</h3>
		<ul class="newslist">
			<li><span>12 Dec 2009 | <a href="#">0 comments</a></span>
				<h5><a href="#">Duis nec porttitor lorem</a></h5> Mauris et nisi urna nonfaucibus lacus magna. Integer lacus ante then ante ullamcorper ut vulputate.. </li>
			<li><span>18 Dec 2009 | <a href="#">5 comments</a></span>
				<h5><a href="#">Aenean interdum</a></h5> Vestibulum ante ipsum primis into faucibus orci luctus ultrices antene posuere.</li>
			<li><span>4 Jan 20010 | <a href="#">2 comments</a></span>
				<h5><a href="#">Integer vitae nisl</a></h5> Duis volutpat ligula laoreet orci lectus placerat Curabitur lectus malesuada pulvinar.</li>
		</ul>
		 end: announcments 

<div class="sidebar-box">
 start: messages 
		<h3>Message Board</h3>
		<ul class="newslist">
			<li><span>12 Dec 2009 | <a href="#">0 comments</a></span>
				<h5><a href="#">Duis nec porttitor lorem</a></h5> Mauris et nisi urna nonfaucibus lacus magna. Integer lacus ante then ante ullamcorper ut vulputate.. </li>
			<li><span>18 Dec 2009 | <a href="#">5 comments</a></span>
				<h5><a href="#">Aenean interdum</a></h5> Vestibulum ante ipsum primis into faucibus orci luctus ultrices antene posuere.</li>
			<li><span>4 Jan 20010 | <a href="#">2 comments</a></span>
				<h5><a href="#">Integer vitae nisl</a></h5> Duis volutpat ligula laoreet orci lectus placerat Curabitur lectus malesuada pulvinar.</li>
		</ul>
		 end: useful messages 

<div class="sidebar-box">
 start: useful resources 
		<h3>Sites of Interest</h3>
		<ul class="newslist">
			<li><span>12 Dec 2009 | <a href="#">0 comments</a></span>
				<h5><a href="#">Duis nec porttitor lorem</a></h5> Mauris et nisi urna nonfaucibus lacus magna. Integer lacus ante then ante ullamcorper ut vulputate.. </li>
			<li><span>18 Dec 2009 | <a href="#">5 comments</a></span>
				<h5><a href="#">Aenean interdum</a></h5> Vestibulum ante ipsum primis into faucibus orci luctus ultrices antene posuere.</li>
			<li><span>4 Jan 20010 | <a href="#">2 comments</a></span>
				<h5><a href="#">Integer vitae nisl</a></h5> Duis volutpat ligula laoreet orci lectus placerat Curabitur lectus malesuada pulvinar.</li>
		</ul>
		 end: useful resources 
</div>
</div>
</div>
</div>
</div>
 end content -->

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
