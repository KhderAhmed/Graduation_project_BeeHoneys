<?php

namespace App\Http\Controllers\Services;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
class ClientProfileService{
      public function update(Client $client, array $data): void
    {
        $client->name = $data['name'];
        $client->email = $data['email'];

        if (!empty($data['password'])) {
            $client->password = Hash::make($data['password']);
        }

        $client->save();
    }
}