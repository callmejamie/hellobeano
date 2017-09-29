<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Inncee Pte Ltd',
        'product' => 'hellobeano chatbot service',
        'street' => 'PO Box 111',
        'location' => 'Your Town, NY 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'support@hellobeano.com';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'jamiel@hellobeano.com'
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = false;
    
    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        //Spark::identifyTeamsByPath();
        Spark::noAdditionalTeams();
        
        Spark::useStripe()->noCardUpFront()->trialDays(7);
        Spark::collectBillingAddress();

        // Spark::freePlan()
        //     ->features([
        //         'First', 'Second', 'Third'
        //     ]);

        Spark::plan('Starter', 'provider-id-1')
            ->price(9)
            ->features([
                '1 chat integration', 
                '50 messages', 
                '5 export requests',
                'Standard support'
            ]);
            
        Spark::plan('Standard', 'provider-id-2')
            ->price(15)
            ->features([
                'Unlimited chat integrations', 
                '300 messages', 
                '50 export requests',
                'Standard support'
            ]);
            
        Spark::plan('Enterprise', 'provider-id-3')
            ->price(20)
            ->features([
                'Unlimited chat + SMS integrations', 
                'Unlimited messages', 
                'Unlimited export requests',
                'Standard and in-chat support'
            ]);
            
        Spark::hideTeamSwitcher();
    }
    
    public function register()
    {
        Spark::referToTeamAs('store');
    }
    
}
