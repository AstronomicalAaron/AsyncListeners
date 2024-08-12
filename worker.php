<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Pheanstalk\Pheanstalk;

$pheanstalk = Pheanstalk::create('beanstalkd');

while ($job = $pheanstalk->watch('my_tube')->reserve()) {
    $data = json_decode($job->getData(), true, flags: JSON_THROW_ON_ERROR);
    echo "Processing message: " . $data['message'] . PHP_EOL;
    $pheanstalk->delete($job);
}
