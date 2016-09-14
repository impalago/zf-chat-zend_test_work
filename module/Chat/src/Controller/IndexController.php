<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Chat\Controller;

use Chat\Form\ChatForm;
use Chat\Model\Chat;
use Chat\Model\ChatTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
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

    /**
     * @return mixed
     */
    public function addAction()
    {
        $form = new ChatForm();

        $request = $this->getRequest();

        $chat = new Chat();
        $form->setInputFilter($chat->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            $this->getResponse()->setStatusCode(400);
            return;
        }

        $this->table->numberMessages();
        $formData = $form->getData();
        $newMessage = [
            'text' => $formData['text'],
            'created' => date('Y-m-d h:i:s')
        ];

        $chat->exchangeArray($newMessage);
        $this->table->saveMessage($chat);

        $jsonModel = new JsonModel([
            'response' => 'success'
        ]);

        return $jsonModel;
    }

    /**
     * Update list messages (fot Ajax request)
     *
     */
    public function getMessagesAction()
    {
        $messages = $this->table->fetchAll();
        $data = [];
        if ($messages->count() > 0) {
            foreach ($messages as $key => $message) {
                $data[$key]['created'] = $message->created;
                $data[$key]['text'] = $message->text;
            }
        }

        $jsonModel = new JsonModel([
            'data' => $data,
            'response' => 'success'
        ]);

        return $jsonModel;
    }
}
