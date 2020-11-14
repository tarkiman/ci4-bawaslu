<?php

/**
 *
 * @author Tarkiman | tarkiman@itasoft.co.id / tarkiman.zone@gmail.com 
 */

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{

    protected $table      = 'department';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'department_code', 'department_name', 'description'];

    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getData()
    {
        $this->select('
        id,
        department_code,
        department_name,
        description');
        $this->orderBy('department_name', 'ASC');
        $query = $this->get();
        $data = $query->getResult();
        if (isset($data)) {
            return $data;
        }
        return array();
    }

    public function getDataById($id)
    {
        $this->select('
        id,
        department_code,
        department_name,
        description');
        $this->orderBy('department_name', 'ASC');
        $this->where('id', $id);
        $query = $this->get();
        $data = $query->getRow();
        if (isset($data)) {
            return $data;
        }
        return array();
    }

    public function counterID()
    {
        try {
            $sql = "
            SELECT
            COUNT(id) + 1 AS counter
            FROM (
                SELECT
                a.id
                FROM section a 
                UNION 
                SELECT
                b.id
                FROM department b
                UNION 
                SELECT
                c.id
                FROM division c
                UNION 
                SELECT
                d.id
                FROM directorate d
            ) tmp";
            $query = $this->query($sql);
            $data = $query->getRow();
            if (isset($data)) {
                return $data->counter;
            }
            return 0;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
