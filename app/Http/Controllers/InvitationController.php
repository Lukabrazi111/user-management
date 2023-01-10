<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invitation\InvitationRequest;
use App\Interfaces\InvitationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\InvitationMail;
use App\Services\FileUploadService;
use Mail;
use Str;

class InvitationController extends Controller
{
    private InvitationRepositoryInterface $invitationRepository;
    private FileUploadService $fileUploadService;
    private UserRepositoryInterface $userRepository;

    /**
     * Method: construct a new instance of controller.
     *
     * @param InvitationRepositoryInterface $invitationRepository
     * @param UserRepositoryInterface $userRepository
     * @param FileUploadService $fileUploadService
     */
    public function __construct(InvitationRepositoryInterface $invitationRepository, UserRepositoryInterface $userRepository, FileUploadService $fileUploadService)
    {
        $this->invitationRepository = $invitationRepository;
        $this->userRepository = $userRepository;
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Show the form of invitation.
     */
    public function create()
    {
        return view('invitation');
    }

    /**
     * Store a new resource invitation.
     *
     * @param $token
     */
    public function store(InvitationRequest $request)
    {
        $validated = $request->validated();

        if ($request->file('image')) {
            $validated['image'] = $this->fileUploadService->handleUploadImage($request->file('image'), 'public/images');
        }

        $validated['password'] = Str::random(60);

        $user = $this->userRepository->store($validated);
        $token = $this->saveToken($user->id);

        // Send email to user.
        Mail::to($user->email)->send(new InvitationMail($user, $token));

        return redirect()->route('login.create')->with('success', __('invitation.email.sent'));
    }

    /**
     * Get user token.
     *
     * @param $id
     */
    public function saveToken($id)
    {
        $token = Str::random(80);
        $invitationData = ['token' => $token, 'user_id' => $id];
        $this->invitationRepository->store($invitationData);
        return $token;
    }
}
