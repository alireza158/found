<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Passbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::query()->orderByDesc('id')->paginate(20);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required','string','max:190'],
            'phone' => ['nullable','string','max:40'],
            'national_id' => ['nullable','string','max:40'],
            'joined_at' => ['nullable','date'],
            'is_active' => ['nullable','boolean'],
            'passbook_numbers' => ['nullable','string','max:2000'],
        ]);

        $passbookNumbers = $this->parsePassbookNumbers($data['passbook_numbers'] ?? null);

        DB::transaction(function () use ($data, $passbookNumbers) {
            $m = Member::query()->create([
                'full_name' => $data['full_name'],
                'phone' => $data['phone'] ?? null,
                'national_id' => $data['national_id'] ?? null,
                'joined_at' => $data['joined_at'] ?? now()->toDateString(),
                'is_active' => (bool)($data['is_active'] ?? true),
            ]);

            if (count($passbookNumbers) === 0) {
                Passbook::query()->create([
                    'member_id' => $m->id,
                    'number' => null,
                    'title' => 'دفترچه پس‌انداز',
                    'type' => 'savings',
                    'is_active' => true,
                ]);
            } else {
                foreach ($passbookNumbers as $number) {
                    Passbook::query()->create([
                        'member_id' => $m->id,
                        'number' => $number,
                        'title' => 'دفترچه شماره '.$number,
                        'type' => 'savings',
                        'is_active' => true,
                    ]);
                }
            }
        });

        return redirect()->route('members.index')->with('ok','عضو ایجاد شد.');
    }

    public function show(Member $member)
    {
        $member->load(['passbooks.loans', 'loans.installments', 'loans.passbook']);
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'full_name' => ['required','string','max:190'],
            'phone' => ['nullable','string','max:40'],
            'national_id' => ['nullable','string','max:40'],
            'joined_at' => ['nullable','date'],
            'is_active' => ['nullable','boolean'],
            'passbook_numbers' => ['nullable','string','max:2000'],
        ]);

        $member->update([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'] ?? null,
            'national_id' => $data['national_id'] ?? null,
            'joined_at' => $data['joined_at'] ?? $member->joined_at,
            'is_active' => (bool)($data['is_active'] ?? false),
        ]);

        $passbookNumbers = $this->parsePassbookNumbers($data['passbook_numbers'] ?? null);
        foreach ($passbookNumbers as $number) {
            Passbook::query()->firstOrCreate(
                ['member_id' => $member->id, 'number' => $number],
                [
                    'title' => 'دفترچه شماره '.$number,
                    'type' => 'savings',
                    'is_active' => true,
                ]
            );
        }

        return redirect()->route('members.show', $member)->with('ok','بروزرسانی شد.');
    }

    public function destroy(Member $member)
    {
        // safer: soft delete could be added; for MVP we block delete
        return back()->with('err','در نسخه MVP حذف عضو غیرفعال است. عضو را غیرفعال کنید.');
    }

    public function storePassbook(Request $request, Member $member)
    {
        $data = $request->validate([
            'number' => ['required', 'string', 'max:100'],
            'title' => ['nullable', 'string', 'max:190'],
        ]);

        $number = trim($data['number']);
        if ($number === '') {
            return back()->with('err', 'شماره دفترچه را وارد کنید.');
        }

        $passbook = Passbook::query()->firstOrCreate(
            ['member_id' => $member->id, 'number' => $number],
            [
                'title' => trim((string) ($data['title'] ?? '')) ?: 'دفترچه شماره '.$number,
                'type' => 'savings',
                'is_active' => true,
            ]
        );

        if (!$passbook->wasRecentlyCreated) {
            return back()->with('err', 'این شماره دفترچه قبلاً برای این عضو ثبت شده است.');
        }

        return redirect()->route('members.show', $member)->with('ok', 'دفترچه جدید با موفقیت اضافه شد.');
    }

    private function parsePassbookNumbers(?string $raw): array
    {
        if (!$raw) {
            return [];
        }

        $parts = preg_split('/[\s,،]+/u', $raw) ?: [];
        $numbers = array_values(array_unique(array_filter(array_map(static function ($item) {
            return trim((string)$item);
        }, $parts))));

        return array_slice($numbers, 0, 50);
    }
}
