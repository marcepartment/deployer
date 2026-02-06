<?php

declare(strict_types=1);

/* (c) Anton Medvedev <anton@medv.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Logger\Handler;

use Deployer\Task\Context;
use function Deployer\currentHost;

class FileHandler implements HandlerInterface
{
    /**
     * @var string
     */
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function log(string $message): void
    {
        if(!empty($this->filePath)) {
            file_put_contents($this->filePath, $message, FILE_APPEND);
        }

        if(Context::has()){
            if(currentHost()->has('log_file')){
                if(!empty(currentHost()->get('log_file'))){
                    file_put_contents(currentHost()->get('log_file'), $message, FILE_APPEND);
                }
            }
        }
    }
}
