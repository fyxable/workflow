<?php

namespace Fyxable\Workflow;

use SplObjectStorage;
use Fyxable\Workflow\Workflow;
use Fyxable\Workflow\Transition;
use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\Metadata\InMemoryMetadataStore;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;

class Factory
{
    public static function createFromArray($type, array $data)
    {
        $metaDataStore = [
            'workflows' => [],
            'places' => [],
            'transitions' => new SplObjectStorage
        ];

        $builder = new DefinitionBuilder();

        foreach ($data['places'] as $places) {
            foreach ($places as $marking => $place) {
                $builder->addPlace($marking);

                $metaDataStore['places'][$marking] = $place['metadata'];
            }
        }

        foreach ($data['transitions'] as $name => $data) {
            foreach ((array) $data['from'] as $from) {
                $transition = new Transition(
                    $name,
                    $from,
                    $data['to'],
                    $data['metadata']
                );

                $builder->addTransition($transition);

                $metaDataStore['transitions'][$transition] = $data['metadata'] ?? [];
            }
        }

        $builder->setMetadataStore(
            new InMemoryMetadataStore(
                $metaDataStore['workflows'],
                $metaDataStore['places'],
                $metaDataStore['transitions']
            )
        );

        return new Workflow(
            $builder->build(),
            new MethodMarkingStore(true, 'status'),
            null,
            $type
        );
    }
}
