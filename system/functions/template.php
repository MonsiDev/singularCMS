<?php
  if(defined('BASEPATH') === false) {
    exit;
}

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

  function _e($echo) {
    echo($echo);
  }

  function _esc($echo) {
    echo(htmlspecialchars($echo));
  }

  function get_meta() {
    global $cTemplate;
    $cTemplate->render_temp('assets/meta');
  }

  function jsonSend($data) {
    ob_end_clean();
    header('Content-type: application/json;charset=utf-8');
    exit(json_encode($data));
  }

  function isAjax() {
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      return true;
    }
    return false;
  }
