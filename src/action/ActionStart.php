<?php
namespace Blacking\TaskForce;

class ActionStart extends ActionAbstract
{
    const ACTION_START = 'start';

    protected string $name = 'Старт';
    protected string $internal_name = self::ACTION_START;

    protected function rightsCheck($executor_id, $customer_id, $user_id): bool
    {
        if ($customer_id === $user_id) {
            return true;
        }
        return false;
    }
}
