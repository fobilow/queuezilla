<?php
/**
 * @author  Oke.Ugwu
 */

namespace QueueZilla\Framework\Queue;

abstract class MySQLQueueConsumer extends QueueConsumer
{

  protected $_dbConn;

  protected $_queueTableName;

  /**
   * Override this method to return a db connection object ($_dbConn)
   */
  abstract protected function _getConnection();
}
