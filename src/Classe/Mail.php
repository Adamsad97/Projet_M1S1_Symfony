<?php
namespace App\Classe;
use Mailjet\Client;
use \Mailjet\Resources;
//require 'vendor/autoload.php';
class Mail
{
    public function send($to_email, $to_name, $subject, $template, $vars = null)
    {
        // DEBUG : Vérification de l'appel à la fonction send
        file_put_contents(__DIR__.'/../../var/log/mailjet_debug.log', "Appel de la fonction send OK\n", FILE_APPEND);
        //récupécuration du template
        $content = file_get_contents(dirname(__DIR__).'/Mail/'.$template);

        //Je récupères les variables facultatives
        if($vars)
        {
            foreach($vars as $key => $var)
            {
              $content = str_replace('{'.$key.'}', $var, $content);
            }
        }
        $mj = new Client($_ENV['MJ_APIKEY_PUBLIC'], $_ENV['MJ_APIKEY_PRIVATE'], true, ['version' => 'v3.1']);

// Define your request body

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "adiawara35@myges.fr",
                        'Name' => "ElecStore"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 7091118,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
       
        file_put_contents(__DIR__.'/../../var/log/mailjet_debug.log', print_r($response->getData(), true), FILE_APPEND);


    }

}
