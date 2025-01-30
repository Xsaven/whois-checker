<?php

namespace App\Livewire;

use App\Contracts\WhoisServiceContractInterface;
use App\Dto\WhoisLookupDto;
use App\Dto\WhoisResponseDto;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class WhoisChecker extends Component
{
    /**
     * @var string
     */
    #[Url(except: '')]
    public string $domain = '';

    /**
     * @var \App\Dto\WhoisResponseDto|null
     */
    protected WhoisResponseDto|null $whoisData = null;

    /**
     * @return void
     * @throws \Bfg\Dto\Exceptions\DtoUndefinedArrayKeyException
     */
    #[On('checkWhois')]
    public function checkWhois(): void
    {
        $this->validate([
            'domain' => 'required|string|regex:/^([a-z0-9-]+\.)+[a-z]{2,}$/i',
        ]);

        $result = app(WhoisServiceContractInterface::class)->lookup(
            WhoisLookupDto::fromArray(['domain' => $this->domain])
        );

        if (! $result) {
            $this->addError('domain', 'Domain not found');
        } else {
            $this->whoisData = $result;
        }
    }

    public function render()
    {
        return view('livewire.whois-checker', [
            'dto' => $this->whoisData,
            'domain' => $this->domain,
        ])->layout('layouts.app');
    }
}
