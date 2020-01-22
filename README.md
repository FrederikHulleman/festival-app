# I used the following email configuration"

'EmailTransport' => [
        'gmail' => [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'timeout' => 30,
            'username' => '******@gmail.com',
            'password' => '******',
            'className' => 'Smtp',
            'tls' => true,
        ]
    ],

'Email' => [
        'gmail' => [
            'transport' => 'gmail',
            'from' => ['donotreply@lrmf.com' => 'Leidsche Rijn Mahler festival'],
            'sender' => ['donotreply@lrmf.com' => 'Leidsche Rijn Mahler festival'],
            'replyTo' => ['donotreply@lrmf.com' => 'Leidsche Rijn Mahler festival'],
            'returnPath' => '******@gmail.com',
        ],
    ],