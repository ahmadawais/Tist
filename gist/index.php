<?php
/* TA.Gist is a PHP template that displays your GitHub gists as blog posts     */
/* This is a sample raw text gist - http://tebel.org/gist/interface_automation */
/* Setup comments in uppercase for your action, general comments in lowercase  */
/* For more info and GitHub repository - https://github.com/tebelorg/TA.Gist   */

// OPTION 1 - MANUAL UPDATING OF GIST NAME AND ID
// ADD GIST NAME FOR YOUR GIST AND ITS ID IN THE FOLLOWING FORMAT
$gist = [
	"interface_automation" => "1d1722fb7feab973576a6e2a02a8da93",
	"open-source_software" => "85c581db27bb2932ca35f9685598358a",
	"about" => "b2f3f7c2176cbabd42b6746ce8d258b1",
];
$gist_found = FALSE;
foreach ($gist as $gist_name => $gist_id) {if ($gist_name == $_GET['show']) $gist_found = TRUE;}
if ($gist_found == FALSE) {header("Location: https://github.com/404"); exit;}
// OPTION 1 - END OF BLOCK

/*
// OPTION 2 - AUTO UPDATING OF GIST NAME AND ID
// WARNING - WILL BREAK WHEN GITHUB UPDATES LAYOUT
include('gist_map.php'); $gist_found = FALSE;
foreach ($gist as $gist_name => $gist_id) {if ($gist_name == $_GET['show']) $gist_found = TRUE;}
if ($gist_found == FALSE) {
	$user_id = 'kensoh'; // CHANGE THIS TO YOUR GITHUB USERID
	include('update.php'); include('gist_map.php');
	foreach ($gist as $gist_name => $gist_id) {if ($gist_name == $_GET['show']) $gist_found = TRUE;}
	if ($gist_found == FALSE) {header("Location: https://github.com/404"); exit;}
}
// OPTION 2 - END OF BLOCK
*/

?>

<!DOCTYPE HTML>
<html>
<head>
	<?php
	// replace underscore with space and convert name to title case for page title
	echo "<title>" . ucwords(str_replace("_", " ", $_GET['show']), " -") . "</title>\n";
	
	// CHANGE TO YOUR DOMAIN NAME, TO SHOW IMAGE WHEN URL IS SHARED ON FACEBOOK
	echo "<meta property=\"og:image\" content=\"http://tebel.org/media/" . $_GET['show'] . ".jpeg\" />\n";
	
	// CHANGE THE REST OF THIS HEAD BLOCK BELOW ACCORDINGLY FOR YOUR WEBSITE
	// favicon can be easily generated by - https://realfavicongenerator.net
	?>
	<meta charset="utf-8" />
	<meta name="description" content="TA helps computers do our work by automating web-based technologies" />
	<meta name="keywords" content="tebel, automation" />
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=lkgzdXgNPx">
	<link rel="icon" type="image/png" href="/favicon-32x32.png?v=lkgzdXgNPx" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png?v=lkgzdXgNPx" sizes="16x16">
	<link rel="manifest" href="/manifest.json?v=lkgzdXgNPx">
	<link rel="mask-icon" href="/safari-pinned-tab.svg?v=lkgzdXgNPx" color="#1e82c9">
	<link rel="shortcut icon" href="/favicon.ico?v=lkgzdXgNPx">
	<meta name="apple-mobile-web-app-title" content="Tebel">
	<meta name="application-name" content="Tebel">
	<meta name="theme-color" content="#ffffff">
</head>

<body style="padding: 0; margin: 0; overflow-y: scroll;">
	<?php
	// option to present different sizes and positions for logo base on user device
	require_once '../media/Mobile_Detect.php'; $detect = new Mobile_Detect;
	if ($detect->isMobile())
		$icon_size = "float: right; margin: 333px 36px 36px 36px; width: 111px; height: 111px;";
	else
		$icon_size = "float: right; margin: 333px 36px 36px 36px; width: 111px; height: 111px;";

	// CHANGE TO YOUR DOMAIN NAME AND LOGO ICON, TO SHOW BACKLINK ICON TO YOUR MAIN PAGE
	// SAVE YOUR HEADER IMAGES (1440 x 480) IN .jpeg FORMAT USING SAME NAME AS YOUR GIST NAME
	echo "<header style=\"height: 480px; background: url(../media/" . $_GET['show'] . ".jpeg) no-repeat center; background-size: cover;\">
	<a href=\"http://tebel.org\"><img src=\"../media/tebel_icon.png\" title=\"Home\" style=\"opacity: 0.90; " . $icon_size . "\"></a></header>\n<p></p>\n";

	// CHANGE BELOW TO YOUR GITHUB USERID TO LOAD YOUR EMBEDDED GIST FROM GITHUB
	echo "<script src=\"https://gist.github.com/kensoh/" . $gist[$_GET['show']] . ".js\"></script>\n";	

	// load custom css base on user device to overwrite default gist styling for raw text gist (non .md)
	if ($detect->isMobile())
		echo "<link rel=\"stylesheet\" href=\"../css/style_gist_mobile.css\" />\n";
	else
		echo "<link rel=\"stylesheet\" href=\"../css/style_gist_desktop.css\" />\n";
	?>
</body>
</html>