<?php

namespace App\Services;

use App\Contracts\WhoisServiceContractInterface;
use App\Dto\WhoisLookupDto;
use App\Dto\WhoisResponseDto;
use Illuminate\Support\Str;

class WhoisService implements WhoisServiceContractInterface
{
    /**
     * Perform a whois lookup.
     *
     * @param  \App\Dto\WhoisLookupDto  $dto
     * @return \App\Dto\WhoisResponseDto|false
     * @throws \Bfg\Dto\Exceptions\DtoUndefinedArrayKeyException
     */
    public function lookup(WhoisLookupDto $dto): WhoisResponseDto|false
    {
        $domain = escapeshellarg($dto->domain);
        $output = shell_exec("whois $domain 2>&1");
        if (str_contains($output, 'This query returned 0 objects.')) {
            return false;
        }
        $result = $this->parseWhoisOutput($output);

        return WhoisResponseDto::fromArray([
            'refer' => $result['refer'] ?? '',
            'domain' => $result['domain'] ?? '',
            'organisations' => $result['organisation'] ?? [],
            'address' => $result['address'] ?? '',
            'contacts' => $result['contact'] ?? [],
            'names' => $result['name'] ?? [],
            'phones' => $result['phone'] ?? [],
            'faxNos' => (array)($result['fax-no'] ?? []),
            'emails' => $result['e-mail'] ?? [],
            'nServers' => $result['nserver'] ?? [],
            'dsRdata' => $result['ds-rdata'] ?? '',
            'whois' => $result['whois'] ?? '',
            'status' => $result['status'] ?? '',
            'remarks' => $result['remarks'] ?? '',
            'created' => $result['created'] ?? '',
            'changed' => $result['changed'] ?? '',
            'source' => $result['source'] ?? '',
            'domainName' => $result['Domain Name'] ?? '',
            'registryDomainId' => $result['Registry Domain ID'] ?? '',
            'registrarWhoisServer' => $result['Registrar WHOIS Server'] ?? '',
            'registrarUrl' => $result['Registrar URL'] ?? '',
            'updatedDate' => $result['Updated Date'] ?? [],
            'creationDate' => $result['Creation Date'] ?? [],
            'registryExpiryDate' => $result['Registry Expiry Date'] ?? '',
            'registrars' => (array)($result['Registrar'] ?? []),
            'registrarIanaIds' => (array)($result['Registrar IANA ID'] ?? []),
            'registrarAbuseContactEmails' => (array)($result['Registrar Abuse Contact Email'] ?? []),
            'registrarAbuseContactPhones' => $result['Registrar Abuse Contact Phone'] ?? [],
            'domainStatuses' => $result['Domain Status'] ?? [],
            'nameServers' => $result['Name Server'] ?? [],
            'dnssec' => $result['DNSSEC'] ?? [],
            'urlOfTheIcannWhoisInaccuracyComplaintForm' => $result['URL of the ICANN Whois Inaccuracy Complaint Form'] ?? '',
            'lastUpdateOfWhoisDatabase' => $result['Last update of whois database'] ?? '',
            'registrarRegistrationExpirationDate' => $result['Registrar Registration Expiration Date'] ?? '',
            'registrantOrganization' => $result['Registrant Organization'] ?? '',
            'registrantStateProvince' => $result['Registrant State/Province'] ?? '',
            'registrantCountry' => $result['Registrant Country'] ?? '',
            'registrantEmail' => $result['Registrant Email'] ?? '',
            'adminOrganization' => $result['Admin Organization'] ?? '',
            'adminStateProvince' => $result['Admin State/Province'] ?? '',
            'adminCountry' => $result['Admin Country'] ?? '',
            'adminEmail' => $result['Admin Email'] ?? '',
            'techOrganization' => $result['Tech Organization'] ?? '',
            'techStateProvince' => $result['Tech State/Province'] ?? '',
            'techCountry' => $result['Tech Country'] ?? '',
            'techEmail' => $result['Tech Email'] ?? '',
            'urlOfTheIcannWhoisDataProblemReportingSystem' => $result['URL of the ICANN WHOIS Data Problem Reporting System'] ?? '',
        ]);
    }

    /**
     * Parse whois output.
     *
     * @param  string  $output
     * @return array
     */
    private function parseWhoisOutput(string $output): array
    {
        $result = [];
        $lines = explode("\n", $output);

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line) || str_starts_with($line, "#") || str_starts_with($line, "%")) {
                continue;
            }

            if (preg_match('/^([^:]+):\s*(.+)$/', $line, $matches)) {
                $key = trim($matches[1], " \n\r\t\v\0<>");
                $value = trim($matches[2], " \n\r\t\v\0<>");

                if (isset($result[$key])) {
                    if (!is_array($result[$key])) {
                        $result[$key] = [$result[$key]];
                    }
                    if (! in_array($value, $result[$key])) {
                        $result[$key][] = $value;
                    }
                } else {
                    $result[$key] = $value;
                }
            }
        }

        if (isset($result['address']) && is_array($result['address'])) {
            $result['address'] = implode(', ', $result['address']);
        }

        if (isset($result['Domain Name'])) {
            if (is_array($result['Domain Name'])) {
                $result['Domain Name'] = collect($result['Domain Name'])->map(Str::lower(...))->unique()->values()->all();
                if (count($result['Domain Name']) === 1) {
                    $result['Domain Name'] = $result['Domain Name'][0];
                }
            }
        }

        if (isset($result['Name Server'])) {
            if (is_array($result['Name Server'])) {
                $result['Name Server'] = collect($result['Name Server'])->map(Str::lower(...))->unique()->values()->all();
            }
        }

        if (isset($result['Registry Domain ID'])) {
            if (is_array($result['Registry Domain ID']) && count($result['Registry Domain ID']) === 1) {
                $result['Registry Domain ID'] = $result['Registry Domain ID'][0];
            }
        }

        if (isset($result['Registrar WHOIS Server'])) {
            if (is_array($result['Registrar WHOIS Server']) && count($result['Registrar WHOIS Server']) === 1) {
                $result['Registrar WHOIS Server'] = $result['Registrar WHOIS Server'][0];
            }
        }

        if (isset($result['Registrar URL'])) {
            if (is_array($result['Registrar URL']) && count($result['Registrar URL']) === 1) {
                $result['Registrar URL'] = $result['Registrar URL'][0];
            }
        }

        return $result;
    }
}
