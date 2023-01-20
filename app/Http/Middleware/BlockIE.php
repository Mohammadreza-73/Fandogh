<?php

namespace App\Http\Middleware;

use hisorange\BrowserDetect\Parser as Browser;
use App\Http\Middleware\Contract\MiddlewareInterface;

class BlockIE implements MiddlewareInterface
{
    public function handle()
    {
        if (Browser::isIE()) {
            return view('errors.block');
        }
    }
}
