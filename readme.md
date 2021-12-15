# Description
js script to Download invoices from Aliexpress and php script to rename invoices to a date_import_vat_aliexpress_invoicenumber.pdf format

# Download invoices from aliexpress using aliexpressInvoiceDownload.js
- go to https://trade.aliexpress.com/orderList.htm
- select "30 products per page"
- put this script content (aliexpressInvoiceDownload.js) into the chrome console.
- go to next page...

Download will start automatically.
Take note that only items with VAT has invoice. For previous you need to use some aliexpress invoice generator like...

## How this script works:

Aliexpress orders page has an array with all orderIds. It is called "idsArray".
If you look of the source url of the downloaded invoices, and also look at the javascript code of the page, you can see that this two url's are called:

https://trade.aliexpress.com/ajax/invoice/queryInvoiceIdAjax.htm?orderIds=X
https://trade.aliexpress.com/ajax/invoice/invoiceExportAjax.htm?invoiceId=Y&orderId=X

(Where X belongs to idsArray[] and Y are the JSON output of the first url)

## Possible errors
- popup blocking: disable popup blocking on aliexpress page to allow this downloads

- each pdf tries to open pdf viewer: to disable do this https://www.techieshelp.com/stop-downloads-opening-automatically-google-chrome/

# Rename invoices to date_import_vat_aliexpress_invoicenumber.pdf
This naming format helps you to organize your invoices. It is specially good for freelancers.

First, clone this repository into some web server accessible folder

## edit php script
modify first lines to fit your needs
```
$directory = "oldinvoices";
$newdirectory = "newinvoices";
$vendor = "aliexpress";
$vat = 21;
```

vat: In Spain VAT is 21% on aliexpress

directory: folder where downloaded invoices are

newdirectory: destiny folder of the renamed invoices

## execute php script
call index.php

## install pdfparser 
pdf parser is included in this repository, but if you want to install by yourself do the following:

https://www.pdfparser.org/documentation
https://github.com/smalot/pdfparser

You can do it using composer or manually.

Using composer: go to your working folder and execute:
```$ composer update smalot/pdfparser```

# TODO
- run this js script as chrome extension: https://developer.chrome.com/docs/extensions/mv3/getstarted/