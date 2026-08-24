<?php

namespace App\Http\Controllers\Services;

use App\Models\Beekeeper;
use Illuminate\Support\Facades\Hash;

class ClientProfileBeekeeperService
{
    public function update(Beekeeper $beekeeper, array $data): void
    {
        $beekeeper->name = $data['name'];
        $beekeeper->email = $data['email'];

        if (!empty($data['password'])) {
            $beekeeper->password = Hash::make($data['password']);
        }

        $beekeeper->save();
    }
}
