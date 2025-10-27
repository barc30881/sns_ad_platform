<?php

   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;

   class EnsureIsFreelancer
   {
       public function handle(Request $request, Closure $next)
       {
           if (!Auth::check()) {
               return redirect()->route('freelancer.login.form')->with('error', '프리랜서로 로그인해야 이 기능에 접근할 수 있습니다.');
           }

           if (Auth::user()->role !== 'freelancer') {
               return redirect()->route('dashboard')->with('error', '프리랜서로 등록해야 이 기능에 접근할 수 있습니다.');
           }

           return $next($request);
       }
   }
   