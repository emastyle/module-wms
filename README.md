# Gian Wms Service

## This is an example module to exercise Magento backend development.

## What it does
The module adds a **Synch with WMS** button on the product edit admin page.
Pressing the button runs a request to an external service to retrieve the
inventory quantity by the provided SKU. *This functionality only works for non-composite product types and without MSI enabled.*

The result from the service is displayed in a modal alert window.

The qty returned will automatically update the quantity field on the product edit form.

After the quantity value is set on the form field, the product should be saved manually.

Results from the Web Service are stored in the `gian_wms_response_logger` table on database.

The information available are:
* sku (sku from request)
* qty (quantity for the product requests returned)
* status (0 = fail, 1 = success)
* error_reason (error reason phrase)
* create_at (date/time of the request)

## Note about the module
The button on admin calls an admin controller via Ajax which then fires a remote web service call
to retrieve the quantity for the SKU provided.
The external service is called as GET passing the sku in the url like `<WEBSERVICE_URL>?sku=XXX`.
The service should return the quantity in a JSON object like:

```
{
  qty: 123
}
```

GH workflow Action is configured to run some static tests on the module code
to check Magento 2 coding standards.

### 1. Installation:
* `composer config repositories.gian/module-wms git git@github.com:emastyle/module-wms.git`
* `composer require gian/module-wms`

or copy the code in `app/code` .

Then run:

* `bin/magento setup:upgrade`

### 2. Configuration
* Go to Stores > Configuration > Catalog > Gian Wms Service
* Enable the functionality and set the web service endpoint.

*Warning: This module doesn't support [MSI](https://github.com/magento/inventory).*
