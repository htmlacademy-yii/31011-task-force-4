<?php
namespace Blacking\TaskForce;

abstract class ActionAbstract
{
    protected string $name;
    protected string $internal_name;

    public function getName(): string
    {
        return $this->name;
    }

    public function getInternalName(): string
    {
        return $this->internal_name;
    }

    abstract protected function rightsCheck($executor_id, $customer_id, $user_id): bool;
}
