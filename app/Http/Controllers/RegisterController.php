<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\RegisterRequest;
use App\Interfaces\InvitationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private InvitationRepositoryInterface $invitationRepository;

    /**
     * Method: construct a new instance of controller.
     *
     * @param UserRepositoryInterface $userRepository
     * @param InvitationRepositoryInterface $invitationRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, InvitationRepositoryInterface $invitationRepository)
    {
        $this->userRepository = $userRepository;
        $this->invitationRepository = $invitationRepository;
    }

    /**
     * Show the form for create a new resource.
     */
    public function create($token)
    {
        return view('register', compact('token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $request
     */
    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $invited = $this->invitationRepository->getByToken($validated['token']);

        if (!is_null($invited) && isset($invited->user)) {
            $this->userRepository->update($invited->user->id, ['password' => $validated['password']]);
            $invited->user->markEmailAsVerified();

            // Delete invitation by token
            $this->invitationRepository->deleteByToken($validated['token']);
        } else {
            return redirect()->route('invitation.create')->with('error', __('auth.not_found'));
        }

        return redirect()->route('login.create')->with('success', __('auth.verified'));
    }
}
