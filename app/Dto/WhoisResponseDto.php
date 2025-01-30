<?php

namespace App\Dto;

use Bfg\Dto\Dto;

class WhoisResponseDto extends Dto
{
    public function __construct(
        public string $refer = '',
        public string $domain = '',
        public array $organisations = [],
        public string $address = '',
        public array $contacts = [],
        public array $names = [],
        public array $phones = [],
        public array $faxNos = [],
        public array $emails = [],
        public array $nServers = [],
        public string $dsRdata = '',
        public string $whois = '',
        public string $status = '',
        public string $remarks = '',
        public string $created = '',
        public string $changed = '',
        public string $source = '',
        public string|array $domainName = '',
        public string|array $registryDomainId = '',
        public string|array $registrarWhoisServer = '',
        public string|array $registrarUrl = '',
        public string|array $updatedDate = '',
        public string|array $creationDate = '',
        public string $registryExpiryDate = '',
        public array $registrars = [],
        public array $registrarIanaIds = [],
        public array $registrarAbuseContactEmails = [],
        public array $registrarAbuseContactPhones = [],
        public array $domainStatuses = [],
        public array $nameServers = [],
        public array $dnssec = [],
        public string $urlOfTheIcannWhoisInaccuracyComplaintForm = '',
        public string $lastUpdateOfWhoisDatabase = '',
        public string $registrarRegistrationExpirationDate = '',
        public string $registrantOrganization = '',
        public string $registrantStateProvince = '',
        public string $registrantCountry = '',
        public string $registrantEmail = '',
        public string $adminOrganization = '',
        public string $adminStateProvince = '',
        public string $adminCountry = '',
        public string $adminEmail = '',
        public string $techOrganization = '',
        public string $techStateProvince = '',
        public string $techCountry = '',
        public string $techEmail = '',
        public string $urlOfTheIcannWhoisDataProblemReportingSystem = '',
    ) {}
}
