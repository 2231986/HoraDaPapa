<?php

namespace common\components;

use yii\base\Component;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

// Guia para criar componente - https://www.yiiframework.com/wiki/760/yii-2-0-write-use-a-custom-component-in-yii2-0-advanced-template
// Guia para criar MQTT - https://www.emqx.com/en/blog/how-to-use-mqtt-in-php
class Mosquitto extends Component
{
    public static  function getTopic($userID)
    {
        return  'topic_' . $userID;
    }

    // Como usar? - "Yii::$app->Mosquitto->publish();"
    public function publish($topic, $payload)
    {
        try 
        {
            $mqtt = $this->initializeMqttClient();

            $mqtt->publish(
                // topic
                $topic,
                // payload
                json_encode($payload),
                // qos
                0,
                // retain
                true
            );
    
            $mqtt->disconnect();
        }
        catch (\Throwable $th) 
        {
            //TODO: Adicionar log
        }   
    }

    public function subscribe($topic)
    {
        try 
        {
            $mqtt = $this->initializeMqttClient();

            $mqtt->subscribe($topic, function ($t, $m)
            {
                printf("Received message on topic [%s]: %s\n", $t, $m);
            }, 0);
    
            $mqtt->disconnect();
        }
        catch (\Throwable $th)
        {
            //TODO: Adicionar log
        }
    }

    private function initializeMqttClient()
    {
        $server = '127.0.0.1'; // Set your MQTT server address here
        $port = 1883; // Set your MQTT server port here
        $clientId = 'client_horadapapa_api'; // Ensure a unique client ID
        $username = 'admin'; // Add your MQTT username here
        $password = '1234'; // Add your MQTT password here
        $mqtt_version = MqttClient::MQTT_3_1_1;

        $mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

        $connectionSettings = (new ConnectionSettings())
            ->setUsername($username)
            ->setPassword($password)
            ->setKeepAliveInterval(60)
            ->setLastWillTopic('emqx/test/last-will')
            ->setLastWillMessage('client disconnect')
            ->setLastWillQualityOfService(1);

        $mqtt->connect($connectionSettings, true);

        return $mqtt;
    }
}
