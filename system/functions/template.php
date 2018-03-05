<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

//THE FUNC
  function site_title() {
    global $cTemplate;
    _e(trim($cTemplate->site_title . ' - ' . getConfig('site')['title'], ' - '));
  }

  function site_keywords() {
    global $cTemplate;
    _e(implode($cTemplate->site_keywords, ','));
  }

  function site_description() {
    global $cTemplate;
    _e($cTemplate->site_description);
  }

//GET FUNC

  function _e($echo) {
    echo(htmlspecialchars($echo));
  }

  function get_meta() {
    global $cTemplate;
    $cTemplate->render_temp('assets/meta');
  }
