<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Installment;
use App\Models\Period;
use App\Models\Transaction;
use App\Services\AccountingService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(AccountingService $acc)
    {
        $period = Period::query()->orderByDesc('id')->first();

        $centralBalance = $acc->centralBalance();

        $unpaidContribs = $period
            ? Contribution::query()->where('period_id', $period->id)->where('status','!=','paid')->count()
            : 0;

        $incomingThisPeriod = $period
            ? Transaction::query()->where('period_id',$period->id)->where('direction','in')->sum('amount')
            : 0;

        $outgoingThisPeriod = $period
            ? Transaction::query()->where('period_id',$period->id)->where('direction','out')->sum('amount')
            : 0;

        $soon = Carbon::now()->addDays(7)->toDateString();
        $dueSoon = Installment::query()
            ->where('status','!=','paid')
            ->whereDate('due_date','<=',$soon)
            ->orderBy('due_date')
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'period','centralBalance','unpaidContribs','incomingThisPeriod','outgoingThisPeriod','dueSoon'
        ));
    }
}
