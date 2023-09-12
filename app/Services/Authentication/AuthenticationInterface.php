<?php

namespace App\Services\Authentication;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RuntimeException;

interface AuthenticationInterface
{
    public function login(string $username, string $password): object;

    public function logout(object $usrData): bool | string | RedirectResponse;

    public function handleLoginCallback(Request $request): RedirectResponse | RuntimeException;

    public function getLoginUrl(): string | RuntimeException;
}
