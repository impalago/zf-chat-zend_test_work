<?php
namespace Chat\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;


class ChatTable
{
    private $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


}