<?php

namespace App\Entity\Cron;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cron
 *
 * @ORM\Table(name="cron", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity
 */
class Cron
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="function", type="string", length=255, nullable=false)
     */
    private $function;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="run_date", type="datetime", nullable=true)
     */
    private $runDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="exec_time", type="decimal", precision=8, scale=3, nullable=true)
     */
    private $execTime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="time_gate", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $timeGate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="params", type="string", length=255, nullable=true)
     */
    private $params;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * @param string $function
     */
    public function setFunction(string $function): void
    {
        $this->function = $function;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime|null
     */
    public function getRunDate(): ?\DateTime
    {
        return $this->runDate;
    }

    /**
     * @param \DateTime|null $runDate
     */
    public function setRunDate(?\DateTime $runDate): void
    {
        $this->runDate = $runDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime|null $endDate
     */
    public function setEndDate(?\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return null|string
     */
    public function getExecTime(): ?string
    {
        return $this->execTime;
    }

    /**
     * @param null|string $execTime
     */
    public function setExecTime(?string $execTime): void
    {
        $this->execTime = $execTime;
    }

    /**
     * @return null|string
     */
    public function getTimeGate(): ?string
    {
        return $this->timeGate;
    }

    /**
     * @param null|string $timeGate
     */
    public function setTimeGate(?string $timeGate): void
    {
        $this->timeGate = $timeGate;
    }

    /**
     * @return null|string
     */
    public function getParams(): ?string
    {
        return $this->params;
    }

    /**
     * @param null|string $params
     */
    public function setParams(?string $params): void
    {
        $this->params = $params;
    }

}
