<?php

namespace App\Traits;

use App\Models\User;

trait AuthenticatesWithSanctumCookies {
    public function actingAsCookie(array $data) {
        $this->get('/sanctum/csrf-cookie');

        $this->post('/api/login', [
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return $this;
    }
}
