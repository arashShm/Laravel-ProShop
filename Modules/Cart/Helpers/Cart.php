<?php 

namespace Modules\Cart\Helpers;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Collection;



/**
 * Class Cart
 * @package App\Helpers\Cart
 * @method static boolean has($id)
 * @method static Collection all()
 * @method static array get($id)
 * @method static Cart put(array $value , Model $obj = null)
 * @method static Cart update(array $key, $options)
 * @method static Cart instance(string $name)
 * @method static Cart flush()
 */
class Cart extends Facade
{
    protected Static function getFacadeAccessor()
    {
        return 'cart';
    }
}