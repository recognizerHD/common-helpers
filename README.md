# Common Helpers

A collection of things that go in the helpers file for various projects.

* gen_uuid = Generates a unique ID in the format of: c2ce3a4d-e729-4d76-8af3-95a982fa5f62

* showMoney = Does the same as asMoney, but has more configuration options and also shows the currency symbol.

* asMoney = Converts a value to a double with two decimal points and no thousands separator.

* dot_explode($array) = convert a dot based flat array to a multidimensional array.

## Release Notes

###### v1.3.0
* Fixed - PHP 8.5 deprecation notices for the non-canonical `(double)` cast (now `(float)`).
* Updated - Removed the dead `money_format()` branch from showMoney (the function was removed in PHP 8.0). The `$format` argument is still accepted but ignored.
* Updated - Laravel 11, 12 and 13 added to the supported framework versions.

###### v1.2.0
* Reverted - asMoney no longer using bcdiv. Reverted back to number_format. 

###### v1.1.2
* Fixed - thousands separator threw errors too.

###### v1.1.1
* Fixed - bcdiv function argument not well formed bug.

###### v1.1.0
* New - Added PHP extension bcmath as required
* Updated - composer library updates

###### v1.0.2
* Updated - Put the negative symbol first

###### v1.0.1
* New - Added License

###### v1.0.0
* Initial Commit
