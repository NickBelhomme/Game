<?php
namespace Game\Action;
class Open extends AbstractAction
{
    /**
     * name of the action, it is the id of a specific action
     *
     * @var string
     */
    protected $name = 'open';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        'open[ ]?',
    );

    /**
     * opens the subject
     *
     * @see Game\Action.AbstractAction::execute()
     * @return void
     */
    public function execute()
    {
        return $this->getExecuteMessageSuccess();
    }
}