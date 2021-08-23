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
        $numOfdays->d = $numOfdays->d+1;
        $price_tm = 0;
        $AllPrices = SettingAdmin::orderBy('id')->get();
          for($counter=1; $counter<=$numOfdays->d; $counter++){
            //MayAndJune
            if(strtotime($checkin)>=strtotime($AllPrices[0]->season_start) && strtotime($checkin)<=strtotime('2021-06-30')){
              if(SettingAdmin::checkWeekOrNot($checkin) == 0){
                if($numOfadults == 1){
                    $price_tm += $AllPrices[0]->adult1_price;
                  }else if($numOfadults == 2){
                    $price_tm += $AllPrices[0]->adult2_price;
                  }else if($numOfadults == 3){
                    $price_tm += $AllPrices[0]->adult3_price;
                  }else if($numOfadults == 4){
                    $price_tm += $AllPrices[0]->adult4_price;
                }
                }else{
                  if($numOfadults == 1){
                    $price_tm += $AllPrices[0]->adult1_price_weekend;
                  }else if($numOfadults == 2){
                    $price_tm += $AllPrices[0]->adult2_price_weekend;
                  }else if($numOfadults == 3){
                    $price_tm += $AllPrices[0]->adult3_price_weekend;
                  }else if($numOfadults == 4){
                    $price_tm += $AllPrices[0]->adult4_price_weekend;
                }
              }
             //July
            }else if(strtotime($checkin)>=strtotime($AllPrices[1]->season_start) && strtotime($checkin)<=strtotime($AllPrices[1]->season_end)){
              if(SettingAdmin::checkWeekOrNot($checkin) == 0){
                if($numOfadults == 1){
                      $price_tm += $AllPrices[1]->adult1_price;
                    }else if($numOfadults == 2){
                      $price_tm += $AllPrices[1]->adult2_price;
                    }else if($numOfadults == 3){
                      $price_tm += $AllPrices[1]->adult3_price;
                    }else if($numOfadults == 4){
                      $price_tm += $AllPrices[1]->adult4_price;
                    }
                }else{
                    if($numOfadults == 1){
                      $price_tm += $AllPrices[1]->adult1_price_weekend;
                    }else if($numOfadults == 2){
                      $price_tm += $AllPrices[1]->adult2_price_weekend;
                    }else if($numOfadults == 3){
                      $price_tm += $AllPrices[1]->adult3_price_weekend;
                    }else if($numOfadults == 4){
                      $price_tm += $AllPrices[1]->adult4_price_weekend;
                    }
                }
                //August
            }else if(strtotime($checkin)>=strtotime($AllPrices[2]->season_start) && strtotime($checkin)<=strtotime($AllPrices[2]->season_end)){
                if(SettingAdmin::checkWeekOrNot($checkin) == 0){
                    if($numOfadults == 1){
                      $price_tm += $AllPrices[2]->adult1_price;
                    }else if($numOfadults == 2){
                      $price_tm += $AllPrices[2]->adult2_price;
                    }else if($numOfadults == 3){
                      $price_tm += $AllPrices[2]->adult3_price;
                    }else if($numOfadults == 4){
                      $price_tm += $AllPrices[2]->adult4_price;
                  }
                }else{
                    if($numOfadults == 1){
                      $price_tm += $AllPrices[2]->adult1_price_weekend;
                    }else if($numOfadults == 2){
                      $price_tm += $AllPrices[2]->adult2_price_weekend;
                    }else if($numOfadults == 3){
                      $price_tm += $AllPrices[2]->adult3_price_weekend;
                    }else if($numOfadults == 4){
                      $price_tm += $AllPrices[2]->adult4_price_weekend;
                  }
               }
               //September
            }else if(strtotime($checkin)>=strtotime($AllPrices[3]->season_start) && strtotime($checkin)<=strtotime($AllPrices[3]->season_end)){
                    if(SettingAdmin::checkWeekOrNot($checkin) == 0){
                      if($numOfadults == 1){
                          $price_tm += $AllPrices[3]->adult1_price;
                      }else if($numOfadults == 2){
                          $price_tm += $AllPrices[3]->adult2_price;
                      }else if($numOfadults == 3){
                          $price_tm += $AllPrices[3]->adult3_price;
                      }else if($numOfadults == 4){
                          $price_tm += $AllPrices[3]->adult4_price;
                      }
                    }else{
                        if($numOfadults == 1){
                          $price_tm += $AllPrices[3]->adult1_price_weekend;
                        }else if($numOfadults == 2){
                          $price_tm += $AllPrices[3]->adult2_price_weekend;
                        }else if($numOfadults == 3){
                          $price_tm += $AllPrices[3]->adult3_price_weekend;
                        }else if($numOfadults == 4){
                          $price_tm += $AllPrices[3]->adult4_price_weekend;
                      }
                   }
                }
            $nextday = date('Y-m-d', strtotime("+1 day", strtotime($checkin)));
            $checkin = $nextday;
         }
         return $price_tm;
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
