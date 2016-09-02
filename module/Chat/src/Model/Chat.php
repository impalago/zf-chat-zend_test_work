<?php
namespace Chat\Model;

class Chat
{
    public $id;
    public $text;
    public $created;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->text = !empty($data['text']) ? $data['text'] : null;
        $this->created  = !empty($data['created']) ? $data['created'] : null;
    }
}