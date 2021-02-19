<?php

namespace App\Models;

use App\Models\Personaldatastudent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'registrations';
    protected $guarded = [];
    protected $primaryKey  = 'idRegistration';
    public function personal()
    {
        return $this->belongsTo(Personaldatastudent::class, 'idSF', 'idRegistration');
    }
    public function supervisors()
    {
        return $this->belongsToMany(Supervisor::class, 'registerationsupervisors', 'idRegistrationF', 'idSupervisorF');
    }
    public function refress()
    {
        return $this->belongsToMany(Referee::class, 'reports', 'idRegistrationF', 'idRefereedF');
    }
}
