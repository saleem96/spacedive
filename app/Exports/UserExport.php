<?php
namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    use Exportable;
    protected $plan_id = 0;

    function __construct($id) {
        $this->plan_id = $id;
    }
    public function collection()
    {
        $plan = $this->plan_id;
        return User::selectRaw('concat(fname," ",lname) as name,email')->when($plan,function ($q) use ($plan) {
            return $q->where('plan_id',$plan);
        })->where('is_admin',0)->get();
    }
    public function headings(): array
    {
        return [
            'Full Name',
            'Email',
        ];
    }
}
