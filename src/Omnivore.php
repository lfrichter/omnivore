<?php

namespace lfrichter\omnivore;

class Omnivore
{
    /**
     * @var OmnivoreGeneral
     */
    public $omnivoreGeneral;

    /**
     * @var OmnivoreTickets
     */
    public $omnivoreTickets;

    /**
     * @var OmnivoreTables
     */
    public $omnivoreTables;

    /**
     * Get main classes
     *
     * omnivore constructor.
     */
    public function __construct()
    {
        $this->omnivoreGeneral = new OmnivoreGeneral;
        $this->omnivoreTables  = new OmnivoreTables;
        $this->omnivoreTickets = new OmnivoreTickets;
    }

    /**
     * @return OmnivoreGeneral
     */
    public function general(): OmnivoreGeneral
    {
        return $this->omnivoreGeneral;
    }

    /**
     * @return OmnivoreTables
     */
    public function tables(): OmnivoreTables
    {
        return $this->omnivoreTables;
    }

    /**
     * @return OmnivoreTickets
     */
    public function tickets(): OmnivoreTickets
    {
        return $this->omnivoreTickets;
    }
}
