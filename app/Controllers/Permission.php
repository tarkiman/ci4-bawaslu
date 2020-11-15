<?php

/**
 *
 * @author Tarkiman | tarkiman@itasoft.co.id / tarkiman.zone@gmail.com 
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermissionModel;
use App\Models\GroupModel;
use App\Models\GroupPermissionModel;
use App\Models\AuthModel;

class Permission extends BaseController
{
    protected $PermissionModel;
    protected $groupModel;
    protected $groupPermissionModel;
    protected $authModel;

    public function __construct()
    {
        $this->permissionModel = new PermissionModel();
        $this->groupModel = new GroupModel();
        $this->groupPermissionModel = new GroupPermissionModel();
    }

    public function index()
    {
        $data = [
            'title' => 'List of Permissions',
            'active' => 'permission',
            'data' => null
        ];

        return view('permission/index', $data);
    }

    public function datatables()
    {
        $table =
            "
            (
                SELECT 
                a.id,
                a.name,
                a.uri
                FROM permissions a
                WHERE a.deleted_at IS NULL
                ORDER BY a.uri ASC
            ) temp
            ";

        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'name', 'dt' => 1),
            array('db' => 'uri', 'dt' => 2),
            array(
                'db'        => 'id',
                'dt'        => 3,
                'formatter' => function ($i, $row) {
                    $html = '
                    <center>
                    ' . link_detail('permission/detail', $i) . '
                    ' . link_edit('permission/edit', $i) . '
                    ' . link_delete('permission/delete', $i) . '
                    </center>';
                    return $html;
                }
            ),
        );

        $primaryKey = 'id';

        $condition = null;

        tarkiman_datatables($table, $columns, $condition, $primaryKey);
    }

    public function create()
    {
        $groups_options = array();
        $groups = $this->groupModel->getData();
        foreach ($groups as $r) {
            $groups_options[$r->id] = $r->name;
        }

        $data = [
            'title' => 'Create New Permission',
            'active' => 'user',
            'groups_options' => $groups_options,
            'validation' => \Config\Services::validation()
        ];
        return view('permission/create', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[permissions.name]',
                'errors' => [
                    // 'required' => '{field} harus diisi.',
                    // 'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'uri' => [
                'rules' => 'required|is_unique[permissions.uri]',
                'errors' => [
                    // 'required' => '{field} harus diisi.',
                    // 'is_unique' => '{field} sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('/permission/create')->withInput();
        }

        try {
            $db      = \Config\Database::connect();

            $db->transStart();

            $idPermission = get_uuid();


            $this->permissionModel->insert([
                'id' => $idPermission,
                'name' => $this->request->getVar('name'),
                'uri' => $this->request->getVar('uri')
            ]);

            /*Insert data baru ke table GROUP_PERMISSIONS berdasarkan ID_GROUP */
            if ($this->request->getVar('groups[]')) {
                foreach ($this->request->getVar('groups[]') as $r) {
                    $groupPermissionsData[] = array(
                        'id' => get_uuid(),
                        'id_group' => $r,
                        'id_permission' => $idPermission
                    );
                }
                $this->groupPermissionModel->insertBatch($groupPermissionsData);
            }

            $db->transComplete();
            if ($db->transStatus() === FALSE) {
                return redirect()->to('/permission/create')->withInput();
            } else {
                session()->setFlashData('messages', 'new data added successfully');

                /*update session USER_PERMISSIONS*/
                $this->authModel = new AuthModel();
                session()->set('user_permissions', $this->authModel->getUserPermissions(session()->get('id_user')));
            }
        } catch (\Exception $e) {
            return redirect()->to('/permission/create')->withInput()->with('messages', $e->getMessage());
        }

        return redirect()->to('/permission');
    }

    public function edit($id)
    {
        $groups = $this->groupModel->getData();
        foreach ($groups as $r) {
            $groups_options[$r->id] = $r->name;
        }

        $data = [
            'title' => 'Edit Permission',
            'active' => 'permission',
            'data' => $this->permissionModel->getDataById($id),
            'groups_options' => $groups_options,
            'groups_selected' => $this->groupPermissionModel->getGroupsSelectedByIdPermission($id),
            'validation' => \Config\Services::validation()
        ];
        return view('permission/edit', $data);
    }

    public function update($id)
    {

        $validation = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    // 'required' => '{field} harus diisi.'
                ]
            ],
            'uri' => [
                'rules' => 'required',
                'errors' => [
                    // 'required' => '{field} harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($validation)) {
            return redirect()->to('/permission/edit/' . $id)->withInput()->with('messages', 'Validation Error');
        } else {

            try {
                $db      = \Config\Database::connect();

                $db->transStart();

                $data = [
                    'id' => $id,
                    'name' => $this->request->getVar('name'),
                    'uri' => $this->request->getVar('uri')
                ];

                /*Update data ke table PERMISSIONS berdasarkan ID */
                $this->permissionModel->save($data);

                /*Delete data lama di table GROUP_PERMISSIONS berdasarkan ID_PERMISSION */
                $this->groupPermissionModel->where('id_permission', $id);
                $this->groupPermissionModel->delete();

                /*Insert data baru ke table GROUP_PERMISSIONS berdasarkan ID_PERMISSION */
                if ($this->request->getVar('groups[]')) {
                    foreach ($this->request->getVar('groups[]') as $r) {
                        $groupPermissionsData[] = array(
                            'id' => get_uuid(),
                            'id_group' => $r,
                            'id_permission' => $id
                        );
                    }
                    $this->groupPermissionModel->insertBatch($groupPermissionsData);
                }

                $db->transComplete();
                if ($db->transStatus() === FALSE) {
                    return redirect()->to('/permission/edit/' . $id)->withInput();
                } else {

                    session()->setFlashData('messages', 'Data was successfully updated');

                    /*update session USER_PERMISSIONS*/
                    $this->authModel = new AuthModel();
                    session()->set('user_permissions', $this->authModel->getUserPermissions(session()->get('id_user')));
                }
            } catch (\Exception $e) {
                return redirect()->to('/permission/edit/' . $id)->withInput()->with('messages', $e->getMessage());
            }

            return redirect()->to('/permission');
        }
    }

    public function detail($id)
    {
        $groups = $this->groupModel->getData();
        foreach ($groups as $r) {
            $groups_options[$r->id] = $r->name;
        }

        $data = [
            'title' => 'Detail Permission',
            'active' => 'permission',
            'data' => $this->permissionModel->getDataById($id),
            'groups_options' => $groups_options,
            'groups_selected' => $this->groupPermissionModel->getGroupsSelectedByIdPermission($id),
            'validation' => \Config\Services::validation()
        ];

        if (empty($data['data'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Permission Data ' . $id . ' is not found.');
        }
        return view('permission/detail', $data);
    }

    public function delete($id)
    {
        try {
            $db      = \Config\Database::connect();

            $db->transStart();

            $this->groupPermissionModel->where('id_permission', $id);
            $this->groupPermissionModel->delete();

            $this->permissionModel->delete($id);
            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                return redirect()->to('/permission')->with('messages', 'failed delete data');
            } else {

                session()->setFlashData('messages', 'Data was successfully deleted');

                /*update session USER_PERMISSIONS*/
                $this->authModel = new AuthModel();
                session()->set('user_permissions', $this->authModel->getUserPermissions(session()->get('id_user')));
            }
        } catch (\Exception $e) {
            return redirect()->to('/permission')->with('messages', $e->getMessage());
        }

        return redirect()->to('/permission');
    }
}