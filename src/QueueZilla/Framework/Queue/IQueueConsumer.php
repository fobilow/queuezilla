<?php
/**
 * @author  Oke.Ugwu
 */

namespace QueueZilla\Framework\Queue;

interface IQueueConsumer
{
  /**
   * @return bool
   */
  public function getNewJob();

  /**
   * @return mixed|bool
   */
  public function getLockedJob();

  public function doJob($job);

  public function completeJob($job);

  public function takeABreak();
}
