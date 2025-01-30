@php
/**
 * @var \App\Dto\WhoisResponseDto|null $dto
 * @var string|null $domain
 */
@endphp
<div class="max-w-3xl w-full p-6 bg-white rounded-lg shadow-lg">

    <form @class(['flex justify-center', 'mb-6' => $dto]) wire:submit.prevent="checkWhois" id="whois-form">
        <input
            type="text"
            name="domain"
            wire:model="domain"
            value="{{ $domain }}"
            class="w-full max-w-xl p-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
            placeholder="Введіть домен"
            required>
        <button type="submit" class="ml-4 p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Перевірити</button>
    </form>
    @error('domain')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
    @if ($dto)
        <div id="whois-info" class="space-y-4 text-gray-700" wire:loading.remove>
            @if($dto->domain)
                <div>
                    <p class="font-semibold">Домен: <span id="domain-name">{{ $dto->domain }}</span></p>
                </div>
            @endif
            @if($dto->status)
                <div>
                    <p><strong>Статус:</strong> <span id="status">{{ $dto->status }}</span></p>
                </div>
            @endif
            @if ($dto->organisations)
                <div>
                    <p><strong>Організація:</strong> <span id="organisation">{{ implode(', ', $dto->organisations) }}</span></p>
                </div>
            @endif
            @if($dto->address)
                <div>
                    <p><strong>Адреса:</strong> <span id="address">{{ $dto->address }}</span></p>
                </div>
            @endif
            @if ($dto->emails || $dto->phones || $dto->faxNos)
                <div>
                    <p><strong>Контакти:</strong></p>
                    <ul id="contacts" class="list-inside list-disc">
                        @if($dto->emails) <li>Email: <span id="email">{{ implode(', ', $dto->emails) }}</span></li> @endif
                        @if($dto->phones) <li>Телефон: <span id="phone">{{ implode(', ', $dto->phones) }}</span></li> @endif
                        @if($dto->faxNos) <li>Факс: <span id="fax">{{ implode(', ', $dto->faxNos) }}</span></li> @endif
                    </ul>
                </div>
            @endif
            @if($dto->names)
                <div>
                    <p><strong>Імена:</strong></p>
                    <ul id="names" class="list-inside list-disc">
                        @foreach($dto->names as $name)
                            <li><span id="name{{ $loop->index }}">{{ $name }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($dto->nameServers)
                <div>
                    <p><strong>Сервери імен:</strong></p>
                    <ul id="nameservers" class="list-inside list-disc">
                        @foreach($dto->nameServers as $nameServer)
                            <li><span id="nameserver{{ $loop->index }}">{{ $nameServer }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($dto->created)
                <div>
                    <p><strong>Дата створення:</strong> <span id="created-date">{{ $dto->created }}</span></p>
                </div>
            @endif
            @if($dto->changed)
                <div>
                    <p><strong>Дата зміни:</strong> <span id="changed-date">{{ $dto->changed }}</span></p>
                </div>
            @endif
            @if($dto->source)
                <div>
                    <p><strong>Джерело:</strong> <span id="source">{{ $dto->source }}</span></p>
                </div>
            @endif
            @if($dto->registryDomainId)
                <div>
                    <p><strong>ID домену:</strong> <span id="registry-domain-id">{{ $dto->registryDomainId }}</span></p>
                </div>
            @endif
            @if($dto->registrarWhoisServer || $dto->registrarUrl)
                <div>
                    @if($dto->registrarWhoisServer) <p><strong>Реєстратор WHOIS сервер:</strong> <span id="registrar-whois-server">{{ $dto->registrarWhoisServer }}</span></p> @endif
                    @if($dto->registrarUrl) <p><strong>URL реєстратора:</strong> <span id="registrar-url">{{ implode(', ', (array) $dto->registrarUrl) }}</span></p> @endif
                </div>
            @endif
            @if($dto->registrarRegistrationExpirationDate)
                <div>
                    <p><strong>Дата закінчення реєстрації:</strong> <span id="registrar-registration-expiration-date">{{ $dto->registrarRegistrationExpirationDate }}</span></p>
                </div>
            @endif
            @if($dto->registrantOrganization)
                <div>
                    <p><strong>Організація реєстратора:</strong> <span id="registrar-organization">{{ $dto->registrantOrganization }}</span></p>
                </div>
            @endif
            @if($dto->registrarAbuseContactEmails || $dto->registrarAbuseContactPhones)
                <div>
                    @if($dto->registrarAbuseContactEmails) <p><strong>Email для зловживань:</strong> <span id="registrar-abuse-contact-emails">{{ implode(', ', $dto->registrarAbuseContactEmails) }}</span></p> @endif
                    @if($dto->registrarAbuseContactPhones) <p><strong>Телефон для зловживань:</strong> <span id="registrar-abuse-contact-phones">{{ implode(', ', $dto->registrarAbuseContactPhones) }}</span></p> @endif
                </div>
            @endif
            @if($dto->dnssec)
                <div>
                    <p><strong>DNSSEC:</strong> <span id="dnssec">{{ implode(', ', $dto->dnssec) }}</span></p>
                </div>
            @endif
            @if($dto->urlOfTheIcannWhoisInaccuracyComplaintForm)
                <div>
                    <p><strong>URL для подачі скарги на WHOIS:</strong> <span id="url-icann-whois-complaint">{{ $dto->urlOfTheIcannWhoisInaccuracyComplaintForm }}</span></p>
                </div>
            @endif
            @if($dto->lastUpdateOfWhoisDatabase)
                <div>
                    <p><strong>Останнє оновлення бази WHOIS:</strong> <span id="last-update-whois">{{ $dto->lastUpdateOfWhoisDatabase }}</span></p>
                </div>
            @endif
            @if($dto->registrantOrganization || $dto->registrantStateProvince || $dto->registrantCountry || $dto->registrantEmail)
                <div>
                    @if($dto->registrantOrganization) <p><strong>Організація реєстранта:</strong> <span id="registrant-organization">{{ $dto->registrantOrganization }}</span></p> @endif
                    @if($dto->registrantStateProvince || $dto->registrantCountry) <p><strong>Область реєстранта:</strong> <span id="registrant-state-province">{{ $dto->registrantStateProvince }}{{ $dto->registrantCountry ? ", " . $dto->registrantCountry : "" }}</span></p>@endif
                    @if($dto->registrantEmail)<p><strong>Email реєстранта:</strong> <span id="registrant-email">registrant@example.com</span></p>@endif
                </div>
            @endif
            @if($dto->adminOrganization || $dto->adminStateProvince || $dto->adminCountry || $dto->adminEmail)
                <div>
                    <p><strong>Адміністративний контакт:</strong></p>
                    @if($dto->adminOrganization)<p>Організація: <span id="admin-organization">{{ $dto->adminOrganization }}</span></p>@endif
                    @if($dto->adminStateProvince)<p>Область: <span id="admin-state-province">{{ $dto->adminStateProvince }}</span></p>@endif
                    @if($dto->adminCountry)<p>Країна: <span id="admin-country">{{ $dto->adminCountry }}</span></p>@endif
                    @if($dto->adminEmail)<p>Email: <span id="admin-email">{{ $dto->adminEmail }}</span></p>@endif
                </div>
            @endif
            @if($dto->techOrganization || $dto->techStateProvince || $dto->techCountry || $dto->techEmail)
                <div>
                    <p><strong>Технічний контакт:</strong></p>
                    @if($dto->techOrganization)<p>Організація: <span id="tech-organization">{{ $dto->techOrganization }}</span></p>@endif
                    @if($dto->techStateProvince)<p>Область: <span id="tech-state-province">{{ $dto->techStateProvince }}</span></p>@endif
                    @if($dto->techCountry)<p>Країна: <span id="tech-country">{{ $dto->techCountry }}</span></p>@endif
                    @if($dto->techEmail)<p>Email: <span id="tech-email">{{ $dto->techEmail }}</span></p>@endif
                </div>
            @endif
            @if($dto->urlOfTheIcannWhoisDataProblemReportingSystem)
                <div>
                    <p><strong>URL для повідомлення про проблеми з WHOIS даними:</strong> <span id="url-icann-whois-data-problem">{{ $dto->urlOfTheIcannWhoisDataProblemReportingSystem }}</span></p>
                </div>
            @endif
        </div>
    @endif

    <div class="flex justify-center">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-gray-900 mt-10" wire:loading></div>
    </div>

    @if($domain)
        @script
            <script>
                $wire.dispatch('checkWhois', { refreshPosts: true });
            </script>
        @endscript
    @endif
</div>
