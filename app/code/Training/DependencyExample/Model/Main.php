<?php

declare(strict_types=1);

namespace Training\DependencyExample\Model;

use Training\DependencyExample\Model\NonInjectable;

class Main
{

    protected array $data;
    protected Injectable $injectable;

    protected NonInjectableInterfaceFactory $nonInjectableFactory;

    public function __construct(InjectableInterface $injectable, NonInjectableInterfaceFactory $nonInjectableFactory, array $data = [])
    {
        $this->data = $data;
        $this->injectable = $injectable;

        $this->nonInjectableFactory = $nonInjectableFactory;

    }

    public function getId(): string
    {
        return $this->data["id"];
    }

    public function getInjectable(): Injectable
    {
        return $this->injectable;
    }

    public function getNonInjectable(): NonInjectable
    {
        return $this->nonInjectableFactory->create();
    }
}