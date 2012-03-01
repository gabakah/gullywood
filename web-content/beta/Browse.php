<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us">
	<head>
		<title>Gullywood Online :: Browse Movies</title>
		<link href="jcarousel/style.css" rel="stylesheet" type="text/css" />
		<link href="../css/gwood.css" rel="stylesheet" type="text/css" media="all" />

		<!--
		  jQuery library
		-->
		<script type="text/javascript" src="jcarousel/lib/jquery-1.2.1.pack.js"></script>

		<!--
		  jCarousel library
		-->
		<script type="text/javascript" src="jcarousel/lib/jquery.jcarousel.pack.js"></script>

		<!--
		  jCarousel core stylesheet
		-->
		<link rel="stylesheet" type="text/css" href="jcarousel/lib/jquery.jcarousel.css" />

		<!--
		  jCarousel skin stylesheet
		-->
		<link rel="stylesheet" type="text/css" href="jcarousel/skins/ie7/skin.css" />
		<style type="text/css" media="screen"><!--#logo { width: 770px; right: 0; position: absolute; top: 27px; left: 0; height: 45px; visibility: visible; }
#footer { left: 0; right: 0; position: absolute; top: 780px; width: 542px; height: 80px; visibility: visible; }
#userinfo { width: 770px; left: 0; position: absolute; top: 55px; height: 25px; visibility: visible; }
#plate { background-color: #fff; background-image: url('(EmptyReference!)'); width: 779px; left: 0; right: 0; position: absolute; top: 80px; height: 540px; visibility: visible; }
#wrap { height: 180px; width: 770px; position: absolute; top: 100px; left: 0; right: 0; visibility: visible; }
#wrapActionAdv 	{ height: 180px; width: 770px; position: absolute; top: 310px; left: 0; right: 0; visibility: visible; }
#wrapDrama { width: 770px; left: 0; right: 0; position: absolute; top: 300px; height: 180px; visibility: hidden; }--></style>
		<script type="text/javascript">

		function mycarousel_itemLoadCallback(carousel, state)
		{
		    // Check if the requested items already exist
    		if (carousel.has(carousel.first, carousel.last)) {
        		return;
		    }

    		if (document.getElementById('wrapDrama'))
    		{
    			var getFileName = 'drama_ajax.php';
    		}
    		
    		if (document.getElementById('wrap'))
    		{
    			var getFileName = 'members_ajax.php';
    		}
    		jQuery.get(getFileName,
        	{
            	first: carousel.first,
	            last: carousel.last
    	    },
        		function(xml) {
            		mycarousel_itemAddCallback(carousel, carousel.first, carousel.last, xml);
	        	},
		        'xml'
    		);
		};

		function mycarousel_itemAddCallback(carousel, first, last, xml)
		{
		    // Set the size of the carousel
		    carousel.size(parseInt(jQuery('total', xml).text()));

		    jQuery('movie', xml).each(function(i) {
			//        carousel.add(first + i, mycarousel_getItemHTML(jQuery(this).text()));
	        carousel.add(first + i, mycarousel_getItemHTML(this));
    		});
		};

		/**
		 * Item html creation helper.
		 */
		function mycarousel_getItemHTML(item)
		{
		    return '<a href=../beta/Details.php?movieId='+$('movieId', item).text()+'><img src="'+$('movieImage', item).text()+'" width="130" height="130" alt="" /></a><br /><label class="newReleaases"><a href=../beta/Details.php?movieId='+$('movieId', item).text()+'>'+$('movieTitle', item).text()+'</a></label>';
		};

		jQuery(document).ready(function() {
		    jQuery('#mycarousel').jcarousel({
        	// Uncomment the following option if you want items
	        // which are outside the visible range to be removed
    	    // from the DOM.
        	// Useful for carousels with MANY items.

	        // itemVisibleOutCallback: {onAfterAnimation: function(carousel, item, i, state, evt) { carousel.remove(i); }},
    		    itemLoadCallback: mycarousel_itemLoadCallback
		    });
		});
		jQuery(document).ready(function() {
		    jQuery('#mycarouselActionAdv').jcarousel({
        	// Uncomment the following option if you want items
	        // which are outside the visible range to be removed
    	    // from the DOM.
        	// Useful for carousels with MANY items.

	        // itemVisibleOutCallback: {onAfterAnimation: function(carousel, item, i, state, evt) { carousel.remove(i); }},
    		    itemLoadCallback: mycarousel_itemLoadCallback
		    });
		});

	</script>
	</head>
	<body>
		<div id="logo" class="centered80">
			<img src="../images/GLogo00.png" alt="" height="45" width="220" border="0" />
		</div>

		<div id="plate" class="centered80">
			<div style="position:relative;width:779px;height:536px;-adbe-g:m;">
				<div style="position:absolute;top:247px;left:17px;width:71px;height:25px;">
					<label class="NewReleasesCaption">Actors</label></div>
				<div style="position:absolute;top:280px;left:17px;width:106px;height:150px;">
					<a href="personDetails.php?personnelId=4"><img src="../images/castcrew/actors/edochie.jpg" alt="" height="148" width="104" border="0" /></a></div>
				<div style="position:absolute;top:280px;left:171px;width:101px;height:150px;">
					<a href="personDetails.php?personnelId=3"><img src="../images/castcrew/actors/buari2.jpg" alt="" height="148" width="99" border="0" /></a></div>
				<div style="position:absolute;top:280px;left:326px;width:95px;height:150px;">
					<a href="personDetails.php?personnelId=2"><img src="../images/castcrew/actors/jackie_l_00.jpg" alt="" height="148" width="93" border="0" /></a></div>
				<div style="position:absolute;top:280px;left:464px;width:177px;height:150px;">
					<a href="personDetails.php?personnelId=1"><img src="../images/castcrew/actors/van_vicker.jpg" alt="" height="148" width="175" border="0" /></a></div>
				<div style="position:absolute;top:228px;left:13px;width:640px;height:8px;">
					<hr noshade="noshade" size="1" width="640" />
				</div>
				<div style="position:absolute;top:462px;left:14px;width:640px;height:8px;">
					<hr noshade="noshade" size="1" width="640" />
				</div>
				<div style="position:absolute;top:433px;left:34px;width:90px;height:16px;">
					<label class="newReleaases"><a href="personDetails.php?personnelId=4">Pete Edochie</a></label></div>
				<div style="position:absolute;top:433px;left:189px;width:90px;height:16px;">
					<label class="newReleaases"><a href="personDetails.php?personnelId=3">Nadia Buari</a></label></div>
				<div style="position:absolute;top:433px;left:335px;width:90px;height:16px;">
					<label class="newReleaases"><a href="personDetails.php?personnelId=2">Jackie Appiah</a></label></div>
				<div style="position:absolute;top:433px;left:520px;width:90px;height:16px;">
					<label class="newReleaases"><a href="personDetails.php?personnelId=1">Van Vicker</a></label></div>
			</div>
		</div>
				<div id="wrap" class="centered80">
					<div id="mycarousel" class="jcarousel-skin-ie7">
						<label class="NewReleasesCaption">New Releases</label>
			    		<ul>
							<!-- The content will be dynamically loaded in here -->
					    </ul>
				  </div>
				</div>			
				
				<div id="wrapDrama" class="centered80">
					<div id="mycarouselActionAdv" class="jcarousel-skin-ie7">
						<label class="NewReleasesCaption">Actors</label>
			    		<ul>
							<!-- The content will be dynamically loaded in here -->
					    </ul>
				  </div>
				</div>				

		<div id="userinfo">
			<label for="loginNonMember" class="loginNonMember">Not a member?</label>
			<label for="usrinfoRegister" class="usrinfoRegister"><a href="/beta/Register.php">Join Now</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes"> | </label>
			<label for="usrinfoSignIn" class="usrinfoSignIn"><a href="/beta/Login.php">Sign In</a></label>
			<label for="usrinfoSlashes" class="usrinfoSlashes"> | </label>
			<label for="usrinfoMyAccount" class="usrinfoMyAccount"><a href="/gw/MyAccount.html">My Account</a></label>
		</div>
		<div id="footer" class="centered80">
			<ul>
				<li><a href="/gw/About.html">About Us</a></li>
				<li><a href="/gw/TermsOfUse.html">Terms of Use</a></li>
				<li><a href="/gw/PrivacyPolicy.html">Privacy Policy</a></li>
				<li><a href="/gw/Contact.html">Contact Us</a></li>
				<li><a href="/gw/News.html">Media Center</a></li>
				<div class="copyright">
					<p>Copyright © 2008 Gullywood Enterprise. All rights reserved.</p>
				</div>
			</ul>
		</div>
	</body>
</html>