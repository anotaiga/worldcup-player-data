<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    use Illuminate\Support\Facades\DB;
    use App\Http\Requests\FormRequest;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;

    class UsersController extends Controller 
    {
        public function create_new_entry()
        {
            $user = new User;
            $countries = $user->selectCountries();
            return view('users.create_new_entry', ['user' => $user, 'countries' => $countries]);
        }
        
        
        public function backToLogIn()
        {
            // ここではindex1/1にリダイレクトしますが、実際の要件に合わせて変更してください。
            return redirect('login');
        }

        public function register(Request $request)
        {
            $validateMessages = [
                "email.required" => "この項目は必須入力です。",
                "email.email" => "email形式で入力してください",
                'email.regex' => '正しいメールアドレスの形式で入力してください。',
                "email.unique" => "入力されたメールアドレスはすでに登録されています。",
                "password.required" => "この項目は必須入力です。",
                "password.min" => "パスワードは8文字以上で入力してください。",
                "password2.required" => "この項目は必須入力です。",
                "password2.min" => "パスワードは8文字以上で入力してください。",
                "password2.same" => "パスワードが確認用と一致していません。",
            ];
        
            $validatedData = $request->validate([
                'email' => 'required|email|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/|unique:users,email',
                'password' => 'required|min:8',
                'password2' => 'required|min:8|same:password',
                'role' => 'required',
                'country_id' => 'sometimes|required',
            ], $validateMessages);
        
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'password2' => $validatedData['password2'],
                'role' => $validatedData['role'],
                'country_id' => $validatedData['country_id'],
            ]);
        
            return view('users.register', ['validatedData' => $validatedData]);
        }
        
        
        public function backToCreate()
        {
            // ここではindex1/1にリダイレクトしますが、実際の要件に合わせて変更してください。
            return redirect('create_new_entry');
        }
        
        public function login()
        {
            return view('users.login');
        }

        public function signin(Request $request)
        {
            $validateMessages = [
                "email.required" => "この項目は必須入力です。",
                "email.email" => "email形式で入力してください",
                'email.regex' => '正しいメールアドレスの形式で入力してください。',
                "password.required" => "この項目は必須入力です。",
                "password.min" => "パスワードは8文字以上で入力してください。",
            ];
        
            $validatedData = $request->validate([
                'email' => 'required|email|regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
                'password' => 'required|min:8',
            ], $validateMessages);

            $user = User::where('email', $validatedData['email'])->first();

            // ユーザーが存在し、パスワードが一致すれば認証成功
            if ($user && Hash::check($validatedData['password'], $user->password)) {
                Auth::login($user);
                if ($user->country_id == 0) {
                    // country_id が 0 の場合
                    return redirect('index1/1');
                }else {
                    // 他の country_id の場合
                    return redirect("index2/{$user->country_id}");
                }
            }

            $errors = collect();
            if (!$user) {
                $errors->put('email', 'メールアドレスが正しくありません。');
            }
            if ($user && !Hash::check($validatedData['password'], $user->password)) {
                $errors->put('password', 'パスワードが正しくありません。');
            }
        
            // エラーメッセージを追加してリダイレクト
            return redirect()->back()->withErrors($errors);
        
        }
        }
    
?>