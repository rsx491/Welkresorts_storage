<?php

namespace Okta\Resource;

/**
 * Implementation of the Okta Groups resource, access via $okta->group
 *
 * http://developer.okta.com/docs/api/resources/groups.html
 */
class Group extends Base
{

    /**
     * Adds a new group with OKTA_GROUP type to your organization.
     *
     * @param  array $profile okta:user_group profile for a new group
     *
     * @return object         The created Group object
     */
    public function add(array $profile)
    {
        $request = $this->request->post('groups');

        $request->data(['profile' => $profile]);

        return $request->send();
    }

    /**
     * Fetches a specific group by id from your organization.
     *
     * @param  string $gid ID of a group
     *
     * @return object      Group object
     */
    public function get($gid)
    {
        $request = $this->request->get('groups/' . $gid);

        return $request->send();
    }

    /**
     * Enumerates groups in your organization with pagination. A subset of
     * groups can be returned that match a supported filter expression or query.
     *
     * @param  array $query Array of query parameters/values
     *
     * @return array        Array of Group objects
     */
    public function listGroups(array $query = null)
    {
        $request = $this->request->get('groups');

        if (isset($query)) $request->query($query);

        return $request->send();
    }

    /**
     * Updates the profile for a group with OKTA_GROUP type from your
     * organization. Only profiles for groups with OKTA_GROUP type can be
     * modified.
     *
     * @param  string $gid     ID of the group to update
     * @param  array  $profile Updated profile for the group
     *
     * @return object          Updated Group
     */
    public function update($gid, array $profile)
    {
        $request = $this->request->put('groups/' . $gid);

        $request->data(['profile' => $profile]);

        return $request->send();
    }

    /**
     * Removes a group with OKTA_GROUP type from your organization. Only groups
     * with OKTA_GROUP type can be removed.
     *
     * @param  string $gid ID of the group to delete
     *
     * @return object      Empty object
     */
    public function remove($gid)
    {
        $request = $this->request->delete('groups/' . $gid);

        return $request->send();
    }

    /**
     * Enumerates all users that are a member of a group.
     *
     * @param  string $gid   ID of the group
     * @param  int    $limit Specifies the number of user results in a page
     * @param  string $after Specifies the pagination cursor for the next page
     *                       of users
     *
     * @return array         Array of Users
     */
    public function listMembers($gid, $limit = null, $after = null)
    {
        $request = $this->request->get('groups/' . $gid . '/users');

        if (isset($limit)) $request->query(['limit' => $limit]);
        if (isset($after)) $request->query(['after' => $after]);

        return $request->send();
    }

    /**
     * Adds a user to a group with OKTA_GROUP type. Only memberships for groups
     * with OKTA_GROUP type can be modified.
     *
     * @param  string $gid ID of the group
     * @param  string $uid ID of the user
     *
     * @return object      Empty object
     */
    public function addUser($gid, $uid)
    {
        $request = $this->request->put('groups/' . $gid . '/users/' . $uid);

        return $request->send();
    }

    /**
     * Removes a user from a group with OKTA_GROUP type. Only memberships for
     * groups with OKTA_GROUP type can be modified.
     *
     * @param  string $gid ID of the group
     * @param  string $uid ID of the user
     *
     * @return object      Empty object
     */
    public function removeUser($gid, $uid)
    {
        $request = $this->request->delete('groups/' . $gid . '/users/' . $uid);

        return $request->send();
    }

    /**
     * Enumerates all applications that are assigned to a group. See Application
     * Group Operations
     *
     * @param  string $gid   ID of the group
     * @param  int    $limit Specifies the number of user results in a page
     * @param  string $after Specifies the pagination cursor for the next page
     *                       of users
     *
     * @return array         Array of Applications
     */
    public function listApps($gid, $limit = null, $after = null)
    {
        $request = $this->request->get('groups/' . $gid . '/apps');

        if (isset($limit)) $request->query(['limit' => $limit]);
        if (isset($after)) $request->query(['after' => $after]);

        return $request->send();
    }
}
