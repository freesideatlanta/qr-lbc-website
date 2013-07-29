The styles are organized according to [SMACSS](http://www.smacss.com/)
and are defined with [Sass](http://www.sass-lang.com) v3.2.9 SCSS syntax.

Know both before touching anything. Neither are complicated.

You will gain much productivity in this system, but only if you
do things in a certain way. Conventions change rarely, and are
strictly enforced. They help maintain sanity as the project
grows larger, but it must be confessed they are harder to
deal with for smaller-scale applications. Bear with it. You'll
be happy they are there later.
    
# Deployment

Run `compass compile` in `/themes/default` to compile the source,
or `compass watch` to compile in real time.

# Directory Structure and Loading Conventions

```
/<theme root>
    ie.scss
    screen.scss
    print.scss
    _import.scss
    _config.scss
    layout/
        _index.scss
    module/
        _index.scss
    state/
        _index.scss
    theme/
        _index.scss
    base/
        _index.scss
```

## Aggregator files

SCSS without underscores will be referred to as "aggregator files."
They are to be stored in `/themes/default/sass`.

Aggregator files target a specific platform or media type, and must
always start with the line `@import "import"` to collect dependencies
before declaring rules specific to the platform or media referenced in
its name.

**Only aggregator files may be compiled to CSS files. All other files must be partials.**

Aggregator files, once compiled, represent production CSS or development CSS being tested.
Always minify Sass output in production environments.

## Dependency management

`_import.scss` must `@import` the following dependencies in this *exact order*.

1. Third party components that influence styles in more than one TLD
1. Project specific mixins
1. Variables in `_config.scss` that configure dependencies and the behavior of the site's styles in below items.
1. Common partials that each aggregator file would import if `_import.scss` did not exist.

`_import.scss` must import all TLD index files (See "Index files"), after third party dependencies.

Each aggregator file must start with the line `@import "import"`.

## Index files

Each `_index.scss` file is referred to as an "index file."

Each index file has the following responsibilities:

1. Imports all styles inside the directory it resides in
2. Imports all index files in IMMEDIATE subdirectories.
3. Imports and configures dependencies that influence only the directory it resides in, and/or *strictly more than one* subdirectory.

No index file includes any specific style sheets in subdirectories
outside of the index file. Index files must only import specific styles
from the directory it immediately resides in, and third party dependencies
if the scope is appropriate.

No index file is to import any sheet more than two directories
deep from it's current location.

Example:

```
/<theme root>
    style.scss <- imports 'module/index'
    module/
        _a.scss
        _b.scss
        _index.scss <- imports 'a', 'b', 's/index' and 't/index'
        s/
            _x.scss
            _y.scss
            _index.scss <- imports 'x', 'y' and 'deeper/index'
            deeper/
                _index.scss <- imports 'u' and 'v'
                _u.scss
                _v.scss
        t/
            _index.scss <- imports 'g' and 'h'
            _g.scss
            _h.scss
```

# Conventions

* `@import` all dependencies and their configuration in
  locations that reflect their scope of influence.

    * If an imported dependency only influences a single stylesheet,
      import and configure it in that stylesheet alone.

    * If an imported dependency influences a directory of sheets,
      import and configure it in that directory's `_index.scss`

    * If an imported dependency influences a directory and
      subdirectories, import and configure it in the most
      immediate parent's directory's `_index.scss` before
      importing subdirectory `_index.scss` files.

    * If an imported dependency influences more than one TLD,
      import the dependency in `_import.scss` and configure
      it in `_config.scss`.

* Do not rename or add directories without a strong, pragmatic reason.

* Variable names are all lowercase semantic alphanumeric characters
  with words seperated by exactly one dash. (i.e. $width-tablet-max)

* Variables that represent common properties
  must have those properties as the first words.

        $width-sidebar;
        $width-image;
        $width-span;

        $height-footer;
        $height-navbar;

        $font-size-large;
        $font-size-mid;
  
  This convention may be ignored when setting variables declared
  by third party components.

* Tabs are 4 spaces

* Always use [Allman indentation](http://x.vu/allman)

* Comply with SMACSS

* Use the SCSS syntax, where all SCSS files end with the `.scss` extension

* Deploy with compass only.

* Make a new file in the appropriate location when a new set
  of styles pertaining to a particular module or concept is
  needed. e.g, if you are making a new module, make a new file
  just for it in `module/`. Grouped collections of modules may
  need a subdirectory.

* `@import` all files in any directory inside the `_index.scss` file
  in that same directory. Order the imports according to CSS declarations.
  But if you are really good with CSS, order should not matter.
  Always `@import "<subdir>/_index.scss"` in a  parent directory's
  `_index.scss`
