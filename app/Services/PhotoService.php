<?php declare(strict_types=1);


namespace App\Services;


use App\Photo;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class PhotoService
 * @package App\Services
 */
class PhotoService extends AbstractService
{
    protected const PHOTO_DIR = 'images';

    /**
     * @param UploadedFile $image
     * @param string       $format
     * @param int          $quality
     *
     * @return Photo
     */
    public function createPhoto(UploadedFile $image, $format = 'jpg', $quality = 80): Photo
    {
        $fileName = $this->uploadPhoto($image, $format, $quality);

        return Photo::create(
            [
                'file_name' => $fileName,
            ]
        );
    }

    /**
     * @param int          $photoId
     * @param UploadedFile $image
     * @param string       $format
     * @param int          $quality
     *
     * @return Photo
     */
    public function updatePhoto(int $photoId, UploadedFile $image, $format = 'jpg', $quality = 80): Photo
    {
        $photo = Photo::findOrFail($photoId);

        $fileName = $this->uploadPhoto($image, $format, $quality);
        if ($this->hasUnlinkPhotoFile($photo)) {
            unlink($this->getPhotoPath($photo->file_name));
        }

        $photo->update(
            [
                'file_name' => $fileName,
            ]
        );

        return $photo;
    }

    /**
     * @param UploadedFile $image
     * @param string       $format
     * @param int          $quality
     *
     * @return Photo
     */
    public function uploadPhoto(UploadedFile $image, $format = 'jpg', $quality = 80): string
    {
        $img = Image::make($image);
        $fileName = md5_file($image->getRealPath()) . ".$format";
        $img->encode($format, $quality)->save($this->getPhotoPath($fileName));

        return $fileName;
    }

    /**
     * @param Photo $photo
     *
     * @return bool
     */
    public function hasUnlinkPhotoFile(Photo $photo): bool
    {
        $photoPath = $this->getPhotoPath($photo->file_name);
        $countSamePhotos = Photo::where('file_name', $photo->file_name)->where('id', '!=', $photo->id)->count();

        return file_exists($photoPath) && $countSamePhotos === 0;
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    public function getPhotoPath(string $fileName): string
    {
        return public_path(self::PHOTO_DIR . '/' . $fileName);
    }

    /**
     * @param $photoId
     *
     * @throws \Exception
     */
    public function deletePhoto($photoId): void
    {
        $photo = Photo::findOrFail($photoId);

        if ($this->hasUnlinkPhotoFile($photo)) {
            unlink($this->getPhotoPath($photo->file_name));
        }

        $photo->delete();
    }
}
