# camohub/paginator
Paginator component for Laravel

This package solves the problem with native Laravel paginator, 
which generates urls with query string parameters for the page.

```$xslt
https://example.com/category?page=4
```

This package allows you to create pretty urls 
with page parameter according route pattern.

```$xslt
https://example.com/category/4
# with fallback to
https://example.com/category?page=4
```

Installation
------------
```
composer install camohub/paginator
```

Examples
------------

Lets imagine a controller for articles with route
```$xslt
Route::get('/{categorySlug}/{page?}', 'ArticleController@index')->name('articles');
```
The index action displays all articles in required category.

```$xslt
public function index(Request $request, $categorySlug, $page = 1)
{
    $category = Category::where('slug', $slug)->first()
    
    if( ! $category ) abort(404);
    
    $paginator = new Paginator($request, $category->articles(), 'articles', ['categorySlug' => $categorySlug]);

    $view = [
        'articles' => $paginator->getItems(),
        'paginator' => $paginator,
        'category' => $category,
    ];

    return view('articles.index', $view);
}
```
Paginator __construct() method expects second parameter to be query builder
which can call skip() and take() methods to paginate the collection.

Internal implementation looks like
```$xslt
$this->items = $this->model->skip($this->skip)->take($this->perPage)->get();
```

Options
-----------

Paginator requires 4 non optional parameters. 
1. Request object
2. Query builder / model
3. Route name
4. Route parameters

In addition there are few optional parameters which can be used to configure the paginator.
1. pageParam - the name of the route parameter which represents the page. Default is "page"
2. perPage - items per page
3. sideItemsCount - the number it items around the current page in paginator. It is ekvivalent 
of Laravel native ->onEachSide() paginator method. 

You can override the whole paginator with simple MyPaginator extends Paginator 
and also publish the template files and rewrites it. 
Current template is based on Bootstrap 4.