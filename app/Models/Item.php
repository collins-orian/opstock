<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'quantity', 'created_by'];

    /**
     * @param array $data
     * @return Model
     * @throws ValidationException
     */
    private static function create(array $data): Model
    {
        // Validate the input data before creating the item
        $validatedData = validator($data, [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'created_by' => 'required|integer|exists:users,id'
        ])->validate();

        // Create and return the new item using the validated data
        return self::query()->create($validatedData);
    }

    /**
     * Create a new item in the inventory.
     *
     * @param string $name
     * @param int $quantity
     * @return Model
     * @throws ValidationException
     */

    public static function createItem(string $name, int $quantity): Model
    {
        return self::create([
            'name' => $name,
            'quantity' => $quantity,
            'created_by' => auth()->id(),
        ]);
    }

    /**
     * Find an item by its primary key or throw an exception.
     *
     * @param int $id
     * @return Item
     * @throws ModelNotFoundException
     */
    public static function find(int $id): Item
    {
        // Use Laravel built-in findOrFail method to retrieve the item
        return Item::query()->findOrFail($id);
    }

}
