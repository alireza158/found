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
        ]);

        DB::transaction(function () use ($data) {
            $m = Member::query()->create([
                'full_name' => $data['full_name'],
                'phone' => $data['phone'] ?? null,
                'national_id' => $data['national_id'] ?? null,
                'joined_at' => $data['joined_at'] ?? now()->toDateString(),
                'is_active' => (bool)($data['is_active'] ?? true),
            ]);

            // default savings passbook
            Passbook::query()->create([
                'member_id' => $m->id,
                'title' => 'دفترچه پس‌انداز',
                'type' => 'savings',
                'is_active' => true,
            ]);
        });

        return redirect()->route('members.index')->with('ok','عضو ایجاد شد.');
    }

    public function show(Member $member)
    {
        $member->load('passbooks','loans.installments');
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
        ]);

        $member->update([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'] ?? null,
            'national_id' => $data['national_id'] ?? null,
            'joined_at' => $data['joined_at'] ?? $member->joined_at,
            'is_active' => (bool)($data['is_active'] ?? false),
        ]);

        return redirect()->route('members.show', $member)->with('ok','بروزرسانی شد.');
    }

    public function destroy(Member $member)
    {
        // safer: soft delete could be added; for MVP we block delete
        return back()->with('err','در نسخه MVP حذف عضو غیرفعال است. عضو را غیرفعال کنید.');
    }
}
