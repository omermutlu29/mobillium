<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $articles = $browser->visit('https://localhost:8000/')
                ->elements('.link-to-article');
            $random = rand(1, count($articles));
            $browser->click($articles[$random])->waitForText('Article Show')->assertSee('Article Show');;
        });
    }
}
