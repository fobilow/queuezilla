<?php
/**
 * @author  Oke.Ugwu
 */

namespace QueueZilla\Framework\Queue;

abstract class QueueConsumer implements IQueueConsumer
{
  /**
   * Identifier string for process. This is used for locking jobs from a queue
   *
   * @var string $_processId
   */
  protected $_processId;

  public function consume()
  {
    while(true)
    {
      $job = $this->getLockedJob();
      if($job)
      {
        $this->doJob($job);
      }
      else
      {
        if(!$this->getNewJob())
        {
          $this->takeABreak();
        }
      }
    }
  }

  public function setProcessId($id)
  {
    $this->_processId = $id;
  }

  protected function _getProcessId()
  {
    return $this->_processId;
  }

  public function takeABreak()
  {
    sleep(1);
  }
}
