<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function clockIn(Request $request)
    {
        $user =  Auth::guard('admin')->user();
        // dd($user);
        $today = Carbon::today();

        // Check if already clocked in today
        $existingAttendance = Attendance::where('user_id', $user->id)
                                        ->whereDate('clock_in_time', $today)
                                        ->first();

        if ($existingAttendance && $existingAttendance->clock_in_time) {
            return redirect()->back()->with('message', 'You have already clocked in today.');
        }

        // Current time
        $now = Carbon::now('Asia/Kolkata');
        $workStartTime = Carbon::createFromTime(9, 30, 0, 'Asia/Kolkata');
        $lateThreshold = $workStartTime->copy()->addMinutes(15); // 9:45 AM
        
        // Determine if late
        $isLate = $now->gt($lateThreshold);
        // dd($isLate);
        // Create attendance record
        $attendance = Attendance::create([
            'user_id' => $user->id,
            'clock_in_time' => $now,
            'status' => $isLate ? 'late' : 'on_time',
            'ip_address' => $request->ip(),
        ]);

        // If late, check if reason is provided
        if ($isLate) {
            if ($request->has('reason') && !empty($request->reason)) {
                $attendance->reason = $request->reason;
                $attendance->save();
            } else {
                // Redirect back with flag to show reason modal
                return redirect()->back()->with('needs_reason', true);
            }
        }

        return redirect()->back()->with('message', 'Attendance marked successfully.');
    }
}
