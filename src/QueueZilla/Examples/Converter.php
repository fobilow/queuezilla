<?php
namespace QueueZilla\Cli;

use QueueZilla\Framework\Queue\MySQLQueueConsumer;

/**
 * @author  Oke.Ugwu
 */
class Converter extends MySQLQueueConsumer
{
  protected $_queueTableName = "queue";

  public function getLockedJob()
  {
    $where      = "locked_by = :locked_by";
    $job = $this->_getConnection()->fetchRow(
      sprintf(
        'SELECT * FROM %s WHERE %s ORDER BY id ASC LIMIT 1',
        $this->_queueTableName,
        $where
      ),
      ['locked_by' => $this->_getInstanceName()]
    );

    return json_decode(json_encode($job));
  }

  public function getNewJob()
  {
    $this->_getConnection()->executeSql(
      sprintf(
        "UPDATE %s SET locked_by='%s' "
        . "WHERE locked_by IS NULL "
        . "AND processed=0 ORDER BY id ASC LIMIT 1",
        $this->_queueTableName,
        $this->_getInstanceName()
      )
    );

    $return = false;
    if($this->_getConnection()->getRowCount() > 0)
    {
      $return = true;
    }

    return $return;
  }

  public function doJob($job)
  {
    $output     = [];
    $return     = null;
    $outputFile = escapeshellarg('/path/to/file');
    $videoUrl   = escapeshellarg('http://...');
    exec(
      "youtube-dl $videoUrl -o $outputFile",
      $output,
      $return
    );
    if($return == 0)
    {
      $this->completeJob();
    }
  }

  public function completeJob()
  {
    $this->_getConnection()->update(
      $this->_queueTableName,
      ['id' => $this->_job->id],
      ['locked_by' => null, 'processed' => 1]
    );
  }

  public function takeABreak()
  {
    sleep(1);
  }

  protected function _getConnection()
  {
    return null;
  }
}


//in your console class
//create an instance of Conveter and call the consume method
