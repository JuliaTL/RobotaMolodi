<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Session;

class Vacancy extends Model {


    protected $table = 'vacancies';
    protected $fillable = ['id','position','company_id','branch','organisation', 'date_field', 'salary','city', 'description','user_email'];

//Read and return company
    public function ReadCompany()
    {
        $company = $this->belongsTo('App\Models\Company','company_id')->first();

        return $company;
    }

//Fill and return vacancy Model
    public function fillVacancy($id,$request)
    {


        $position = $request['Position'];
        $branch = $request['branch'];
        $salary = $request['Salary'];
        $description = $request['Description'];
        $userEmail = $request['user_email'];
        $companyId = $request['Organisation'];

        if($id!=0)
		{
			$vacancy = Vacancy::find($id);
        }
        else
        {
            $vacancy = new Vacancy();
        }

        $vacancy->position = $position;
        $vacancy->branch = $branch;
        $vacancy->salary = $salary;
        $vacancy->description = $description;
        $vacancy->company_id = $companyId;
        $vacancy->user_email = $userEmail;
        return $vacancy;
    }
	//
//Read and return user through company
    public function ReadUser($id)
    {
        $vacancy = Vacancy::find($id);
        $comp = $vacancy->ReadCompany();
        $user = $comp->ReadUser();
        return $user;
    }

    public function Cities()
    {
        return $this->belongsToMany('App\Models\City','vacancy_city')->get();
    }

    public function scopeCompany()
    {
        return Vacancy::ReadCompany();
    }

}
