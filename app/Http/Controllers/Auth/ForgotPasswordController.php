<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendMail(Request $request)
    {
        $this->validateEmail($request);

        $token = md5(time() . $request->email . bcrypt(env('APP_KEY')));

        $infoMail = [
            'content' => 'Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.',
            'link' => route('forgot.resetPassword', $token),
            'subject' => 'Yêu cầu đặt lại mật khẩu cho tài khoản của bạn',
        ];


        Mail::send('vendor.notifications.reset-password', $infoMail, function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Đặt lại mật khẩu cho tài khoản của bạn!');
        });

        if (empty(Mail::failures())) {

            PasswordReset::create([
                'email' => $request->email,
                'token' => $token
            ]);

            return back()->with('success', 'Bạn hãy kiểm tra mail để đặt lại mật khẩu');
        } else {
            return back()->with('danger', 'Gửi mail bị lỗi!');
        }
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
    }

    public function resetPassword(Request $request)
    {
        if ($request->post()) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|string|min:6|confirmed'
            ]);

            $email = $request->email;
            $password = $request->password;
            $token = $request->token;

            $info = PasswordReset::where('email', $email)
                ->where('token', $token)->first();

            if ($info) {
                $user = Admin::where('email', $email)->first();
                $user->password = bcrypt($password);

                $flag = $user->save();

                if ($flag) {
                    PasswordReset::destroy($info->id);
                    return redirect()->route('home');
                } else {
                    return back()->with('danger', 'Cập nhật không thành công! Liên hệ Administrator để được giúp đỡ!');
                }
            } else {
                abort(404);
            }
        }

        $info = PasswordReset::where('token', $request->token)->first();
        if (!$info) {
            abort(404);
        }
        return view('auth.passwords.reset', ['token' => $request->token]);
    }
}
