<?php
/**
 * @author  Oke.Ugwu
 */

namespace QueueZilla\Framework\Queue;

abstract class QueueConsumer implements IQueueConsumer
{
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


  public function takeABreak()
  {
    sleep(1);
  }
}
