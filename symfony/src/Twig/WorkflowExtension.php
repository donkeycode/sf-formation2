<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\Component\Workflow\Registry;

class WorkflowExtension extends AbstractExtension
{
    private $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_transitions', [$this, 'getTransitions']),
        ];
    }

    /**
     * get_transitions(bienModification)
     * 
     * return array
     */
    public function getTransitions($entity)
    {
        $workflow = $this->registry->get($entity);

        return $workflow->getEnabledTransitions($entity);
    }
}
