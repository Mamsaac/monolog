<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog;

use Monolog\Writer\WriterInterface;

class Log
{
    protected $name;
    protected $writers;

    public function __construct($name, $writers = array())
    {
        $this->name = $name;
        $this->writers = $writers;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addWriter(WriterInterface $writer)
    {
        $this->writers[] = $writer;
    }

    public function log($level, $message)
    {
        if ($level < $this->level) {
            return;
        }
        foreach ($this->writers as $writer) {
            $writer->write($this->name, $level, $message);
        }
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getLevel()
    {
        return $level;
    }
}
