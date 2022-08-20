<?php
namespace Blacking\TaskForce;

class ActionResponce extends ActionAbstract
{
    const ACTION_RESPONSE = 'response';

    protected string $name = 'Отклик';
    protected string $internal_name = self::ACTION_RESPONSE;

    protected function rightsCheck($executor_id, $customer_id, $user_id): bool
    {
        if ($executor_id === $user_id) {
            return true;
        }
        return false;
    }
}
