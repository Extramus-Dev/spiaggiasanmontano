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



      $checkin1 = strtotime($checkin);
      $checkout2 = strtotime($checkout);



      $numOfdays = date_diff(date_create($checkin), date_create($checkout));
      $numOfdays->d = $this->datediffcount($checkin, $checkout);
      $price_tm = 0;

      $julyFullOccupied = false;
      // check if full month covered in july
      if(strtotime($checkin)<= strtotime("2022-05-01") && strtotime($checkout) >= strtotime('2022-05-31')){
        // full month of july is occupied
        $julyFullOccupied = true;
        $numOfdays->d -= 1;
      }


      if($this->datediffcount("2022-05-31", $checkout) >= 1 && strtotime($checkout) > strtotime("2022-05-31")){

          $numofDaysoct = $this->datediffcount($checkin, "2022-05-31");
          $numofDaysoct2 = $this->datediffcount("2022-09-01", $checkout);
          $numofDaysoct3 = $this->datediffcount("2022-08-01", $checkout);
          $numofDaysoct4 = $this->datediffcount("2022-07-01", $checkout);
          $numofDaysoct5 = $this->datediffcount("2022-06-01", $checkout);
          $numofDaysoct6 = $this->datediffcount($checkin, $checkout);


          $numofDaysoutOct =  $numofDaysoct6 ;


          $timestamp = strtotime($checkin);

          $daysRemaining = (int)date('t', $timestamp) - (int)date('j', $timestamp);



          if($julyFullOccupied)
            $numofDaysoutOct -= 1;
          $monthCode = date("m", strtotime($checkout));
          $monthCode2 = date("m", strtotime($checkin));


          if($monthCode2 == "06"){
            $numOfDaysInMonth = 30;
          }else if ($monthCode2 == "07"){
            $numOfDaysInMonth = 31;
          }
          else if ($monthCode2 == "08"){
            $numOfDaysInMonth = 31;
          }





          if ($checkin1 >= strtotime("2022-06-01") && $checkin1 <= strtotime("2022-06-30") && $checkout2 <= strtotime("2022-08-31")){

            if($numOfadults == 1){
              $daysRemaining += 1;
              echo $daysRemaining;
              $june_calulation = ($place->price1/ $numOfDaysInMonth) * $daysRemaining;
              $july_calculation = $place->price1;
              $august_calcualtion = $place->price1;
              $price_tm = $june_calulation + $july_calculation + $august_calcualtion;
            }

            elseif($numOfadults == 2){
              $daysRemaining += 1;
              $june_calulation = ($place->price2/ $numOfDaysInMonth) * $daysRemaining;
              $july_calculation = $place->price2;
              $august_calcualtion = $place->price2;
              $price_tm = $june_calulation + $july_calculation + $august_calcualtion;
            }

            elseif($numOfadults == 3){
              $daysRemaining += 1;
              $june_calulation = ($place->price3/ $numOfDaysInMonth) * $daysRemaining;
              $july_calculation = $place->price3;
              $august_calcualtion = $place->price3;
              $price_tm = $june_calulation + $july_calculation + $august_calcualtion;
            }

            
            elseif($numOfadults == 4){
              $daysRemaining += 1;
              $june_calulation = ($place->price4/ $numOfDaysInMonth) * $daysRemaining;
              $july_calculation = $place->price4;
              $august_calcualtion = $place->price4;
              $price_tm = $june_calulation + $july_calculation + $august_calcualtion;
            }
            return round($price_tm);

          }

          else if ($checkin1 >= strtotime("2022-07-01") && $checkin1 <= strtotime("2022-07-31") && $checkout2 <= strtotime("2022-08-31")){

            if($numOfadults == 1){
              echo "here";
              $daysRemaining += 1;
              $july_calculation = ($place->price1/ $numOfDaysInMonth) * $daysRemaining;
              $august_calcualtion = $place->price1;
              $price_tm = $july_calculation + $august_calcualtion;
            }

            elseif($numOfadults == 2){
              $daysRemaining += 1;
              $july_calculation = ($place->price2/ $numOfDaysInMonth) * $daysRemaining;
              $august_calcualtion = $place->price2;
              $price_tm = $july_calculation + $august_calcualtion;
            }

            elseif($numOfadults == 3){
              $daysRemaining += 1;
              $july_calculation = ($place->price3/ $numOfDaysInMonth) * $daysRemaining;
              $august_calcualtion = $place->price3;
              $price_tm = $july_calculation + $august_calcualtion;
            }

            
            elseif($numOfadults == 4){
              $daysRemaining += 1;
              $july_calculation = ($place->price4/ $numOfDaysInMonth) * $daysRemaining;
              $august_calcualtion = $place->price4;
              $price_tm = $july_calculation + $august_calcualtion;
            }
            return round($price_tm);

          }


          // price without oct
      //     if($numOfadults == 1){
      //       $price_tm = (($place->price1/ $numOfDaysInMonth)*$daysRemaining);
      //       if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
      //         $price_tm += $place->price1;
      //       }
      //     }else if($numOfadults == 2){
      //       $price_tm = (($place->price2/ $numOfDaysInMonth)*$numofDaysoutOct);

      //       if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
      //         $price_tm += $place->price2;
      //       }
      //     }else if($numOfadults == 3){
      //       $price_tm = (($place->price3/ $numOfDaysInMonth)*$numofDaysoutOct);
      //       if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
      //         $price_tm += $place->price3;
      //       }
      //     }else{
      //       $price_tm = (($place->price4/ $numOfDaysInMonth)*$numofDaysoutOct);
      //       if(($monthCode == "08" || $monthCode2 == "08") || (intval($monthCode) > 8 && intval($monthCode2) < 8)){
      //         $price_tm += $place->price4;
      //       }
      //     }
      //   }

      // return round($price_tm);
      }
    }



    public function calculatePriceJuneOnly($place, $checkin, $checkout, $numOfadults){
      $numOfdays = date_diff(date_create($checkin), date_create($checkout));
      $numOfdays->d = $numOfdays->d+1;
      $price_tm = 0;
      if($numOfadults == 1){
        $price_tm = $this->adult1_price * $numOfdays->d;
      }else if($numOfadults == 2){
        $price_tm = $this->adult2_price * $numOfdays->d;
      }else if($numOfadults == 3){
        $price_tm = $this->adult3_price * $numOfdays->d;
      }else if($numOfadults == 4){
        $price_tm = $this->adult4_price * $numOfdays->d;
      }

      return $price_tm;
    }

    // for Monthly price calculation
    public function calculatePriceMonthly($place, $checkin, $checkout, $numOfadults){

      $numOfdays = date_diff(date_create($checkin), date_create($checkout));
      $numOfdays->d = $this->datediffcount($checkin, $checkout);
      $price_tm = 0;

      $julyFullOccupied = false;
      // check if full month covered in july
      if(strtotime($checkin)<= strtotime("2022-05-01") && strtotime($checkout) >= strtotime('2022-05-31')){
        // full month of july is occupied
        $julyFullOccupied = true;
        $numOfdays->d -= 1;
      }


      if($this->datediffcount("2022-05-31", $checkout) >= 1 && strtotime($checkout) > strtotime("2022-05-31")){

          $numofDaysoct = $this->datediffcount($checkin, "2022-05-31");
          $numofDaysoct2 = $this->datediffcount("2022-09-01", $checkout);
          $numofDaysoct6 = $this->datediffcount($checkin, $checkout);



          $numofDaysoutOct =  $numofDaysoct + $numofDaysoct6;
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
              // $price_tm += ($this->daily_fee * $numofDaysoutOct);
              $price_tm += $place->price1;
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
            // $price_tm += ($this->daily_fee * $numOfdays->d);
            $price_tm += $place->price1;
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


        // check for booking is according to server time
        $makestr = '+'.($set_admin->max_no_days)." day";
        $close_h = date('H', strtotime($set_admin->closing_time));
        $close_hBig = date('H', strtotime($set_admin->closing_time)+60*60);
        $close_m = date('i', strtotime($set_admin->closing_time));
        if((date('H')>=$close_h && date('i')>=$close_m) || (date('H')>=$close_hBig)){
          $today = date("Y-m-d H:i");
          $startday = date("Y-m-d", strtotime("+2 day"));
          $makestr = '+'.($set_admin->max_no_days+1)." day";
        }else{
          $today = date("Y-m-d H:i");
          $startday = date("Y-m-d", strtotime("+1 day"));
        }

        $endday = date("Y-m-d", strtotime($checkin.$makestr));
        if($startday<=$checkin && $endday>=$checkout){
          // not 404 error
          return true;

        }

        // $numOFdays = $this->datediffcount($checkin, $checkout);
        // if($numOFdays <= $set_admin->max_no_days){
        //   return true;
        // }

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

    public function checkWeekOrNot($checkin){
        $day = date('D', strtotime($checkin));
        if($day=="Mon"){
          return 0;
        }else if($day=="Tue"){
          return 0;
        }else if($day=="Wed"){
          return 0;
        }else if($day=="Thu"){
          return 0;
        }else if($day=="Fri"){
          return 0;
        }else if($day=="Sat"){
          return 1;
        }else if($day=="Sun"){
          return 1;
        }
        return 2;
    }
}
