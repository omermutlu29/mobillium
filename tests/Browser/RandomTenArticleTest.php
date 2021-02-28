<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RandomTenArticleTest extends DuskTestCase
{
    public function loginAndClickButton()
    {
        $this->browse(function (Browser $browser) {
            $articles=$browser->visit('https://localhost:8000/')
                ->elements('.link-to-article');

            $random=rand(1,count($articles));
            $browser->click($articles[$random])->waitForText('Article Show');
        });
    }
}
