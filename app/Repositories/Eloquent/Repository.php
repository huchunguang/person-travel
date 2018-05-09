<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class Repository implements RepositoryInterface
{

	private $app;
	protected $model;
	public function __construct(App $app)
	{
		$this->app=$app;
		$this->makeModel();
	}
	
	abstract function model();
	public function all($columns = array('*')) 
	{
		return $this->model->get($columns);
	}
	
	public function paginate($columns=array('*')) 
	{
		return $this->model->paginate(PAGE_SIZE,$columns);
	}
	public function create(array $data) 
	{
		return $this->model->create($data);
	}
	public function update(array $data,$id,$attribute='id') 
	{
		return $this->model->where($attribute,'=',$id)->update($data);
	}
	public function delete($id) 
	{
		return $this->model->destory($id);
	}
	public function find($id,$columns=array('*')) 
	{
		return $this->model->find($id,$columns);
	}
	public function findBy($attribute,$id,$columns=array('*'))
	{
		return $this->where($attribute,'=',$id)->first($columns);
	}
	
	public function makeModel() 
	{
		$model=$this->app->make($this->model());
// 		dd($model);
		if (!$model instanceof Model)
		{
			throw new \Exception("Class {$this->model} does't existed");
		}
		return $this->model=$model->newQuery();
	}
}

