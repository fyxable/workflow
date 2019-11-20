<?php

namespace Fyxable\Workflow;

use Fyxable\Transition;
use Symfony\Component\Workflow\Workflow as SymfonyWorkflow;

class Workflow extends SymfonyWorkflow
{
    /**
     * @param string $name
     *
     * @return \Fyxable\Transition
     */
    public function getTransition($name): Transition
    {
        /** @var Transition $transition */
        foreach ($this->getDefinition()->getTransitions() as $transition) {
            if ($transition->getName() == $name) {
                return $transition;
            }
        }

        return null;
    }

    public function dump($path, $fromat = 'png')
    {
        $destination = $path . ($this->getName() . '.' . $fromat);

        $definition = $this->getDefinition();
        $dumper = new \Symfony\Component\Workflow\Dumper\GraphvizDumper();
        $dotCommand = "dot -T$fromat -o $destination";
        $process = new \Symfony\Component\Process\Process($dotCommand);
        $process->setInput($dumper->dump($definition));
        $process->mustRun();
    }
}
