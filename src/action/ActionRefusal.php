<?php
namespace Blacking\TaskForce\action;

class ActionRefusal extends ActionAbstract
{
    const ACTION_REFUSAL = 'refusal';

    protected string $name = 'Отказ';
    protected string $internal_name = self::ACTION_REFUSAL;

    protected function rightsCheck(int $executor_id, int $customer_id, int $user_id): bool
    {
        if ($executor_id === $user_id) {
            return true;
        }
        return false;
    }
}
