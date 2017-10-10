<?php
namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

class GreetingConversation extends Conversation
{
    public function introduction()
    {
        $question = Question::create('Hi there! My name\'s hellobeano and I help people manage and monitor their e-commerce stores remotely via their favorite chat apps. What can I do for you today?')
            ->fallback('Sorry, I haven\'t learnt how to respond to that yet. Could you pick one of the 2 options available first?')
            ->callbackId('introduction')
            ->addButtons([
                Button::create('Tell me more')->value('more'),
                Button::create('Access my store')->value('store'),
            ]);
            
        return $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'more') {
                    $this->tellMeMore();
                } else if($answer->getValue() === 'store') {
                    $this->comingSoonScript();
                }
            }    
        });
    }
    
    public function tellMeMore()
    {
        $this->say('Well, if you have an e-commerce store running on Shopify, you can install me as an app in your Shopify store. Once installed, I will be able to answer any question you may have about the status of your store.');
        $this->bot->typesAndWaits(2);
        $this->say('You can ask me about your sales figures, product inventory levels, order information and I\'ll be able to retrieve them and report back to you about it. I can even export reports from your store for you.');
        $this->bot->typesAndWaits(2);
        
        $question = Question::create('In addition, I can also help you to manage your orders too. Fulfilling orders, updating tracking information and even emailing the customer is not a problem for me. Just tell me what you need me to do.')
            ->fallback('Sorry, I haven\'t learnt how to respond to that yet. Could you pick one of the 2 options available first?')
            ->callbackId('tellmemore')
            ->addButtons([
                Button::create('How to install')->value('install'),
                Button::create('Tell me more')->value('more'),
            ]);
        
        return $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'install') {
                    $this->installScript();
                } else if($answer->getValue() === 'more') {
                    $this->comingSoonScript();
                }
            }
        });
    }
    
    public function comingSoonScript()
    {
        $this->say('My service is currently still under testing and development and I will only be going live on 1 November 2017. Exciting!');
        $this->bot->typesAndWaits(2);
        $this->say('If you\'d like me to be able to assist you in managing your Shopify store, you can register for early access to me at the hellobeano website');
        $this->bot->typesAndWaits(2);
        $this->say('If you register now, I\'ll be able to give you 10% off your first year\'s subscription and I could be chatting with you earlier than 1 November!');
        
        $this->bot->reply(GenericTemplate::create()
        	->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
        	->addElements([
        		Element::create('Hellobeano Registration')
        			->subtitle('Register now for your early access and get 10% off your first year\'s subscription')
        			//->image(env('APP_URL', 'http://hellobeano.com') . '/img/hellobeano-website.png')
        			->addButton(ElementButton::create('visit')->url('http://hellobeano.com/register.html')),
        	])
        );
    }
    
    public function installScript()
    {
        $this->say('Currently I can only support e-commerce stores that are running on the Shopify platform.');
        $this->bot->typesAndWaits(2);
        $this->say('You simply install my Shopify app from the app store into your dashboard and create an hellobeano account.');
        $this->bot->typesAndWaits(2);
        $this->say('Once we\'re linked up, just add your email address to the list of approved users and we are good to chat!');
        
        $question = Question::create('Once we\'re linked up, just add your email address to the list of approved users and we are good to chat!')
            ->fallback('Sorry, I haven\'t learnt how to respond to that yet. Could you pick one of the options available first?')
            ->callbackId('installscript')
            ->addButtons([
                Button::create('Install app in store')->value('install'),
                Button::create('Not interested')->value('no'),
            ]);
        
        return $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'install') {
                    $this->comingSoonScript();
                } else if($answer->getValue() === 'no') {
                    $this->thanksForStoppingBy();
                }
            }
        });
    }
    
    public function greet()
    {
        $this->say('Hi there, how can I help you today?');
    }
    
    public function thanksForStoppingBy()
    {
        $this->say('Ok. Thank you so much for stopping by then.');
        $this->bot->typesAndWaits(1);
        $this->say('Have a good day!');
        
        return true;
    }
    
    /**
     * Start the conversation
     */
    public function run()
    {
        $this->introduction();
    }
}