OktaSDK-PHP
===========

[![Latest Stable Version](https://img.shields.io/packagist/v/dakkusingh/oktasdk.svg)](https://packagist.org/packages/dakkusingh/oktasdk)
[![Total Downloads](https://img.shields.io/packagist/dt/dakkusingh/oktasdk.svg)](https://packagist.org/packages/dakkusingh/oktasdk)
[![License](https://img.shields.io/packagist/l/dakkusingh/oktasdk.svg)](https://packagist.org/packages/dakkusingh/oktasdk)
[![Build Status](https://img.shields.io/travis/dakkusingh/oktasdk-php.svg)](https://travis-ci.org/dakkusingh/oktasdk-php)

PHP client library for the Okta API (v1)

Refer to the full [Okta API documentation](http://developer.okta.com/docs/api)
for more complete information on each resource/component.

Install with Composer
---------------------

```bash
composer require dakkusingh/oktasdk
```

Initializing the Client
-----------------------

To initialize the client object you must pass in your Okta organization
subdomain and API key as parameters. For example, if your Okta domain is
`https://foo.okta.com`, your org prefix is `foo`. For instructions on how to get
an API key for your organization, see
[Obtaining a token](http://developer.okta.com/docs/api/getting_started/getting_a_token.html).

#### Example:

```php
use Okta;

$okta = new Okta\Client('foo', 'api_key');
```

You may also optionally pass an array of config options as the third argument:

```php
$okta = new Okta\Client('foo', 'api_key', [
    'bootstrap' => false, // Don't auto-bootstrap the Okta resource properties
    'preview'   => true,  // Use the okta preview (oktapreview.com) domain
    'headers'   => [
        'Some-Header'    => 'Some value',
        'Another-Header' => 'Another value'
    ]
]);
```

Usage
-----

All Okta resources are available via the `$okta->$resource->$method` syntax
where `$resource` is the lower case, singular name of the resource (i.e. -
Users = `user`, Groups = `group`, etc.) and `$method` is the method name (see
the docs for all available methods). The only exception being the Authentication
resource for which the method name is `auth` (because `authentication` is just
too long).

#### Example:

```php
// Get a user by ID
$user = $okta->user->get('jpinkerton');

// Add user to a group
$group = $okta->group->addUser($someGroupId, $user->id);

// Get a user's apps
$userApps = $okta->user->apps($user->id);
```

Handling Exceptions
-------------------

```php
use Okta;

try {
    $user = $okta->user->get('jpinkerton');
} catch (Okta\Exception as $e) {
    return $e->getErrorSummary();
}
```

See documentation for available exception methods.

Contributing
------------

  1. Fork [the repository](https://github.com/dakkusingh/oktasdk-php)

  2. Clone your fork:

     ```bash
     git clone git@github.com:your-username/oktasdk-php.git
     # NOTE: Be sure to use your fork's repository URL
     ```

  3. In your local copy, create a branch:

     ```bash
     git checkout -b descriptive-branch-name'
     ```

  4. Make your changes

  5. Commit your changes:

     ```bash
     git commit -m "Your commit notes here"
     # NOTE: Be descriptive with your commit notes
     ```

  6. Push your branch:

     ```bash
     git push origin descriptive-branch-name
     ```

  7. [Open a Pull Request](https://github.com/dakkusingh/oktasdk-php/pull/new)
     on GitHub.


Copyright
---------

This project is liscensed under the [MIT License](https://github.com/dakkusingh/oktasdk-php/blob/master/LICENSE).
