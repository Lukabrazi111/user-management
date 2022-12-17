<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private FileUploadService $fileUploadService;
    private UserRepositoryInterface $userRepository;

    /**
     * Method: construct a new instance of controller.
     *
     * @param FileUploadService $fileUploadService
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(FileUploadService $fileUploadService, UserRepositoryInterface $userRepository)
    {
        $this->fileUploadService = $fileUploadService;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource. + -
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterRequest $request
     */
    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        if ($request->file('image')) {
            $validated['image'] = $this->fileUploadService->handleUploadImage($request->file('image'), 'public/images');
        }

        $this->userRepository->store($validated);

        return redirect()->route('login')->with('success', 'Registered Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
