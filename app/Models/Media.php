<?php namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model {
    use HasFactory;
    protected $fillable = ['image'];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public static function uploadFile($file): string {
        $filename = $file->getClientOriginalName();
        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();
        $newFileName = time() . '_' . str_replace(' ', '_', $filenameWithoutExtension) . '.' . $fileExtension;
        $img_path = $file->storeAs('public/CategoryImage', $newFileName);
        // $file->storeAs('public/images/posts', $newFileName);
        return $newFileName;

        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/CategoryImage', $filename);
        return $filename;
    }

    public static function createOrUpdate($request, $id = null) {
        $image = $request['image'];
        $image = self::uploadFile($image);
        $media = ['image' => $image, 'category_id' => $request['category_id']];
        $media = self::updateOrCreate(['id' => $id], $media);
        return $media->id;
    }
}