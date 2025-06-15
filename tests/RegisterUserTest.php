<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {
        /*
         * 1. Créer un faux client (navigateur) de pointer vers une URL
         * 2. Remplir les champs de mon formulaire d'inscription
         * 3. Est-ce tu peux régarder si le message d'alerte suivant: Compte créé avec succès!
         *
         */
        // 1.
        $client = static::createClient();
        $client->request('GET', '/inscription');
        //2. (firstname, lastname, email, password, confirmation du password
        $client->submitForm('Valider', [
            'register_user[firstname]' => 'Adama',
            'register_user[lastname]' => 'DIAWARA',
            'register_user[email]' => 'damuss@gmail.com',
            'register_user[plainPassword][first]' => '1234',
            'register_user[plainPassword][second]' => '1234'

        ]);

        //FOLLOW (Suivre la rédirection)
        $this->assertResponseRedirects('/connexion');
        $client->followRedirect();


        //3.
       $this->assertSelectorExists('div:contains("Compte créé avec succès!")');
        //$this->assertSelectorTextContains('div', 'Compte créé avec succès!');


    }
}
