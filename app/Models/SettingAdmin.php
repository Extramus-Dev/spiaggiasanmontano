<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\TempBooking;

use DateTime;

class SettingAdmin extends Model
{
    use HasFactory;


    public function calculatePrice($place, $checkin, $checkout, $numOfadults){

      $numOfdays = date_diff(date_create($checkin), date_create($checkout));
      $numOfdays->d = $this->datediffcount($checkin, $checkout);
      $price_tm = 0;

      $julyFullOccupied = false;
      // check if full month covered in july
      if(strtotime($checkin)<= strtotime("2021-07-01") && strtotime($checkout) >= strtotime('2021-07-31')){
        // full month of july is occupied
        $julyFullOccupied = true;
        $numOfdays->d -= 1;
      }


      if($this->datediffcount("2021-07-31", $checkout) >= 1 && strtotime($checkout) > strtotime("2021-07-31")){

          $numofDaysoct = $this->datediffcount($checkin, "2021-07-31");
          $numofDaysoct2 = $this->datediffcount("2021-09-01", $checkout);


          $numofDaysoutOct =  $numofDaysoct + $numofDaysoct2;
          if($julyFullOccupied)
            $numofDaysoutOct -= 1;
          $monthCode = date("m", strtotime($checkout));
          $monthCode2 = date("m", strtotime($checkin));
          // price without oct
          if($numOfadults == 1){
            $price_tm = (($place->price1/30)*$numofDaysoutOct);
            if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
              $price_tm += $place->price1;
            }
          }else if($numOfadults == 2){
            $price_tm = (($place->price2/30)*$numofDaysoutOct);

            if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
              $price_tm += $place->price2;
            }
          }else if($numOfadults == 3){
            $price_tm = (($place->price3/30)*$numofDaysoutOct);
            if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
              $price_tm += $place->price3;
            }
          }else{
            $price_tm = (($place->price4/30)*$numofDaysoutOct);
            if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
              $price_tm += $place->price4;
            }
          }
          if($numOfdays->d < 30){
              $price_tm += ($this->daily_fee * $numofDaysoutOct);
          }
      }else{
        //no oct month
        if($numOfadults == 1){
          $price_tm = (($place->price1/30)*$numOfdays->d);
        }else if($numOfadults == 2){
          $price_tm = (($place->price2/30)*$numOfdays->d);
        }else if($numOfadults == 3){
          $price_tm = (($place->price3/30)*$numOfdays->d);
        }else{
          $price_tm = (($place->price4/30)*$numOfdays->d);
        }

        if($numOfdays->d < 30){
            $price_tm += ($this->daily_fee * $numOfdays->d);
        }
      }

      return round($price_tm);
    }

    public function recentActivaty($numOf){
        $bookings = Booking::orderByDesc('id')->limit($numOf)->get();
        return $bookings;
    }

    public function bookingURLvalidation($checkin, $checkout){

      if(isset($checkin) && isset($checkout) && $checkout >= $checkin){
        $set_admin = SettingAdmin::orderBy('id')->first();

        if(strtotime($checkin) < strtotime($set_admin->season_start) || strtotime($checkout) < strtotime($set_admin->season_start)){
          return false;
        }
        if(strtotime($checkin) > strtotime($set_admin->season_end) || strtotime($checkout) > strtotime($set_admin->season_end)){
          return false;
        }

        $numOFdays = $this->datediffcount($checkin, $checkout);
        if($numOFdays >= $set_admin->max_no_days){
          return true;
        }
      }
        return false;
    }


    public function datediffcount($checkin, $checkout){
        $checkin = strtotime($checkin);
        $checkout = strtotime($checkout);
        $datediff = $checkout-$checkin;
          if(round($datediff / (60 * 60 * 24))<0){
            return 0;
          }
        return round($datediff / (60 * 60 * 24))+1;
    }

    public function allPlaceReservationClosed($checkin, $checkout, $limitBooking = 72){
        $firstdayofMonth =  date("Y-m-01" ,strtotime($checkin));
        $lastdayofMonth =  date("Y-m-31" ,strtotime($checkin));

        $firstdayofMonth2 =  date("Y-m-01" ,strtotime($checkout));
        $lastdayofMonth2 =  date("Y-m-31" ,strtotime($checkout));

        $numOfBook = Booking::where('user_checkin', '>=', $firstdayofMonth)
                              ->where('user_checkin', '<=', $lastdayofMonth)
                              ->orWhere('user_checkout', '>=', $firstdayofMonth)
                              ->Where('user_checkout', '<=', $lastdayofMonth)->count();

        $numOfTempBooking = TempBooking::where('user_checkin', '>=', $firstdayofMonth)
                              ->where('user_checkin', '<=', $lastdayofMonth)->count();

        $numOfBook = $numOfBook + $numOfTempBooking;
        if($numOfBook >= $limitBooking){
            return true;
        }
        return false;
    }
}