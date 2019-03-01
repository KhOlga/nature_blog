<?php
/**
 * Created by PhpStorm.
 * User: okharabet
 * Date: 08.02.2019
 * Time: 14:10
 */

namespace App\Service;

use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;


class SlackClient
{


    /**
     * @var Client
     */
    private $slack;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * SlackClient constructor.
     */
    public function __construct(Client $slack)
    {

        $this->slack = $slack;
    }

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Beaming a message to Slack!', [
            'message' => $message
        ]);

        if ($this->logger) {
            $this->logger->info('Beaming a message to Slack!');
        }

        $message = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);
        $this->slack->sendMessage($message);
    }


}