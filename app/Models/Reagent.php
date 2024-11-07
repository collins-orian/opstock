<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class Reagent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'quantity',
        'expiry_date',
        'registered_by'
    ];

    /**
     * Ensures that the expiry date is treated as datetime.
     * @var array
     */
    protected $casts = ['expiry_date' => 'datetime'];

    /**
     * @param array $data
     * @return mixed
     * @throws ValidationException
     */
    public static function create(array $data): Model
    {
        $validatedData = validator($data, [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date|after:today',
            'registered_by' => 'required|exists:users,id'
        ])->validate();

        // Create and return the new reagent using the validated data
        return self::query()->create($validatedData);
    }

    /**
     * @param string $name
     * @param int $quantity
     * @param DateTimeInterface $expiry_date
     * @return Model
     * @throws ValidationException
     */
    public static function createReagent(string $name, int $quantity, DateTimeInterface $expiry_date): Model
    {
        return self::create([
            'name' => $name,
            'quantity' => $quantity,
            'expiry_date' => $expiry_date->format('Y-m-d'),
            'registered_by' => auth()->id(),
        ]);
    }

    /**
     * Get the user who created the item.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    /**
     * Find a reagent by its primary key or throw an exception.
     *
     * @param int $id
     * @return Reagent
     * @throws ModelNotFoundException
     */
    public static function find(int $id): Reagent
    {
        // Use Laravel built-in findOrFail method to retrieve the item
        return Reagent::query()->findOrFail($id);
    }

}
