<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>VK API Example #1</title>
</head>
<body>
  
<?php
/**
 * Example 1.
 * Usage VK API without access token.
 * Some calls are not available.
 * @link http://vk.com/dev VK API
 */
error_reporting(E_ALL);
require_once('../src/vkapi.php');

$config = array( // Use your app_id and api_secret
    'app_id'        => '{YOUR_APP_ID}',
    'api_secret'    => '{YOUR_API_SECRET}'
);

$vk = new MAKSA\VKAPI($config['app_id'], $config['api_secret']);

$users = $vk->api('users.get', array(
    'uids'   => '1234,4321',
    'fields' => 'first_name,last_name,sex'));
    
foreach ($users['response'] as $user) {
    echo $user['first_name'] . ' ' . $user['last_name'] . ' (' .
        ($user['sex'] == 1 ? 'Girl' : 'Man') . ')<br />';
}
?>

</body>
</html>