<?php

  // Server
  require 'server/fb-php-sdk/facebook.php';
  
  function get_stocks($stock, $cache)
  {
  	return $this->generate_stock_array($stock);   
  } 

  // Linking to Facebook Application
  $app_id = '418284238273760';
  $app_secret = '44926e66c8b6d95019865554ec58c9a2';
  $app_namespace = 'tradingwithfriends';

  $app_url = 'http://apps.facebook.com/' . $app_namespace . '/';
  $scope = 'email,publish_actions';

  // Init the Facebook SDK
  $facebook = new Facebook(array(
     'appId'  => $app_id,
     'secret' => $app_secret,
   ));

   // Get the current user
  $user = $facebook->getUser();

   // If the user has not installed the app, redirect them to the Login Dialog
  if (!$user) {
    $loginUrl = $facebook->getLoginUrl(array(
      'scope' => $scope,
      'redirect_uri' => $app_url,
    ));
    print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
  }
  
$names = array(	
	'APPL' => 'APPL',
	'FB' => 'FB',
	'D05.SI' => 'D05.SI',
	'039.SI' => '039.SI',
	'TRI' => 'TRI',
	'MSFT' => 'MSFT'	
);
   
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Trading with Friends!</title>
    
   	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

      <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
      <meta property="og:image" content="https://github.com/Astarcorp/tradingwithfriends/blob/master/images/logo_large.jpg"/>

      <link href="scripts/style.css" rel="stylesheet" type="text/css">
      
      <script type="text/javascript" src="scripts/date_time.js"></script>
      <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>

  </head>
  <body>
      <div id="topbar">
      <img src="images/logo.jpg"/>
      </div>
      
      <div id="fb-root"></div>
      <script src="//connect.facebook.net/en_US/all.js"></script>
      
      <span id="date_time"></span>
	  <script type="text/javascript">window.onload = date_time('date_time');</script>

      <script src="scripts/userinterface.js"></script>
      <script src="scripts/accounting.js"></script>
      <script src="scripts/payments.js"></script>
      
      <div id="equityButton">Equities List</div>
	  <div id="showEquity"><?php require 'scripts/equity.php';?></div>
	  
	  <p>
		<b>Buying Equity:</b>
		<select name="name" >
			<option value="">Select Equity</option>
			<?php foreach($names as $key=>$name) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['name']) && $_POST['name']==$key) echo "selected"; ?> ><?php echo $name; ?></option>			
			<?php endforeach; ?>
		</select>
	  
		<b>Quantity:</b> <input type="text" name="quantity" value="<?php if(!empty($_POST['quantity']))echo $_POST['quantity']; ?>" />	
	  </p>
	  
	  <p>
	  	<input type="submit" value="Submit" /><br>
	  	Your Equity <?php echo $_POST["Buying Equity"]; ?><br>
	 	Your Quantity : <?php echo $_POST["Quantity"]; ?>
	  </p>
	  
	 
	  <div id="portfolioButton">My Portfolio</div>
	  <div id="showPortfolio">My Portfolio</div>
	  
	  <div id="recommendButton">Recommend Friends</div>
                         
      <script>
          var appId = '<?php echo $facebook->getAppID() ?>';

          // Initialize the JS SDK
          FB.init({
            appId: appId,
            frictionlessRequests: true,
            cookie: true,
          });

          FB.getLoginStatus(function(response) {
            uid = response.authResponse.userID ? response.authResponse.userID : null;
          });
      </script>
  </body>
</html>
