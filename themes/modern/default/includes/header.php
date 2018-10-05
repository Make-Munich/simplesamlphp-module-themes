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
    <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>/bootstrap-min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>/bootstrap-theme.css" />
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $js_path; ?>/bootstrap-min.js"></script>
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto+Condensed%3A400%7CRoboto%3A400&#038;ver=1535976071' type='text/css' media='all' />
		
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
              <li><a href="/module.php/selfregister/reviewUser.php">Login</li>
						  <li>
								<form class="navbar-form navbar-left" action="#" method="post">
									<select class="selectpicker form-control" data-width="fit" name="language" onchange='this.form.submit()'>
										<option data-content='<span class="flag-icon flag-icon-de"></span> Deutsch' value="de">de</option>
										<option data-content='<span class="flag-icon flag-icon-gb"></span> English' value="en">en</option>
									</select>
									<noscript><input type="submit" value="Go" class="btn btn-default"></noscript>
								</form>
							</li>
						</ul>
					</div>
				</div>
      </nav>

			  <div class="container" style="padding-bottom: 60px;">
          <?php
          if(!empty($this->data['htmlinject']['htmlContentPre'])) :
            foreach($this->data['htmlinject']['htmlContentPre'] as $content) :
              echo $content;
            endforeach;
          endif;
          ?>
          <div class="row">
            <div class="page-header col-md-12">
              <h1 class="mainTitle"><?php echo $title; ?></h1>
            </div>
          </div>
          