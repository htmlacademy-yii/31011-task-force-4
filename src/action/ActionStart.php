<?php
namespace Blacking\TaskForce\action;

class ActionStart extends ActionAbstract
{
    const ACTION_START = 'start';

    protected string $name = 'Старт';
    protected string $internal_name = self::ACTION_START;

    protected function rightsCheck(int $executor_id, int $customer_id, int $user_id): bool
    {
        if ($customer_id === $user_id) {
            return true;
        }
        return false;
    }
}
