<?php

namespace EtsvThor\CashRegisterBridge\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait VerifiesSignature
{
    protected function verifySignature(Request $request, string $signature): JsonResponse|null
    {
        if (! $request->verifySignature($signature)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid signature.',
            ], 403);
        }

        return null;
    }
}