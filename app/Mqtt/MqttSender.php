<?php

/**
 * Created by PhpStorm.
 * User: julien
 * Date: 23/06/17
 * Time: 16:58
 */

namespace App\Mqtt;
use Lzq\Mqtt\lib\Mqtt;
use Lzq\Mqtt\SamMessage;
use Lzq\Mqtt\SamConnection;
class MqttSender
{
    public static function sendMessage(MSMessage $message)
    {
        $message->setTopicPrefix(env('MQTT_TOPIC'));
        $mqtt = new SamConnection();
        $mqtt->connect('mqtt', array('SAM_HOST' => env('MQTT_IP'), 'SAM_PORT' => intval(env('MQTT_PORT'))));//start initialise the connection
        $mqtt->send($message->getTopic(), new SamMessage($message->getMessage()));
        $mqtt->disconnect();
    }

}