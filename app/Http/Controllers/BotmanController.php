<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\LaravelCache;

use App\Conversations\ExampleConversation;
use App\Conversations\GreetingConversation;

use Log;

class BotmanController extends Controller
{
    protected $botman;
    
    public function __construct()
    {
        $config = [
            'facebook' => [
                'token' => env('FACEBOOK_TOKEN'),
                'app_secret' => env('FACEBOOK_APP_SECRET'),
                'verification' => env('FACEBOOK_VERIFICATION'),
            ]
        ];
        
        DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);
        
        // create an instance
        $this->botman = BotManFactory::create($config, new LaravelCache);
    }
    
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $this->botman->hears('((h|H)ello|(s|S)tart)', function(BotMan $bot) {
            $this->startConversation($bot);
        });
        
        $this->botman->hears('stop', function(BotMan $bot) {
            $bot->reply('No problem. Goodbye!');
        })->stopsConversation();
        
        $this->botman->listen();
    }
    
    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new GreetingConversation);
    }
}
