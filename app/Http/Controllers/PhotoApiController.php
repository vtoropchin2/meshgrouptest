<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhotoRequest;
use App\Http\Requests\DeletePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Services\PhotoService;
use Illuminate\Http\Response;

/**
 * Class PhotoApiController
 * @package App\Http\Controllers
 */
class PhotoApiController extends Controller
{
    /**
     * @var PhotoService
     */
    protected $photoService;

    /**
     * PhotoApiController constructor.
     *
     * @param PhotoService $photoService
     */
    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    /**
     * @param CreatePhotoRequest $request
     *
     * @return Response
     */
    public function createPhoto(CreatePhotoRequest $request): Response
    {
        $image = $request->file('image');

        $photo = $this->photoService->createPhoto($image);
        $data = PhotoResource::make($photo);

        return $this->success($data);
    }

    /**
     * @param UpdatePhotoRequest $request
     *
     * @return Response
     */
    public function updatePhoto(UpdatePhotoRequest $request): Response
    {
        $image = $request->file('image');
        $photoId = $request->get('photoId');

        $photo = $this->photoService->updatePhoto(
            $photoId,
            $image
        );
        $data = PhotoResource::make($photo);

        return $this->success($data);
    }

    /**
     * @param DeletePhotoRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function deletePhoto(DeletePhotoRequest $request): Response
    {
        $photoId = $request->get('photoId');

        $this->photoService->deletePhoto($photoId);

        return $this->success([]);
    }
}
