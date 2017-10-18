<?php namespace App\Models;

use App\Models\Enums\StaffAssignmentStat;
use App\Models\Services\TicketService;
use Carbon\Carbon;
use Eloquent, DB, Validator, Log;

class TicketOtp extends Eloquent
{
  public $table = 'ticket_otp';
  protected $primaryKey = 'ticket_otp_id';
  protected $validation;
  public $timestamps = false;

  public function enterOtp($ticket_otp_id, $type, $otp, $username = 'admin') {
    $ticket_otp = DB::table('ticket_otp')
      ->where('ticket_otp_id', $ticket_otp_id)
      ->first();
    if ($ticket_otp == null) {
      return false;
    }
    
    if ($type == 'first') {
      $valid_otp = $ticket_otp->first_otp == $otp;
    } else {
      $valid_otp = $ticket_otp->second_otp == $otp;
    }
    
    if ($valid_otp) {
      $ticket_id = DB::table('ticket_otp')->where('ticket_otp_id', $ticket_otp_id)->value('ticket_id');
      if ($type == 'first') {
        DB::table('ticket_otp')
          ->where('ticket_otp_id', $ticket_otp_id)
          ->update(['first_entered_on'=>Carbon::now()]);
        $this->staffAttendTicket($ticket_id );
        
      } else if ($type == 'second') {
        DB::table('ticket_otp')
          ->where('ticket_otp_id', $ticket_otp_id)
          ->update(['second_entered_on'=>Carbon::now()]);
        
        $ticket_service = new TicketService();
        $ticket_service->completeTicket($ticket_id, $username);
      }
    }
    return $valid_otp;
  }
  
  private function staffAttendTicket($ticket_id) {
    DB::table('staff_assignment')->where('ticket_id', $ticket_id)->update([
      'stat'=>StaffAssignmentStat::Attended
    ]);
  }
  
  public function getValidation() {
    return $this->validation;
  }
}