<?php

namespace Okta\Resource;

/**
 * Implementation of the Okta Roles resource, access via $okta->role
 *
 * http://developer.okta.com/docs/api/resources/roles.html
 */
class Role extends Base
{
    /**
     * Lists all roles assigned to a user.
     *
     * @param  string $uid ID of user
     *
     * @return array       Array of Roles
     */
    public function listRoles($uid)
    {
        $request = $this->request->get('users/' . $uid . '/roles');

        return $request->send();
    }

    /**
     * Assigns a role to a user.
     *
     * @param  string $uid  ID of user
     * @param  string $type Type of role to assign
     *
     * @return object       Assigned Role
     */
    public function assignRole($uid, $type)
    {
        $request = $this->request->post('users/' . $uid . '/roles');

        $request->data(['type' => $type]);

        return $request->send();
    }

    /**
     * Unassigns a role from a user.
     *
     * @param  string $uid  ID of user
     * @param  string $rid  ID of role
     *
     * @return empty        HTTP/1.1 204 No Content
     */
    public function unassignRole($uid, $rid)
    {
        $request = $this->request->delete('users/' . $uid . '/roles/' . $rid);

        return $request->send();
    }

    /**
     * Lists all group targets for a USER_ADMIN role assignment.
     *
     * @param  string $uid   ID of user
     * @param  string $rid   ID of role
     * @param  int    $limit Number of results for a page
     * @param  string $after Specifies the pagination cursor for the next page
     *                       of targets
     *
     * @return array         Array of Groups
     */
    public function listUserAdminGroupTargets($uid, $rid, $limit = null, $after = null)
    {
        $request = $this->request->get('users/' . $uid . '/roles/' . $rid . '/targets/groups');

        if (isset($limit)) $request->query(['limit' => $limit]);
        if (isset($after)) $request->query(['after' => $after]);

        return $request->send();
    }

    /**
     * Lists all app targets for an APP_ADMIN role assignment.
     *
     * @param  string $uid   ID of user
     * @param  string $rid   ID of role
     * @param  int    $limit Number of results for a page
     * @param  string $after Specifies the pagination cursor for the next page
     *                       of targets
     *
     * @return array         Array of Catalog Apps
     */
    public function listAppAdminAppTargets($uid, $rid, $limit = null, $after = null)
    {
        $request = $this->request->get('users/' . $uid . '/roles/' . $rid . '/targets/catalog/apps');

        if (isset($limit)) $request->query(['limit' => $limit]);
        if (isset($after)) $request->query(['after' => $after]);

        return $request->send();
    }
}
