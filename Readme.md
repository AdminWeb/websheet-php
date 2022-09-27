AW WebSheet SDK
==========

This package software allow generates pdf (and send it by email) using our services with content in HTML.

Installation
------------

```shell
 $ composer require adminweb/websheet-php
```


Usage
-----
Creates an API Key on https://www.websheet.tech. (No credit card need)

1. Generate PDF file

```php
<?php

require 'vendor/autoload.php';
use Adminweb\Sdk\Pdf;

$pdf = new Pdf('api-key');

$content = '<html>
                <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
                    <style>
                        body {font-family: "Tangerine", serif;font-size: 48px; text-shadow: 4px 4px 4px #aaa;}
                    </style>
                </head>
                <body>
                    <div>Making the Web Beautiful!</div>
                </body>
            </html>';

$result = $pdf->make('almost finalizado', $content);

echo $result->id; // ID of file
echo $result->name; // Name of file
echo $result->url; // URL of created PDF file
// Creation date of Pdf file (returns DateTime object) (and formats brazilian format here)
echo $result->createdAt->format('d/m/Y '); 
```

2. Generate PDF file and send for email

```php
<?php

require 'vendor/autoload.php';
use Adminweb\Sdk\Pdf;

$pdf = new Pdf('api-key');

$content = '<html>
                <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
                    <style>
                        body {font-family: "Tangerine", serif;font-size: 48px; text-shadow: 4px 4px 4px #aaa;}
                    </style>
                </head>
                <body>
                    <div>Making the Web Beautiful!</div>
                </body>
            </html>';
            
// The generated file will send by email to destinatary
$result = $pdf->setDestinatary('bob@example.com')->make('almost finalizado', $content); 
```

3. Generate PDF file and send for email with your own email template (some plans).

```php
<?php

require 'vendor/autoload.php';
use Adminweb\Sdk\Pdf;

$pdf = new Pdf('api-key');

$content = '<html>
                <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
                    <style>
                        body {font-family: "Tangerine", serif;font-size: 48px; text-shadow: 4px 4px 4px #aaa;}
                    </style>
                </head>
                <body>
                    <div>Making the Web Beautiful!</div>
                </body>
            </html>';

// The generated file will send by email to destinatary 
// with template registered in https://websheet.tech
$result = $pdf->setDestinatary('bob@example.com')
              ->setTemplate('template ID')
              ->make('almost finalizado', $content); 
```
