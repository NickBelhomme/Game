<?php
namespace Game;
class Conversation
{
    /**
     * Possible responses to say by the player
     *
     * @var array
     */
    protected $give = array();

    /**
     * Possible responses to receive from the program
     *
     * @var array
     */
    protected $receive = array();

    /**
     * the last response received from the program
     *
     * @var integer
     */
    protected $currentAnswerId = 0;

    /**
     * the last responsed said by the player
     *
     * @var mixed integer or false when nothing is said yet
     */
    protected $selectedOptionId = false;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->initDialog();
    }

    /**
     * Get the next complete conversation to be held.
     * This is calculated depending on the $selectedOptionId
     *
     * @return array
     */
    public function get() {
        return array('answer' => $this->getAnswer(), 'optionsNext' => $this->getNextOptions(), 'optionsPrev' => $this->getPrevOptions());
    }

    /**
     * sets the player his response Id
     * @param integer $optionId
     */
    public function setSelectedOptionId($optionId)
    {
        $this->selectedOptionId = (int) $optionId;
        return $this;
    }

    /**
     * Get the next available options for the player to choose from
     *
     * @return array
     */
    protected function getNextOptions()
    {
        $choices = array();
        foreach ($this->give as $id => $option) {
            if ($option['parentId'] === $this->currentAnswerId) {
                if ($id === 0) {
                    $firstOptionFound = true;
                }
                $choices[] = array('id' => $id, 'text' => $option['text']);
            }
        }
        return $choices;
    }

    /**
     * Get the previous available options for the player to choose from
     *
     * @return array
     */
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

    /**
     * Get the seemingly random answer from the computer.
     * It is actually depending on the selectedoption from the player
     *
     * @return string
     */
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

    /**
     * template method in which you store the entire dialog
     *
     * @return void
     */
    protected function initDialog()
    {
        $this->give[0] = array('parentId' => false, 'text' => 'Never Mind');
    }
}