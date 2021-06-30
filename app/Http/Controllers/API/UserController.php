<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name'     => ['required', 'string', 'max:255' ],
                'username' => ['required', 'string', 'unique:users', 'max:255'],
                'email'    => ['required', 'email', 'unique:users', 'max:255'],
                'phone'    => ['nullable', 'string', 'max:255' ],
                'password' => ['required', 'string']
            ]);

            $request->merge([
                'password' => Hash::make($request->password)
            ]);

            $user  = User::create($request->all());
            $token = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success(
                [
                    'acces_token' => $token,
                    'token_type'  => 'Bearer',
                    'user'        => $user
                ],
                'berhasil daftar'
            );

        } catch (Exception $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'something when wrong',
                    'error'   => $error
                ],
                'gagal authentikasi',
                '500'
            );
        }
    }

	public function login(Request $request)
	{
		try {
			$request->validate([
				'email'    => ['required', 'email'],
				'password' => ['required']
			]);

			$credentials= request(['email', 'password']);
			
			if (!Auth::attempt($credentials)){
				return ResponseFormatter::error(
					[
						'message' => 'gagal autorisasi'
					],
					'gagal authorisasi',
					'500'
				);
			}

			$user = User::where('email',$request->email)->first();

			if (!Hash::check($request->password, $user->password)) {
				throw new Exception('invalid crential');
			}

			$token = $user->createToken('authToken')->plainTextToken;

			return ResponseFormatter::success(
				[
					'access_token' => $token,
					'token_type'   => 'Bearer',
					'user'		   => $user
				],
				'berhasil login'
			);

		} catch (Exception $error) {
			return ResponseFormatter::error(
				[
					'message' => 'gagal login',
					'error'   => $error
				],
				'gagal login',
				'500'
			);
		}
	}

	public function fetch(Request $request)
	{
		return ResponseFormatter::success(
			$request->user(),
			'data profil berhasil di ambil',
		);
	}

	public function udateProfile(Request $request)
	{
		$data = $request->all();

		$user = Auth::user();
		$user->update($data);
		
		return ResponseFormatter::success(
			$user,
			'profil berhasil di update'
		);
	}

	public function logout(Request $request)
	{
		$token = $request->user()->currentAccessToken()->delete();
		
		return ResponseFormatter::success(
			$token,
			'berhasil logout'
		);
	}
}
