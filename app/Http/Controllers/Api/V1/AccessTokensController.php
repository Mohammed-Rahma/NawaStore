<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([ //تحققت انه الايميل و الباسورد الي بده يبعتهم اليوزر موجودين 
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => ['nullable'],
            'abilities'=>['array']
        ]);

        //->where('password' , '=' , $request->password)  // خطا لانه الباسورد الي بده يصلني بدي اقارنه مع الباسورد الي في الداتا بيز يكون مشفر 
        //->where('password' , '=' ,  Hash::check($request->password , $user->password))  بقارن باسورد مشفرة مع باسورد مشفرة الي في الداتا بيز وهيك خطا لانه كل عملية دخول الباسورد تعطي كود مشفر مختلف 
        /* Hash::check(  عملية مقارنة بين الي في الاسفل اذا ترو بكون متطابقة الباسورد 
        $request->password,  النص العادي بناخده من هدا الريكوست لانه هيبعتلي الباسورد في الركوست
         $user->password, اليوزر بحتوي على حقل اسمه باسورد هذا الحقل مخزن بداخله باسورد مشفرة 
         )*/
        $user = User::where('email', '=', $request->email)
            ->first(); // بقارن بالايميل ولانه الايميل يونيك برجع  ->first() يوزر واحد فقط 

        if ($user && Hash::check($request->password, $user->password)) {
            //بعد التحقق انشا بنشا توكن 
            //Authanticated
            $name = $request->input('device_name', $request->userAgent()); //بعتله اسم الجهاز لو مش موجود خد اسمه من اليوزراجنت 
            $token =  $user->createToken($name, $request->input('abilities' , ['*']), now()->addDays(30)); // استخدم اليوزرآجنت كاسم لتوكن  وبعتله باراميتر تاني بحتوي على صلحيات التوكن
            return response([
                'access_token' => $token->plainTextToken, //اخد اوبجكت من التوكن وبدي اياه يرجعلي ك بلييينplain    لانه بده يتخزن مشفر في الداتابيز 
                'usre' => $user //رجعت بيانات اليوزر 
            ]);
        }

        return response([ // اذا جملة الشطر الي فوق ما تحققت بكون فيه خطأ ولازم ارجعله ريسبونس انه فيه مشكلة البيانات مثلا خطا
            'message' => 'Invalid credentails'
        ],  401); // statusCode 200 -> 401  في حال رجعلي خطا غيرت الستاتس وكود  


    }

    //Revoke يسمى هذا المصطلح لسحب التوكن من اليوزر 
    public function destroy()
    { //لحذف التوكن 
        $user = Auth::guard('sanctum')->user(); //بدي اليوزر الي جاييني من sancrum
        $user->currentAccessToken()->delete(); // التوكن الحالي تاع اليوزر الس استخدمه في ارسال هذا الريكوست هذا التوكنعبارة عن الرو الي في الداتابيز 
        return response([], 204);

         $user->token()->delete(); //حذف كل التوكن الخاصة باليوزر من كل الاجهزة 

        $user->tokens; //بترجع كل التوكن تاعت اليوزر 

    }
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        return $user->tokens;
    }
}
