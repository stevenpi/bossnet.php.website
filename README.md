# bossnet.php.website

To setup the project locally using Apache2 follow these steps:

* Clone the Project
* Create a vhost in your Apache2 config using this template:
```
<VirtualHost *:80>
    DocumentRoot "PATH_TO_CLONED_PROJECT"
    ServerName bossnet.local
</VirtualHost>
```
**NOTE:** don't forget to replace PATH_TO_CLONED_PROJECT with your project path

* Create an entry in your hosts file in which `bossnet.local` redirects to `127.0.0.1`
  * for windows go to `C:\Windows\System32\drivers\etc`, open `hosts` and insert `127.0.0.1	bossnet.local`
* visit [http://bossnet.local](bossnet.local)
