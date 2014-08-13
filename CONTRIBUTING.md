# How to contribute

This guide outlines the procedure for all contributions, such as reporting bugs or submitting code patches.
Please read and follow the contributions guidelines or your contribution may take longer to resolved (or be rejected outright).

## Reporting issues

* This project uses a kanban board called [Huboard](https://huboard.com/boxmeup/Boxmeup#/).
* Look through these tickets and ensure your issue hasn't been reported before.
* Label your issue appropriately (if it is a bug, label with `bug`, etc).
* Do not move items from the backlog, project maintainers have a procedure for organizing when and in what version branch
an issue will be worked.

## Making Changes

* Create a topic branch from where you want to base your work.
  * This is usually the master branch.
  * Only target release branches if you are certain your fix must be on that
    branch.
  * To quickly create a topic branch based on master; `git checkout -b
    my_contribution master`. Please avoid working directly on the
    `master` branch.
* Make commits of logical units.
* Check for unnecessary whitespace with `git diff --check` before committing.
* Be sure to fix any codesniffer warning the pre-commit hook blocks. Do not use `git commit -n`.
* Make sure you have added the necessary tests for your changes (if applicable).
* Run _all_ the tests to assure nothing else was accidentally broken.
* Fix any issues that may be reported by travis CI.
* If the change fixes an open issue, reference the issue in the pull request.

## Reporting Security Issues

Please send an email containing the details of the security issue and steps to reproduce to the email address listed on
the [organization page](https://github.com/boxmeup).

* DO NOT open an issue ticket for any potential security issues.
* The core team will open an issue detailing post-mordem of the security issue once it has been patched and deployed to production.

## Submitting Changes

* Push your changes to a topic branch in your fork of the repository.
* Submit a pull request to the repository in the boxmeup organization.
* After feedback has been given we expect responses within two weeks. After two
  weeks, we may close the pull request if it isn't showing any activity.

## Core Library Dependency

Boxmeup has a [core library](https://github.com/boxmeup/boxmeup-core) that handles most of the domain logic
and database manipulation. Please do not open issues in this repository, they should be handled in [Huboard](https://huboard.com/boxmeup/Boxmeup#/).

# Additional Resources

* [Bug tracker (Huboard)](https://huboard.com/boxmeup/Boxmeup#/)
* [General GitHub documentation](http://help.github.com/)
* [GitHub pull request documentation](http://help.github.com/send-pull-requests/)
* [Core boxmeup library](https://github.com/boxmeup/boxmeup-core)
