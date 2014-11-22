# PHPagelizer, easy page it

User-friendly PHP pager generating array. Generate your own pager customize to your taste

***

### Step 1: Installation
Using PHPagelizer Parallax is pretty simple. You can download the PHP and put them in your own directories. Then add the following lines in your code.
```php
  require_once('../class.phpagelizer.php');
```

### Step 2: How to use
### Little programs that do one thing well :
- Just return array
- Multi-constructors
- Verified on PHP 5.4.12
- Commented with PHP DocBlock syntax

```php
      require_once('../class.phpagelizer.php');

    /** Create object with parameters :
      - current page
      - total of items
      - Number of item per page
      - Number of adjacents page (from current page)
    */
      $paging = new PHPagelizer(2, 1024, 10, 4);
      var_dump($paging->getPagination());
```

#### Attributres
- private options - array : arguments to create pagination
 - perpage int : Number of items per page</li>
 - page int : Current page</li>
 - total int : Number of items</li>
 - adjacents int : Range of page to display from current page</li>

#### Methodes
- public setOption(string, int) : Setter for arguments to create pagination</li>
- public getOptions(string) : Getter for arguments to create pagination</li>
- public getPagination() : Pager generator</li>
- public getMaxPages() : Total of pages


### Step 3: Examples
[Live Demo](http://kevin-wenger.ch/PHPagelizer)

***

## History

You can discover the history inside the [History.md](https://github.com/Sudei/PHPagelizer/blob/master/HISTORY.md#files) file

## License

Licensed under the incredibly [permissive](http://en.wikipedia.org/wiki/Permissive_free_software_licence) [MIT License](http://creativecommons.org/licenses/MIT/)

## Contributors

- [Kevin Wenger](http://github.com/Sudei)
