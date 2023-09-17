<?php

namespace App\Http\Middleware;

use App\Repository\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class cekEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    private $userRepo;

    public function __construct(UserRepository $userRepository){
        $this->userRepo=$userRepository;
    }
    public function handle(Request $request, Closure $next): Response
    {
        // $userRepository = $this->userRepo->get(session()->get("sessionKey")["id"])->first();
        // if($userRepository->email_isVerified==0) return redirect("/emailNotVerified");
        return $next($request);
    }
}
