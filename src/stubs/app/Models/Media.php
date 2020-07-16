<?php

namespace App\Models;

use Exception;
use Illuminate\Http\{File, UploadedFile};
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * Class Permission
 * @package App\Models
 */
class Media extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mediable_id', 'mediable_type', 'directory', 'filename', 'extension', 'mime_type', 'size'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'url'
    ];

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::saving(function ($media) {
            if (!array_key_exists('file', $media->getAttributes())) {
                throw new Exception("Media need 'file' attribute to save", 401);
            }

            if ($media->file instanceof File || $media->file instanceof UploadedFile) {
                $path = Storage::putFile($media->directory ?? 'media', $media->file, 'public');
                $path = (object) pathinfo($path);

                $media->directory = $path->dirname;
                $media->filename = $path->basename;
                $media->extension = $path->extension;
                $media->mime_type = mime_content_type($media->file->path());
                $media->size = $media->file->getSize();
                $media->increment('order');

                unset($media->file);
            }
        });

        // Attach event handler, on deleting of the user
        self::deleting(function ($media) {
            $file = $media->directory.'/'.$media->filename;
            if (Storage::exists($file)) {
                Storage::delete($file);
            }
        });
    }

    #########################
    ####  RELATIONSHIPS  ####
    #########################

    /**
     * Get all of the models that own medias.
     */
    public function mediable()
    {
        return $this->morphTo();
    }

    #########################
    ####     SCOPES      ####
    #########################

    //

    #########################
    ####    MUTATORS     ####
    #########################

    //

    #########################
    ####    ACCESSORS    ####
    #########################

    /**
     * Get the media url.
     *
     * @param  string  $avatar
     * @return string|null
     */

    public function getUrlAttribute()
    {
        if ($this->attributes['filename']) {
            return Storage::url($this->attributes['directory'].'/'.$this->attributes['filename']);
        }

        return null;
    }

    #########################
    ####     METHODS     ####
    #########################

    //
}
