<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
    <head>
        <title><?php print $head_title ?></title>
        <meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
        <?php print $head ?>
        <?php print $styles ?>
        <?php print $scripts ?>
    </head>
    <body>
        <a href="/" id="logo"><img src="<?php print $logo; ?>" alt=""/></a>
        <?php print $nav;?>
        
        <a href="http://www.twitter.com/thegalleryguide" title="Twitter">
            <img src="<?php echo base_path().path_to_theme();?>/twitter.gif" alt="Twitter"/>
        </a>
        <h1><?php print $title;?></h1>
        <div id="before"><?php print $before; ?></div>
        <div id="main"><?php print $content;?></div>
        <div id="after"><?php print $after;?></div>
        <div id="footer"><?php print $footer;?></div>
        
        <script type="text/javascript"><!--
  // XHTML should not attempt to parse these strings, declare them CDATA.
  /* <![CDATA[ */
  window.googleAfmcRequest = {
    client: 'ca-mb-pub-7249571142615222',
    format: '320x50_mb',
    output: 'html',
    slotname: '7849532151',
  };
  /* ]]> */
//--></script>
<script type="text/javascript"    src="http://pagead2.googlesyndication.com/pagead/show_afmc_ads.js"></script>

    </body>
</html>