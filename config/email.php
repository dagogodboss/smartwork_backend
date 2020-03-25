<?php
return [
    'deposit' => [
        'subject' => 'SM Transaction Alert [Credit Alert] ',
        'greeting' => "Hello %name%, ", 
        'message' => 'We wish to inform you that a Credit transaction occurred on your account with us. Find more info below.',
    ],
    'bank' =>[
        'subject' => 'Smart Motion Bank Account Action Notification',
        'greeting' => "Hello %name%, ", 
        'message' => 'You have carried out an action concerning your bank account on smart motion. Please click the link to find out more.'
    ],
    'withdrawal' =>[
        'greeting' => "Hello %name%, ", 
        'subject' => 'SM Transaction Alert [Debit Alert]',
        'message' => 'We wish to inform you that a successful debit transaction occurred on your account with us. Find more info below.'
    ],
    'transfer' =>[
        'subject' => 'SM Transaction Alert [Transfer Alert]',
        'greeting' => "Hello %name%, ", 
        'message' => 'We want to inform you that your transfer was successful. The beneficiary with this Account Number %account% receive this amount %amount%, from you. Your new account balance is %balance%',
        'receiver' => [
            'subject' => 'SM Transaction Alert [Transfer Alert]',
            'greeting' => "Hello %name%, ", 
            'message' => 'We want to inform you that your account has been credited through transfer. The sender with this Account Number %account% send this amount %amount%, to you. Your new account balance is %balance%',
        ]
    ]
];