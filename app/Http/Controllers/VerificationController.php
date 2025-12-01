<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;


class VerificationController extends Controller
{

    // ===========================
    // VERIFIKASI DARI LINK EMAIL
    // ===========================

  public function verify(Request $request, $id, $hash)
    {
        $user = User::find($id);

        if (! $user) {
            return abort(404, "User not found.");
        }

        // cek hash
        if (! hash_equals($hash, sha1($user->email))) {
            return abort(403, "Invalid verification link.");
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/email-verified-success');
        }

        // tandai terverifikasi
        $user->markEmailAsVerified();

        // kirim event
        event(new Verified($user));

        return redirect('/email-verified-success');
    }
        public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/email-verified-success');
        }

        $request->user()->markEmailAsVerified();

        return redirect('/email-verified-success');
    }

    // ===========================
    // RESEND EMAIL (ANDROID)
    // ===========================
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email sudah diverifikasi.'
            ], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Email verifikasi telah dikirim ulang.'
        ], 200);
    }
}