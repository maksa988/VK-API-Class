<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>VK API Example #2</title>
</head>
<body>
  
<?php
/**
 * Example 2.
 * Usage VK API having access token.
 * Some calls are not available.
 * @link http://vk.com/dev VK API
 */
error_reporting(E_ALL);
require_once('../src/vkapi.php');

$config = array( // Use your app_id, api_secret and access token
    'app_id'        => '{YOUR_APP_ID}',
    'api_secret'    => '{YOUR_API_SECRET}',
    'access_token'  => '{YOUR_ACCESS_TOKEN}'
);

$vk = new MAKSA\VKAPI($config['app_id'], $config['api_secret'], $config['access_token']);

$user_friends = $vk->api('friends.get', array(
    'uid'       => '12345',
    'fields'    => 'uid,first_name,last_name',
    'order'     => 'name'
));
    
foreach ($user_friends['response'] as $key => $value) {
    echo $value['first_name'] . ' ' . $value['last_name'] . ' ('
        . $value['uid'] . ')<br />';
}
?>

</body>
</html>