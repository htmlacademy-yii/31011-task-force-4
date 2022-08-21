<?php
namespace Blacking\TaskForce\action;

class ActionCompletion extends ActionAbstract
{
    const ACTION_COMPLETION = 'completion';

    protected string $name = 'Завершение';
    protected string $internal_name = self::ACTION_COMPLETION;

    protected function rightsCheck(int $executor_id, int $customer_id, int $user_id): bool
    {
        if ($customer_id === $user_id) {
            return true;
        }
        return false;
    }
}
