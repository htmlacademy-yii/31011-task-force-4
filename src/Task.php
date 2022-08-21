<?php
namespace Blacking\TaskForce;

class Task {

    private $action_cancel = new action\ActionCancel;
    private $action_completion = new action\ActionCompletion;
    private $action_response = new action\ActionResponce;
    private $action_refusal = new action\ActionRefusal;

    private $current_status;
    private $id_executor;
    private $id_customer;

    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_IN_WORK = 'in_work';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';

    const MAP_STATUS_ACTION = [
        'new' => 'Новое',
        'canceled' => 'Отменено',
        'in_work' => 'В работе',
        'completed' => 'Выполнено',
        'failed' => 'Провалено',
    ];

    public function __construct(int $id_user)
    {
        $this->current_status = self::STATUS_NEW;
        $this->id_customer = $id_user;
        $this->id_executor = null;
    }

    public function get_current_status() :string {
        return $this->current_status;
    }

    public function get_available_actions(int $id_user): bool {
        switch($this->current_status) {
            case self::STATUS_NEW:
                if ($id_user === $this->id_customer) {
                    return $this->action_cancel->rightsCheck;
                }
                return $this->action_response->rightsCheck;
            break;
            case self::STATUS_IN_WORK:
                if ($id_user === $this->id_customer) {
                    return $this->action_completion->rightsCheck;
                }
                return $this->action_refusal->rightsCheck;
            break;
            default:
                throw new exception\ActionException("Cтатус не существует");
        }
    }
}
