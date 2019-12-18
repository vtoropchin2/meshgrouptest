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
    public const PHOTO_DIR = 'images';

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
            unlink(self::getPhotoPath($photo->file_name));
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
        $fileName = self::getFileName($image->getRealPath(), $format);
        $img->encode($format, $quality)->save(self::getPhotoPath($fileName));

        return $fileName;
    }

    /**
     * @param Photo $photo
     *
     * @return bool
     */
    public function hasUnlinkPhotoFile(Photo $photo): bool
    {
        $photoPath = self::getPhotoPath($photo->file_name);
        $countSamePhotos = Photo::where('file_name', $photo->file_name)->where('id', '!=', $photo->id)->count();

        return file_exists($photoPath) && $countSamePhotos === 0;
    }

    /**
     * @param string $path
     * @param string $format
     *
     * @return string
     */
    public static function getFileName(string $path, string $format): string
    {
        return md5_file($path) . ".$format";
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    public static function getPhotoPath(string $fileName): string
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
            unlink(self::getPhotoPath($photo->file_name));
        }

        $photo->delete();
    }
}
