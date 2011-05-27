<?php
namespace Game\Action;
class Look extends AbstractAction
{
    /**
     * name of the action, it is the id of a specific action
     *
     * @var string
     */
    protected $name = 'describe';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        'look[ ]?',
        'take a look[ ]?',
        'see[ ]?',
        'view[ ]?',
    );

    /**
     * Looks at the subject and gives feedback
     *
     * @see Game\Action.AbstractAction::execute()
     * @return void
     */
    public function execute()
    {
        echo $this->subject->getDescription();
    }
}