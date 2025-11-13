<?php

require 'vendor/autoload.php';

use App\RedisExample;

try {
    $redis = new RedisExample();
    
    $setResult = $redis->setValue('user:101', json_encode(['name_session' => 'Math', 'amount_hour' => 25, 'listener_amount' => 102, 'teacher_name' => 'ABHSDcubx']));
    echo "SET result: " . ($setResult ? 'OK' : 'FAILED') . "\n";
    
    $value = $redis->getValue('user:101');
    echo "GET result: " . $value . "\n";
    
    $data = json_decode($value, true);
    echo "Decoded data: " . print_r($data, true) . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}