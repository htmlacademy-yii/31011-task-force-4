<?php
namespace Blacking\TaskForce;

class ActionCancel extends ActionAbstract
{
    const ACTION_CANCEL = 'cancel';

    protected string $name = 'Отменить';
    protected string $internal_name = self::ACTION_CANCEL;

    protected function rightsCheck($executor_id, $customer_id, $user_id): bool
    {
        if ($customer_id === $user_id) {
            return true;
        }
        return false;
    }
}
