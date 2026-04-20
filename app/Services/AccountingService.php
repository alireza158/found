<?php

namespace App\Services;

use App\Models\Passbook;
use App\Models\Transaction;

class AccountingService
{
    /**
     * موجودی یک دفترچه: مجموع ورودی - مجموع خروجی
     */
    public function passbookBalance(int $passbookId): int
    {
        $in = Transaction::query()
            ->where('passbook_id', $passbookId)
            ->where('direction', 'in')
            ->sum('amount');

        $out = Transaction::query()
            ->where('passbook_id', $passbookId)
            ->where('direction', 'out')
            ->sum('amount');

        return (int)$in - (int)$out;
    }

    /**
     * موجودی صندوق مرکزی (passbook type=central)
     */
    public function centralBalance(): int
    {
        $central = Passbook::query()->where('type','central')->first();
        return $central ? $this->passbookBalance($central->id) : 0;
    }
}
