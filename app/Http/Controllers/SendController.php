<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendController extends Controller
{
    public function index()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('queue_4', false, false, false, false);

        $msg = new AMQPMessage('Hello Laravel!');
        $channel->basic_publish($msg, '', 'queue_4');

        echo " [x] Sent 'Hello Laravel!'\n";

        $channel->close();
        $connection->close();
    }
}
