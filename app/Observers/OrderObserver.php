<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\TempTable;
use Carbon\Carbon;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function creating(Order $order)
    {
        //
        $order->ORD_StartTime = Carbon::now();
        $order->ORD_UserSerial = request()->waiter_user->U_Serial;
    }
    public function created(Order $order)
    {
        //

    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        // logger("test");
        if ($order->isDirty("ORD_Status")) {
            // dd($order);
            if ($order->ORD_Status == 10) {
                $temp_table = TempTable::create([
                    'TMP_Type' => $order->ORD_Type,
                    'TMP_TableID' => $order->ORD_TableID,
                    'TMP_OpenTime' => $order->ORD_StartTime,
                    'TMP_CustomerID' => $order->ORD_CustomerID,
                    'TMP_Status' => $order->ORD_Status,
                    'TMP_Total' => $order->ORD_Total,
                    // 'TMP_OrderNo'=>$order->ORD_OrderNo,
                    'TMP_Discount' => $order->ORD_Discount,
                    'TMP_UserID' => $order->ORD_UserSerial,
                    'TMP_NOTES' => $order->ORD_NOTES,
                    'TMP_OrderID' => $order->ORD_ID,
                    'TMP_WaiterID' => $order->ORD_UserSerial

                ]);
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
