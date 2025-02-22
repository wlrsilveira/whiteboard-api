<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhiteboardRequest;
use App\Http\Resources\WhiteboardQrCodeResource;
use App\Http\Resources\WhiteboardResource;
use App\Models\Whiteboard;
use App\Services\WhiteboardService;
use Illuminate\Http\Response;

class WhiteboardController extends Controller
{
    public function store(
        WhiteboardRequest $request,
        WhiteboardService $whiteboardService
    ): WhiteboardResource {
        $validated = $request->validated();
        $whiteboard = $whiteboardService->create(
            data: $validated,
            user: auth()->user()
        );

        return WhiteboardResource::make($whiteboard);
    }

    public function index(WhiteboardService $whiteboardService)
    {
        return WhiteboardResource::collection(
            $whiteboardService->list(
                user: auth()->user()
            )
        );
    }

    public function update(
        Whiteboard $whiteboard,
        WhiteboardRequest $request,
        WhiteboardService $whiteboardService
    ): WhiteboardResource {
        $validated = $request->validated();
        $whiteboard = $whiteboardService->update(
            data: $validated,
            whiteboard: $whiteboard
        );

        return WhiteboardResource::make($whiteboard);
    }

    public function destroy(
        Whiteboard $whiteboard,
        WhiteboardService $whiteboardService
    ): Response {
        $whiteboardService->delete(
            whiteboard: $whiteboard
        );

        return response()->noContent();
    }

    public function show(
        Whiteboard $whiteboard
    ): WhiteboardResource {
        return WhiteboardResource::make($whiteboard->load('user'));
    }

    public function getQrCode(
        Whiteboard $whiteboard,
        WhiteboardService $whiteboardService
    ): WhiteboardQrCodeResource {
        $qrCode = $whiteboardService->generateQrCode($whiteboard);

        return WhiteboardQrCodeResource::make([
            'whiteboard' => $whiteboard,
            'qr_code' => $qrCode,
        ]);
    }

    public function signIn(
        Whiteboard $whiteboard,
        WhiteboardService $whiteboardService
    ): void {
        // TODO
    }
}
