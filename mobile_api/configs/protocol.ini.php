<?php
$ccmd_rows = array (
  'Bug' =>
  array (
    'bug' =>
    array (
      'cmd_id' => 'int16_t',
      'bug_type' => 'int8_t',
      'msg' => 'string',
    ),
  ),
  'Version' =>
  array (
    'version' =>
    array (
      'cmd_id' => 'int16_t',
      'client_version' => 'string',
    ),
  )
);

//APPCAN,使用了网络请求 Request ，没有使用uexXmlHttpMgr, 新版本有改动，直接变为$_REQUEST
$input_data = trim(file_get_contents("php://input"));

file_put_contents("d.txt", $input_data . "\n", FILE_APPEND);
file_put_contents("r.txt", json_encode($_REQUEST) . "\n", FILE_APPEND);

$user_request_data = array();

if ($input_data)
{
	parse_str($input_data, $user_request_data);
}

if ($user_request_data)
{
	$_REQUEST = array_merge($user_request_data, $_REQUEST);
}

if(isset($_REQUEST['k']) && $_REQUEST['k'])
{
    $_COOKIE['key'] = $_REQUEST['k'];
}
else
{
    $_COOKIE['key'] = 'BnEAdgc9UHJdVAI8XGRSOVI0';
}
