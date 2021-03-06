<?php

/*
 * This file is part of Badcow DNS Library.
 *
 * (c) Samuel Williams <sam@badcow.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badcow\DNS;

use Badcow\DNS\Rdata\RdataInterface;

class ResourceRecord implements ResourceRecordInterface
{
    const COMMENT_DELIMINATOR = '; ';

    const MULTILINE_BEGIN = '(';

    const MULTILINE_END = ')';

    /**
     * @var string
     */
    private $class;

    /**
     * @var RdataInterface
     */
    private $rdata;

    /**
     * @var int
     */
    private $ttl;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $comment;

    /**
     * @param string         $name
     * @param RdataInterface $rdata
     * @param string         $ttl
     * @param string         $class
     * @param string         $comment
     */
    public function __construct($name = null, RdataInterface $rdata = null, $ttl = null, $class = null, $comment = null)
    {
        if (null !== $name) {
            $this->setName($name);
        }

        if (null !== $class) {
            $this->setClass($class);
        }

        if (null !== $ttl) {
            $this->setTtl($ttl);
        }

        $this->rdata = $rdata;
        $this->comment = $comment;
    }

    /**
     * @param string $class
     *
     * @throws \UnexpectedValueException
     */
    public function setClass($class)
    {
        if (!Classes::isValid($class)) {
            throw new \UnexpectedValueException(sprintf('No such class as "%s"', $class));
        }

        $this->class = $class;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @param RdataInterface $rdata
     */
    public function setRdata(RdataInterface $rdata)
    {
        $this->rdata = $rdata;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param int $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = (int) $ttl;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        if (null === $this->rdata) {
            return;
        }

        return $this->rdata->getType();
    }

    /**
     * @return RdataInterface
     */
    public function getRdata()
    {
        return $this->rdata;
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * Set a comment for the record.
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $comment = preg_replace('/(?:\n|\r)/', '', $comment);
        $this->comment = $comment;
    }

    /**
     * Get the record's comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
}
