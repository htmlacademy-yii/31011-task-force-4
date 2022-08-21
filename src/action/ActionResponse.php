<?php
namespace Blacking\TaskForce\action;

class ActionResponce extends ActionAbstract
{
    const ACTION_RESPONSE = 'response';

    protected string $name = 'Отклик';
    protected string $internal_name = self::ACTION_RESPONSE;

    protected function rightsCheck(int $executor_id, int $customer_id, int $user_id): bool
    {
        if ($executor_id === $user_id) {
            return true;
        }
        return false;
    }
}
