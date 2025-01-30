<?php

namespace App\Contracts;

use App\Dto\WhoisLookupDto;
use App\Dto\WhoisResponseDto;

interface WhoisServiceContractInterface
{
    /**
     * Perform a whois lookup.
     *
     * @param  \App\Dto\WhoisLookupDto  $dto
     * @return \App\Dto\WhoisResponseDto|false
     */
    public function lookup(WhoisLookupDto $dto): WhoisResponseDto|false;
}
