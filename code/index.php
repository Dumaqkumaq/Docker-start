<?php

require 'vendor/autoload.php';

use App\RedisExample;
use App\ElasticExample;
use App\ClickhouseExample;

// Redis
$redis = new RedisExample();
echo $redis->setValue('user:101', json_encode(['name' => 'Alice', 'age' => 25]));
echo $redis->getValue('user:101');
?>