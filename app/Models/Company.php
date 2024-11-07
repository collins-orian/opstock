<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'address', 'registered_by'];

    /**
     * Create a new Company
     * @param array $data
     * @return Model
     * @throws ValidationException
     */
    public static function create(array $data): Model
    {
        // Validate the input data before creating the company
        $validatedData = validator($data, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'registered_by' => ['required', 'integer', 'exists:users,id'],
        ])->validate();

        // Create and return the new item using the validated data
        return self::query()->create($validatedData);
    }

    public function rigs()
    {
        return $this->hasMany(Rig::class);
    }

    /**
     * Get the user who created the item.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
