<div class="modal" id="bookingStopedModal">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Avviso</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <div class="text-sm-center" style="font-size:16px;">
          @isset($maparray['err_msg3'])
            @php
              $maparray["set_admin"]->max_no_days = -1;
            @endphp
            <span id="errormsg_txt1" style="color:Blue;">Booking Start- {{ date("d/m/Y, g:i A", strtotime($maparray["set_admin"]->booking_start)) }}</span><br>
            <span id="errormsg_txt1" style="color:Blue;">Booking End- {{ date("d/m/Y, g:i A", strtotime($maparray["set_admin"]->booking_end)) }}</span>
          @endisset
          <br>
          <br>
        </div>

        <div class="alert alert-danger" role="alert">
          Torneremo disponibili all'apertura dello stabilimento!
        </div>

         <a class="btn btn-info float-right" data-dismiss="modal">Close</a>
       </div>

    </div>
  </div>
</div>
