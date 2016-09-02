<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Chat\Controller;

use Chat\Form\ChatForm;
use Chat\Model\ChatTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $table;

    /**
     * IndexController constructor.
     * @param ChatTable $table
     */
    public function __construct(ChatTable $table)
    {
        $this->table = $table;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel([
            'messages' => $this->table->fetchAll(),
            'form' => new ChatForm()
        ]);
    }
}
