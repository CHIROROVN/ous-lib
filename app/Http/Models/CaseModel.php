<?php 
namespace App\Http\Models;
use DB;
use Validator;

class CaseModel {   

    protected $table = 'm_cases';
    protected $primaryKey   = 'case_id';

   public function Rules()
    {
        return array(
            'project_title'                      => 'required',
        );
    }

    public function Messages()
    {
        return array(
            'project_title.required'             => trans('validation.error_project_title_required'),
           
        );
    }

    public function get_all($case_state=null,$sort_order=0)
    {

        $results = DB::table($this->table)->where('last_kind', '<>', DELETE);
        if((int)$case_state >0){
          $results = ($case_state !=5)?$results->where('case_state', '=',$case_state):$results->whereIn('case_state', array(2, 3));
        }

        $results = ($sort_order==0)?$results->orderBy('delivery_date', 'ASC'):$results->orderBy('delivery_date', 'DESC');
        //$results = $results->paginate(LIMIT_PAGE);
        $results = $results->get();
        return  $results;
    }    

    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    public function update($id, $data)
    {
        return DB::table($this->table)->where('case_id', $id)->update($data);
    }

    public function get_by_id($id)
    {
        return DB::table($this->table)->where('case_id', $id)->first();
    }

    

}
