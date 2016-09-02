<?php
namespace Chat\Model;

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
            $select->order('created DESC');
        });
    }

}