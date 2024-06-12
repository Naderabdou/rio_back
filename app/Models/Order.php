<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\OrderItems;
use Carbon\Traits\Converter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function getDateAttribute($date)
    {

       if ($this->attributes['created_at'] == null) {
            return null;
        }
        $dateFromat = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at']);

        // Get the current app locale
        $locale = app()->getLocale();

        // Tell Carbon to use the current app locale
        Carbon::setlocale($locale);

        /**
         * Set the date format you'd like to use.
         * Here, I use two different formats depending on current app locale.
         *
         * For Example: `D, M j, Y H:i:s` outputs `mer., oct. 21, 2020 15:11:07`,
         *  and `D, M j, Y g:i A` outputs `mer., oct. 21, 2020 3:26 PM`
         * If you have a look at the below function 👇🏻 in the Carbon source code,
         * you'll see it uses the first format mentioned above.
         *
         * @see \Carbon\Traits\Converter::toDayDateTimeString()
         */
        $format = $locale === 'ar' ? 'd M Y | h:i A' : 'd M Y | h:i A';

        // dd($dateFromat);

        // Use `translatedFormat()` to get a translated date string
        return $dateFromat->translatedFormat($format);
    }

    public function getDrivingAtAttribute($date)
    {
        if ($this->attributes['driving_at'] == null) {
            return null;
        }
        $dateFromat = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['driving_at']);

        // Get the current app locale
        $locale = app()->getLocale();

        // Tell Carbon to use the current app locale
        Carbon::setlocale($locale);

        /**
         * Set the date format you'd like to use.
         * Here, I use two different formats depending on current app locale.
         *
         * For Example: `D, M j, Y H:i:s` outputs `mer., oct. 21, 2020 15:11:07`,
         *  and `D, M j, Y g:i A` outputs `mer., oct. 21, 2020 3:26 PM`
         * If you have a look at the below function 👇🏻 in the Carbon source code,
         * you'll see it uses the first format mentioned above.
         *
         * @see \Carbon\Traits\Converter::toDayDateTimeString()
         */
        $format = $locale === 'ar' ? 'd M Y | h:i A' : 'd M Y | h:i A';

        // dd($dateFromat);

        // Use `translatedFormat()` to get a translated date string
        return $dateFromat->translatedFormat($format);


    }
    public function getProcessingAtAttribute($date)
    {
        if ($this->attributes['processing_at'] == null) {
            return null;
        }
        $dateFromat = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['processing_at']);

        // Get the current app locale
        $locale = app()->getLocale();

        // Tell Carbon to use the current app locale
        Carbon::setlocale($locale);

        /**
         * Set the date format you'd like to use.
         * Here, I use two different formats depending on current app locale.
         *
         * For Example: `D, M j, Y H:i:s` outputs `mer., oct. 21, 2020 15:11:07`,
         *  and `D, M j, Y g:i A` outputs `mer., oct. 21, 2020 3:26 PM`
         * If you have a look at the below function 👇🏻 in the Carbon source code,
         * you'll see it uses the first format mentioned above.
         *
         * @see \Carbon\Traits\Converter::toDayDateTimeString()
         */
        $format = $locale === 'ar' ? 'd M Y | h:i A' : 'd M Y | h:i A';

        // dd($dateFromat);

        // Use `translatedFormat()` to get a translated date string
        return $dateFromat->translatedFormat($format);
    }
    public function getShippedAtAttribute($date)
    {
        if ($this->attributes['shipped_at'] == null) {
            return null;
        }

        $dateFromat = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['shipped_at']);

        // Get the current app locale
        $locale = app()->getLocale();

        // Tell Carbon to use the current app locale
        Carbon::setlocale($locale);

        /**
         * Set the date format you'd like to use.
         * Here, I use two different formats depending on current app locale.
         *
         * For Example: `D, M j, Y H:i:s` outputs `mer., oct. 21, 2020 15:11:07`,
         *  and `D, M j, Y g:i A` outputs `mer., oct. 21, 2020 3:26 PM`
         * If you have a look at the below function 👇🏻 in the Carbon source code,
         * you'll see it uses the first format mentioned above.
         *
         * @see \Carbon\Traits\Converter::toDayDateTimeString()
         */
        $format = $locale === 'ar' ? 'd M Y | h:i A' : 'd M Y | h:i A';

        // dd($dateFromat);

        // Use `translatedFormat()` to get a translated date string
        return $dateFromat->translatedFormat($format);
    }
    public function getCompletedAtAttribute($date)
    {
        if ($this->attributes['completed_at'] == null) {
            return null;
        }
        $dateFromat = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['completed_at']);

        // Get the current app locale
        $locale = app()->getLocale();

        // Tell Carbon to use the current app locale
        Carbon::setlocale($locale);

        /**
         * Set the date format you'd like to use.
         * Here, I use two different formats depending on current app locale.
         *
         * For Example: `D, M j, Y H:i:s` outputs `mer., oct. 21, 2020 15:11:07`,
         *  and `D, M j, Y g:i A` outputs `mer., oct. 21, 2020 3:26 PM`
         * If you have a look at the below function 👇🏻 in the Carbon source code,
         * you'll see it uses the first format mentioned above.
         *
         * @see \Carbon\Traits\Converter::toDayDateTimeString()
         */
        $format = $locale === 'ar' ? 'd M Y | h:i A' : 'd M Y | h:i A';

        // dd($dateFromat);

        // Use `translatedFormat()` to get a translated date string
        return $dateFromat->translatedFormat($format);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}
