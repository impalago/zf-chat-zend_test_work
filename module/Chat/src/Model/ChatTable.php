<?php
namespace Chat\Model;

use Zend\Db\Sql\Delete;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;


class ChatTable
{
    private $tableGateway;

    /**
     * ChatTable constructor.
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Get all messages
     *
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll()
    {
        return $this->tableGateway->select(function (Select $select) {
            $select->order('id DESC');
        });
    }

    /**
     * Create new message
     *
     * @param Chat $chat
     * @return string
     */
    public function saveMessage(Chat $chat)
    {
        $data = [
            'text' => $chat->text,
            'created'  => $chat->created,
        ];

        $this->tableGateway->insert($data);
        return 'success';
    }

    /**
     * Deleting old messages
     *
     * @return int
     */
    public function numberMessages() {

        return $this->tableGateway->delete(function (Delete $delete) {
            $delete->where('id <= (
                SELECT id FROM messages
                ORDER BY id DESC
                LIMIT 10,1
            )');
        });
    }

}