<?php

namespace App\Http\Middleware;

use hisorange\BrowserDetect\Parser as Browser;
use App\Http\Middleware\Contract\MiddlewareInterface;

class BlockFirefox implements MiddlewareInterface
{
    public function handle()
    {
        if (Browser::isFirefox()) {
            return view('errors.block');
        }
    }
}
