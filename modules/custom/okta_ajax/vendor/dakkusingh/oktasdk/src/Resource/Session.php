<?php

namespace Okta\Resource;

/**
 * Implementation of the Okta Sessions resource, access via $okta->session
 *
 * http://developer.okta.com/docs/api/resources/sessions.html
 */
class Session extends Base
{
    /**
     * Creates a new session for a user with a valid session token. Only use
     * this operation if you need the session id, otherwise you should use one
     * of the following flows to obtain a SSO session with a sessionToken
     *
     * @param  string $sessionToken     Session token obtained via
     *                                  Authentication API
     * @param  string $additionalFields Comma separated string of optional
     *                                  session properties
     *
     * @return object                   The new Session for the user if the
     *                                  sessionToken was valid. Invalid
     *                                  sessionToken will return a 401
     *                                  Unauthorized status code.
     */
    public function create($sessionToken, $additionalFields = null)
    {
        $request = $this->request->post('sessions');

        $request->data(['sessionToken' => $sessionToken]);

        if (isset($additionalFields)) $request->query(['additionalFields' => $additionalFields]);

        return $request->send();
    }

    /**
     * Extends the lifetime of a user's session.
     *
     * @param  string $id ID of a valid session
     * @return empty      Invalid sessions will return a 404 Not Found status
     *                    code.
     */
    public function extend($id)
    {
        $request = $this->request->put('sessions/' . $id);

        return $request->send();
    }

    /**
     * Closes a user's session (logout).
     *
     * @param  string $id ID of a valid session
     *
     * @return empty      Invalid sessions will return a 404 Not Found status
     *                    code.
     */
    public function close($id)
    {
        $request = $this->request->delete('sessions/' . $id);

        return $request->send();
    }
}
