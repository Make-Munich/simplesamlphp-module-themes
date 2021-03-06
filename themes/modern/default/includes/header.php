<?php
$dir = SimpleSAML_Module::getModuleDir('themes');
require $dir . '/lib/functions.php';

// Define variables.
$url_path  = SimpleSAML_Module::getModuleURL('themes');
$css_path  = $url_path . '/css';
$js_path   = $url_path . '/js';
$img_path  = $url_path . '/img';
$language  = $this->getLanguage();

$this->data['isadmin'] = (bool)SimpleSAML_Session::getSessionFromRequest()->getAuthState('admin');

$login_url = isset($this->data['loginurl'])
  ? $this->data['loginurl']
  : '';

$title     = isset($this->data['header'])
  ? $this->data['header']
  : 'SimpleSAMLphp';

$alert_msg = $this->data['isadmin']
  ? $this->t('{core:frontpage:loggedin_as_admin}')
  : '<a href="' . $login_url . '">' . $this->t('{core:frontpage:login_as_admin}') . '</a>';

if (array_key_exists('pageid', $this->data)) :
  $hookinfo = array(
    'pre'    => &$this->data['htmlinject']['htmlContentPre'],
    'post'   => &$this->data['htmlinject']['htmlContentPost'],
    'head'   => &$this->data['htmlinject']['htmlContentHead'],
    'jquery' => &$jquery,
    'page'   => $this->data['pageid']
  );
  SimpleSAML_Module::callHooks('htmlinject', $hookinfo);

endif;

$uregconf = SimpleSAML_Configuration::getConfig('module_selfregister.php');
$asId = $uregconf->getString('auth');
$as = new SimpleSAML_Auth_Simple($asId);

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $title; ?></title>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="SAML Configuration">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>/font-awesome.css" />

    <!--[if IE]>
      <link href="<?php echo $css_path; ?>/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <![endif]-->
    <?php
      if(!empty($this->data['htmlinject']['htmlContentHead'])) :
        foreach($this->data['htmlinject']['htmlContentHead'] as $content) :
          echo $content;
        endforeach;
      endif;
    ?>

    <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>/cfp.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>/lang/bootstrap-select.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>/lang/flag-icon.min.css" />
    <script type="text/javascript" src="<?php echo $css_path; ?>/lang/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="<?php echo $js_path; ?>/bootstrap.min.js"></script>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto+Condensed%3A400%7CRoboto%3A400&#038;ver=1535976071' type='text/css' media='all' />
		<script>
			$(function(){
        $('.selectpicker').selectpicker();
      });
		</script>
	</head>
	<body>
		<div id="wrap">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="#" style="padding: 12.5px 10px;">
							<img alt="Brand" src="<?php echo $url_path; ?>/MakeMunich_logo_white_40x120.png">
						</a>
					</div>
					<div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <?php
              if ($this->data['links']['3']['text'] == '{status:logout}') {
						    echo '<li><a href="' . $as->getLogoutURL(SimpleSAML_Module::getModuleURL('selfregister/index.php')) . '">Logout</a></li>';
              } else {
                echo '<li><a href="' . SimpleSAML_Module::getModuleURL('selfregister/login.php') . '">Login</a></li>';
              }
              ?>
              <li>
								<form class="navbar-form navbar-left">
									<select class="selectpicker form-control" data-width="fit" name="language" onchange='this.form.submit()'>
                    <?php
                      $langs = array(
                        'en'    => 'English',
                        'de'    => 'Deutsch',
                      );
                      foreach ($langs as $lang => $name) {
                        if ($lang == 'en') {
                          $langicon = 'gb';
                        } else {
                          $langicon = $lang;
                        }
                        if ($lang == $language) {
                          print "<option data-content='<span class=\"flag-icon flag-icon-$langicon\"></span> $name' value=\"$lang\" selected>$name</option>";
                        } else {
                          print "<option data-content='<span class=\"flag-icon flag-icon-$langicon\"></span> $name' value=\"$lang\">$name</option>";
                        }
                      };
                    ?>
									</select>
									<noscript><input type="submit" value="Go" class="btn btn-default"></noscript>
                  <?php foreach ($this->data['stateparams'] as $name => $value) : ?>
                  <input type="hidden" name="<?php echo htmlspecialchars($name); ?>" value="<?php echo htmlspecialchars($value); ?>" />
                  <?php endforeach; ?>  
								</form>
							</li>
						</ul>
					</div>
				</div>
      </nav>

			  <div class="container" style="padding-bottom: 100px;">
          <?php
          if(!empty($this->data['htmlinject']['htmlContentPre'])) :
            foreach($this->data['htmlinject']['htmlContentPre'] as $content) :
              echo $content;
            endforeach;
          endif;
          ?>
            <div class="page-header">
              <h2><?php echo $title; ?></h2>
            </div>