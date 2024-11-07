<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Rig extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'location', 'company_id', 'registered_by'];

    /**
     * Create a new rig
     * @param array $data
     * @return Model
     * @throws ValidationException
     */
    public static function create(array $data): Model
    {
        // Define validation rules
        $validatedData = validator($data, [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
        ])->validate();

        // Create and return the new rig using the validated data
        return self::query()->create($validatedData);
    }

    /**
     * This
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user who created the item.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
