<?php

namespace Fyxable\Workflow;

use Fyxable\Workflow\Contracts\RegistryContract;
use Symfony\Component\Workflow\Registry as SymfonyRegistry;

class Registry extends SymfonyRegistry implements RegistryContract
{ }
