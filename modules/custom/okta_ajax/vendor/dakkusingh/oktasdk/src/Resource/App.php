<?php

namespace Okta\Resource;

/**
 * Implementation of the Okta Apps resource, access via $okta->app
 *
 * http://developer.okta.com/docs/api/resources/apps.html
 */
class App extends Base
{
    /**
     * Adds a new application to your Okta organization.
     *
     * @param  string $name       Application name
     * @param  string $label      Application label
     * @param  string $signOnMode Application sign on mode
     * @param  array  $settings   Associative array of application settings
     * @param  bool   $activate   If true, executes activation lifecycle
     *                            operation when creating the application
     *
     * @return object             Application object
     */
    public function add($name, $label, $signOnMode, array $settings = null, $activate = null)
    {
        $request = $this->request->post('apps');

        $request->data([
            'name'       => $name,
            'label'      => $label,
            'signOnMode' => $signOnMode,
        ]);

        if (isset($settings)) $request->data(['settings' => ['app' => $settings]]);
        if (isset($activate)) $request->query(['activate' => $activate]);

        return $request->send();
    }

    /**
     * Fetches an application from your Okta organization by id.
     *
     * @param  string $aid Application ID
     *
     * @return object      Application object
     */
    public function get($aid)
    {
        $request = $this->request->get('apps/' . $aid);

        return $request->send();
    }

    /**
     * Enumerates apps added to your organization with pagination. A subset of
     * apps can be returned that match a supported filter expression or query.
     *
     * @param  array $query Array of query parameters/values
     *
     * @return array        Array of Application objects
     */
    public function listApps(array $query = null)
    {
        $request = $this->request->get('apps');

        if (isset($query)) $request->query($query);

        return $request->send();
    }

    /**
     * Updates an application in your organization.
     *
     * @param  string $aid ID of application to update
     * @param  array  $app Associative array of updated application data
     *
     * @return object      Application object
     */
    public function update($aid, array $app)
    {
        $request = $this->request->put('apps/' . $aid);

        $request->data($app);

        return $request->send();
    }

    /**
     * Removes an inactive application. Applications must be deactivated before
     * they can be deleted.
     *
     * @param  string $aid ID of application to delete
     *
     * @return object      An empty JSON object {}
     */
    public function delete($aid)
    {
        $request = $this->request->delete('apps/' . $aid);

        return $request->send();
    }

    /**
     * Activates an inactive application.
     *
     * @param  string $aid ID of application to activate
     *
     * @return object      An empty JSON object {}
     */
    public function activate($aid)
    {
        $request = $this->request->post('apps/' . $aid . '/lifecycle/activate');

        return $request->send();
    }

    /**
     * Deactivates an inactive application.
     *
     * @param  string $aid ID of application to deactivate
     *
     * @return object      An empty JSON object {}
     */
    public function deactivate($aid)
    {
        $request = $this->request->post('apps/' . $aid . '/lifecycle/deactivate');

        return $request->send();
    }

    /**
     * Assigns an user to an application.
     *
     * @param  string $aid     Unique key of Application
     * @param  array  $appuser Array of user credentials and (optional) profile
     *                         for the app
     *
     * @return object          Application User object
     */
    public function assignUser($aid, array $appuser)
    {
        $request = $this->request->post('apps/' . $aid . '/users');

        $request->data($appuser);

        return $request->send();
    }

    /**
     * Fetches a specific user assignment for application by ID.
     *
     * @param  string $aid Unique key of Application
     * @param  string $uid Unique key of assigned User
     *
     * @return object      Application User
     */
    public function getUser($aid, $uid)
    {
        $request = $this->request->get('apps/' . $aid . '/users/' . $uid);

        return $request->send();
    }

    /**
     * Enumerates all assigned application users for an application.
     *
     * @param  string $aid   Unique key of Application
     * @param  int    $limit Specifies the number of results for a page
     * @param  string $after Specifies the pagination cursor for the next page
     *                       of assignments
     *
     * @return array        Array of Application Users
     */
    public function listUsers($aid, $limit = null, $after = null)
    {
        $request = $this->request->get('apps/' . $aid . '/users');

        if (isset($limit)) $request->query(['limit' => $limit]);
        if (isset($after)) $request->query(['after' => $after]);

        return $request->send();
    }

    /**
     * Updates a user's credentials and/or profile for an assigned application
     *
     * @param  string $aid     Unique key of Application
     * @param  string $uid     Unique key of assigned User
     * @param  array  $appuser Array of user credentials and (optional) profile
     *                         for the app
     *
     * @return object          Application User
     */
    public function updateUser($aid, $uid, array $appuser)
    {
        $request = $this->request->post('apps/' . $aid . '/users/' . $uid);

        $request->data($appuser);

        return $request->send();
    }

    /**
     * Removes an assignment for a user from an application.
     *
     * This is a destructive operation and the user's app profile will not be
     * recoverable. If the app is enabled for provisioning and configured to
     * deactivate users, the user will also be deactivated in the target
     * application.
     *
     * @param  string $aid Unique key of Application
     * @param  string $uid Unique key of assigned User
     *
     * @return object      An empty object
     */
    public function removeUser($aid, $uid)
    {
        $request = $this->request->delete('apps/' . $aid . '/users/' . $uid);

        return $request->send();
    }

    /**
     * Assigns a group to an application
     *
     * @param  string $aid      Unique key of Application
     * @param  string $gid      Unique key of a valid Group
     * @param  array  $appgroup App group
     *
     * @return object           The assigned Application Group
     */
    public function assignGroup($aid, $gid, array $appgroup)
    {
        $request = $this->request->put('apps/' . $aid . '/groups/' . $gid);

        $request->data($appgroup);

        return $request->send();
    }

    /**
     * Fetches an application group assignment
     *
     * @param  string $aid Unique key of Application
     * @param  string $gid Unique key of a valid Group
     *
     * @return object      Application Group
     */
    public function getGroup($aid, $gid)
    {
        $request = $this->request->get('apps/' . $aid . '/groups/' . $gid);

        return $request->send();
    }

    /**
     * Enumerates group assignments for an application.
     *
     * @param  string $aid Unique key of Application
     *
     * @return array       Array of Application Groups
     */
    public function listGroups($aid)
    {
        $request = $this->request->get('apps/' . $aid . '/groups');

        return $request->send();
    }

    /**
     * Removes a group assignment from an application.
     *
     * @param  string $aid Unique key of Application
     * @param  string $gid Unique key of a valid Group
     *
     * @return object      An empty JSON object {}
     */
    public function removeGroup($aid, $gid)
    {
        $request = $this->request->delete('apps/' . $aid . '/groups/' . $gid);

        return $request->send();
    }

    /**
     * Generates a new X.509 certificate for an application key credential
     *
     * @param  string $aid           Unique key of Application
     * @param  int    $validityYears Expiry of the Application Key Credential
     *
     * @return object                The generated Application Key Credential
     */
    public function generateKey($aid, $validityYears)
    {
        $request = $this->request->post('apps/' . $aid . '/credentials/keys/generate');

        $request->query(['validityYears' => $validityYears]);

        return $request->send();
    }

    /**
     * Enumerates key credentials for an application
     *
     * @param  string $aid Unique key of Application
     *
     * @return array       Array of Application Key Credentials
     */
    public function listKeys($aid)
    {
        $request = $this->request->get('apps/' . $aid . '/credentials/keys');

        return $request->send();
    }

    /**
     * Gets a specific application key credential by kid
     *
     * @param  string $aid Unique key of Application
     * @param  string $kid Unique key of Application Key Credential
     *
     * @return object      Application Key Credential
     */
    public function getKey($aid, $kid)
    {
        $request = $this->request->get('apps/' . $aid . '/credentials/keys/' . $kid);

        return $request->send();
    }

    /**
     * Preview SAML metadata based on a specific key credential for an
     * application
     *
     * @param  string $aid Unique key of Application
     * @param  string $kid Unique key of Application Key Credential
     *
     * @return string      SAML metadata in XML
     */
    public function getSaml($aid, $kid)
    {
        $request = $this->request->get('apps/' . $aid . '/sso/saml/metadata');

        $request->query(['kid' => $kid]);

        return $request->send();
    }
}
