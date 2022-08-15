<?php

class Task {
    private $current_status;
    private $id_executor;
    private $id_customer;

    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_IN_WORK = 'in_work';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    const ACTION_COMPLETION = 'completion'; # заказчик
    const ACTION_CANCEL = 'cancel';  # заказчик
    const ACTION_START = 'start'; # заказчик

    const ACTION_RESPONSE = 'response'; # исполнитель
    const ACTION_REFUSAL = 'refusal'; # исполнитель

    const MAP_STATUS_ACTION = [
        'new' => 'Новое',
        'canceled' => 'Отменено',
        'in_work' => 'В работе',
        'completed' => 'Выполнено',
        'failed' => 'Провалено',
        'completion' => 'Завершение',
        'cancel' => 'Отменить',
        'start' => 'Старт',
        'response' => 'Отклик',
        'refusal' => 'Отказ'
    ];

    public function __construct($id_user)
    {
        $this->current_status = self::STATUS_NEW;
        $this->id_customer = $id_user;
        $this->id_executor = null;
    }

    public function get_current_status() {
        return $this->current_status;
    }

    public function get_available_actions($id_user) {
        switch($this->current_status) {
            case self::STATUS_NEW:
                if ($id_user === $this->id_customer) {
                    return self::ACTION_CANCEL;
                }
                return self::ACTION_RESPONSE;
            break;
            case self::STATUS_IN_WORK:
                if ($id_user === $this->id_customer) {
                    return self::ACTION_COMPLETION;
                }
                return self::ACTION_REFUSAL;
            break;

        }
    }
}
