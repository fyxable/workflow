<?php

namespace Fyxable\Workflow;

use Fyxable\Workflow\Registry;
use Fyxable\Workflow\Contracts\RegistryContract;

class WorkflowServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function registerBindings()
    {
        $registry = new Registry;

        $this->app->bind(
            RegistryContract::class,
            Registry::class
        );

        $this->app->instance(Registry::class, $registry);
    }
}
