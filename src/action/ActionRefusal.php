<?php
namespace Blacking\TaskForce;

class ActionRefusal extends ActionAbstract
{
    const ACTION_REFUSAL = 'refusal';

    protected string $name = 'Отказ';
    protected string $internal_name = self::ACTION_REFUSAL;

    protected function rightsCheck($executor_id, $customer_id, $user_id): bool
    {
        if ($executor_id === $user_id) {
            return true;
        }
        return false;
    }
}
