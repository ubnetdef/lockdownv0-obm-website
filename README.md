Lockdown v0: Office of Blue Team Management
========

This is the website that Blue Teams defended during [Lockdown v0](https://lockdown.ubnetdef.org).  This is made to be **extremely insecure**.  Do not use in a production enviroment.

## Vulnerabilities

### User Emulation
As long as you have a valid password hash, you can emulate any user. Change the cookie "user" to the UID you wish to emulate.  The cookie "pass" must still be a valid password hash of any user.

### File Editor
Currently the admin file editor can view/edit any file it has access to.  Visit `/admin/editor.php?f=/absolute/path/to/file.here`.

### User Privilege Escalation
A user can escalate their privileges by sending a POST request to `/panel/edit.php`, with the field "`admin=1`".

### Unauthoried User View/Edit
A user can edit any user, as long as they have an ID. They have the change the hidden form field "`uid`" on the `/panel/edit.php` page to the UID they wish to view/edit.

### Stored XSS
A user can update their username (by sending a POST request to `/panel/edit.php`, with field "`username=<script>alert('xss');</script>`"), and gain a stored XSS.  This can affect admin users that visit the Personnel Management page (`/admin/people.php`).