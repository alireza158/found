<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Services\PeriodService;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::query()->orderByDesc('id')->paginate(24);
        return view('periods.index', compact('periods'));
    }

    public function create()
    {
        return view('periods.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => ['required','integer','min:1300','max:1600'],
            'month' => ['required','integer','min:1','max:12'],
            'starts_at' => ['required','date'],
            'ends_at' => ['required','date','after_or_equal:starts_at'],
        ]);

        Period::query()->create([
            'year' => $data['year'],
            'month' => $data['month'],
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'],
            'status' => 'open',
        ]);

        return redirect()->route('periods.index')->with('ok','دوره ایجاد شد.');
    }

    public function edit(Period $period)
    {
        return view('periods.edit', compact('period'));
    }

    public function update(Request $request, Period $period)
    {
        if ($period->status === 'closed') {
            return back()->with('err','دوره بسته است و قابل ویرایش نیست.');
        }

        $data = $request->validate([
            'year' => ['required','integer','min:1300','max:1600'],
            'month' => ['required','integer','min:1','max:12'],
            'starts_at' => ['required','date'],
            'ends_at' => ['required','date','after_or_equal:starts_at'],
        ]);

        $period->update($data);
        return redirect()->route('periods.index')->with('ok','دوره بروزرسانی شد.');
    }

    public function generateContributions(Period $period, PeriodService $svc)
    {
        try {
            $count = $svc->generateContributions($period);
            return back()->with('ok', "برای این دوره $count بدهی اشتراک ایجاد شد.");
        } catch (\Throwable $e) {
            return back()->with('err', $e->getMessage());
        }
    }

    public function close(Period $period)
    {
        $period->update(['status' => 'closed']);
        return back()->with('ok','دوره بسته شد.');
    }
}
