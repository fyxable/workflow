<?php

namespace Fyxable\Workflow;

use Symfony\Component\Workflow\Transition as SymfonyTransition;

class Transition extends SymfonyTransition
{

    /**
     * @var array
     */
    protected $metadata = [];

    /**
     * @param string|string[] $froms
     * @param string|string[] $tos
     * @param array $metadata
     */
    public function __construct(string $name, $froms, $tos, $metadata = [])
    {
        $this->metadata = $metadata;

        parent::__construct($name, $froms, $tos);
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'froms' => $this->getFroms(),
            'tos' => $this->getTos(),
            'metadata' => $this->getMetadata(),
        ];
    }
}
