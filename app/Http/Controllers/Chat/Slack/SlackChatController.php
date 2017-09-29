<?php

namespace App\Http\Controllers\Chat\Slack;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\LaravelCache;

use App\Conversations\ExampleConversation;
use App\Conversations\GreetingConversation;

use Log;

class SlackChatController extends Controller
{
    protected $botman;
    
    public function __construct()
    {
        $config = [
            'slack' => [
                'token' => env('SLACK_TOKEN'),
            ]
        ];
        
        DriverManager::loadDriver(\BotMan\Drivers\Slack\SlackDriver::class);
        
        // create an instance
        $this->botman = BotManFactory::create($config, new LaravelCache);
    }
    
    public function handle()
    {
        $this->botman->hears('((h|H)ello|(s|S)tart)', function(BotMan $bot) {
            $this->startConversation($bot);
        });
        
        $this->botman->listen();
    }
    
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new GreetingConversation);
    }
}
