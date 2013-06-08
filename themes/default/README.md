The styles are organized according to SMACSS (http://www.smacss.com/)
and are defined with Sass v3.2.9 SCSS syntax. (http://www.sass-lang.com)

Know both before touching anything. Neither are complicated.

You will gain much productivity in this system, but only
if you do things in a certain way.

# Deployment

Run `compass compile` in `/themes/default` to compile the source,
or `compass watch` to compile in real time.

# Directory Structure and Loading Conventions

The SCSS files in the sass directory without underscores
will be referred to as "aggregator files." All these
files do is import partials named "_index.scss"
from top level SMACSS directories (henceforth TLDs)

```
/<theme root>
    style.scss
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

Each index file itself imports all styles inside
the directory it resides in, as well as all
index files in IMMEDIATE subdirectories. style.scss is
ONLY aware of index files in TLDs. So, it is the responsibility
of index files in TLDs to include index files in subdiectories.

No index file should include any specific style
sheets in subdirectories outside of the index file.
Index files must only import specific styles
from the directory it immediately resides in.

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

For reasons why underscores prefix file names, see Conventions.

# Conventions

* Do not change or add to the TLD structure.
  Subdirectories of TLDs are permissible, but must
  be justified.

* Variable names are descriptive, and are in camelCase.

* Variables that represent common properties
  must have those properties as the first words.

        ```
        $widthSidebar;
        $widthImage;
        $widthSpan;

        $heightFooter;
        $heightNavbar;

        $fontSizeLarge;
        $fontSizeMid;
        ``` 

* Tabs are 4 spaces

* Allman indentation

* Comply with SMACSS

* Use the SCSS syntax

* Deploy with compass

* Make a new file in the appropriate location when a new set
  of styles pertaining to a particular module or concept is
  needed. So, if you are making a new module, make a new file
  just for it in "modules/". Grouped collections of modules may
  need a subdirectory.

* Start all file names with an underscore and give it the .scss extension.
  Only aggregator scss files (print, screen, ie, etc) may omit underscores.
  This configuration prevents excess CSS files from being output
  in compilation. See "Partials" in Sass reference for more information.

* @import all files in any directory inside the "_index.scss" file in that
  ssme directory. Order the imports according to CSS declarations.
  But if you are really good with CSS, order should not matter.
  Always @import "_index.scss" in subdirectories in the immediate parent
  directory's "_index.scss"
