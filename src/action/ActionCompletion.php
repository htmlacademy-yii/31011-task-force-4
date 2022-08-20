<?php
namespace Blacking\TaskForce;

class ActionCompletion extends ActionAbstract
{
    const ACTION_COMPLETION = 'completion';

    protected string $name = 'Завершение';
    protected string $internal_name = self::ACTION_COMPLETION;

    protected function rightsCheck($executor_id, $customer_id, $user_id): bool
    {
        if ($customer_id === $user_id) {
            return true;
        }
        return false;
    }
}
