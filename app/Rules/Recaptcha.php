<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\TryCatch;
use PHPUnit\Framework\Constraint\IsFalse;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

     
        $response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => env('GOOGLE_RECAPTCHA_SECRET_KEY'),
            'response' => $value,
            'remoteip' => request()->ip()
        ]);
     
        $response = $response->json();
     
        if(! ($response["success"] ?? false) ) {
            $fail('error message ');
        }
        
    }


    // public function passes($attribute, $value, $fail)
    // {
    //        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
    //         'form_params' => [
    //             'secret' => env('GOOGLE_RECAPTCHA_SECRET_KEY'),
    //             'response' => $value,
    //             'remoteip' => request()->ip()
    //         ]
    //     ]);

    //     // $response->throw();

    //     $response = $response->json();

    //     // return $response['success'];

    //     if(! ($response["success"] ?? false) ) {
    //         $fail('error message ');
    //     }
   
    // }



    public function message()
    {
        return 'THe validation method message';
    }
}
