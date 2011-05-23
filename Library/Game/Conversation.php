<?php
namespace Game;
class Conversation
{
    protected $give = array();
    protected $receive = array();
    protected $currentAnswerId = 0;
    protected $selectedOptionId = false;

    public function __construct()
    {
        $this->initDialog();
    }

    public function get() {
        return array('answer' => $this->getAnswer(), 'optionsNext' => $this->getNextOptions(), 'optionsPrev' => $this->getPrevOptions());
    }

    public function setSelectedOptionId($int)
    {
        $this->selectedOptionId = (int) $int;
        return $this;
    }

    protected function getNextOptions()
    {
        $choices = array();
        foreach ($this->give as $id => $option) {
            if ($option['parentId'] === $this->currentAnswerId) {
                $choices[] = array('id' => $id, 'text' => $option['text']);
            }
        }
        $choices[] = array('id' => 0, 'text' => $this->give[0]['text']);
        return $choices;
    }

    protected function getPrevOptions()
    {
        if (array_key_exists($this->currentAnswerId, $this->receive)) {
            $optionId = $this->receive[$this->currentAnswerId]['parentId'];
            $choices = array();
            foreach ($this->give as $id => $option) {
                    if ($option['parentId'] === $this->give[$optionId]['parentId']) {
                        $choices[] = array('id' => $id, 'text' => $option['text']);
                    }
                }
            return $choices;
        }
        return false;
    }

    protected function getAnswer()
    {
        $answers = array();
        foreach ($this->receive as $id => $option) {
            if ($option['parentId'] === $this->selectedOptionId) {
                $answers[] = $option['text'];
                $this->currentAnswerId = $id;
            }
        }
        if (count($answers) > 0) {
            shuffle($answers);
            return $answers[0];
        }
        return false;
    }

    protected function initDialog()
    {
        $this->give[0] = array('parentId' => false, 'text' => 'Never Mind');
    }
}