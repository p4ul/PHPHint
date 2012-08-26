# PHPHint: online PHP code quality tool

PHPHint is a community-driven, quick and easy to use, online tool that analyzes your PHP code and looks for potential errors, lack of [best practices](http://paul-m-jones.com/archives/2420) and [code smell](http://en.wikipedia.org/wiki/Code_smell). It also allows you to clean your code automagically thanks to [PHP-CS-Fixer](http://cs.sensiolabs.org). It was created to spread the work about the PSR standards and the [PHP-FIG group](http://www.php-fig.org/), the importance of getting rid of code smell and applying to standards.

PHPHint only works because of other great open-source projects made by the brightest of the PHP community. It is a frontend (but also could be called a mashup) to:

* [PHP_CodeSniffer](http://pear.php.net/package/PHP_CodeSniffer), by Greg Sherwood
* [PHP-CS-Fixer](http://cs.sensiolabs.org), by Fabien Potencier
* [phploc](https://github.com/sebastianbergmann/phploc), by Sebastian Bergmann
* [PHPMD](http://phpmd.org/), by Manuel Pichler
* [PHP_Depend](http://pdepend.org/), by Manuel Pichler

## Authors and contributors
* [Klaus Silveira](http://www.klaussilveira.com) (Creator, developer)

## License
[New BSD license](http://www.opensource.org/licenses/bsd-license.php)

## Todo
* finish integration with PHPMD and PHPDepend
* HPHPA? maybe?
* refactor the whole thing, it was made in one night of pure coffee frenzy

## What it won't do
PHPHint was created to be quick and easy to use, helping spread the word about code smells and helping people follow the PSR standards. It won't fix or check your entire codebase, that's not the objective. Quick, easy, single-file analysis is the objective. If you want to run PHPHint on a project, just use the tools that power PHPHint! They were made for that.