<?php

namespace App\Providers;

use App\Models\Distributor;
use App\Models\Manufacturer;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**manuf-grp
         * distributor-grp
         * slsmgr-grp
         * sales-grp
         * dealer-grp
         * direct-dealer
         */
    }

    public static function isManufacturer($user): bool
    {
        return $user->hasGroup('manuf-grp');
    }

    public static function isDirectDealer($user): bool
    {
        return $user->hasGroup('direct-dealer-grp');
    }
    public static function isDistributor($user): bool
    {
        return $user->hasGroup('distributor-grp');
    }

    public static function isDealer($user): bool
    {
        return $user->hasGroup('dealer-grp');
    }

    public static function isSalesManager($user): bool
    {
        return $user->hasGroup('slsmgr-grp');
    }

    public static function isSales($user): bool
    {
        return $user->hasGroup('sales-grp');
    }

    public static function getUserType($user): string
    {
        if (self::isManufacturer($user)) {
            return 'manufacturer';
        } else if (self::isDirectDealer($user)) {
            return 'direct_dealer';
        } else if (self::isDistributor($user)) {
            return 'distributor';
        } else if (self::isDealer($user)) {
            return 'dealer';
        } else if (self::isSalesManager($user)) {
            return 'sales_manager';
        } else if (self::isSales($user)) {
            return 'sales';
        }

        return 'user';
    }
}
