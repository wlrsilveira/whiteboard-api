<?php

namespace App\Services;

use App\Models\User;
use App\Models\Whiteboard;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class WhiteboardService
{
    public function __construct() {}

    public function list(User $user): Collection
    {
        return $user->whiteboards;
    }

    public function create(array $data, User $user): Whiteboard
    {
        $data = array_merge($data, [
            'identifier' => Str::uuid(),
            'user_id' => $user->id,
        ]);

        return Whiteboard::create($data);
    }

    public function update(array $data, Whiteboard $whiteboard): Whiteboard
    {
        $whiteboard->fill($data)->save();

        return $whiteboard;
    }

    public function delete(Whiteboard $whiteboard): void
    {
        $whiteboard->delete();
    }

    public function generateQrCode(Whiteboard $whiteboard): string
    {
        $renderer = new ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(400),
            new SvgImageBackEnd
        );

        $writer = new Writer($renderer);

        $image = $writer->writeString($whiteboard->identifier);

        return 'data:image/png;base64,'.base64_encode($image);
    }
}
