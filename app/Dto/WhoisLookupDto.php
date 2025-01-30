<?php

namespace App\Dto;

use Bfg\Dto\Dto;

class WhoisLookupDto extends Dto
{
    public function __construct(
        public string $domain
    ) {}
}
