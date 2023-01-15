# Installation
 ```bash
 composer require bermudaphp/hasher
 ````
 # Usage
 ```php
 $hasher = new PasswordHasher;
 
 $hash = $hasher->generateHash($password);
 $hash = new Hash($hash, $hasher);
 
 $hash->validate($password); // true
 
 ````
