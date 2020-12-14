<?php

namespace App\Cleaners;

use HuangYi\Shadowfax\Contracts\Cleaner;
use Illuminate\Contracts\Container\Container;

class TymonJwtAuthCleaner implements Cleaner
{
    /**
     * Clean something.
     *
     * @param  \Illuminate\Contracts\Container\Container  $app
     * @return void
     */
    public function clean(Container $app)
    {
        $class = $app instanceof Lumen ? LumenServiceProvider::class : LaravelServiceProvider::class;

        $provider = new $class($app);

        $method = (new ReflectionObject($provider))->getMethod('extendAuthGuard');

        $method->setAccessible(true);

        $method->invoke($provider);
    }
}
