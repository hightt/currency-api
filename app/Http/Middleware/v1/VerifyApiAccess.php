<?php

namespace App\Http\Middleware\v1;

use Closure;
use Illuminate\Http\Request;

class VerifyApiAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiTokens = [
            "4fa0daecd827e3a7d9138c2563396c10addef5e34d8e7627dd2c269ef25f723b12cd71b7bb754a6af30e40f449bd094f1b4c7ed80013d30cde29a2c917591389",
            "cb7b4276551f96c9a3dec9a52328ff067a3144346afee84326d60c10177165da7d79ffceddd0b39e115b8169d2409794bbb4dce7e589329b09f5b58bd3e4a809",
            "ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff",
            "d2a74ea0123266ccb1a2f0cc45a8b4bb9c74e2f636f02a6f59ff32d10e9efdc6d035bff88835f8d02408e8324f13b0d65643a0c590d2f5dc3a3a4af46e0247d0",
            "ce98953cc1ea8a18ff975aa7daccf86e66e539ea65ce132f5836a33f280bffed859b6877a07496d7b9c5cbf96895068a54852dbbcc5e1154276de3460bab1d33",
            "5b329ae55cf4db66437358170dc2827ccea43f9976f5083abde1044d5384e41f0b4c77380f99b327b87d3a5d7a728668c2b9e7add6a8b41cf549a4be46ff106b"
        ];

        if(in_array($request->token, $apiTokens)) {
            return $next($request);
        } else {
            return response()->json(['status' => false, 'message' => "Valid authorization token."], 403);
        }

    }
}
