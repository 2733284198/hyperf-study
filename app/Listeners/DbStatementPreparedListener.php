<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.org
 * @document https://wiki.hyperf.org
 * @contact  group@hyperf.org
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Listeners;

use Hyperf\Database\Events\StatementPrepared;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\ApplicationContext;
use Hyperf\Framework\Contract\StdoutLoggerInterface;

/**
 * @Listener
 */
class DbStatementPreparedListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            StatementPrepared::class,
        ];
    }

    public function process(object $event)
    {
        if ($event instanceof StatementPrepared) {
            $sql = $event->statement->queryString;
            $logger = ApplicationContext::getContainer()->get(StdoutLoggerInterface::class);
            $logger->debug($sql);
        }
    }
}