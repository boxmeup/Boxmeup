<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<div class="dev-submenu well well-small" data-spy="affix" data-offset-top="100">
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="#auth"><?php echo __('Authentication') ?></a></li>
					<li><a href="#user"><?php echo __('User Resource') ?></a></li>
					<li><a href="#container"><?php echo __('Container Resource') ?></a></li>
					<li><a href="#container-item"><?php echo __('Container Item Resource') ?></a></li>
					<li><a href="#location"><?php echo __('Location Resource') ?></a></li>
				</ul>
			</div>
		</div>
		<div class="col-lg-9">
			<h2><?php echo __('API Documentation') ?></h2>
			<p><?php echo __('This document contains information about using Boxmeup\'s API.') ?></p>
			<br>
			<h3>Legal Notice</h3>
			<p>Boxmeup’s API is not to be used to duplicate the service. It is meant for integration with other services and software. API access can be denied at will.</p>
			<br>
			<h3 id="auth"><?php echo __('Authentication') ?></h4>
			<p>Boxmeup uses an form of <a href="http://en.wikipedia.org/wiki/OAuth">OAuth</a> to authenticate requests to various resources.</p>
			<p>See the <a href="#user">User Resource</a> section on how to acquire an authentication token.</p>
			<p>All requests to any API resource must have an authentication header that contains the authentication token provided by the user resource. This authentication header should look something like the following:</p>
			<pre>Authentication: BoxmeupAPI token=&lt;your token here&gt;</pre>
			<p>An example cURL request using the above header would look something like:</p>
			<pre>curl -H "Authentication: BoxmeupAPI token=28f98f0b91db02b8480b9d91ac6c7cd183731e4b" https://boxmeupapp.com/api/containers</pre>
			<p>This would validate your request with your OAuth token and provide a list of all your containers.</p>
			<br>
			<h3 id="user"><?php echo __('User Resource') ?></h4>
			<h4>&raquo; <code>POST /api/users/login</code></h4>
			<ul>
				<li>Acquire an OAuth token with provided credentials for an application.</li>
				<li>Parameters:
					<ul>
						<li><code>email</code><span class="label label-warning">Required</span> - Email address of an account.</li>
						<li><code>password</code><span class="label label-warning">Required</span> - Password of an account.</li>
						<li><code>application</code><span class="label label-warning">Required</span> - Application name to associate token.</li>
					</ul>
				</li>
				<li>Example:
					<pre>
curl -d "email=test@test.com&password=test1234&application=Test Application" https://boxmeupapp.com/api/users/login

{
	"token": "1cd2b6edc30afc5e0e8084c83601506de69f53a3"
}
					</pre>
				</li>
			</ul>
			<br>
			<h3 id="container"><?php echo __('Container Resource') ?></h3>
			<h4>&raquo; <code>GET /api/containers</code></h4>
			<ul>
				<li>Get a list of all containers.</li>
				<li>Parameters:
					<ul>
						<li><code>slug</code><span class="label label-info">Optional</span> - Slug of a container to retrieve a specific container.</li>
					</ul>
				</li>
				<li>Example:
					<pre>
curl -H "Authentication: BoxmeupAPI token=testtoken" https://boxmeupapp.com/api/containers

[
    {
        "Container": {
            "container_item_count": 1,
            "created": "2013-08-11 01:33:31",
            "modified": "2013-08-11 04:27:44",
            "name": "Test",
            "slug": "test",
            "uuid": "5206e9eb-8e8c-49b9-bced-087921210046"
        },
        "Location": {
            "name": null,
            "uuid": null
        }
    }
]
					</pre>
				</li>
			</ul>
			<br>
			<h4>&raquo; <code>POST /api/containers</code></h4>
			<ul>
				<li>Creates a new container.</li>
				<li>Parameters:
					<ul>
						<li><code>name</code><span class="label label-warning">Required</span> - Name of the new container.</li>
					</ul>
				</li>
				<li>Example:
					<pre>
curl -H "Authentication: BoxmeupAPI token=testtoken" -d "name=Test" https://boxmeupapp.com/api/containers

{
    "slug": "test-1",
    "uuid": "520713ad-1a50-4cce-a450-086421210046"
}
					</pre>
				</li>
			</ul>
			<br>
			<h4>&raquo; <code>PUT /api/containers/&lt;container-slug&gt;</code></h4>
			<ul>
				<li>Updates an existing container.</li>
				<li>Parameters:
					<ul>
						<li><code>name</code><span class="label label-warning">Required</span> - Rename the container to this name.</li>
					</ul>
				</li>
				<li>Example:
					<pre>
curl -X PUT -H "Authentication: BoxmeupAPI token=testtoken" -d "name=Test 2" https://boxmeupapp.com/api/containers/test-1

{
    "Container": {
        "container_item_count": 0,
        "created": "2013-08-11 04:31:41",
        "modified": "2013-08-11 04:31:41",
        "name": "Test 2",
        "slug": "test-1",
        "uuid": "520713ad-1a50-4cce-a450-086421210046"
    },
    "Location": {
        "name": null,
        "uuid": null
    }
}
					</pre>
				</li>
			</ul>
			<br>
			<h4>&raquo; <code>DELETE /api/containers/&lt;container-slug&gt;</code></h4>
			<ul>
				<li>Updates an existing container.</li>
				<li>Example:
					<pre>
curl -X DELETE -H "Authentication: BoxmeupAPI token=testtoken" https://boxmeupapp.com/api/containers/test-1

{
    "success": true
}
					</pre>
				</li>
			</ul>
			<br>
			<h4>&raquo; <code>GET /api/containers/search</code></h4>
			<ul>
				<li>Search containers for an item.</li>
				<li>Parameters:
					<ul>
						<li><code>query</code><span class="label label-warning">Required</span> - Search query.</li>
					</ul>
				</li>
				<li>Example:
					<pre>
curl -H "Authentication: BoxmeupAPI token=testtoken" https://boxmeupapp.com/api/containers/search?query=test

{
    "pages": 1,
    "search": [
        {
            "Container": {
                "container_item_count": "1",
                "created": "2013-08-11 01:33:31",
                "modified": "2013-08-11 04:27:44",
                "name": "Test",
                "slug": "test",
                "uuid": "5206e9eb-8e8c-49b9-bced-087921210046"
            },
            "ContainerItem": {
                "body": "test",
                "created": "2013-08-11 01:33:33",
                "modified": "2013-08-11 01:33:33",
                "quantity": "1",
                "uuid": "5206e9ed-45b4-46ce-a423-087921210046"
            }
        }
    ],
    "total": 1
}
					</pre>
				</li>
			</ul>
			<br>
			<h3 id="container-item"><?php echo __('Container Item Resource') ?></h3>
			<p>Not ready for release.</p>
			<h3 id="location"><?php echo __('Location Resource') ?></h3>
			<p>Not ready for release.</p>
		</div>
	</div>
</div>
