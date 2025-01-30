<?php

namespace App\Http\Controllers\Api;

use App\Contracts\WhoisServiceContractInterface;
use App\Dto\WhoisLookupDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\WhoisLookupRequest;

class WhoisController extends Controller
{
    public function __construct(
        protected WhoisServiceContractInterface $whoisService
    ) {}

    /**
     * Lookup whois information for a domain.
     *
     * @param  \App\Http\Requests\WhoisLookupRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lookup(WhoisLookupRequest $request)
    {
        $dto = WhoisLookupDto::fromRequest($request);
        $resultDto = $this->whoisService->lookup($dto);

        if (! $resultDto) {

            return response()->json([
                'error' => 'Domain not found',
            ], 404);
        }

        return response()->json([
            'data' => $resultDto->snakeKeys()->toArray(),
        ]);
    }
}
